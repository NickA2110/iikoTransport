<?php

namespace IikoTransport\Entity\Loyalty\Customer;

class WalletBalance
{
	const types = [
		'Money' => 0,
		'Bonus' => 1,
		'Product' => 2,
		'Discount' => 3,
		'Certificate' => 4,
	];

	public $id;

	public $name;

	public $type;

	public $balance;

	function __construct(
		string $id,
		string $name,
		int $type,
		float $balance
	) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $this->getValidType($type);
		$this->balance = $balance;
	}

	function getValidType(int $type): int
	{
		if (in_array($type, static::types)) {
			return $type;
		}

		throw new Exception(
			"Index of type '{$type}' is not in white list WalletBalance::types",
			Exception::INDEX_OF_BALANCE_TYPES_IS_NOT_IN_WHITE_LIST
		);
	}
}