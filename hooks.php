<?php

use WHMCS\Module\Addon\NemcDebugBar\DebugBar\StandardDebugBar;

add_hook( "AdminAreaPage", 1, function ( $vars ) {
	$debugbar         = new StandardDebugBar();
	$debugbarRenderer = $debugbar->getJavascriptRenderer( $GLOBALS["CONFIG"]["SystemURL"] . "/modules/addons/nemc_debug_bar/lib/DebugBar/Resources/" );

	$vars["php.debugbar.renderer"] = $debugbarRenderer;

	return $vars;
} );

add_hook( "AdminAreaHeadOutput", 1, function ( $vars ) {
	return $vars["php.debugbar.renderer"]->renderHead();
} );

add_hook( "AdminAreaFooterOutput", 1, function ( $vars ) {
	return $vars["php.debugbar.renderer"]->render();
} );