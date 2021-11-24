<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\Nomenclature\Group;
use IikoTransport\Entity\Nomenclature\Product\GroupModifier as ProductGroupModifier;
use IikoTransport\Entity\Nomenclature\Product\Modifier as ProductModifier;
use IikoTransport\Entity\Nomenclature\Product\Price as ProductPrice;
use IikoTransport\Entity\Nomenclature\Product\Product;
use IikoTransport\Entity\Nomenclature\Product\SizePrice as ProductSizePrice;
use IikoTransport\Entity\Nomenclature\ProductCategory;
use IikoTransport\Entity\Nomenclature\Size;

class Nomenclature
{
	var $aGroups = [];

	var $aProductCategories = [];

	var $aProducts = [];

	var $aSizes = [];

	var $nRevision;

	function __construct(array $aResponseBody)
	{
		if (!empty($aResponseBody['groups'])) {
			$this->aGroups = $this->getGroupsFromResponseArray(
				$aResponseBody['groups']
			);
		}

		if (!empty($aResponseBody['productCategories'])) {
			$this->aProductCategories = $this->getProductCategoriesFromResponseArray(
				$aResponseBody['productCategories']
			);
		}

		if (!empty($aResponseBody['products'])) {
			$this->aProducts = $this->getProductsFromResponseArray(
				$aResponseBody['products']
			);
		}

		if (!empty($aResponseBody['sizes'])) {
			$this->aSizes = $this->getSizesFromResponseArray(
				$aResponseBody['sizes']
			);
		}

		if (!empty($aResponseBody['revision'])) {
			$this->nRevision = (int) $aResponseBody['revision'];
		}
	}

	function getGroupsFromResponseArray(array $aGroups): array
	{
		$aResult = [];
		foreach ($aGroups as $aGroup) {
			$aResult[] = $this->getGroup($aGroup);
		}
		return $aResult;
	}

	function getGroup(array $aGroup): Group
	{
		return new Group(
			$aGroup['id'],
			$aGroup['code'],
			$aGroup['name'],
			$aGroup['imageLinks'] ?? [],
			$aGroup['parentGroup'],
			$aGroup['order'],
			$aGroup['isIncludedInMenu'],
			$aGroup['isGroupModifier'],
			$aGroup['description'],
			$aGroup['additionalInfo'],
			$aGroup['tags'] ?? [],
			$aGroup['isDeleted'],
			$aGroup['seoDescription'],
			$aGroup['seoText'],
			$aGroup['seoKeywords'],
			$aGroup['seoTitle']
		);
	}

	function getProductCategoriesFromResponseArray(array $aProductCategories): array
	{
		$aResult = [];
		foreach ($aProductCategories as $aProductCategory) {
			$aResult[] = $this->getProductCategory($aProductCategory);
		}
		return $aResult;
	}

	function getProductCategory(array $aProductCategory): ProductCategory
	{
		return new ProductCategory(
			$aProductCategory['id'],
			$aProductCategory['name'],
			$aProductCategory['isDeleted']
		);
	}

	function getProductsFromResponseArray(array $aProducts): array
	{
		$aResult = [];
		foreach ($aProducts as $aProduct) {
			$aResult[] = $this->getProduct($aProduct);
		}
		return $aResult;
	}

	function getProduct(array $aProduct): Product
	{
		return new Product(
			$aProduct['fatAmount'],
			$aProduct['proteinsAmount'],
			$aProduct['carbohydratesAmount'],
			$aProduct['energyAmount'],
			$aProduct['fatFullAmount'],
			$aProduct['proteinsFullAmount'],
			$aProduct['carbohydratesFullAmount'],
			$aProduct['energyFullAmount'],
			$aProduct['weight'],
			$aProduct['groupId'],
			$aProduct['productCategoryId'],
			$aProduct['type'],
			$aProduct['orderItemType'],
			$aProduct['modifierSchemaId'],
			$aProduct['modifierSchemaName'],
			$aProduct['splittable'],
			$aProduct['measureUnit'],
			$this->getSizePricesOfProduct($aProduct['sizePrices']),
			$this->getModifiersOfProduct($aProduct['modifiers']),
			$this->getGroupModifiersOfProduct($aProduct['groupModifiers']),
			$aProduct['imageLinks'] ?? [],
			$aProduct['doNotPrintInCheque'],
			$aProduct['parentGroup'],
			$aProduct['order'],
			$aProduct['fullNameEnglish'],
			$aProduct['useBalanceForSell'],
			$aProduct['canSetOpenPrice'],
			$aProduct['id'],
			$aProduct['code'],
			$aProduct['name'],
			$aProduct['description'],
			$aProduct['additionalInfo'],
			$aProduct['tags'] ?? [],
			$aProduct['isDeleted'],
			$aProduct['seoDescription'],
			$aProduct['seoText'],
			$aProduct['seoKeywords'],
			$aProduct['seoTitle']
		);
	}

	function getSizePricesOfProduct(array $aSizePrices): array
	{
		$aResult = [];
		foreach ($aSizePrices as $aSizePrice) {
			$aResult[] = $this->getSizePrice($aSizePrice);
		}
		return $aResult;
	}

	function getSizePrice(array $aSizePrice): ProductSizePrice
	{
		return new ProductSizePrice(
			$aSizePrice['sizeId'],
			$this->getPriceOfSizePrice($aSizePrice['price'])
		);
	}

	function getPriceOfSizePrice(array $aPrice): ProductPrice
	{
		return new ProductPrice(
			$aPrice['currentPrice'],
			$aPrice['isIncludedInMenu'],
			$aPrice['nextPrice'],
			$aPrice['nextIncludedInMenu'],
			$aPrice['nextDatePrice']
		);
	}

	function getModifiersOfProduct(array $aModifiers): array
	{
		$aResult = [];
		foreach ($aModifiers as $aModifier) {
			$aResult[] = $this->getModifier($aModifier);
		}
		return $aResult;
	}

	function getModifier(array $aModifier): ProductModifier
	{
		return new ProductModifier(
			$aModifier['id'],
			$aModifier['defaultAmount'],
			$aModifier['minAmount'],
			$aModifier['maxAmount'],
			$aModifier['required'],
			$aModifier['hideIfDefaultAmount'],
			$aModifier['splittable'],
			$aModifier['freeOfChargeAmount']
		);
	}

	function getGroupModifiersOfProduct(array $aGroupModifiers): array
	{
		$aResult = [];
		foreach ($aGroupModifiers as $aGroupModifier) {
			$aResult[] = $this->getGroupModifier($aGroupModifier);
		}
		return $aResult;
	}

	function getGroupModifier(array $aGroupModifier): ProductGroupModifier
	{
		return new ProductGroupModifier(
			$aGroupModifier['id'],
			$aGroupModifier['minAmount'],
			$aGroupModifier['maxAmount'],
			$aGroupModifier['required'],
			$aGroupModifier['childModifiersHaveMinMaxRestrictions'],
			$this->getModifiersOfProduct($aGroupModifier['childModifiers']),
			$aGroupModifier['hideIfDefaultAmount'],
			$aGroupModifier['defaultAmount'],
			$aGroupModifier['splittable'],
			$aGroupModifier['freeOfChargeAmount']
		);
	}

	function getSizesFromResponseArray(array $aSizes): array
	{
		$aResult = [];
		foreach ($aSizes as $aSize) {
			$aResult[] = $this->getSize($aSize);
		}
		return $aResult;
	}

	function getSize(array $aSize): Size
	{
		return new Size(
			$aSize['id'],
			$aSize['name'],
			$aSize['priority'],
			$aSize['isDefault']
		);
	}

	public function getGroups(): array
	{
		return $this->aGroups;
	}

	public function getProductCategories(): array
	{
		return $this->aProductCategories;
	}

	public function getProducts(): array
	{
		return $this->aProducts;
	}

	public function getSizes(): array
	{
		return $this->aSizes;
	}

	public function getRevision(): int
	{
		return $this->nRevision;
	}
}