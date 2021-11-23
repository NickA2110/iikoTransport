<?php 

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\TerminalGroups as Request;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class TerminalGroupsTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			$aOrganizationIds = [
				ApiKey::getOrganizationId(),
			]
		);
		return $oRequest;
	}

	function checkResponse(array $aBody)
	{
		$this->assertNotEmpty($aBody['terminalGroups']);
	}
}
