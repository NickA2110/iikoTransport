<?php

namespace IikoTransport\Response\Combo;

use IikoTransport\Entity\Combo\ComboCategory;
use IikoTransport\Entity\Combo\ComboSpecification;
use IikoTransport\Entity\Combo\Group;
use IikoTransport\Entity\Combo\Product;
use IikoTransport\Response\Common;
use IikoTransport\Response\IResponse;

class GetCombosInfo extends Common
{
	var $aComboSpecifications;

	var $aComboCategories;

	public function parseBody(): IResponse
	{
		$this->aComboSpecifications = [];
		$this->aComboCategories = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['comboSpecifications'])) {
			$this->aComboSpecifications = $this->getComboSpecificationsFromResponseArray(
				$aBody['comboSpecifications']
			);
		}

		if (!empty($aBody['comboCategories'])) {
			$this->aComboCategories = $this->getComboCategoriesFromResponseArray(
				$aBody['comboCategories']
			);
		}

		return $this;
	}

	function getComboSpecificationsFromResponseArray(array $aComboSpecifications): array
	{
		$aResult = [];
		foreach ($aComboSpecifications as $aComboSpecification) {
			$aResult[] = $this->getComboSpecification($aComboSpecification);
		}
		return $aResult;
	}

	function getComboSpecification(array $aComboSpecification): ComboSpecification
	{
		return new ComboSpecification(
			$aComboSpecification['sourceActionId'],
			$aComboSpecification['categoryId'],
			$aComboSpecification['name'],
			$aComboSpecification['priceModificationType'],
			$aComboSpecification['priceModification'],
			$this->getGroupsOfComboSpecification($aComboSpecification['groups'])
		);
	}

	function getGroupsOfComboSpecification(array $aGroups): array
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
			$aGroup['name'],
			$this->getProductsOfGroup($aGroup['products'])
		);
	}

	function getProductsOfGroup(array $aProducts): array
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
			$aProduct['productId'],
			$aProduct['sizeId'],
			$aProduct['forbiddenModifiers'] ?? [],
			$aProduct['priceModificationAmount']
		);
	}

	function getComboCategoriesFromResponseArray(array $aComboCategories): array
	{
		$aResult = [];
		foreach ($aComboCategories as $aComboCategory) {
			$aResult[] = $this->getComboCategory($aComboCategory);
		}
		return $aResult;
	}

	function getComboCategory(array $aComboCategory): ComboCategory
	{
		return new ComboCategory(
			$aComboCategory['id'],
			$aComboCategory['name']
		);
	}

	public function getComboSpecifications(): array
	{
		if (!is_array($this->aComboSpecifications)) {
			$this->parseBody();
		}
		return $this->aComboSpecifications;
	}

	public function getComboCategories(): array
	{
		if (!is_array($this->aComboCategories)) {
			$this->parseBody();
		}
		return $this->aComboCategories;
	}
}