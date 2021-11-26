<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\Address\Street;
use IikoTransport\Request\Common as CommonRequest; 
use IikoTransport\Response\StreetsByCity as Response; 
use PHPUnit\Framework\TestCase;

class StreetsByCityTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = $this->getResponseByArray($aResponse);
		
		$aStreets = $oResponse->getStreets();
		$this->assertNotEmpty($aStreets);

		$aStreet = reset($aStreets);
		$this->assertEquals(
      Street::class,
			get_class($aStreet),
			"The StreetsByCity Response return instance of not Street"
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
		$aResult['aResponseWithSimpleStreets'] = [
			'aResponse' => [
				'streets' => 
json_decode('[
    {
      "id": "f8aaf1ec-8f46-907f-9357-e4c27bab5f78",
      "name": "----------",
      "externalRevision": 3615381,
      "classifierId": null,
      "isDeleted": false
    },
    {
      "id": "2d2746bc-b75b-48c8-0170-2cd0f36cf004",
      "name": "10-й Кедровый переулок",
      "externalRevision": 1669637,
      "classifierId": "99000009000097400",
      "isDeleted": false
    },
    {
      "id": "2d2746bc-b75b-48c8-0170-2cd0f36cee39",
      "name": "10-я Садовая",
      "externalRevision": 3313468,
      "classifierId": "99000009000099500",
      "isDeleted": false
    }
  ]', true),
			],
		];
		return $aResult;
	}
}
