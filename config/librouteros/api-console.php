<?php
date_default_timezone_set('America/Sao_Paulo');

if (php_sapi_name() != 'cli') {
	die('Mikrotik console can only be run from the cli!');
}

require_once 'RouterOS.php';

// check for special arguments
foreach($_SERVER['argv'] as $arg) {
    $arg = trim($arg);
    if (in_array($arg, array('--help', '-h', '?', '/?'))) {
        usage();
        exit;
    }
}

// get any options passed from the command line
$router   = (isset($_SERVER['argv'][1])) ? $_SERVER['argv'][1] : '';
$username = (isset($_SERVER['argv'][2])) ? $_SERVER['argv'][2] : '';
$password = (isset($_SERVER['argv'][3])) ? $_SERVER['argv'][3] : '';

// get new instance of mikrotik api object
$mt = new Lib_RouterOS();

// set default identity for api prompt
$router_identity = 'router';

// Prompt for router if not given
if ($router == '') {
	do {
		echo "Connect to: ";
		$router = trim(fgets(STDIN));
	} while ($router == '');
}

if (strpos($router, ':') !== false) {
    // a router:port combination was supplied, validate the port
    list($router, $port) = explode(':', $router, 2);
    if (!preg_match('/^\d{1,5}$/', $port) || (int)$port > 65535) {
        die('Invalid port "' . $port . '" provided.' . "\n");
    }
}

try {
	// attempt to connect or terminate if connection fails
	// if router has default admin password, this will auto log in
	$mt->connect($router);
} catch (Exception $ex) {
	die('Failed to connect to router.  Reason: ' . $ex . "\n");
}

if (!$mt->getAuthenticated()) {
    do { // login until success or quit
    	// prompt for username if not given
    	if ($username == '') {
    	    echo "Username [admin]: ";
    		$username = trim(fgets(STDIN));
    		if ($username == '') $username = 'admin';
    	}

    	// If password not given on command line, prompt for it and allow empty password
    	if ($password == '') {
    		echo "Password (blank for none): ";
    		$password = trim(fgets(STDIN));
    	}

    	try {
    		// try to login, exit loop on success
    		$mt->login($username, $password);
    		break;

    	} catch (Exception $ex) {
    		// clear username and password, reprompt and try again
    		$username = '';
    		$password = '';
    		echo "Login failed.  Response: " . $ex->getMessage() . "\n";
    	}
    } while (true);
} else {
    echo "Connected to router with default credentials.\n";
}

echo "Connected, type \"/quit\" or press ^C to disconnect.\n"
    ."Terminate API sentences with an empty line or ;\n\n";

// get the name (identity) of the current router
$identity = $mt->getRouterIdentity();
if ($identity) $router_identity = $identity;

// set up command sentence to send
$sentence = array();

do {
    // infinite loop, while in console
    // prompt for commands, send when terminated, read and display response

	// print prompt
	if (sizeof($sentence) == 0) {
		echo "$router_identity>";
	} else {
		$action = $sentence[0];
		echo "$router_identity $action>";
	}

	// read a line of input
	$input = trim(fgets(STDIN));

	if (strlen($input) > 0 && $input{0} != '/') {
		// if there is input that does not begin with "/"
		if ($input == 'quit' || $input == 'exit' || $input == (chr(4))) {
			// check for one or more ways to quit
			$input = '/quit';
		} else if ($input == 'setdebug') {
			// toggle debug output
			$dbg = $mt->getDebug();
			$mt->setDebug(!$dbg);
			if ($dbg) echo "Debugging disabled\n"; else echo "Debugging enabled\n";
			continue;
		}
	}

	if ($input == '' || $input == '/quit' || substr($input, -1) == ';') {
		// if input was empty, or quit - send sentence
		if ($input == '/quit') $sentence = array($input);

		if (substr($input, -1) == ';') {
		    if (trim($input) != '') {
		        $sentence[] = substr($input, 0, -1);
		    }
		}

		if (sizeof($sentence) > 0) {
			// only send if we have something to send
			$mt->send($sentence);

			try {
				// try to read until !done
				$response = $mt->read(); // throws exception

				print_response($response); // print out the parsed response

				$sentence = array(); // reset input sentence
			} catch (Exception $ex) {
				if ($input == '/quit') {
					// if exception on quit, then command was successful
					echo "Disconnected.\n";
					exit(0);
				} else {
					// caught trap or fatal error
					echo "Command failed: " . $ex->getMessage() . "\n";
					$sentence = array(); // reset input

					if (strpos($ex->getMessage(), '!fatal') !== false) {
						// terminate on fatal error, router has closed connection
						exit(1);
					}
				}
			}
		}
	} else {
		// append the input to the sentence
		$sentence[] = $input;
	}
} while (true);


function print_response($response)
{
	foreach ($response as $key => $val) {
		if (is_int($key)) {
			// numeric keys are !re entries
			echo "!re\n";
		} else {
			// !done, !trap, !fatal etc
			echo "$key\n";
		}

		foreach($val as $name => $v) {
			// echo each property
			// !done usually has 0 properties
			echo "=$name=$v\n";
		}
	}
}

function usage()
{
    printf("Usage: php %s [router[:port=8728]] [username] [password]\n\n"
          ."Connect to router with the supplied username and password.\n"
          ."Arguments must be supplied in the above order; any missing paramters "
          ."will be\nprompted for before connecting.\n",
           $_SERVER['argv'][0]);
}
