<?php
namespace IikoTransport\Request\Commands;

use IikoTransport\Request\Common;

/**
 *  Get status request
 */
class Status extends Common
{
	protected $sUri = 'commands/status';

	function __construct(
		string $sOrganizationId,
		string $sCorrelationId
	) {
		$this->aData = [
			'organizationId' => $sOrganizationId,
			'correlationId' => $sCorrelationId,
		];
	}
}
