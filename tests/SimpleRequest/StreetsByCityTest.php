<?php 

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\StreetsByCity as Request;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class StreetsByCityTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$sCityId = ApiKey::getCityId()
		);
		return $oRequest;
	}

	function checkResponse(array $aBody, string $sBody)
	{
		$this->assertNotEmpty($aBody['streets']);
	}
}
