<?php

namespace WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector;

use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\AssetProvider;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\DataCollector;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\Renderable;
use WHMCS\Module\Addon\NemcDebugBar\DebugBar\DataCollector\TimeDataCollector;

class CapsuleCollector extends DataCollector implements Renderable, AssetProvider {

	protected $queryLog;

	public function __construct( $queryLog = [] ) {
		$this->queryLog = $queryLog;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'queries';
	}

	public function collect() {
		$statements = [];
		foreach ( $this->queryLog as $logRow ) {
			array_push( $statements, [
				"sql"        => $logRow["query"],
				"params"     => (object) $logRow["bindings"],
				"is_success" => true,
				"duration"   => $logRow["time"],
				"duration_str" => $logRow["time"] . " ms",
			] );
		}

		$data = [
			'nb_statements'        => count( $this->queryLog ),
			'nb_failed_statements' => 0,
			'accumulated_duration' => 0,
			'memory_usage'         => 0,
			'peak_memory_usage'    => 0,
			'statements'           => $statements,
		];

		return $data;
	}

	/**
	 * @return array
	 */
	public function getWidgets() {
		$name = $this->getName();

		return [
			"queries"       => [
				"icon"    => "database",
				"widget"  => "PhpDebugBar.Widgets.SQLQueriesWidget",
				"map"     => "queries",
				"default" => "[]",
			],
			"queries:badge" => [
				"map"     => "queries.nb_statements",
				"default" => 0,
			],
		];
	}

	/**
	 * @return array
	 */
	public function getAssets() {
		return [
			'css' => 'widgets/sqlqueries/widget.css',
			'js'  => 'widgets/sqlqueries/widget.js',
		];
	}
}

