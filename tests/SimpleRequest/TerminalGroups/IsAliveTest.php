<?php 

namespace IikoTransport\Tests\SimpleRequest\TerminalGroups;

use IikoTransport\Request\TerminalGroups\IsAlive as Request;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class IsAliveTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			$aOrganizationIds = [
				ApiKey::getOrganizationId(),
			],
			$aTerminalGroupIds = [
				ApiKey::getTermianlGroupId(),
			],
		);
		return $oRequest;
	}

	function checkResponse(array $aBody, string $sBody)
	{
		$this->assertNotEmpty($aBody['isAliveStatus']);
	}
}
