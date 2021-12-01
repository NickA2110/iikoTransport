<?php

namespace IikoTransport\Entity\Order;

class ComboInformation
{
	public $comboId;

	public $comboSourceId;

	public $comboGroupId;

	public function setComboId(string $comboId): self
	{
		$this->comboId = $comboId;
		return $this;
	}

	public function setComboSourceId(string $comboSourceId): self
	{
		$this->comboSourceId = $comboSourceId;
		return $this;
	}

	public function setComboGroupId(string $comboGroupId): self
	{
		$this->comboGroupId = $comboGroupId;
		return $this;
	}

	public function toArray(): array
	{
		$aData = [];
		$aData['comboId'] = $this->comboId;
		$aData['comboSourceId'] = $this->comboSourceId;
		$aData['comboGroupId'] = $this->comboGroupId;
		return $aData;
	}
}