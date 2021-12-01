<?php

namespace IikoTransport\Entity\Order;

class Card
{
	public $track;

	public function setTrack(string $track): self
	{
		$this->track = $this->getValidTrack($track);
		return $this;
	}

	function getValidTrack(?string $track): string
	{
		if (empty($track)) {
			throw new Exception(
				"Track is not set",
				Exception::TRACK_IS_NOT_SET
			);
		}
		return $track;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['track'] = $this->track;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidTrack($this->track);
		return $this;
	}

}