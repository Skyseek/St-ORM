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

namespace Sky\St\ORM\Cli\Command;
use Sky\St\ORM as StORM;
use Sky\St;
use Sky;



// ----------------------------------
// 	Includes
// ----------------------------------

require_once 'Sky/St/ORM/Cli/Command.php';
require_once 'Sky/St/ORM.php';


/**
 * StORM CLI Command
 *
 * @category   Sky
 * @package    StORM
 * @subpackage Cli_Util
 * @copyright  Copyright (c) 2011, Skyseek Technologies
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */
class Info extends StORM\Cli\Command 
{
	public function execute()
	{
		$this->drawHeader();
		Sky\Cli::clEcho("StORM Directory - " . STORM_DIR);
		Sky\Cli::clEcho("StORM Config    - " . StORM\CliUtil::getInstance()->getConfigPath());
		Sky\Cli::nl();

		Sky\Cli::clEcho("Storage: PDO (MySQL)");
		$this->drawLine(false);
		Sky\Cli::clEcho(" -> DB Name     - GiftCerts");
		Sky\Cli::clEcho(" -> DB Host     - localhost");
		Sky\Cli::clEcho(" -> DB User     - root");
		Sky\Cli::clEcho(" -> DB Pass     - BLANK");
		Sky\Cli::nl();

		Sky\Cli::clEcho("Vender (None)");
		$this->drawLine(false);
		Sky\Cli::nl();

		Sky\Cli::clEcho("Members");
		$this->drawLine(false);
		Sky\Cli::clEcho(" -> " . count(StORM\CliUtil::getInstance()->getEntities()) . " Entities");

		Sky\Cli::nl();
	}
}
