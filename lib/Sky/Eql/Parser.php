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
 * @category   Sky
 * @package    StORM
 * @subpackage Eql
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

// ----------------------------------
// 	Namespaces
// ----------------------------------

namespace Sky\Eql;


// ----------------------------------
// 	Includes
// ----------------------------------

require_once 'Sky/Eql/Tokenizer.php';


/**
 * Eql Parser Factory
 *
 * @uses       \Sky\Eql\Tokenizer
 * @category   Sky
 * @package    StORM
 * @subpackage Eql
 * @copyright  Copyright (c) 2011, Skyseek Technologies
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */
class Parser
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	public $tokenizer;

	
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
	// 	Constructor
	//
	// ====================================================================

	public function __construct()
	{
		$this->tokenizer = new Tokenizer();
	}

	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	public function createCommandFromEql($eql)
	{
		$this->tokenizer->reset();
		$this->tokenizer->parseEql($eql);

		return $this->getCommand(); 		
	}

	public function getCommand()
	{
		switch(strtoupper($this->tokenizer->getToken(0))) {
			case 'SELECT':
				require_once('Sky/Eql/Command/Select.php');
				return new Command\Select($this->tokenizer);

			case 'DELETE':
				require_once('Sky/Eql/Command/Delete.php');
				return new Command\Delete($this->tokenizer);

			case 'UPDATE':
				require_once('Sky/Eql/Command/Update.php');
				return new Command\Update($this->tokenizer);

			case 'INSERT':
				require_once('Sky/Eql/Command/Insert.php');
				return new Command\Insert($this->tokenizer);

			default:
				require_once 'Sky/Eql/Exception.php';
				throw new Exception("Uknown Command '{$this->tokens[0]}'");
		}
	}
}