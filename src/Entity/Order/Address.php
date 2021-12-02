<?php

namespace IikoTransport\Entity\Order;

class Address
{
	public $street;

	public $index;

	public $house;

	public $building;
	
	public $flat;
	
	public $entrance;
	
	public $floor;
	
	public $doorphone;
	
	public $regionId;

	public function setStreet(Street $street): self
	{
		$this->street = $this->getValidStreet($street);
		return $this;
	}

	function getValidStreet(?Street $street): Street
	{
		if (empty($street)) {
			throw new Exception(
				"Street is not set",
				Exception::STREET_IS_NOT_SET
			);
		}
		return $street;
	}

	public function setIndex(?string $index): self
	{
		$this->index = $index;
		return $this;
	}

	public function setHouse(string $house): self
	{
		$this->house = $this->getValidHouse($house);
		return $this;
	}

	function getValidHouse(?string $house): string
	{
		if (empty($house)) {
			throw new Exception(
				"House is not set",
				Exception::HOUSE_IS_NOT_SET
			);
		}
		return $house;
	}

	public function setBuilding(?string $building): self
	{
		$this->building = $building;
		return $this;
	}

	public function setFlat(?string $flat): self
	{
		$this->flat = $flat;
		return $this;
	}

	public function setEntrance(?string $entrance): self
	{
		$this->entrance = $entrance;
		return $this;
	}

	public function setFloor(?string $floor): self
	{
		$this->floor = $floor;
		return $this;
	}

	public function setDoorphone(?string $doorphone): self
	{
		$this->doorphone = $doorphone;
		return $this;
	}

	public function setRegionId(?string $regionId): self
	{
		$this->regionId = $regionId;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['street'] = $this->street->toArray();

		if (!is_null($this->index)) {
			$aData['index'] = $this->index;
		}

		$aData['house'] = $this->house;
		
		if (!is_null($this->building)) {
			$aData['building'] = $this->building;
		}
		if (!is_null($this->flat)) {
			$aData['flat'] = $this->flat;
		}
		if (!is_null($this->entrance)) {
			$aData['entrance'] = $this->entrance;
		}
		if (!is_null($this->floor)) {
			$aData['floor'] = $this->floor;
		}
		if (!is_null($this->doorphone)) {
			$aData['doorphone'] = $this->doorphone;
		}
		if (!is_null($this->regionId)) {
			$aData['regionId'] = $this->regionId;
		}

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidStreet($this->street);
		$this->getValidHouse($this->house);
		return $this;
	}
}