<?php 

namespace IikoTransport\Tests\Request\TerminalGroups;

use IikoTransport\Request\TerminalGroups\IsAlive as Request; 
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\Request\CommonTrait;
use PHPUnit\Framework\TestCase;

class IsAliveTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'terminal_groups/is_alive',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
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

}
