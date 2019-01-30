<?php

class Lib_RouterOS
{
    const VERSION = '1.0';

    protected $_conn;
    protected $_authenticated;
    protected $_debug;
    protected $_connected;

    protected $_router;
    protected $_routerPort;
    protected $_username;
    protected $_password;

    /*%*********************************************************************%*/
    // Constructor and public methods

    public function __construct(array $options = array())
    {
        // set defaults
        $this->_router     = '192.168.0.1';
        $this->_routerPort = 8728;
        $this->_username   = 'admin';
        $this->_password   = '';

        $this->_authenticated = false;
        $this->_debug         = false;
        $this->_connected     = false;

        // attempt to set any options provided
        if (is_array($options) && sizeof($options) > 0) {
            foreach($options as $opt => $value) {
                $method = 'set' . ucfirst($opt);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                } else {
                    trigger_error('Attempting to set unknown option "' . $opt . '" in constructor', E_USER_NOTICE);
                }
            }
        }
    }

    function __destruct()
    {
        if ($this->_connected == true) {
            $this->disconnect();
        } else if ($this->_conn) {
            @fclose($this->_conn);
        }
    }

    /**
     * Connect and log in to a MikroTik router
     *
     * @param string $router          The ip address or hostname (and optional :port) of the router to log into
     * @param string $username        The user to login as (default 'admin')
     * @param string $password        The user's password  (default null)
     * @param bool $connectOnDemand   default: false - connect and authenticate immediately; true - connect and auth on first command
     * @throws Exception              If login fails or on !trap/!failure
     */
    public function connect($router, $username = 'admin', $password = null, $connectOnDemand = false)
    {
        if ($this->_connected) {
            throw new Exception('Already connected, cannot call connect()');
        }

        if (strpos($router, ':') !== false) {
            list($router, $port) = explode(':', $router, 2);
            $this->_routerPort = $port;
        }

        $this->_router   = $router;
        $this->_username = $username;
        $this->_password = $password;

        $errno = ''; $errstr = '';

        if (!$connectOnDemand) {
            $this->_debug("Connecting to $router...");

            $this->_conn = @fsockopen($router, $this->_routerPort, $errno, $errstr, 10);

            if ($this->_conn) {
                $this->_debug("Connected to router");
                $this->_connected = true;

                if ($username != '' && $password != null) {
                    try {
                          $this->login($username, $password);
                    } catch(Exception $ex) {
                          throw $ex;
                    }
                }

            } else {
                throw new Exception("Failed to connect to router.  Code $errno: $errstr");
            }
        }

        return true;
    }

    /**
     * Close connection to the router
     *
     * @return boolean true if successfully disconnected, false if failed
     */
    public function disconnect()
    {
        if (!$this->_connected) return true;

        $this->send('/quit');

        try {
            $resp = $this->read();
        } catch (Exception $ex) {
            $this->_connected     = false;
            $this->_authenticated = false;
            return true;
        }

        return false;
    }

    /**
     * Attempt to authenticate with the RouterOS API.  Router IP/host should be set already otherwise defaults to 192.168.88.1
     *
     * @param string $username  Username to log in as
     * @param string $password  Password for username
     * @throws Exception If login fails, exception is thrown
     */
    public function login($username, $password)
    {
        $this->_username = $username;
        $this->_password = $password;

        if ($this->_authenticated) return true;

        if (!$this->_connected) try { $this->_doConnect(); } catch (Exception $ex) { throw $ex; }

        $this->_debug("Starting login sequence");

        $this->send("/login");
        $resp = $this->read();

        $md5  = md5(chr(0) . $password . pack('H*', $resp['!done']['ret']));

        $this->send('/login', array('name'     => $username,
                                    'response' => '00' . $md5));

        try {
            $resp = $this->read();

            if (!isset($resp['!done'])) {
                throw new Exception('Login failed for unknown reason, !done not found');
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        $this->_authenticated = true;
        return true;
    }

    /**
     * Gets the identity (given name) of the connected router
     * @throws Exception Throws exception on !trap or !fatal, or if login fails
     * @return <string>|boolean  Returns false if identity not found, or the identity
     */
    public function getRouterIdentity()
    {
        try {
            $this->send('/system/identity/print');
            $resp = $this->read();

            foreach($resp as $k => $r) {
                if ($k === '!done') continue;

                if (isset($r['name']) && trim($r['name']) != '') {
                    return $r['name'];
                }
            }

            return false;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Send one or more commands to the router
     *
     * @param string|array $commands  A command or array of commands to send
     * @param array        $args      An optional array of name => value parameters to send encoded as =name=value
     */
    public function send($commands, $args = array())
    {
        if (!$this->_connected) try { $this->_doConnect(); } catch (Exception $ex) { throw $ex; }

        if (!is_array($commands)) $commands = array($commands);
        if (is_array($args) && sizeof($args) > 0) {
            foreach($args as $attr => $value) {
                $commands[] = "={$attr}={$value}";
            }
        }

        foreach($commands as $command) {
            $len = $this->encodeLength(strlen($command));
            $this->_debug(">>> $len $command");
            $writ = fputs($this->_conn, $len . $command);
        }

        if ($writ !== false) {
            $writ = fputs($this->_conn, $this->encodeLength(0));
        }

        if ($writ === false) {
            $this->_connected = false;
            throw new Exception('Failed to send command - connection terminated');
        }
    }

    /**
     * Read data from the API (if available).  This function will block if called and no data is available to be read
     *
     * @throws Exception If !trap or !fatal error result, or if failed to read length of command response
     * @return array Returns array of data parsed from the response
     */
    public function read()
    {
        if (!$this->_connected) try { $this->_doConnect(); } catch (Exception $ex) { throw $ex; }

        $ret   = array();
        $trap  = null;

        while(1) {
            $len  = $this->readLength();

            if ($len === false) {
                $this->_connected = false;
                throw new Exception('Failed to read length - connection terminated');
            }

            $word = $this->readWord($len);
            if (strlen($word) == 0) continue;

            $reply = $word;
            $attrs = array();

            while( ($len = $this->readLength()) > 0 ) {
                $w = $this->readWord($len);

                if ($reply == '!re') {
                    $reply = '';
                }

                $p = strpos($w, '=', 1);
                if ($p !== false) {
                    $attrs[substr($w, 1, $p - 1)] = substr($w, $p + 1);
                } else {
                    $attrs[$w] = '';
                }
            }

            if ($reply == '') {
                $ret[] = $attrs;
            } else {
                $ret[$reply] = $attrs;
            }

            if ($reply == '!trap') {
                if ($trap != null) {
                    $trap .= "Trap: {$attrs['message']}";
                } else {
                    $trap = "Trap: {$attrs['message']}";
                }
            } else if ($reply == '!fatal') { 
                if (sizeof($attrs) > 0) {
                    $keys    = array_keys($attrs);
                    $message = array_shift($keys);
                } else {
                    $message = 'Unknown Error';
                }

                fclose($this->_conn);
                $this->_conn      = null;
                $this->_connected = false;
                throw new Exception ("Fatal: $message");
            }

            if ($reply == '!done') {
                if ($trap != null) throw new Exception($trap);

                return $ret;
            }
        }
    }

    /**
     * Read a word of given $length from the API socket
     * @param int $length  The length of the data to read
     * @throws Exception If connection lost during read
     */
    public function readWord($length)
    {
        $w   = '';

        if ($length > 0) {
            $read = 0;
            while($read < $length) {
                $s = fread($this->_conn, $length - $read);

                if ($s === false) {
                    throw new Exception('Connection to router was lost');
                }

                $w    .= $s;
                $read += strlen($w);
            }

            $this->_debug("<<< $w");
        }

        return $w;
    }

    /**
     * Read an encoded length from the API socket
     * @return bool|int false if no data to be read, or the length of the next data chunk
     */
    public function readLength()
    {
        $len = fread($this->_conn, 1);
        if ($len === false) return false;

        if ( ($len & 0x80) == 0) {
            $len = ord($len);
        } else if ( ($len & 0xC0) == 0x80) {
            $len &= ~0xC0;
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
        } else if ( ($len & 0xE0) == 0xC0) {
            $len &= ~0xE0;
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
        } else if ( ($len & 0xF0) == 0xE0) {
            $len &= ~0xF0;
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
        } else if ( ($len & 0xF8) == 0xF0) {
            $len = ord(fread($this->_conn, 1));
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
            $len <<= 8;
            $len += ord(fread($this->_conn, 1));
        }

        return $len;
    }

    /**
     * Get an encoded length for sending to the API
     * @param int $length  The length of the command to encode
     * @return string Encoded length
     */
    public function encodeLength($length)
    {
        if ($length <= 0x7F) {
            return pack('C', $length);
        } else if ($length <= 0x3FFF) {
            return pack('n', ($length | 0x8000));
        } else if ($length <= 0x1FFFFF) {
            $length |= 0xC00000;
            return pack('C3', ($length >> 16) & 0xFF, ($length >> 8) & 0xFF, ($length & 0xFF));
        } else if ($length <= 0xFFFFFFF) {
            return pack('N', ($length | 0xE0000000));
        } else {
            return pack('CN', 0xF0, $length);
        }
    }

    /*%*********************************************************************%*/
    // Getters and Setters

    public function getConnected()
    {
        return $this->_connected;
    }

    public function getAuthenticated()
    {
        return $this->_authenticated;
    }

    public function getRouter()
    {
        return $this->_router;
    }

    public function setRouter($router)
    {
        $this->_router = $router;
        return $this;
    }

    public function getRouterPort()
    {
        return $this->_routerPort;
    }

    public function setRouterPort($routerPort)
    {
        $this->_routerPort = $routerPort;
        return $this;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * Enable debug output
     * @param bool $debug true to enable debug output, false to disable (default)
     */
    public function setDebug($debug)
    {
        $this->_debug = (bool)$debug;
        return $this;
    }

    /**
     * Get the value of the debug setting
     * @return boolean true if debugging enabled, false if disabled
     */
    public function getDebug()
    {
        return $this->_debug;
    }


    /*%*********************************************************************%*/
    // Protected methods

    /**
     * Helper function used by many other functions to connect to the router and support connectOnDemand option
     * @throws Exception
     */
    protected function _doConnect()
    {
        try {
            $this->connect($this->_router, $this->_username, $this->_password);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Output a debug message to the console
     * @param string $message Message to display
     */
    protected function _debug($message)
    {
        if ($this->_debug) {
            echo sprintf("%s: %s\n", date('r'), $message);
        }
    }
}

