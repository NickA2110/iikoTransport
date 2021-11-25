<?php

namespace IikoTransport\Entity\Combo;

class ComboCategory
{
	public $id;

	public $name;

	function __construct(
		string $id,
		string $name
	) {
		$this->id = $id;
		$this->name = $name;
	}
}