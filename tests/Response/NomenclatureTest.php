<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\Nomenclature\Group;
use IikoTransport\Entity\Nomenclature\Product\Product;
use IikoTransport\Entity\Nomenclature\ProductCategory;
use IikoTransport\Entity\Nomenclature\Size;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Nomenclature as Response;
use PHPUnit\Framework\TestCase;

class NomenclatureTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = $this->getResponseByArray($aResponse);
		
		$this->checkGroups($oResponse);
		$this->checkProductCategories($oResponse);
		$this->checkProducts($oResponse);
		$this->checkSizes($oResponse);

		$this->assertNotEmpty($oResponse->getRevision());
	}

  function getResponseByArray(array $aResponse): Response
  {
    $oResponse = new Response(
      $oRequest = $this->createMock(CommonRequest::class),
      $nHttpStatus = 200,
      $aHeaders = [],
      json_encode($aResponse)
    );
    return $oResponse->parseBody();
  }

	function checkGroups(Response $oResponse) {
		$aResult = $oResponse->getGroups();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			Group::class,
			get_class($oResultItem),
			"The Nomenclature Response return instance of not Group"
		);
	}

	function checkProductCategories(Response $oResponse) {
		$aResult = $oResponse->getProductCategories();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			ProductCategory::class,
			get_class($oResultItem),
			"The Nomenclature Response return instance of not ProductCategory"
		);
	}

	function checkProducts(Response $oResponse) {
		$aResult = $oResponse->getProducts();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			Product::class,
			get_class($oResultItem),
			"The Nomenclature Response return instance of not Product"
		);
	}

	function checkSizes(Response $oResponse) {
		$aResult = $oResponse->getSizes();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			Size::class,
			get_class($oResultItem),
			"The Nomenclature Response return instance of not Sizes"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
		$aResult['aResponseWithSimpleNomenclature'] = [
			'aResponse' => [
				'groups' => $this->getGroups(),
				'productCategories' => $this->getProductCategories(),
				'products' => $this->getProducts(),
				'sizes' => $this->getSizes(),
				'revision' => 1637664530796,
			],
		];
		return $aResult;
	}

	function getGroups(): array
	{
		return json_decode('[
    {
      "imageLinks": [],
      "parentGroup": null,
      "order": 0,
      "isIncludedInMenu": true,
      "isGroupModifier": true,
      "id": "e979f75d-2942-4948-9152-0de81cf6762f",
      "code": "828",
      "name": "Добавка к пицце 30 см.",
      "description": "",
      "additionalInfo": null,
      "tags": null,
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    },
    {
      "imageLinks": [],
      "parentGroup": null,
      "order": 3,
      "isIncludedInMenu": true,
      "isGroupModifier": false,
      "id": "5fcf7ef5-d031-4e51-8592-641094fb4bc3",
      "code": "",
      "name": "Пицца",
      "description": null,
      "additionalInfo": null,
      "tags": [],
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    },
    {
      "imageLinks": [],
      "parentGroup": "5fcf7ef5-d031-4e51-8592-641094fb4bc3",
      "order": 4,
      "isIncludedInMenu": true,
      "isGroupModifier": false,
      "id": "03075130-e18d-46c8-ba1d-25e57cd031f7",
      "code": "",
      "name": "Тонкое 30 см.",
      "description": null,
      "additionalInfo": null,
      "tags": [],
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    }
]', true);
	}

	function getProductCategories(): array
	{
		return json_decode('[
    {
      "id": "2d2746bc-b75b-48c8-0170-51abba7b9ac7",
      "name": "Десерты",
      "isDeleted": false
    },
    {
      "id": "5be0f0fb-0ce8-ef50-0179-802109949e70",
      "name": "тонк. 30 см. (акция)",
      "isDeleted": false
    }
]', true);
	}

	function getProducts(): array
	{
		return json_decode('[
    {
      "fatAmount": 4.801000000,
      "proteinsAmount": 7.628000000,
      "carbohydratesAmount": 33.108000000,
      "energyAmount": 206.150000000,
      "fatFullAmount": 23.284850000000000000,
      "proteinsFullAmount": 36.995800000000000000,
      "carbohydratesFullAmount": 160.573800000000000000,
      "energyFullAmount": 999.827500000000000000,
      "weight": 0.485000000,
      "groupId": "9edec410-ad71-4fc1-8230-90ddcba54c54",
      "productCategoryId": "2d2746bc-b75b-48c8-0170-51abba7b9ac7",
      "type": "Dish",
      "orderItemType": "Product",
      "modifierSchemaId": null,
      "modifierSchemaName": null,
      "splittable": false,
      "measureUnit": "порц",
      "sizePrices": [
        {
          "sizeId": null,
          "price": {
            "currentPrice": 279.000000000,
            "isIncludedInMenu": true,
            "nextPrice": null,
            "nextIncludedInMenu": false,
            "nextDatePrice": null
          }
        }
      ],
      "modifiers": [],
      "groupModifiers": [],
      "imageLinks": [],
      "doNotPrintInCheque": false,
      "parentGroup": "c5865191-82d3-4b52-a4a8-2c47598df03b",
      "order": 0,
      "fullNameEnglish": "",
      "useBalanceForSell": false,
      "canSetOpenPrice": false,
      "id": "8ff77aa9-5320-4cca-9774-c6b79b76534f",
      "code": "00130",
      "name": "Роллы с ананасом (16 шт.)",
      "description": "",
      "additionalInfo": null,
      "tags": [],
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    },
    {
      "fatAmount": 12.101000000,
      "proteinsAmount": 10.718000000,
      "carbohydratesAmount": 25.759000000,
      "energyAmount": 254.812000000,
      "fatFullAmount": 68.249640000000000000,
      "proteinsFullAmount": 60.449520000000000000,
      "carbohydratesFullAmount": 145.280760000000000000,
      "energyFullAmount": 1437.139680000000000000,
      "weight": 0.564000000,
      "groupId": "2c3352d2-3d2b-4d6b-b24b-dc51415c6b30",
      "productCategoryId": "5be0f0fb-0ce8-ef50-0179-802109949e70",
      "type": "Dish",
      "orderItemType": "Product",
      "modifierSchemaId": null,
      "modifierSchemaName": null,
      "splittable": false,
      "measureUnit": "шт",
      "sizePrices": [
        {
          "sizeId": null,
          "price": {
            "currentPrice": 759.000000000,
            "isIncludedInMenu": true,
            "nextPrice": null,
            "nextIncludedInMenu": false,
            "nextDatePrice": null
          }
        }
      ],
      "modifiers": [],
      "groupModifiers": [
        {
          "id": "e979f75d-2942-4948-9152-0de81cf6762f",
          "minAmount": 0,
          "maxAmount": 99,
          "required": false,
          "childModifiersHaveMinMaxRestrictions": false,
          "childModifiers": [
            {
              "id": "db8efcbc-abd8-4d04-a0b2-03097e4ac033",
              "defaultAmount": 0,
              "minAmount": 0,
              "maxAmount": 0,
              "required": false,
              "hideIfDefaultAmount": false,
              "splittable": false,
              "freeOfChargeAmount": 0
            },
            {
              "id": "52a354ef-08c1-4a08-8013-058e5864e64c",
              "defaultAmount": 0,
              "minAmount": 0,
              "maxAmount": 0,
              "required": false,
              "hideIfDefaultAmount": false,
              "splittable": false,
              "freeOfChargeAmount": 0
            }
          ],
          "hideIfDefaultAmount": false,
          "defaultAmount": 0,
          "splittable": false,
          "freeOfChargeAmount": 0
        }
      ],
      "imageLinks": [],
      "doNotPrintInCheque": false,
      "parentGroup": "03075130-e18d-46c8-ba1d-25e57cd031f7",
      "order": 11,
      "fullNameEnglish": "",
      "useBalanceForSell": false,
      "canSetOpenPrice": false,
      "id": "d335023e-014f-4370-a311-1ab31d80f37e",
      "code": "00312",
      "name": "Карбонара (Тонк. 30 см.)",
      "description": "соус \"чесночный ранч\", бекон, помидоры, сыр пармезан, сыр моцарелла",
      "additionalInfo": null,
      "tags": [],
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    },
    {
      "fatAmount": 0.000000000,
      "proteinsAmount": 0.000000000,
      "carbohydratesAmount": 0.000000000,
      "energyAmount": 0.000000000,
      "fatFullAmount": 0.000000000000000000,
      "proteinsFullAmount": 0.000000000000000000,
      "carbohydratesFullAmount": 0.000000000000000000,
      "energyFullAmount": 0.000000000000000000,
      "weight": 0.000000000,
      "groupId": "e979f75d-2942-4948-9152-0de81cf6762f",
      "productCategoryId": null,
      "type": "Modifier",
      "orderItemType": "Product",
      "modifierSchemaId": null,
      "modifierSchemaName": null,
      "splittable": false,
      "measureUnit": "порц",
      "sizePrices": [
        {
          "sizeId": null,
          "price": {
            "currentPrice": 75.000000000,
            "isIncludedInMenu": true,
            "nextPrice": null,
            "nextIncludedInMenu": false,
            "nextDatePrice": null
          }
        }
      ],
      "modifiers": [],
      "groupModifiers": [],
      "imageLinks": [],
      "doNotPrintInCheque": false,
      "parentGroup": "e979f75d-2942-4948-9152-0de81cf6762f",
      "order": 0,
      "fullNameEnglish": "",
      "useBalanceForSell": false,
      "canSetOpenPrice": false,
      "id": "db8efcbc-abd8-4d04-a0b2-03097e4ac033",
      "code": "00784",
      "name": "Пепперони (доп.)",
      "description": "",
      "additionalInfo": null,
      "tags": null,
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    },
    {
      "fatAmount": 0.000000000,
      "proteinsAmount": 0.000000000,
      "carbohydratesAmount": 0.000000000,
      "energyAmount": 0.000000000,
      "fatFullAmount": 0.000000000000000000,
      "proteinsFullAmount": 0.000000000000000000,
      "carbohydratesFullAmount": 0.000000000000000000,
      "energyFullAmount": 0.000000000000000000,
      "weight": 0.020000000,
      "groupId": "e979f75d-2942-4948-9152-0de81cf6762f",
      "productCategoryId": null,
      "type": "Modifier",
      "orderItemType": "Product",
      "modifierSchemaId": null,
      "modifierSchemaName": null,
      "splittable": false,
      "measureUnit": "порц",
      "sizePrices": [
        {
          "sizeId": null,
          "price": {
            "currentPrice": 75.000000000,
            "isIncludedInMenu": true,
            "nextPrice": null,
            "nextIncludedInMenu": false,
            "nextDatePrice": null
          }
        }
      ],
      "modifiers": [],
      "groupModifiers": [],
      "imageLinks": [],
      "doNotPrintInCheque": false,
      "parentGroup": "e979f75d-2942-4948-9152-0de81cf6762f",
      "order": 0,
      "fullNameEnglish": "",
      "useBalanceForSell": false,
      "canSetOpenPrice": false,
      "id": "52a354ef-08c1-4a08-8013-058e5864e64c",
      "code": "08643",
      "name": "Маслины (доп.)",
      "description": "",
      "additionalInfo": null,
      "tags": null,
      "isDeleted": false,
      "seoDescription": null,
      "seoText": null,
      "seoKeywords": null,
      "seoTitle": null
    }
]', true);
	}

	function getSizes(): array
	{
		return json_decode('[
    {
      "id": "5be0f0fb-0ce8-ef50-0179-802109949e07",
      "name": "Size XXL",
      "priority": 4,
      "isDefault": true
    }
]', true);
	}
}
