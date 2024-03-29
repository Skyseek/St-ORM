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
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */


// ----------------------------------
// 	Namespaces
// ----------------------------------

namespace Sky\St\ORM\Entity;
use \Sky\St\ORM as StORM;

// ----------------------------------
// 	Includes
// ----------------------------------

require_once 'Sky/St/ORM/Entity.php';

/**
 * Entity Collection
 *
 * @package    Skyseek
 * @subpackage StORM
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
abstract class Collection implements \Iterator, \Countable
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
    /**
     * @var string Result class to use for individual items
     */
    protected $_entityClass;

    /**
     * @var array Actual results
     */
    protected $_items = array();


    // ====================================================================
    //
    // 	Constructor
    //
    // ====================================================================
    

    /**
     * Constructor
     *
     * @param  array|Traversable $results
     * @return void
     */
    public function __construct(Array $items = null) {
        if (!$this->_entityClass)
            throw new StORM\Exception('No entity class specified!');

		if($items)
			$this->addItems($items);
    }

    // ====================================================================
    //
    // 	Public Methods
    //
    // ====================================================================
    

	public function addItems(array $items) {
		foreach($items as $item)
			$this->addItem($item);
	}

	public function addItem(StORM\Entity $item) {
		if(!$item instanceof  $this->_entityClass)
			throw new StORM\Exception('Invalid item type.');

		$this->_items[] = $item;
	}

	// ====================================================================
	//
	// 	Interface Supports
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Countable
	// ----------------------------------
	

	/**
	 * Countable: return count of items in result set
	 *
	 * @return int
	 */
	public function count() {
		return count($this->_items);
	}

	
	// ----------------------------------
	// 	Iterator
	// ----------------------------------


	/**
	 * Iterator: return current item
	 */
	public function current() {
		return current($this->_items);
	}

	/**
	 * Iterator: return current key
	 *
	 * @return int|string
	 */
	public function key() {
		return key($this->_items);
	}

	/**
	 * Iterator: advance to next item in result set
	 *
	 * @return void
	 */
	public function next() {
		return next($this->_items);
	}

	/**
	 * Iterator: rewind to first item in result set
	 *
	 * @return void
	 */
	public function rewind() {
		return reset($this->_items);
	}

	/**
	 * Iterator: is the current item valid
	 *
	 * @return bool
	 */
	public function valid() {
		return (bool) $this->current();
	}
}
