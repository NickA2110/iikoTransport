<?php

namespace IikoTransport\Entity\Order;

class Street
{
	public $classifierId;

	public $id;

	public $name;

	public $city;

	public function setClassifierId(?string $classifierId): self
	{
		$this->classifierId = $classifierId;
		return $this;
	}

	public function setId(?string $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function setName(?string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function setCity(?string $city): self
	{
		$this->city = $city;
		return $this;
	}

	public function toArray(): array
	{
		$aData = [];
		
		if (!is_null($this->classifierId)) {
			$aData['classifierId'] = $this->classifierId;
		}
		if (!is_null($this->id)) {
			$aData['id'] = $this->id;
		}
		if (!is_null($this->name)) {
			$aData['name'] = $this->name;
		}
		if (!is_null($this->city)) {
			$aData['city'] = $this->city;
		}

		return $aData;
	}
}