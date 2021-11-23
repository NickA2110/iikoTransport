<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\TerminalGroups as Request; 
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class TerminalGroupsTest extends TestCase 
{
	use CommonTrait,
		OrganizationsAndIncludeDisabledTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'terminal_groups',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$aOrganizationIds = [
				ApiKey::getApiKey(),
			],
		);
		return $oRequest;
	}

}
