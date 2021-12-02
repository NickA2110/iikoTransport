<?php

namespace IikoTransport\Entity\Order;

class DeliveryPoint
{
	public $coordinates;

	public $address;

	public $externalCartographyId;

	public $comment;

	public function setCoordinates(?Coordinates $coordinates): self
	{
		$this->coordinates = $coordinates;
		return $this;
	}
	public function setAddress(?Address $address): self
	{
		$this->address = $address;
		return $this;
	}
	public function setExternalCartographyId(?string $externalCartographyId): self
	{
		$this->externalCartographyId = $externalCartographyId;
		return $this;
	}
	public function setComment(?string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	public function toArray(): array
	{
		$aData = [];
		
		if (!is_null($this->coordinates)) {
			$aData['coordinates'] = $this->coordinates->toArray();
		}
		if (!is_null($this->address)) {
			$aData['address'] = $this->address->toArray();
		}
		if (!is_null($this->externalCartographyId)) {
			$aData['externalCartographyId'] = $this->externalCartographyId;
		}
		if (!is_null($this->comment)) {
			$aData['comment'] = $this->comment;
		}

		return $aData;
	}
}