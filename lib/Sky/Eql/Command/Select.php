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

// ----------------------------------
// 	Namespace
// ----------------------------------

namespace Sky\Eql\Command;
use Sky\Eql;


// ----------------------------------
// 	Includes
// ----------------------------------

require_once 'Sky/Eql/Command.php';
require_once 'Sky/Eql/Condition.php';
require_once 'Sky/Eql/Condition/Collection.php';
require_once 'Sky/Eql/Condition/Collection.php';


class Select extends Eql\Command
{
	public $from = array();
	public $where = null;

	public function parseTokenizer(Eql\Tokenizer $tokenizer)
	{
		$mode = null;
		$currentCollection = null;
		$currentConditionTokens = array();
		$currentLogicalOperator = Eql\Condition::LO_AND;

		foreach($tokenizer->getTokens() as $token) {

			$token = trim($token);

			if($token == '') {
				continue;
			}

			$commandToken = strtoupper($token);

			if(array_search($commandToken, array('SELECT', 'FROM', 'WHERE', 'LIMIT', 'ORDER')) !== false) {
				if($mode == 'WHERE') {
					//Clean up last where command.
					$currentCollection->addComparisonConditionFromTokenArray($currentConditionTokens, $currentLogicalOperator);
				}

				$mode = $commandToken;
				continue;
			}

			if(!$mode) {
				throw new Exception("No Command Mode?");
			} else if($mode == 'SELECT') {
				//We don't care about column names. At least not in this version.
			} else if($mode == 'FROM') {
				//EntityNames
				if(count($this->from) > 0)
					throw new Exception("StORM only supports one FROM tag for now. maybe forever?");

				$this->from[] = $token;
			} else if($mode == 'WHERE') {

				//If we have no collection. 
				if($this->where == null) {
					$this->where = $currentCollection = new Eql\Condition\Collection();
				}

				if($token == '(') {
					//Start Sub Condition Collection.
					$currentCollection = $currentCollection->createChildCollection($currentLogicalOperator);					
					$currentConditionTokens = array();

				} else if($token == ')') {
					//End Sub Condition Collection
					$currentCollection->addComparisonConditionFromTokenArray($currentConditionTokens, $currentLogicalOperator);
					$currentConditionTokens = array();

					$currentCollection = $currentCollection->getParentCollection();
				} else {
					if(array_search($commandToken, array('AND', '&&')) !== false) {
						//Parse Current Tokens
						$currentCollection->addComparisonConditionFromTokenArray($currentConditionTokens, $currentLogicalOperator);
						$currentConditionTokens = array();

						//Set Current Logical Operator
						$currentLogicalOperator = Eql\Condition::LO_AND;
					} else if(array_search($commandToken, array('OR', '||')) !== false) {
						//Parse Current Tokens
						$currentCollection->addComparisonConditionFromTokenArray($currentConditionTokens, $currentLogicalOperator);
						$currentConditionTokens = array();

						$currentLogicalOperator = Eql\Condition::LO_OR;
					} else {
						//Nom Nom Nom... Eat some tokens...
						$currentConditionTokens[] = $token;
					}
				}
			}
		}

		if($mode == 'WHERE') {
			$currentCollection->addComparisonConditionFromTokenArray($currentConditionTokens, $currentLogicalOperator);
		}

		return $this;
	}

	public function __toString() {
		return "SELECT FROM `{$this->from[0]}` WHERE " . $this->where;
	}
}