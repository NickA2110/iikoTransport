<?php

namespace IikoTransport\Entity\Order;

class DiscountsInfo
{
	use ObjectsToNestedArrayTrait;

	public $card;

	public $discounts;

	public function setCard(Card $card): self
	{
		$this->card = $card;
		return $this;
	}

	public function setDiscounts(array $discounts): self
	{
		$this->discounts = $discounts;
		return $this;
	}

	public function toArray(): array
	{
		$aData = [];

		if (!is_null($this->card)) {
			$aData['card'] = $this->card->toArray();
		}
		if (!empty($this->discounts)) {
			$aData['discounts'] = $this->arrayObjectsToNestedArray($this->discounts);
		}

		return $aData;
	}
}