<?php 

namespace IikoTransport\Tests\Response\Commands;

use IikoTransport\Entity\Commands\Status;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Commands\Status as Response;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse)
  {	
		$oResponse = $this->getResponseByArray($aResponse);
		
		$this->checkStatus($oResponse);
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

	function checkStatus(Response $oResponse) {
		$oStatus = $oResponse->getStatus();
		$this->assertEquals(
			Status::class,
			get_class($oStatus),
			"The GetCombosInfo Response return instance of not ComboSpecification"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
    $aResult['aResponseWithSuccessStatus'] = [
      'aResponse' => $this->getSuccessStatus(),
    ];
    $aResult['aResponseWithInProgressStatus'] = [
      'aResponse' => $this->getInProgressStatus(),
    ];
    $aResult['aResponseWithErrorStatus'] = [
      'aResponse' => $this->getErrorStatus(),
    ];
		return $aResult;
	}

	function getSuccessStatus(): array
	{
		return json_decode('
    {
      "state": "Success"
    }
    ', true);
	}

  function getInProgressStatus(): array
  {
    return json_decode('
    {
      "state": "InProgress"
    }
    ', true);
  }

  function getErrorStatus(): array
  {
    return json_decode('
    {
      "state": "Error",
      "exception": null
    }
    ', true);
  }
}
