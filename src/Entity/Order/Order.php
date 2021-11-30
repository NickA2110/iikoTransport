<?php

namespace IikoTransport\Entity\Order;

class Order implements IOrder
{
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
		$this->orderServiceType = $orderServiceType;
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
		$aData = [];
		return $aData;
	}
}