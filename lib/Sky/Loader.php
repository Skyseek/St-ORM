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

namespace Sky;

/**
 * Class Loader
 *
 * @package    Skyseek
 * @subpackage StORM
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Loader
{
	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	public static function getInstance()
	{
		if(static::$_instance == null) {
			static::$_instance = new static();
		}

		return static::$_instance;
	}


	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	protected $_includeDirs;
	protected $_loadedClasses;


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
		
	public function __construct($includeDir) 
	{
		
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================

	public function load($className)
	{
		if($this->canLoad($className)) {
			
		}
	}

	public function canLoad($className)
	{
		
	}

	public function isLoaded($className) 
	{
		
	}
}