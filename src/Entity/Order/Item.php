<?php

namespace IikoTransport\Entity\Order;

abstract class Item
{
	const types = [
		'product' => 'product',
		'compound' => 'compound',
	];

	public $type;

	public $amount;

	public $productSizeId;

	public $comboInformation;

	public $comment;

	public function setAmount(float $amount): self
	{
		$this->amount = $amount;
		return $this;
	}

	public function setProductSizeId(?string $productSizeId): self
	{
		$this->productSizeId = $productSizeId;
		return $this;
	}
	public function setComboInformation(?ComboInformation $comboInformation): self
	{
		$this->comboInformation = $comboInformation;
		return $this;
	}

	public function setComment(?string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	abstract public function toArray(): array;
}