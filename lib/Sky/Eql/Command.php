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
// 	Namespace
// ----------------------------------

namespace Sky\Eql;


// ----------------------------------
// 	Includes
// ----------------------------------

require_once 'Sky/Eql/Tokenizer.php';

/**
 * EQL Command
 *
 * @category   Sky
 * @package    StORM
 * @subpackage Eql
 * @copyright  Copyright (c) 2011, Skyseek Technologies
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */
abstract class Command 
{
	abstract function parseTokenizer(Tokenizer $tokenizer);

	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	public function __construct($input) 
	{
		if($input instanceof Tokenizer)
			$this->parseTokenizer($input);
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	// ----------------------------------
	// 	Arguments
	// ----------------------------------

	protected $_arguments;

	public function setArguments(array $arguments) 
	{
		$this->_arguments = $arguments;
	}

	public function getArguments()
	{
		return $this->_arguments;
	}
		
			

	// ----------------------------------
	// 	Magic Methods
	// ----------------------------------
	
	public function __toString() 
	{
		return __CLASS__;
	}
}