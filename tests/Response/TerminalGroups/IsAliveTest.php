<?php 

namespace IikoTransport\Tests\Response\TerminalGroups;

use IikoTransport\Entity\TerminalGroup\IsAliveStatus;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\TerminalGroups\IsAlive as Response;
use PHPUnit\Framework\TestCase;

class IsAliveTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse)
  {
		$oResponse = $this->getResponseByArray($aResponse);
		$this->checkIsAliveStatus($oResponse);
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

	function checkIsAliveStatus(Response $oResponse)
  {
		$aResult = $oResponse->getIsAliveStatuses();
		$this->assertNotEmpty($aResult);

		$oResultItem = reset($aResult);
		$this->assertEquals(
			IsAliveStatus::class,
			get_class($oResultItem),
			"The IsAlive Response return instance of not IsAliveStatus"
		);
	}

	public function providerCreateResponse()
  {
		$aResult = [];
		$aResult['aResponseWithSimpleIsAliveStatus'] = [
			'aResponse' => [
				'isAliveStatus' => $this->getIsAliveStatus(),
			],
		];
		return $aResult;
	}

	function getIsAliveStatus(): array
	{
		return json_decode('[
    {
      "isAlive": true,
      "terminalGroupId": "7524484d-0d03-85ec-016f-7c5b25a500cd",
      "organizationId": "4dc2266c-4ab2-41e3-8fd2-abdb3c58f30b"
    }
]', true);
	}
}
