<?php

namespace IikoTransport\Entity\Combo;

class Product
{
	public $productId;

	public $sizeId;

	public $forbiddenModifiers;

	public $priceModificationAmount;

	function __construct(
		string $productId,
		?string $sizeId,
		array $forbiddenModifiers,
		float $priceModificationAmount
	) {
		$this->productId = $productId;
		$this->sizeId = $sizeId;
		$this->forbiddenModifiers = $forbiddenModifiers;
		$this->priceModificationAmount = $priceModificationAmount;
	}
}