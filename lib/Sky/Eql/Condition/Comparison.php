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

namespace Sky\Eql\Condition;
use Sky\Eql;


// ----------------------------------
// 	Includes
// ----------------------------------

require_once 'Sky/Eql/Condition.php';


/**
 * Comparison Condition
 *
 * @category   Sky
 * @package    StORM
 * @subpackage Eql
 * @copyright  Copyright (c) 2011, Skyseek Technologies
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */
class Comparison  extends Eql\Condition
{
	//Comparison Operator
	const CO_EQUALS = 1;
	const CO_NOT_EQUALS = 2;
	const CO_GREATER_THAN = 3;
	const CO_GREATER_THAN_OR_EQUAL = 4;
	const CO_LESS_THAN = 5;
	const CO_LESS_THAN_OR_EQUAL = 6;
	const CO_LIKE = 7;
	const CO_NOT_LIKE = 8;
	const CO_IS_NULL = 9;
	const CO_IS_NOT_NULL = 10;
	const CO_IN = 11;
	const CO_NOT_IN = 12;

	protected $_comparisionOperatorType = self::CO_EQUALS;

	protected $_entityProperty;
	protected $_comparisonValue;


	public function parseTokenArray(array $tokens) 
	{
		if(count($tokens) == 3) {
			switch($tokens[1]) {
				case '=':
					$this->_comparisionOperatorType = self::CO_EQUALS;
					break;

				case '!=':
					$this->_comparisionOperatorType = self::CO_NOT_EQUALS;
					break;

				case '!=':
					$this->_comparisionOperatorType = self::CO_NOT_EQUALS;
					break;

				case '>':
					$this->_comparisionOperatorType = self::CO_GREATER_THAN;
					break;

				case '>=':
					$this->_comparisionOperatorType = self::CO_GREATER_THAN_OR_EQUAL;
					break;

				case '<':
					$this->_comparisionOperatorType = self::CO_LESS_THAN;
					break;

				case '<=':
					$this->_comparisionOperatorType = self::CO_LESS_THAN_OR_EQUAL;
					break;

				case 'LIKE':
				case 'like':
					$this->_comparisionOperatorType = self::CO_LIKE;
					break;
			}

			if($this->_comparisionOperatorType !== null) {
				$this->_entityProperty = $tokens[0];
				$this->_comparisonValue = $tokens[2];
			}
		}
	}

	public function __toString() 
	{
		switch($this->_comparisionOperatorType) {
			case self::CO_EQUALS:
				return "`{$this->_entityProperty}`='{$this->_comparisonValue}'";
			case self::CO_NOT_EQUALS:
				return "`{$this->_entityProperty}`!='{$this->_comparisonValue}'";
		}
	}
	
}