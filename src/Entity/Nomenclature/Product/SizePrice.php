<?php

namespace IikoTransport\Entity\Nomenclature\Product;

class SizePrice
{
	public $sizeId;

	public $price;

	function __construct(
		?string $sizeId,
		Price $price
	) {
		$this->sizeId = $sizeId;
		$this->price = $price;
	}
}