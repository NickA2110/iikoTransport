<?php

namespace IikoTransport\Entity\Order;

class Product extends Item
{
	public $productId;

	public $modifiers;

	public $price;

	public $positionId;

	function __construct()
	{
		$this->type = Product::types['product'];
	}

	public function setProductId(string $productId): self
	{
		$this->productId = $productId;
		return $this;
	}

	public function setModifiers(array $modifiers): self
	{
		$this->modifiers = $modifiers;
		return $this;
	}

	public function setPrice(?float $price): self
	{
		$this->price = $price;
		return $this;
	}

	public function setPositionId(?string $positionId): self
	{
		$this->positionId = $positionId;
		return $this;
	}

	public function toArray(): array
	{
		return [];
	}
}