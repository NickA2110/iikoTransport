<?php 

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Regions as Request;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class RegionsTest extends TestCase
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
		$this->assertNotEmpty($aBody['regions']);
	}
}
