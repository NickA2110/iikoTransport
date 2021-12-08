<?php

namespace IikoTransport\Entity\Order;

class Product extends Item
{
	use ObjectsToNestedArrayTrait;

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
		$this->productId = $this->getValidProductId($productId);
		return $this;
	}

	function getValidProductId(?string $productId): string
	{
		if (empty($productId)) {
			throw new Exception(
				"ProductId is not set",
				Exception::PRODUCT_ID_OF_PRODUCT_IS_NOT_SET
			);
		}
		return $productId;
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
			$aData['modifiers'] = $this->arrayObjectsToNestedArray($this->modifiers);
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
		$this->getValidProductId($this->productId);
		$this->getValidAmount($this->amount);
		return $this;
	}
}