<?php 

namespace IikoTransport\Tests\Entity\Nomenclature\Product;

use IikoTransport\Entity\Nomenclature\Product\Exception;
use IikoTransport\Entity\Nomenclature\Product\Product as Entity; 
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase 
{
	/** @dataProvider providerEntityVars */
	public function testGoodCreate(array $aVars) {
		$oEntity = $this->createEntity($aVars);
		$this->assertNotEmpty($oEntity);
	}

	/** @dataProvider providerEntityVars */
	public function testBadOrderItemType(array $aVars) {
		$aVars['orderItemType'] = 'UndefinedOrderItemType';

		$this->expectException(
			Exception::class,
			"Bad orderItemType is not throwing exception"
		);
		$this->expectExceptionCode(Exception::ORDER_ITEM_TYPE_IS_NOT_IN_WHITE_LIST);

		$this->createEntity($aVars);
	}

	function providerEntityVars(): array
	{
		return [
			[
				'aVars' => [
					'fatAmount' => null,
					'proteinsAmount' => null,
					'carbohydratesAmount' => null,
					'energyAmount' => null,
					'fatFullAmount' => null,
					'proteinsFullAmount' => null,
					'carbohydratesFullAmount' => null,
					'energyFullAmount' => null,
					'weight' => null,
					'groupId' => null,
					'productCategoryId' => null,
					'type' => null,
					'orderItemType' => 'Product',
					'modifierSchemaId' => null,
					'modifierSchemaName' => null,
					'splittable' => false,
					'measureUnit' => 'unit',
					'sizePrices' => [],
					'modifiers' => [],
					'groupModifiers' => [],
					'imageLinks' => [],
					'doNotPrintInCheque' => false,
					'parentGroup' => null,
					'order' => 1,
					'fullNameEnglish' => null,
					'useBalanceForSell' => false,
					'canSetOpenPrice' => false,
					'id' => '',
					'code' => null,
					'name' => 'Some product name',
					'description' => null,
					'additionalInfo' => null,
					'tags' => [],
					'isDeleted' => false,
					'seoDescription' => null,
					'seoText' => null,
					'seoKeywords' => null,
					'seoTitle' => null,
				]
			]
		];
	}

	function createEntity(array $aVars): Entity
	{
		extract($aVars);
		$oEntity = new Entity(
			$fatAmount,
			$proteinsAmount,
			$carbohydratesAmount,
			$energyAmount,
			$fatFullAmount,
			$proteinsFullAmount,
			$carbohydratesFullAmount,
			$energyFullAmount,
			$weight,
			$groupId,
			$productCategoryId,
			$type,
			$orderItemType,
			$modifierSchemaId,
			$modifierSchemaName,
			$splittable,
			$measureUnit,
			$sizePrices,
			$modifiers,
			$groupModifiers,
			$imageLinks,
			$doNotPrintInCheque,
			$parentGroup,
			$order,
			$fullNameEnglish,
			$useBalanceForSell,
			$canSetOpenPrice,
			$id,
			$code,
			$name,
			$description,
			$additionalInfo,
			$tags,
			$isDeleted,
			$seoDescription,
			$seoText,
			$seoKeywords,
			$seoTitle
		);
		return $oEntity;
	}
}
