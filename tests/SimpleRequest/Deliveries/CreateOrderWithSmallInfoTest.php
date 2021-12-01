<?php 

namespace IikoTransport\Tests\SimpleRequest\Deliveries;

use IikoTransport\Entity\Order\IOrder;
use IikoTransport\Entity\Order\Item;
use IikoTransport\Entity\Order\Order;
use IikoTransport\Entity\Order\Product;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Deliveries\Create as Request;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class CreateOrderWithSmallInfoTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{

		$this->markTestSkipped('Work, but create order in iiko');

		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$oOrder = $this->getOrder(),
		);
		$oRequest->setTerminalGroupId(ApiKey::getTermianlGroupId());
		return $oRequest;
	}

	function getOrder(): IOrder
	{
		$oOrder = new Order();
		$oOrder
			->setOrderServiceType(Order::orderServiceTypes['DeliveryByClient'])
			->setPhone(ApiKey::getCustomerPhone())
			->setItems([
				$this->getProduct()
			]);
		return $oOrder;
	}

	function getProduct(): Item
	{
		return (new Product())
			->setProductId(ApiKey::getProductId())
			->setAmount(1);
	}

	function checkResponse(array $aBody, string $sBody)
	{
		$aNeedleKeys = [
			'correlationId',
			'orderInfo',
		];
		$aBodyKeys = array_keys($aBody);
		$this->assertEquals(
			$aNeedleKeys,
			$aBodyKeys,
			"Response of 'Deliveries\\Create' not containts needle keys"
		);
	}
}
