<?php

namespace IikoTransport\Entity\Combo;

class Group
{
	public $id;

	public $name;

	public $products;

	function __construct(
		string $id,
		string $name,
		array $products
	) {
		$this->id = $id;
		$this->name = $name;
		$this->products = $products;
	}
}