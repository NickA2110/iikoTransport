<?php 

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Cities as Request;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class CitiesTest extends TestCase
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

	function checkResponse(array $aBody, string $sBody)
	{
		$this->assertNotEmpty($aBody['cities']);
	}
}
