<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Entity\Order\IOrder;
use IikoTransport\Entity\Order\Item;
use IikoTransport\Entity\Order\Order;
use IikoTransport\Entity\Order\Product;
use IikoTransport\Request\Common as RequestCommon; 
use IikoTransport\Request\Exception as RequestException; 

trait GetSimpleOrderTrait
{
	function getOrder(): IOrder
	{
		$oOrder = new Order();
		$oOrder
			->setOrderServiceType('DeliveryByClient')
			->setPhone('+79998887766')
			->setItems([
				$this->getProduct()
			]);;
		return $oOrder;
	}
	
	function getProduct(): Item
	{
		return (new Product())
			->setProductId('88d3e2e9-51d7-4000-bca5-2e67fa0ed66b')
			->setAmount(1);
	}
}
