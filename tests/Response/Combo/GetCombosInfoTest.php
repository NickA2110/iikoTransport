<?php 

namespace IikoTransport\Tests\Response\Combo;

use IikoTransport\Entity\Combo\ComboCategory;
use IikoTransport\Entity\Combo\ComboSpecification;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Combo\GetCombosInfo as Response;
use PHPUnit\Framework\TestCase;

class GetCombosInfoTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = $this->getResponseByArray($aResponse);
		
		$this->checkComboSpecifications($oResponse);
		$this->checkComboCategories($oResponse);
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

	function checkComboSpecifications(Response $oResponse) {
		$aResult = $oResponse->getComboSpecifications();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			ComboSpecification::class,
			get_class($oResultItem),
			"The GetCombosInfo Response return instance of not ComboSpecification"
		);
	}

	function checkComboCategories(Response $oResponse) {
		$aResult = $oResponse->getComboCategories();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			ComboCategory::class,
			get_class($oResultItem),
			"The GetCombosInfo Response return instance of not ComboCategory"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
		$aResult['aResponseWithSimpleCombo'] = [
			'aResponse' => [
				'comboSpecifications' => $this->getComboSpecifications(),
				'comboCategories' => $this->getComboCategories(),
			],
		];
		return $aResult;
	}

	function getComboSpecifications(): array
	{
		return json_decode('[
    {
      "sourceActionId": "fe470000-906b-0025-970f-08d90a50b86a",
      "categoryId": null,
      "name": "Классик",
      "priceModificationType": 0,
      "priceModification": 1399.0,
      "groups": [
        {
          "id": "a381a251-ad2f-4d91-825b-dbf05464867b",
          "name": "1 пицца",
          "isMainGroup": false,
          "products": [
            {
              "productId": "796131ea-4206-46a0-976e-9d2b8db3a7b6",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        },
        {
          "id": "57dc925e-a6b2-42a6-9991-7ad00594c8d6",
          "name": "2 пицца",
          "isMainGroup": false,
          "products": [
            {
              "productId": "05b1f509-a1ab-4b7b-b5d8-a4defb27f6ae",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        },
        {
          "id": "6c5b7aff-3e5f-4cb9-a2a4-c6891b0e3939",
          "name": "Крылья на выбор",
          "isMainGroup": false,
          "products": [
            {
              "productId": "7584f7e2-f0d5-45c9-a5d3-e7045a89a582",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            },
            {
              "productId": "8e7de609-6661-4feb-85af-05eb21761589",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            },
            {
              "productId": "3e16d489-fabd-4df5-aa3f-947d2f2f3df7",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            },
            {
              "productId": "68346a03-438b-4cd8-8035-5dad62ae2f29",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        }
      ]
    },
    {
      "sourceActionId": "fe470000-906b-0025-419a-08d90a7b4b1c",
      "categoryId": null,
      "name": "Баварский",
      "priceModificationType": 0,
      "priceModification": 2499.0,
      "groups": [
        {
          "id": "42dafddc-0ba3-4fcb-8151-132553c81e4c",
          "name": "Новая группа",
          "isMainGroup": false,
          "products": [
            {
              "productId": "8abe9fdf-579b-46ba-8c2c-907bf39cc44d",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        },
        {
          "id": "5d06d84f-5647-47e0-8845-6994c4ac1f1c",
          "name": "Новая группа",
          "isMainGroup": false,
          "products": [
            {
              "productId": "06ca5aee-f915-45ae-ac8b-acfcdbe863e7",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        },
        {
          "id": "0ab58484-5509-4a9b-aa39-75f441fdefb5",
          "name": "Новая группа",
          "isMainGroup": false,
          "products": [
            {
              "productId": "b6f42347-ce1f-4c79-9b9b-b1d0756d4657",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        },
        {
          "id": "6bdb6f07-efa5-4805-bb82-668eb04055cc",
          "name": "Новая группа",
          "isMainGroup": false,
          "products": [
            {
              "productId": "796131ea-4206-46a0-976e-9d2b8db3a7b6",
              "sizeId": null,
              "forbiddenModifiers": null,
              "priceModificationAmount": 0.0
            }
          ]
        }
      ]
    }
]', true);
	}

	function getComboCategories(): array
	{
		return json_decode('[
    {
      "id": "89dda84b-b862-4087-bc9d-e9049da87541",
      "name": "Бизнес Ланч"
    }
]', true);
	}
}
