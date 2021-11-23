<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\TerminalGroup\TerminalGroupsInterface;
use IikoTransport\Response\TerminalGroups as Response; 
use PHPUnit\Framework\TestCase;

class TerminalGroupsTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oResponse = new Response(
			$aResponse
		);
		
		$aTerminalGroups = $oResponse->getTerminalGroups();
		$this->assertNotEmpty($aTerminalGroups);

		$oTerminalGroup = reset($aTerminalGroups);
		$this->assertTrue(
			is_subclass_of($oTerminalGroup, TerminalGroupsInterface::class),
			"The TerminalGroups Response return instance of not TerminalGroupsInterface"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
		$aResult['aResponseWithSimpleTerminalGroups'] = [
			'aResponse' => [
				'terminalGroups' => 
json_decode('[
    {
      "organizationId": "01234567-89ab-cdef-0123-456789abcdef",
      "items": [
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
