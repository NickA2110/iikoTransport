<?php

namespace IikoTransport\Entity\Nomenclature\Product;

class Price
{
	public $currentPrice;

	public $isIncludedInMenu;

	public $nextPrice;

	public $nextIncludedInMenu;
	
	public $nextDatePrice;

	function __construct(
		float $currentPrice,
		bool $isIncludedInMenu,
		?float $nextPrice,
		bool $nextIncludedInMenu,
		?string $nextDatePrice
	) {
		$this->currentPrice = $currentPrice;
		$this->isIncludedInMenu = $isIncludedInMenu;
		$this->nextPrice = $nextPrice;
		$this->nextIncludedInMenu = $nextIncludedInMenu;
		$this->nextDatePrice = $nextDatePrice;
	}
}