<?php

// ----------------------------------
// 	Namespace
// ----------------------------------

namespace Sky\St\ORM;
use Sky;


// ----------------------------------
// 	Includes
// ----------------------------------

define("CURRENT_DIR", getcwd());
define("STORM_DIR", dirname(dirname(__FILE__)));

set_include_path(STORM_DIR . '/lib/');


require_once STORM_DIR . '/bin/lib/Cli.php';


$storm = new CliUtil();
$storm->run();

class CliUtil
{
	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	public static function getInstance()
	{
		if(!self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}

	public static function resetInstance()
	{
		self::$_instance = null;
	}

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	protected $_args = null;
	protected $_version = '0.1.';

	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================

	// ----------------------------------
	// 	Config
	// ----------------------------------
	
	protected $_config;

	public function getConfig()
	{
		if(!$this->_config) {
			require_once STORM_DIR . '/lib/Sky/St/ORM/Config.php';

			$this->_config = new \Sky\St\ORM\Config();
			$this->_config->parseConfigArray($this->getConfigArray());
		}
		
		return $this->_config;
	}

	public function getConfigArray()
	{
		if(!$this->_configArray) {
			require_once STORM_DIR . '/bin/lib/spyc.php';
			$this->_configArray = \Spyc::YAMLLoad(realpath(dirname(__FILE__) . '/../config/app.yml'));
		}

		return $this->_configArray;
	}

	public function getConfigPath()
	{
		return STORM_DIR . '/config/schema.yml';
	}

	// ----------------------------------
	// 	Command Executor
	// ----------------------------------

	public function execute()
	{
		if(count($this->_args) == 1)
			$commandName = 'Info';
		else {
			$commandName = ucwords(strtolower($this->_args[1]));
		}

		$commandFilePath = STORM_DIR . '/lib/Sky/St/ORM/Cli/Command/' . $commandName . '.php';

		if(!file_exists($commandFilePath)) {
			require_once STORM_DIR . '/lib/Sky/St/ORM/Cli/Exception.php';
			throw new Cli\Exception("Unknown/Unsupported Command '$commandName'");
		}

		require_once($commandFilePath);

		$commandClassName = "\\Sky\St\\ORM\\Cli\\Command\\$commandName";

		if(!class_exists($commandClassName)) {
			require_once STORM_DIR . '/lib/Sky/St/ORM/Cli/Exception.php';
			throw new Cli\Exception("Unknown/Unsupported Command '$commandName'");
		}

		$command = new $commandClassName();
		$command->setArguments($this->_args);
		$command->execute();
	}
}

class Entity
{
	public $storm;

	public $name;
	public $namespace;
	public $properties;

	public function __construct(CliUtil $storm, $name, $config)
	{
		$this->storm = $storm;
		$this->name = $name;
		$this->parseConfig($config);
	}

	public function parseConfig($config) 
	{
		foreach($config as $prop=>$config) {
			if(!is_array($config)) {
				$config = array();
			}

			$this->properties[] = new EntityProperty($this, $prop, $config);
		}
	}

	public function buildEntity()
	{
		ob_start();
		include 'templates/mapper.php';
		echo $entity = ob_get_clean();
		exit;
	}

	public function getMapperVariableName()
	{
		$mapperName = $this->getMapperClassName();

		return strtolower($mapperName{0}) . substr($mapperName, 1);

	}

	public function getMapperClassName()
	{
		return $this->name . "Mapper";
	}

}


class EntityProperty
{
	public $entity;

	public $name;
	public $key;
	public $type;

	public function __construct(Entity $entity, $name, array $config)
	{
		$this->entity = $entity;
		$this->name = isset($config['name']) ? $config['name'] : $name;
		$this->key = $name;

		if(isset($config['type'])) {
			$this->type = $config['type'];
		} else {
			$this->type = $this->entity->storm->default_type;
		}

	}

	public function isSimpleType()
	{
		switch($this->type) {
			case 'string':
			case 'int':
				return true;
			
			default:
				return false;
		}
	}

	public function isMappedEntity()
	{
		if(!$this->isSimpleType() && $this->entity->storm->hasEntity($this->type)) {
			return true;
		} else {
			return false;
		}
	}

	public function getMappedEntity()
	{
		return $this->entity->storm->getEntity($this->type);
	}
}