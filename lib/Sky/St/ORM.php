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
// 	Namespaces
// ----------------------------------

namespace Sky\St;
use Sky\Eql;

// ----------------------------------
// 	Includes
// ----------------------------------


/**
 * StORM Utility Class
 *
 * @package    Skyseek
 * @subpackage StORM
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class ORM
{
	const ENTITY_DIR	= '/model/entity';
	const MAPPER_DIR	= '/model/entity/mapper';

	public static function getVersion()
	{
		return '0.1';
	}

	public static function eql($eql) 
	{
		require_once 'Sky/Eql/Parser.php';
		
		$command = Eql\Parser::getInstance()->createCommandFromEql($eql);

		if(func_num_args() > 1)
			$command->setArguments(array_slice(func_get_args(), 1));

		return $command;
	}

	public static function getEntityMapper($entityName)
	{
		$mapperClassName = $entityName . 'Mapper';

		if(!class_exists($mapperClassName)) {
			if(!EntityMapperLoader::getInstance()->canLoadClass($mapperClassName)) {
				throw new \Sky\Exception("Unable to find mapper for entity '$entityName'");
			}

			EntityMapperLoader::getInstance()->loadClass($mapperClassName);

			if(!class_exists($mapperClassName)) {
				require_once 'Sky/Exception.php';
				throw new \Sky\Exception("Unable to find mapper class for entity '$entityName'");
			}
		}

		return $mapperClassName::getInstance();
	}
}