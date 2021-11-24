<?php

namespace IikoTransport\Entity\Nomenclature;

class ProductCategory
{
	public $id;

	public $name;

	public $isDeleted;

	function __construct(
		string $id,
		string $name,
		bool $isDeleted
	) {
		$this->id = $id;
		$this->name = $name;
		$this->isDeleted = $isDeleted;
	}
}