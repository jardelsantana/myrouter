<?php
	/* Class Map */
	abstract class ClassMap
	{
		private $_classMap;
		
		public function __construct($map)
		{
			$this->_classMap = $map;
		}
		
		public function getClassMap()
		{
			return $this->_classMap;
		}
	}
	
	/* Enumeration */
	abstract class Enumeration 
	{
		
	}


	/**
	 * Util - Diversas funcionalidades para manipulacao de dados e objetos
	 * @author Gustavo Gatto (inbox@gustavogatto.net)
	 */
	
	final class Util
	{
		public static function objectToArray($object)
		{
			$array = array();
			$list  = (is_object($object)) ? get_object_vars($object) : $object;
		    foreach  ($list as $key => $val)
		    {
		        $val       = (is_array($val) || is_object($val)) ? Util::objectToArray($val) : $val;
		        $array[$key] = $val;
		    }
		    
		    return $array;
		}
		
		public static function arrayToObject($array, $object = NULL)
		{
			$classMap = array();
			if (is_object($array))
			{
				$array = Util::objectToArray($array);
			}
			
			if ($object instanceof ClassMap)
			{
				$classMap = $object->getClassMap();
				foreach ($array as $field => $value)
				{
					if (array_key_exists($field, $classMap))
					{
						$type = $classMap[$field];
						switch ($type)
						{
							case 'string'  : $object->$field =   strval($value); break;
							case 'boolean' : $object->$field =   intval($value); break;
							case 'integer' : $object->$field =   intval($value); break;
							case 'float'   : $object->$field = floatval($value); break;
							case 'datetime': $object->$field = Util::convertToTimestamp($value); break;
							default:
								
								if (class_exists($type))
								{
									$newObject = new $type();
									if ($newObject instanceof Enumeration)
									{
										$object->$field = $value;
									}
									else
									{
										$newArray   = (isset($value[$type][0])) ? $value[$type] : $value;
										$listObject = array();
										
										foreach ($newArray as $k => $v)
										{
											$newObject = new $type();
											$listObject[count($listObject)] = Util::arrayToObject($v, $newObject);
										}
										
										$object->$field = $listObject;
									}
								}
							break;
						}
					}
				}
			}
			
			return $object;
		}
		
		public static function convertToTimestamp($string)
		{
			$split = explode('T', $string);
			$date  = explode('-', $split[0]);
			$time  = explode(':', $split[1]);
			
			return mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
		}
	}



	/**
	 * WebService - Manipula as classes de SOAP para integracao WebService.
	 * @author Gustavo Gatto (inbox@gustavogatto.net)
	 */
	
	class WebService
	{
		private $_wsSoapHeader      = NULL;
		private $_wsSoapClient      = NULL;
		
		private $_authCredentials   = false;
		private $_authNamespace     = NULL;
		private $_authVarName       = NULL;
		private $_authVars          = array();
		
		private $_wsUriLocationWsdl = NULL;
		private $_wsOptions         = array();
		
		private $_wsCalledMethod    = NULL;
		
		public function __construct($wsUriLocationWsdl = NULL, $wsOptions = array())
		{
			$this->_wsUriLocationWsdl = $wsUriLocationWsdl;
			$this->_wsOptions         = $wsOptions;
		}
		
		public function setCredentials($authVars, $authNamespace = NULL, $authVarName = NULL)
		{
			$this->_authVars        = $authVars;
			$this->_authNamespace   = $authNamespace;
			$this->_authVarName     = $authVarName;
			$this->_authCredentials = true;
			$this->setSoapHeader();
		}
		
		public function setSoapHeader(SoapHeader $wsSoapHeader = NULL)
		{
			if ($wsSoapHeader instanceof SoapHeader)
			{
				$this->_wsSoapHeader = $wsSoapHeader;
			}
			else
			{
				$this->_wsSoapHeader = new SoapHeader($this->_authNamespace, $this->_authVarName, $this->_authVars, false);
			}
		}
		
		public function setSoapClient(SoapClient $wsSoapClient = NULL)
		{
			if ($wsSoapClient instanceof SoapClient)
			{
				$this->_wsSoapClient = $wsSoapClient;
			}
			else
			{
				$this->_wsSoapClient = new SoapClient($this->_wsUriLocationWsdl, $this->_wsOptions);
				
				if ($this->_authCredentials)
				{
					$this->_wsSoapClient->__setSoapHeaders($this->_wsSoapHeader);
				}
			}
		}
		
		public function callMethod($methodName, $params = array())
		{
			if (!($this->_wsSoapClient instanceof SoapClient))
			{
				$this->setSoapClient();
			}
			
			$this->_wsCalledMethod = $methodName;
			
			if ($this->_authCredentials)
			{
				return $this->_wsSoapClient->__soapCall($methodName, $params, NULL, $this->_wsSoapHeader);
			}
			else
			{
				return $this->_wsSoapClient->__soapCall($methodName, $params);
			}
		}
		
		public function getLastCalledMethod()
		{
			return $this->_wsCalledMethod;
		}
		
		public function getLastRequestHeaders()
		{
			if ($this->_wsSoapClient instanceof SoapHeader)
			{
				return $this->_wsSoapClient->__getLastRequestHeaders();
			}
			else
			{
				return NULL;
			}
		}
		
		public function getLastRequest()
		{
			if ($this->_wsSoapClient instanceof SoapHeader)
			{
				return $this->_wsSoapClient->__getLastRequest();
			}
			else
			{
				return NULL;
			}
		}
		
		public function getLastResponseHeaders()
		{
			if ($this->_wsSoapClient instanceof SoapHeader)
			{
				return $this->_wsSoapClient->__getLastResponseHeaders();
			}
			else
			{
				return NULL;
			}
		}
		
		public function getLastResponse()
		{
			if ($this->_wsSoapClient instanceof SoapHeader)
			{
				return $this->_wsSoapClient->__getLastResponse();
			}
			else
			{
				return NULL;
			}
		}
	}
