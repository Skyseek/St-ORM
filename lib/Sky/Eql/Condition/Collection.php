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
 * Collection of Conditions
 *
 * @category   Sky
 * @package    StORM
 * @subpackage Eql
 * @copyright  Copyright (c) 2011, Skyseek Technologies
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */
class Collection extends Eql\Condition
{

	public function createChildCollection($logicalOperatorType = self::LO_AND)
	{ 
		$childCollection = new Collection();
		$childCollection->setParentCollection($this);
		$childCollection->setLogicalOperatorType($logicalOperatorType);
		$this->_conditions[] = $childCollection;

		return $childCollection;
	}

	// ----------------------------------
	// 	Parent Condition Collection
	// ----------------------------------
	
	protected $_parentConditionCollection = null;

	public function setParentCollection(Collection $parentConditionCollection)
	{
		$this->_parentConditionCollection = $parentConditionCollection;
	}

	public function getParentCollection()
	{
		return $this->_parentConditionCollection;
	}


	// ----------------------------------
	// 	Conditions
	// ----------------------------------

	protected $_conditions = array();

	public function addCondition(Eql\Condition $sqlCondition) 
	{
		$this->_conditions[] = $sqlCondition;
	}

	public function addComparisonConditionFromTokenArray(array $tokenArray, $logicalOperatorType) 
	{
		if(count($tokenArray) == 0){
			return false;
		}

		require_once 'Sky/Eql/Condition/Comparison.php';
		$sqlCondition = new Comparison();
		$sqlCondition->parseTokenArray($tokenArray);
		$sqlCondition->setLogicalOperatorType($logicalOperatorType);

		return $this->addCondition($sqlCondition);
	}

	// ----------------------------------
	// 	Temporary SQL Buidler - For Debugging the parser.
	// ----------------------------------
	
	public function __toString() {

		$sql = '(';

		for($i=0;$i<count($this->_conditions);$i++) {
			if($i>0)
				$sql .= ' ' . $this->_conditions[$i]->getLogicalOperatorType() . ' ';
			
			$sql .= $this->_conditions[$i];
		}

		return $sql . ')';
	}
	
}