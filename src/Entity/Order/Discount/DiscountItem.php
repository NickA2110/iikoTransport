<?php

namespace IikoTransport\Entity\Order\Discount;

use IikoTransport\Entity\Order\ObjectsToNestedArrayTrait;

class DiscountItem extends Discount
{
	public $positionId;

	public $sum = 0.;

	public $amount = 0.;

	public function setPositionId(string $positionId): self
	{
		$this->positionId = $this->getValidPositionId($positionId);
		return $this;
	}

	function getValidPositionId(?string $positionId): string
	{
		if (empty($positionId)) {
			throw new Exception(
				"PositionId is not set",
				Exception::POSITION_ID_IS_NOT_SET
			);
		}
		return $positionId;
	}

	public function setSum(float $sum): self
	{
		$this->sum = $sum;
		return $this;
	}

	public function setAmount(float $amount): self
	{
		$this->amount = $amount;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];

		$aData['positionId'] = $this->positionId;
		$aData['sum'] = $this->sum;
		$aData['amount'] = $this->amount;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidPositionId($this->positionId);
		return $this;
	}
}