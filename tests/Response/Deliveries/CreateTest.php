<?php 

namespace IikoTransport\Tests\Response\Deliveries;

use IikoTransport\Entity\Deliveries\OrderInfo;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Deliveries\Create as Response;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse)
  {	
		$oResponse = $this->getResponseByArray($aResponse);
		
		$this->checkOrderInfo($oResponse);
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

	function checkOrderInfo(Response $oResponse) {
		$oOrderInfo = $oResponse->getOrderInfo();
		$this->assertEquals(
			OrderInfo::class,
			get_class($oOrderInfo),
			"The Deliveries\\Create Response return instance of not OrderInfo"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
    $aResult['aResponseWithInProgressStatus'] = [
      'aResponse' => $this->getDeliveriesCreateResponse(),
    ];
		return $aResult;
	}

	function getDeliveriesCreateResponse(): array
	{
		return json_decode('{
  "correlationId": "e539c2af-f6e3-427a-b9b3-250076dfcbd7",
  "orderInfo": {
    "id": "60d77ecb-7eee-4ad0-9ace-9c714e02c7ac",
    "organizationId": "01234567-0123-0124-0123-0123456789ab",
    "timestamp": 1639031979519,
    "creationStatus": "InProgress",
    "errorInfo": null,
    "order": null
  }
}', true);
	}
}
