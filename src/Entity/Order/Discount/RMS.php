<?php

namespace IikoTransport\Entity\Order\Discount;

class RMS extends Discount
{
	public $discountTypeId;

	public $sum = 0;

	public $selectivePositions;

	function __construct()
	{
		$this->type = static::types['RMS'];
	}

	public function setDiscountTypeId(string $discountTypeId): self
	{
		$this->discountTypeId = $this->getValidDiscountTypeId($discountTypeId);
		return $this;
	}

	function getValidDiscountTypeId(?string $discountTypeId): string
	{
		if (empty($discountTypeId)) {
			throw new Exception(
				"DiscountTypeId is not set",
				Exception::DISCOUNT_TYPE_ID_IS_NOT_SET
			);
		}
		return $discountTypeId;
	}

	public function setSum(float $sum): self
	{
		$this->sum = $sum;
		return $this;
	}

	public function setSelectivePositions(array $selectivePositions): self
	{
		$this->selectivePositions = $selectivePositions;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];

		$aData['discountTypeId'] = $this->discountTypeId;
		$aData['sum'] = $this->sum;

		if (!empty($this->selectivePositions)) {
			$aData['selectivePositions'] = $this->selectivePositions;
		}

		$aData['type'] = $this->type;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidType($this->type);
		$this->getValidDiscountTypeId($this->discountTypeId);
		return $this;
	}
}