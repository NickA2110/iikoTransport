<?php

namespace IikoTransport\Entity\Loyalty\Customer;

class Card
{
	public $id;

	public $track;

	public $number;

	public $validToDate;

	function __construct(
		string $id,
		string $track,
		string $number,
		string $validToDate
	) {
		$this->id = $id;
		$this->track = $track;
		$this->number = $number;
		$this->validToDate = $validToDate;
	}
}