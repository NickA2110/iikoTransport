<?php
namespace IikoTransport\Request\TerminalGroups;

use IikoTransport\Request\Common;

/**
 *  Get information on availability of group of terminals request
 */
class IsAlive extends Common
{
	protected $sUri = 'terminal_groups/is_alive';

	function __construct(
		array $aOrganizationIds,
		array $aTerminalGroupIds
	) {
		$this->aData = [
			'organizationIds' => $aOrganizationIds,
			'terminalGroupIds' => $aTerminalGroupIds,
		];
	}
}
