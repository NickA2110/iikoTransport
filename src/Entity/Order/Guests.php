<?php

namespace IikoTransport\Entity\Order;

class Guests
{
	public $count;

	public $splitBetweenPersons;

	public function setСount(int $count): self
	{
		$this->count = $this->getValidCount($count);
		return $this;
	}

	function getValidCount(?int $count): int
	{
		if (is_null($count)) {
			throw new Exception(
				"Count is not set",
				Exception::COUNT_IS_NOT_SET
			);
		}
		return $count;
	}

	public function setSplitBetweenPersons(bool $splitBetweenPersons): self
	{
		$this->splitBetweenPersons = $this->getValidSplitBetweenPersons($splitBetweenPersons);
		return $this;
	}

	function getValidSplitBetweenPersons(?bool $splitBetweenPersons): bool
	{
		if (is_null($splitBetweenPersons)) {
			throw new Exception(
				"SplitBetweenPersons is not set",
				Exception::SPLIT_BETWEEN_PERSONS_IS_NOT_SET
			);
		}
		return $splitBetweenPersons;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['count'] = $this->count;
		$aData['splitBetweenPersons'] = $this->splitBetweenPersons;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidCount($this->count);
		$this->getValidSplitBetweenPersons($this->splitBetweenPersons);
		return $this;
	}
}