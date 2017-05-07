<?php
/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector;

/**
 * Collects info about the current request
 */
class ConstantsDataCollector extends DataCollector implements Renderable {
	/**
	 * @return array
	 */
	public function collect() {
		$constants = get_defined_constants( true );
		$data = [];

		foreach ( $constants["user"] as $constantName => $constantValue ) {
			$data[ $constantName ] = $this->getDataFormatter()->formatVar( $constantValue );
		}

		return $data;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'constants';
	}

	/**
	 * @return array
	 */
	public function getWidgets() {
		return [
			"constants" => [
				"icon"    => "tags",
				"widget"  => "PhpDebugBar.Widgets.VariableListWidget",
				"map"     => "constants",
				"default" => "{}",
			],
		];
	}
}
