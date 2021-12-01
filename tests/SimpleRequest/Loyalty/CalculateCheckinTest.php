<?php 

namespace IikoTransport\Tests\SimpleRequest\Loyalty;

use IikoTransport\Entity\Order\Customer;
use IikoTransport\Entity\Order\IOrder;
use IikoTransport\Entity\Order\Item;
use IikoTransport\Entity\Order\Order;
use IikoTransport\Entity\Order\Payment;
use IikoTransport\Entity\Order\Product;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Loyalty\CalculateCheckin as Request;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class CalculateCheckinTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$oOrder = $this->getOrder(),
		);
		$oRequest->setDeliveryTerminalId(ApiKey::getTermianlGroupId());
		
		return $oRequest;
	}

	function getOrder(): IOrder
	{
		$oOrder = new Order();
		$oOrder
			->setPhone(ApiKey::getCustomerPhone())
			->setOrderServiceType('DeliveryByClient')
			->setComment('Тестовый, через минутку можно отменить. Доброго дня! =)')
			->setCustomer(
				$this->getCustomer()
			)
			->setPayments([
				$this->getPayment()
			])
			->setItems([
				$this->getProduct()
			]);
		return $oOrder;
	}

	function getCustomer(): Customer
	{
		return ApiKey::getCustomer();
	}

	function getPayment(): Payment
	{
		return (new Payment())
			->setPaymentTypeKind(Payment::paymentTypeKinds['Cash'])
			->setSum(998.0)
			->setIsProcessedExternally(false)
			->setPaymentTypeId('09322f46-578a-d210-add7-eec222a08871');
	}

	function getProduct(): Item
	{
		return (new Product())
			->setProductId('88d3e2e9-51d7-4000-bca5-2e67fa0ed66b')
			->setAmount(1);
	}

	function checkResponse(array $aBody, string $sBody)
	{
		$aNeedleKeys = [
			'loyaltyProgramResults',
			'availablePayments',
			'validationWarnings',
			'Warnings',
		];
		$aBodyKeys = array_keys($aBody);
		$this->assertEquals(
			$aNeedleKeys,
			$aBodyKeys,
			"Response of 'Loyalty\\CalculateCheckin' not containts needle keys"
		);
	}
}
