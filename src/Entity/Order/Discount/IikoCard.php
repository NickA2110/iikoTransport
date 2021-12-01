<?php

namespace IikoTransport\Entity\Order\Discount;

use IikoTransport\Entity\Order\ObjectsToNestedArrayTrait;

class IikoCard extends Discount
{
	use ObjectsToNestedArrayTrait;

	public $programId;

	public $programName;

	public $discountItems = [];

	function __construct()
	{
		$this->type = static::types['IikoCard'];
	}

	public function setProgramId(string $programId): self
	{
		$this->programId = $this->getValidProgramId($programId);
		return $this;
	}

	function getValidProgramId(?string $programId): string
	{
		if (empty($programId)) {
			throw new Exception(
				"ProgramId is not set",
				Exception::PROGRAM_ID_IS_NOT_SET
			);
		}
		return $programId;
	}

	public function setProgramName(string $programName): self
	{
		$this->programName = $this->getValidProgramName($programName);
		return $this;
	}

	function getValidProgramName(?string $programName): string
	{
		if (empty($programName)) {
			throw new Exception(
				"ProgramName is not set",
				Exception::PROGRAM_NAME_IS_NOT_SET
			);
		}
		return $programName;
	}

	public function setDiscountItems(array $discountItems): self
	{
		$this->discountItems = $this->getValidDiscountItems($discountItems);
		return $this;
	}

	function getValidDiscountItems(array $discountItems): array
	{
		if (empty($discountItems)) {
			throw new Exception(
				"DiscountItems is not set",
				Exception::DISCOUNT_ITEMS_IS_NOT_SET
			);
		}
		return $discountItems;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];

		$aData['programId'] = $this->programId;
		$aData['programName'] = $this->programName;
		$aData['discountItems'] = $this->arrayObjectsToNestedArray($this->discountItems);
		$aData['type'] = $this->type;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidType($this->type);
		$this->getValidProgramId($this->programId);
		$this->getValidProgramName($this->programName);
		$this->getValidDiscountItems($this->discountItems);
		return $this;
	}
}