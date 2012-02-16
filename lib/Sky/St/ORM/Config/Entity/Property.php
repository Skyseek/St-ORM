<?php
/**
 * Skyseek License, Version 1.0
 *
 * This file contains Original Code and/or Modifications of Original Code
 * as defined in and that are subject to the Skyseek License
 * Version 1.0 (the 'License'). You may not use this file except in
 * compliance with the License. Please obtain a copy of the License at
 * http://www.skyseek.com/License/Version1 and read it before using this
 * file.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 * @package    Skyseek
 * @subpackage StORM
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

namespace Sky\St\ORM\Config\Entity;
use Sky\St\ORM\Config\Entity\Property;

/**
 * Available Property Styles for Entities
 *
 * @package    Skyseek
 * @subpackage StORM
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Property
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	protected $_alias;
	protected $_defaultValue;
	protected $_length;
	protected $_percision;
	protected $_name;
	protected $_style;
	protected $_type;
	protected $_validators;


	// ====================================================================
	//
	// 	Magic Methods
	//
	// ====================================================================
	
	public function __get($propertyName)
	{
		$getterName = 'get' . ucwords($propertyName);

		if(method_exists($this, $getterName)) {
			return $this->$getterName();
		} else {
			require_once 'Sky/St/ORM/Config/Entity/Property/Exception.php';
			throw new Property\Exception("Unknown Property '{$propertyName}'.");
		}
	}

	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	public function setName($name, $alias=null)
	{
		$this->_name	= $name;
		$this->_alias	= $alias;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getAlias()
	{
		
	}


	// ----------------------------------
	// 	Property Type
	// ----------------------------------
	
	public function setType($type, $length=11, $percision=2)
	{
		switch($type) {
			case Property\Type::INTEGER;
			case Property\Type::DOUBLE;
			case Property\Type::FLOAT;
			case Property\Type::BOOLEAN;
			case Property\Type::STRING;
			case Property\Type::TIME;
			case Property\Type::DATE;
			case Property\Type::TIMESTAMP;
				$this->_type = $type;
				break;

			default:
				require_once 'Sky/St/ORM/Config/Entity/Property/Exception.php';
				throw new Property\Exception("Unknown Property Type '{$type}'.");
		}

		if(is_int($length)) {
			$this->_length = $length;
		} else {
			require_once 'Sky/St/ORM/Config/Entity/Property/Exception.php';
			throw new Property\Exception("Invalid Property Length. Must be a integer.");
		}

		if(is_int($percision)) {
			$this->_percision = $percision;
		} else {
			require_once 'Sky/St/ORM/Config/Entity/Property/Exception.php';
			throw new Property\Exception("Invalid Property Percision. Must be a integer.");
		}
	}

	public function getType()
	{
		return $this->_type;
	}

	public function getLength()
	{
		return $this->_length;
	}

	public function getPercision()
	{
		return $this->_percision;
	}


	// ----------------------------------
	// 	Property Style
	// ----------------------------------
	
	public function setStyle($style)
	{
		switch($style) {
			case Property\Style::VARIABLE;
			case Property\Style::MUTATOR;
				$this->_style = $style;
				break;

			default:
				require_once 'Sky/St/ORM/Config/Entity/Property/Exception.php';
				throw new Property\Exception("Unknown Property Style '{$style}'.");
		}
	}

	public function getStyle()
	{
		return $this->_style;
	}

}