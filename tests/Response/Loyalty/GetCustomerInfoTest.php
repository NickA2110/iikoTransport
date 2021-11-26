<?php 

namespace IikoTransport\Tests\Response\Loyalty;

use IikoTransport\Entity\Loyalty\Customer\Info as CustomerInfo;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Loyalty\GetCustomerInfo as Response;
use PHPUnit\Framework\TestCase;

class GetCustomerInfoTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = $this->getResponseByArray($aResponse);
		
		$oCustomerInfo = $oResponse->getCustomerInfo();
    $this->assertNotEmpty($oCustomerInfo);

    $this->assertEquals(
      CustomerInfo::class,
      get_class($oCustomerInfo),
      "The GetCustomerInfo Response return instance of not CustomerInfo"
    );
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

	public function providerCreateResponse() {
		$aResult = [];
		$aResult['aResponseWithSimpleCustomerInfo'] = [
			'aResponse' => $this->getCustomerInfo(),
		];
		return $aResult;
	}

	function getCustomerInfo(): array
	{
		return json_decode('{
  "id": "5f850000-90a3-0025-7d35-08d95836925e",
  "referrerId": null,
  "name": "Username",
  "surname": "Usersurname",
  "middleName": null,
  "comment": "Tester user",
  "phone": "+79998887766",
  "cultureName": "ru-RU",
  "birthday": "2000-04-01 00:00:00.000",
  "email": "mail.of.user@mail.ru",
  "sex": 1,
  "consentStatus": 0,
  "anonymized": false,
  "cards": [],
  "categories": [
    {
      "id": "fdb02941-4e09-4519-84c6-109d3174916a",
      "name": "ДР 2021",
      "isActive": true,
      "isDefaultForNewGuests": true
    },
    {
      "id": "dc33a772-f6b0-4688-b702-8470cc587626",
      "name": "Бонусы 5%",
      "isActive": true,
      "isDefaultForNewGuests": true
    }
  ],
  "walletBalances": [
    {
      "id": "5f850000-90a3-0025-6ae6-08d887cb60ce",
      "name": "Бонусная программа",
      "type": 1,
      "balance": 500.00000
    }
  ],
  "userData": null,
  "shouldReceivePromoActionsInfo": true,
  "shouldReceiveLoyaltyInfo": true,
  "shouldReceiveOrderStatusInfo": false,
  "personalDataConsentFrom": null,
  "personalDataConsentTo": null,
  "personalDataProcessingFrom": null,
  "personalDataProcessingTo": null,
  "isDeleted": false
}', true);
	}

}
