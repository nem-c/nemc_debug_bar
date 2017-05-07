<?php
/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WHMCS\Module\Addon\NemcDebugBar\DebugBar;

use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\ExceptionsCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\MemoryCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\MessagesCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\TimeDataCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\PhpInfoCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\RequestDataCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\ConfigCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\CapsuleCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\ConstantsDataCollector;
use WHMCS\Database\Capsule;

/**
 * Debug bar subclass which adds all included collectors
 */
class StandardDebugBar extends DebugBar {
	public function __construct() {
		$this->addCollector( new PhpInfoCollector() );
		$this->addCollector( new ConstantsDataCollector() );
		$this->addCollector( new RequestDataCollector() );
		$this->addCollector( new MemoryCollector() );
		$this->addCollector( new ConfigCollector( $GLOBALS["CONFIG"] ) );
		$this->addCollector( new CapsuleCollector( Capsule::connection()->getQueryLog() ) );
		$this->addCollector( new ExceptionsCollector() );
		$this->addCollector( new TimeDataCollector() );

	}
}
