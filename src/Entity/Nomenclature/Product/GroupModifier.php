<?php

namespace IikoTransport\Entity\Nomenclature\Product;

class GroupModifier
{
	public $id;

	public $minAmount;

	public $maxAmount;

	public $required;

	public $childModifiersHaveMinMaxRestrictions;

	public $childModifiers;

	public $hideIfDefaultAmount;

	public $defaultAmount;

	public $splittable;

	public $freeOfChargeAmount;


	function __construct(
		string $id,
		int $minAmount,
		int $maxAmount,
		?bool $required,
		?bool $childModifiersHaveMinMaxRestrictions,
		array $childModifiers,
		?bool $hideIfDefaultAmount,
		?int $defaultAmount,
		?bool $splittable,
		?int $freeOfChargeAmount
	) {
		$this->id = $id;
		$this->minAmount = $minAmount;
		$this->maxAmount = $maxAmount;
		$this->required = $required;
		$this->childModifiersHaveMinMaxRestrictions = $childModifiersHaveMinMaxRestrictions;
		$this->childModifiers = $childModifiers;
		$this->hideIfDefaultAmount = $hideIfDefaultAmount;
		$this->defaultAmount = $defaultAmount;
		$this->splittable = $splittable;
		$this->freeOfChargeAmount = $freeOfChargeAmount;
	}
}