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
 * @subpackage Cli_Util
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

// ----------------------------------
// 	Namespace
// ----------------------------------

namespace Sky\St\ORM\Cli;
use Sky\St\ORM as StORM;
use Sky\St;
use Sky;


// ----------------------------------
// 	Includes
// ----------------------------------



/**
 * StORM CLI Command
 *
 * @category   Sky
 * @package    StORM
 * @subpackage Cli_Util
 * @copyright  Copyright (c) 2011, Skyseek Technologies
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */
abstract class Command 
{
	abstract function execute();

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
	// 	Header Display
	// ----------------------------------
	
	public function drawHeader()
	{
		$version = St\ORM::getVersion();
		Sky\Cli::clEcho("                                                                 ");
		Sky\Cli::clEcho("                                                                 ");
		Sky\Cli::clEcho("      _/_/_/    _/   ", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho("    ////  ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho("      _/_/    _/_/_/    _/      _/", true, Sky\Cli::BLUE, true);
		Sky\Cli::clEcho("   _/        _/_/_/_/", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho("   ////   ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho("   _/    _/  _/    _/  _/_/  _/_/ ", true, Sky\Cli::BLUE, true);
		Sky\Cli::clEcho("    _/_/      _/     ", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho("  /////// ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho("  _/    _/  _/_/_/    _/  _/  _/  ", true, Sky\Cli::BLUE, true); 
		Sky\Cli::clEcho("       _/    _/      ", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho("    ////  ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho(" _/    _/  _/    _/  _/      _/   ", true, Sky\Cli::BLUE, true);
		Sky\Cli::clEcho("_/_/_/        _/_/   ", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho("   ///    ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho("  _/_/    _/    _/  _/      _/    ", true, Sky\Cli::BLUE, true); 
		Sky\Cli::clEcho("                     ", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho("  //      ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho("                                  ", true, Sky\Cli::BLUE, true);
		Sky\Cli::clEcho("                     ", false, Sky\Cli::BLUE, true); Sky\Cli::clEcho(" /        ", false, Sky\Cli::YELLOW, true); Sky\Cli::clEcho("                                  ", true, Sky\Cli::BLUE, true);
		Sky\Cli::clEcho("                                                     Version: {$version}");
		
		$this->drawLine();
	}

	public function drawLine($double = true)
	{
		if($double)
			Sky\Cli::clEcho("=================================================================");
		else
			Sky\Cli::clEcho("-----------------------------------------------------------------");
	}
}