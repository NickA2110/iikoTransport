<?php
namespace IikoTransport\Request\Combo;

use IikoTransport\Request\Common;

/**
 *  Get combos info request
 */
class GetCombosInfo extends Common
{
	protected $sUri = 'combo/get_combos_info';

	function __construct(string $sOrganizationId)
	{
		$this->aData = [
			'organizationId' => $sOrganizationId,
		];
	}
}
