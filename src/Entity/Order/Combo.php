<?php

namespace IikoTransport\Entity\Order;

class Combo
{
	public $id;

	public $name;

	public $amount;

	public $price;

	public $sourceId;

	public function setId(string $id): self
	{
		$this->id = $id;
		return $this;
	}
	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}
	public function setAmount(int $amount): self
	{
		$this->amount = $amount;
		return $this;
	}
	public function setPrice(float $price): self
	{
		$this->price = $price;
		return $this;
	}
	public function setSourceId(string $sourceId): self
	{
		$this->sourceId = $sourceId;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['id'] = $this->id;
		$aData['name'] = $this->name;
		$aData['amount'] = $this->amount;
		$aData['price'] = $this->price;
		$aData['sourceId'] = $this->sourceId;

		return $aData;
	}

	function checkFields(): self
	{
		if (empty($this->id)) {
			throw new Exception(
				"Id of combo is not set",
				Exception::ID_OF_COMBO_IS_NOT_SET
			);
		}
		if (empty($this->name)) {
			throw new Exception(
				"Name of combo is not set",
				Exception::NAME_OF_COMBO_IS_NOT_SET
			);
		}
		if (empty($this->amount)) {
			throw new Exception(
				"Amount of combo is not set",
				Exception::AMOUNT_OF_COMBO_IS_NOT_SET
			);
		}
		if (is_null($this->price)) {
			throw new Exception(
				"Price of combo is not set",
				Exception::PRICE_OF_COMBO_IS_NOT_SET
			);
		}
		if (empty($this->sourceId)) {
			throw new Exception(
				"SourceId of combo is not set",
				Exception::SOURCE_ID_OF_COMBO_IS_NOT_SET
			);
		}
		return $this;
	}
}