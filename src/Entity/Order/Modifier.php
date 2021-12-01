<?php

namespace IikoTransport\Entity\Order;

class Modifier
{
	public $productId;

	public $amount;

	public $productGroupId;

	public $price;

	public $positionId;

	public function setProductId(string $productId): self
	{
		$this->productId = $productId;
		return $this;
	}

	public function setAmount(float $amount): self
	{
		$this->amount = $amount;
		return $this;
	}

	public function setProductGroupId(?string $productGroupId): self
	{
		$this->productGroupId = $productGroupId;
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
		$aData['amount'] = $this->amount;

		if (!is_null($this->productGroupId)) {
			$aData['productGroupId'] = $this->productGroupId;
		}
		if (!is_null($this->price)) {
			$aData['price'] = $this->price;
		}
		if (!is_null($this->positionId)) {
			$aData['positionId'] = $this->positionId;
		}

		return $aData;
	}

	function checkFields(): self
	{
		if (empty($this->productId)) {
			throw new Exception(
				"ProductId is not set",
				Exception::PRODUCT_ID_OF_MODIFIER_IS_NOT_SET
			);
		}
		if (empty($this->amount)) {
			throw new Exception(
				"Amount of product is not set",
				Exception::AMOUNT_OF_MODIFIER_IS_NOT_SET
			);
		}
		return $this;
	}
}