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
		$this->setType('Product');
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
		$this->checkFields();

		$aData = [];
		
		$aData['productId'] = $this->productId;
		if (!is_null($this->modifiers)) {
			$aData['modifiers'] = $this->modifiersToArray();
		}
		if (!is_null($this->price)) {
			$aData['price'] = $this->price;
		}
		if (!is_null($this->positionId)) {
			$aData['positionId'] = $this->positionId;
		}
		$aData['type'] = $this->type;
		$aData['amount'] = $this->amount;
		if (!is_null($this->productSizeId)) {
			$aData['productSizeId'] = $this->productSizeId;
		}
		if (!is_null($this->comboInformation)) {
			$aData['comboInformation'] = $this->comboInformation->toArray();
		}
		if (!is_null($this->comment)) {
			$aData['comment'] = $this->comment;
		}
		
		return $aData;
	}

	function checkFields(): self
	{
		if (empty($this->productId)) {
			throw new Exception(
				"ProductId is not set",
				Exception::PRODUCT_ID_OF_PRODUCT_IS_NOT_SET
			);
		}
		if (empty($this->amount)) {
			throw new Exception(
				"Amount of product is not set",
				Exception::AMOUNT_OF_PRODUCT_IS_NOT_SET
			);
		}
		return $this;
	}

	function modifiersToArray(): array
	{
		$aModifiers = [];
		foreach ($this->modifiers as $modifier) {
			$aModifiers[] = $modifier->toArray();
		}
		return $aModifiers;
	}
}