<?php 

namespace IikoTransport\Tests\SimpleRequest\Deliveries;

use IikoTransport\Entity\Order\Customer;
use IikoTransport\Entity\Order\IOrder;
use IikoTransport\Entity\Order\Item;
use IikoTransport\Entity\Order\Order;
use IikoTransport\Entity\Order\Payment;
use IikoTransport\Entity\Order\Product;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Deliveries\Create as Request;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
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
		print_r($oRequest);
		die;
		return $oRequest;
	}

	function getOrder(): IOrder
	{
		$oOrder = new Order();
		$oOrder
			->setOrderServiceType('DeliveryByClient')
			->setPhone(ApiKey::getCustomerPhone())
			->setItems([
				$this->getProduct()
			])
		/*
			->setSourceKey('site')
			->setComment('Тестовый, через минутку можно отменить. Доброго дня! =)')
			->setCustomer(
				$this->getCustomer()
			)
			->setPayments([
				$this->getPayment()
			])
		*/
		;
		return $oOrder;
	}

	function getCustomer(): Customer
	{
		return ApiKey::getCustomer();
	}

	function getPayment(): Payment
	{
		return (new Payment())
		/*
			->setPaymentTypeKind(Payment::paymentTypeKinds['Cash'])
			->setSum(998.0)
			->setPaymentTypeId('09322f46-578a-d210-add7-eec222a08871')
		*/
		;
	}

	function getProduct(): Item
	{
		return (new Product())
			->setProductId('88d3e2e9-51d7-4000-bca5-2e67fa0ed66b')
			// ->setPrice(998.0)
			->setAmount(1)
		;
	}

	function checkResponse(array $aBody, string $sBody)
	{
		print_r($aBody);
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
