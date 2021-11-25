<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\StreetsByCity as Request; 
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class StreetsByCityTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'streets/by_city',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$sCityId = ApiKey::getCityId()
		);
		return $oRequest;
	}
}
