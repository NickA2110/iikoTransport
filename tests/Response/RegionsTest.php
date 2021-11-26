<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\Address\OrganizationRegions;
use IikoTransport\Request\Common as CommonRequest; 
use IikoTransport\Response\Regions as Response; 
use PHPUnit\Framework\TestCase;

class RegionsTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = $this->getResponseByArray($aResponse);
		
		$aRegions = $oResponse->getOrganizationRegions();
		$this->assertNotEmpty($aRegions);

		$aRegion = reset($aRegions);
		$this->assertEquals(
      OrganizationRegions::class,
			get_class($aRegion),
			"The Regions Response return instance of not OrganizationRegions"
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
		$aResult['aResponseWithSimpleRegions'] = [
			'aResponse' => [
				'regions' => 
json_decode('[
    {
      "organizationId": "01234567-0123-0123-0123-0123456789ab",
      "items": [
        {
          "id": "12817024-bb65-46d6-a1b0-cf1a095b098d",
          "name": "2",
          "externalRevision": 3237741,
          "isDeleted": false
        },
        {
          "id": "009e5b16-2081-41d2-98e3-de7e774684c8",
          "name": "1",
          "externalRevision": 3237741,
          "isDeleted": false
        },
        {
          "id": "81377628-2451-4988-a33c-e56d7a6996d4",
          "name": "3",
          "externalRevision": 3237741,
          "isDeleted": false
        }
      ]
    }
  ]', true),
			],
		];
		return $aResult;
	}
}
