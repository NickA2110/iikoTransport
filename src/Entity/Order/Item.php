<?php

namespace IikoTransport\Entity\Order;

abstract class Item
{
	const types = [
		'Product' => 'Product',
		'Compound' => 'Compound',
	];

	public $type;

	public $amount;

	public $productSizeId;

	public $comboInformation;

	public $comment;

	public function setType(string $type): self
	{
		if (!isset(static::types[$type])) {
			throw new Exception(
				"Type '{$type}' is not in white list Order\\Item::types",
				Exception::ITEM_TYPE_IS_NOT_IN_WHITE_LIST
			);
		}
		$this->type = $type;
		return $this;
	}

	public function setAmount(float $amount): self
	{
		$this->amount = $this->getValidAmount($amount);
		return $this;
	}

	function getValidAmount(?float $amount): float
	{
		if (empty($amount)) {
			throw new Exception(
				"Amount of product is not set",
				Exception::AMOUNT_OF_PRODUCT_IS_NOT_SET
			);
		}
		return $amount;
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