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
		$this->id = $this->setValidId($id);
		return $this;
	}

	function setValidId(?string $id): string
	{
		if (empty($id)) {
			throw new Exception(
				"Id of combo is not set",
				Exception::ID_OF_COMBO_IS_NOT_SET
			);
		}
		return $id;
	}

	public function setName(string $name): self
	{
		$this->name = $this->setValidName($name);
		return $this;
	}

	function setValidName(?string $name): string
	{
		if (empty($name)) {
			throw new Exception(
				"Name of combo is not set",
				Exception::NAME_OF_COMBO_IS_NOT_SET
			);
		}
		return $name;
	}

	public function setAmount(int $amount): self
	{
		$this->amount = $this->setValidAmount($amount);
		return $this;
	}

	function setValidAmount(?int $amount): int
	{
		if (empty($amount)) {
			throw new Exception(
				"Amount of combo is not set",
				Exception::AMOUNT_OF_COMBO_IS_NOT_SET
			);
		}
		return $amount;
	}

	public function setPrice(float $price): self
	{
		$this->price = $this->setValidPrice($price);
		return $this;
	}

	function setValidPrice(?float $price): float
	{
		if (is_null($price)) {
			throw new Exception(
				"Price of combo is not set",
				Exception::PRICE_OF_COMBO_IS_NOT_SET
			);
		}
		return $price;
	}

	public function setSourceId(string $sourceId): self
	{
		$this->sourceId = $sourceId;
		return $this;
	}

	function setValidSourceId(?string $sourceId): string
	{
		if (empty($sourceId)) {
			throw new Exception(
				"SourceId of combo is not set",
				Exception::SOURCE_ID_OF_COMBO_IS_NOT_SET
			);
		}
		return $sourceId;
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
		$this->setValidId($this->id);
		$this->setValidName($this->name);
		$this->setValidAmount($this->amount);
		$this->setValidPrice($this->price);
		$this->setValidSourceId($this->sourceId);		
		return $this;
	}
}