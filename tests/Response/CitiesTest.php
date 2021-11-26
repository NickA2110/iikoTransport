<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\Address\OrganizationCities;
use IikoTransport\Request\Common as CommonRequest; 
use IikoTransport\Response\Cities as Response; 
use PHPUnit\Framework\TestCase;

class CitiesTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = $this->getResponseByArray($aResponse);
		
		$aOrganizationsCities = $oResponse->getOrganizationCities();
		$this->assertNotEmpty($aOrganizationsCities);

		$aOrganizationCities = reset($aOrganizationsCities);
		$this->assertEquals(
      OrganizationCities::class,
			get_class($aOrganizationCities),
			"The Cities Response return instance of not OrganizationCities"
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
		$aResult['aResponseWithSimpleCities'] = [
			'aResponse' => [
				'cities' => 
json_decode('[
    {
      "organizationId": "01234567-0123-0123-0123-0123456789ab",
      "items": [
        {
          "id": "12345678-1234-1234-1234-123456789abc",
          "name": "SomeCity",
          "externalRevision": 5635,
          "isDeleted": false,
          "classifierId": "9900000900000",
          "additionalInfo": null
        }
      ]
    }
  ]', true),
			],
		];
		return $aResult;
	}
}
