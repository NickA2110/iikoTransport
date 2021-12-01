<?php

namespace IikoTransport\Entity\Order;

class Order implements IOrder
{
	const orderServiceTypes = [
		'DeliveryByClient' => 'DeliveryByClient',
		'DeliveryByCourier' => 'DeliveryByCourier',
	];

	public $phone;

	public $orderServiceType;

	public $sourceKey;

	public $comment = null;

	public $customer;

	public $payments = [];

	public $items = [];

	function __construct() {
		$this->customer = new Customer();
	}

	public function setPhone(string $phone): self
	{
		$this->phone = $phone;
		return $this;
	}

	public function setOrderServiceType(string $orderServiceType): self
	{
		if (!isset(static::orderServiceTypes[$orderServiceType])) {
			throw new Exception(
				"OrderServiceType '{$orderServiceType}' is not in white list Order\\Order::orderServiceTypes",
				Exception::ORDER_SERVICE_TYPE_IS_NOT_IN_WHITE_LIST
			);
		}
		$this->orderServiceType = static::orderServiceTypes[$orderServiceType];
		return $this;
	}

	public function setSourceKey(string $sourceKey): self
	{
		$this->sourceKey = $sourceKey;
		return $this;
	}

	public function setComment(?string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	public function setCustomer(Customer $customer): self
	{
		$this->customer = $customer;
		return $this;
	}

	public function setPayments(array $payments): self
	{
		$this->payments = $payments;
		return $this;
	}

	public function setItems(array $items): self
	{
		$this->items = $items;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();
		$aData = [];
		$aData['phone'] = $this->phone;
		$aData['orderServiceType'] = $this->orderServiceType;
		// $aData['sourceKey'] = $this->sourceKey;
		// $aData['comment'] = $this->comment;

		$aData['customer'] = $this->customer->toArray();
		$aData['items'] = $this->itemsToArray();
		
		if (!empty($this->payments)) {
			$aData['payments'] = $this->paymentsToArray();
		}
		
		return $aData;
	}

	function checkFields(): self
	{
		if (empty($this->orderServiceType)) {
			throw new Exception(
				"OrderServiceType is not set",
				Exception::ORDER_SERVICE_TYPE_IS_NOT_SET
			);
		}
		if (empty($this->phone)) {
			throw new Exception(
				"Phone is not set",
				Exception::PHONE_IS_NOT_SET
			);
		}
		if (empty($this->items)) {
			throw new Exception(
				"Items is not set",
				Exception::ITEMS_IS_NOT_SET
			);
		}
		return $this;
	}

	function itemsToArray(): array
	{
		$aItems = [];
		foreach ($this->items as $item) {
			$aItems[] = $item->toArray();
		}
		return $aItems;
	}

	function paymentsToArray(): array
	{
		$aPayments = [];
		foreach ($this->payments as $payment) {
			$aPayments[] = $payment->toArray();
		}
		return $aPayments;
	}
}