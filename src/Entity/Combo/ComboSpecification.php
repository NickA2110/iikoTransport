<?php

namespace IikoTransport\Entity\Combo;

class ComboSpecification
{
	public $sourceActionId;

	public $categoryId;

	public $name;

	public $priceModificationType;

	public $priceModification;

	public $groups;


	function __construct(
		string $sourceActionId,
		?string $categoryId,
		string $name,
		int $priceModificationType,
		float $priceModification,
		array $groups
	) {
		$this->sourceActionId = $sourceActionId;
		$this->categoryId = $categoryId;
		$this->name = $name;
		$this->priceModificationType = $priceModificationType;
		$this->priceModification = $priceModification;
		$this->groups = $groups;
	}
}