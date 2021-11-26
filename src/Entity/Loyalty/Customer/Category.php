<?php

namespace IikoTransport\Entity\Loyalty\Customer;

class Category
{
	public $id;

	public $name;

	public $isActive;

	public $isDefaultForNewGuests;

	function __construct(
		string $id,
		string $name,
		bool $isActive,
		bool $isDefaultForNewGuests
	) {
		$this->id = $id;
		$this->name = $name;
		$this->isActive = $isActive;
		$this->isDefaultForNewGuests = $isDefaultForNewGuests;
	}
}