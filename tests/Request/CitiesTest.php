<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\Cities as Request; 
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class CitiesTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'cities',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$aOrganizationIds = [
				ApiKey::getOrganizationId(),
			],
		);
		return $oRequest;
	}

}
