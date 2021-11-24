<?php

namespace IikoTransport\Entity\Nomenclature\Product;

class Modifier
{
	public $id;

	public $defaultAmount;

	public $minAmount;

	public $maxAmount;

	public $required;

	public $hideIfDefaultAmount;

	public $splittable;

	public $freeOfChargeAmount;

	function __construct(
		string $id,
		?int $defaultAmount,
		int $minAmount,
		int $maxAmount,
		?bool $required,
		?bool $hideIfDefaultAmount,
		?bool $splittable,
		?int $freeOfChargeAmount
	) {
		$this->id = $id;
		$this->defaultAmount = $defaultAmount;
		$this->minAmount = $minAmount;
		$this->maxAmount = $maxAmount;
		$this->required = $required;
		$this->hideIfDefaultAmount = $hideIfDefaultAmount;
		$this->splittable = $splittable;
		$this->freeOfChargeAmount = $freeOfChargeAmount;
	}
}