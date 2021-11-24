<?php

namespace IikoTransport\Entity\Nomenclature\Product;

class Product
{
	const orderItemTypes = [
		'Product',
		'Compound',
	];

	public $fatAmount;

	public $proteinsAmount;

	public $carbohydratesAmount;

	public $energyAmount;

	public $fatFullAmount;

	public $proteinsFullAmount;

	public $carbohydratesFullAmount;

	public $energyFullAmount;

	public $weight;

	public $groupId;

	public $productCategoryId;

	public $type;

	public $orderItemType;

	public $modifierSchemaId;

	public $modifierSchemaName;

	public $splittable;

	public $measureUnit;

	public $sizePrices;

	public $modifiers;

	public $groupModifiers;

	public $imageLinks;

	public $doNotPrintInCheque;

	public $parentGroup;

	public $order;

	public $fullNameEnglish;

	public $useBalanceForSell;

	public $canSetOpenPrice;

	public $id;

	public $code;

	public $name;

	public $description;

	public $additionalInfo;

	public $tags;

	public $isDeleted;

	public $seoDescription;

	public $seoText;

	public $seoKeywords;

	public $seoTitle;


	function __construct(
		?float $fatAmount,
		?float $proteinsAmount,
		?float $carbohydratesAmount,
		?float $energyAmount,
		?float $fatFullAmount,
		?float $proteinsFullAmount,
		?float $carbohydratesFullAmount,
		?float $energyFullAmount,
		?float $weight,
		?string $groupId,
		?string $productCategoryId,
		?string $type,
		string $orderItemType,
		?string $modifierSchemaId,
		?string $modifierSchemaName,
		bool $splittable,
		string $measureUnit,
		array $sizePrices,
		array $modifiers,
		array $groupModifiers,
		array $imageLinks,
		bool $doNotPrintInCheque,
		?string $parentGroup,
		int $order,
		?string $fullNameEnglish,
		bool $useBalanceForSell,
		bool $canSetOpenPrice,
		string $id,
		?string $code,
		string $name,
		?string $description,
		?string $additionalInfo,
		array $tags,
		bool $isDeleted,
		?string $seoDescription,
		?string $seoText,
		?string $seoKeywords,
		?string $seoTitle
	) {
		$this->fatAmount = $fatAmount;
		$this->proteinsAmount = $proteinsAmount;
		$this->carbohydratesAmount = $carbohydratesAmount;
		$this->energyAmount = $energyAmount;
		$this->fatFullAmount = $fatFullAmount;
		$this->proteinsFullAmount = $proteinsFullAmount;
		$this->carbohydratesFullAmount = $carbohydratesFullAmount;
		$this->energyFullAmount = $energyFullAmount;
		$this->weight = $weight;
		$this->groupId = $groupId;
		$this->productCategoryId = $productCategoryId;
		$this->type = $type;
		$this->orderItemType = $this->getValidOrderItemType($orderItemType);
		$this->modifierSchemaId = $modifierSchemaId;
		$this->modifierSchemaName = $modifierSchemaName;
		$this->splittable = $splittable;
		$this->measureUnit = $measureUnit;
		$this->sizePrices = $sizePrices;
		$this->modifiers = $modifiers;
		$this->groupModifiers = $groupModifiers;
		$this->imageLinks = $imageLinks;
		$this->doNotPrintInCheque = $doNotPrintInCheque;
		$this->parentGroup = $parentGroup;
		$this->order = $order;
		$this->fullNameEnglish = $fullNameEnglish;
		$this->useBalanceForSell = $useBalanceForSell;
		$this->canSetOpenPrice = $canSetOpenPrice;
		$this->id = $id;
		$this->code = $code;
		$this->name = $name;
		$this->description = $description;
		$this->additionalInfo = $additionalInfo;
		$this->tags = $tags;
		$this->isDeleted = $isDeleted;
		$this->seoDescription = $seoDescription;
		$this->seoText = $seoText;
		$this->seoKeywords = $seoKeywords;
		$this->seoTitle = $seoTitle;
	}

	function getValidOrderItemType(string $orderItemType): string
	{
		if (in_array($orderItemType, static::orderItemTypes)) {
			return $orderItemType;
		}

		throw new Exception(
			"Processing order item type '{$orderItemType}' is not in white list Product::orderItemTypes",
			Exception::ORDER_ITEM_TYPE_IS_NOT_IN_WHITE_LIST
		);
	}
}