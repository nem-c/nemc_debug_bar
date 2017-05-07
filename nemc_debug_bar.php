<?php

if ( ! defined( "WHMCS" ) ) {
	die( "This file cannot be accessed directly" );
}

function nemc_debug_bar_config() {
	return [
		"name"        => "Debug Bar",
		"description" => "WHMCS integration of PHP Debug Bar",
		"version"     => "1.0",
		"author"      => "Nemanja Cimbaljevic",
	];
}