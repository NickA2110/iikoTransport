<?php
namespace IikoTransport\Request\Deliveries;

use IikoTransport\Entity\Order\IOrder;
use IikoTransport\Request\Common;

/**
 *  Create delivery request
 */
class Create extends Common
{
	protected $sUri = 'deliveries/create';

	function __construct(
		string $sOrganizationId,
		IOrder $oOrder
	) {
		$this->aData = [
			'organizationId' => $sOrganizationId,
			'order' => $oOrder->toArray(),
		];
	}

	public function setTerminalGroupId(?string $terminalGroupId): self
	{
		$this->aData['terminalGroupId'] = $terminalGroupId;
		return $this;
	}
}
