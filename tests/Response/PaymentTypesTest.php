<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\PaymentType\EInterface;
use IikoTransport\Response\PaymentTypes as Response; 
use PHPUnit\Framework\TestCase;

class PaymentTypesTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = new Response(
			$aResponse
		);
		
		$aPaymentTypes = $oResponse->getPaymentTypes();
		$this->assertNotEmpty($aPaymentTypes);

		$oPaymentType = reset($aPaymentTypes);
		$this->assertTrue(
			is_subclass_of($oPaymentType, EInterface::class),
			"The PaymentTypes Response return instance of not EInterface"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
		$aResult['aResponseWithSimplePaymentTypes'] = [
			'aResponse' => [
				'paymentTypes' => 
json_decode('[
    {
      "id": "034d363e-3e73-4d83-842d-a7db91e465d7",
      "code": "CARDO",
      "name": "Картой Курьеру",
      "comment": "",
      "combinable": true,
      "externalRevision": 3301064,
      "applicableMarketingCampaigns": [],
      "isDeleted": true,
      "printCheque": true,
      "paymentProcessingType": "Internal",
      "paymentTypeKind": "Card",
      "terminalGroups": [
        {
          "id": "12345678-1234-1234-1234-1234567890ab",
          "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
          "name": "Simple-Group",
          "address": ""
        }
      ]
    },
    {
      "id": "09322f46-578a-d210-add7-eec222a08871",
      "code": "CASH",
      "name": "Наличные",
      "comment": "",
      "combinable": true,
      "externalRevision": 3642186,
      "applicableMarketingCampaigns": [],
      "isDeleted": false,
      "printCheque": true,
      "paymentProcessingType": "Internal",
      "paymentTypeKind": "Cash",
      "terminalGroups": [
        {
          "id": "12345678-1234-1234-1234-1234567890ab",
          "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
          "name": "Simple-Group",
          "address": ""
        }
      ]
    },
    {
      "id": "20d6db27-e23f-43ba-90e9-a6e6d80f17c7",
      "code": "CASHO",
      "name": "Наличные с сайта",
      "comment": "",
      "combinable": true,
      "externalRevision": 3300152,
      "applicableMarketingCampaigns": [],
      "isDeleted": true,
      "printCheque": false,
      "paymentProcessingType": "Internal",
      "paymentTypeKind": "Cash",
      "terminalGroups": [
        {
          "id": "12345678-1234-1234-1234-1234567890ab",
          "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
          "name": "Simple-Group",
          "address": ""
        }
      ]
    },
    {
      "id": "43324df2-e408-4c7a-af9f-2e5339cb0237",
      "code": "BONUS",
      "name": "Бонусы  iikoCard",
      "comment": "",
      "combinable": true,
      "externalRevision": 1655356,
      "applicableMarketingCampaigns": [
        "5f850000-90a3-0025-45f8-08d887cb9a78"
      ],
      "isDeleted": false,
      "printCheque": false,
      "paymentProcessingType": "Internal",
      "paymentTypeKind": "IikoCard",
      "terminalGroups": [
        {
          "id": "12345678-1234-1234-1234-1234567890ab",
          "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
          "name": "Simple-Group",
          "address": ""
        }
      ]
    },
    {
      "id": "9cd5d67a-89b4-ab69-1365-7b8c51865a90",
      "code": "VISA",
      "name": "Банковские карты",
      "comment": "",
      "combinable": true,
      "externalRevision": 3300044,
      "applicableMarketingCampaigns": [],
      "isDeleted": false,
      "printCheque": true,
      "paymentProcessingType": "Both",
      "paymentTypeKind": "Card",
      "terminalGroups": [
        {
          "id": "12345678-1234-1234-1234-1234567890ab",
          "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
          "name": "Simple-Group",
          "address": ""
        }
      ]
    },
    {
      "id": "a4f76d2a-5340-408d-a43f-3bc60f4a05b3",
      "code": "SITE",
      "name": "Оплата с сайта",
      "comment": "",
      "combinable": true,
      "externalRevision": 3305891,
      "applicableMarketingCampaigns": [],
      "isDeleted": false,
      "printCheque": false,
      "paymentProcessingType": "Both",
      "paymentTypeKind": "Card",
      "terminalGroups": [
        {
          "id": "12345678-1234-1234-1234-1234567890ab",
          "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
          "name": "Simple-Group",
          "address": ""
        }
      ]
    }
  ]', true),
			],
		];
		return $aResult;
	}
}
