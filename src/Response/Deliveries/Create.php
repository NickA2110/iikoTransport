<?php

namespace IikoTransport\Response\Deliveries;

use IikoTransport\Entity\Deliveries\OrderInfo;
use IikoTransport\Response\Common;
use IikoTransport\Response\IResponse;

class Create extends Common
{
	var $oOrderInfo;

	public function parseBody(): IResponse
	{
		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['orderInfo'])) {
			$this->oOrderInfo = $this->getOrderInfoFromResponseArray(
				$aBody['orderInfo']
			);
		}

		return $this;
	}

	function getOrderInfoFromResponseArray(array $aOrderInfo): OrderInfo
	{
		$oOrderInfo = new OrderInfo(
			$aOrderInfo['id'],
			$aOrderInfo['organizationId'],
			$aOrderInfo['timestamp'],
			$aOrderInfo['creationStatus'],
			$aOrderInfo['errorInfo'],
			$aOrderInfo['order']
		);
		return $oOrderInfo;
	}

	public function getOrderInfo(): OrderInfo
	{
		if (is_null($this->oOrderInfo)) {
			$this->parseBody();
		}
		return $this->oOrderInfo;
	}
}