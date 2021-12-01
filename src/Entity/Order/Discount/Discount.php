<?php

namespace IikoTransport\Entity\Order\Discount;

abstract class Discount
{
	const types = [
		'RMS' => 'RMS',
		'IikoCard' => 'IikoCard',
	];

	public $type;

	public function setType(string $type): self
	{
		$this->type = $this->getValidType($type);
		return $this;
	}

	function getValidType(?string $type): string
	{
		if (!in_array($type, static::types)) {
			throw new Exception(
				"Type '{$type}' is not in white list Discount\\Discount::types",
				Exception::TYPE_OF_DISCOUNT_IS_NOT_IN_WHITE_LIST
			);
		}
		return $type;
	}

	abstract public function toArray(): array;
}