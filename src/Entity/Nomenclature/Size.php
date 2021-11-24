<?php

namespace IikoTransport\Entity\Nomenclature;

class Size
{
	public $id;

	public $name;

	public $priority;
	
	public $isDefault;

	function __construct(
		string $id,
		string $name,
		?string $priority,
		?bool $isDefault
	) {
		$this->id = $id;
		$this->name = $name;
		$this->priority = $priority;
		$this->isDefault = $isDefault;
	}
}