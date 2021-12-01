<?php
namespace IikoTransport\Request\Loyalty;

use IikoTransport\Entity\Order\IOrder;
use IikoTransport\Request\Common;

/**
 *  Calculate checkin request
 */
class CalculateCheckin extends Common
{
	protected $sUri = 'loyalty/iiko/calculate_checkin';

	function __construct(
		string $sOrganizationId,
		IOrder $oOrder
	) {
		$this->aData = [
			'organizationId' => $sOrganizationId,
			'order' => $oOrder->toArray(),
		];
	}

	public function setDeliveryTerminalId(string $sDeliveryTerminalId): self
	{
		$this->aData['deliveryTerminalId'] = $sDeliveryTerminalId;
		return $this;
	}
}
