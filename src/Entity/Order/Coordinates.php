<?php

namespace IikoTransport\Entity\Order;

class Coordinates
{
	public $latitude;

	public $longitude;

	public function setCoordinates(float $latitude, float $longitude): self
	{
		$this->latitude = $this->getValidLatitude($latitude);
		$this->longitude = $this->getValidLongitude($longitude);
		return $this;
	}

	public function setLatitude(float $latitude): self
	{
		$this->latitude = $this->getValidLatitude($latitude);
		return $this;
	}

	function getValidLatitude(?float $latitude): float
	{
		if (is_null($latitude)) {
			throw new Exception(
				"Latitude is not set",
				Exception::LATITUDE_IS_NOT_SET
			);
		}
		return $latitude;
	}

	public function setLongitude(float $longitude): self
	{
		$this->longitude = $this->getValidLongitude($longitude);
		return $this;
	}

	function getValidLongitude(?float $longitude): float
	{
		if (is_null($longitude)) {
			throw new Exception(
				"Longitude is not set",
				Exception::LONGITUDE_IS_NOT_SET
			);
		}
		return $longitude;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['latitude'] = $this->latitude;
		$aData['longitude'] = $this->longitude;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidLatitude($this->latitude);
		$this->getValidLongitude($this->longitude);
		return $this;
	}
}