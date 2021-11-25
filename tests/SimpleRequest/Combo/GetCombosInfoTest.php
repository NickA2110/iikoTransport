<?php 

namespace IikoTransport\Tests\SimpleRequest\Combo;

use IikoTransport\Request\Combo\GetCombosInfo as Request;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class GetCombosInfoTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			ApiKey::getOrganizationId(),
		);
		return $oRequest;
	}

	function checkResponse(array $aBody, string $sBody)
	{
		$this->assertNotEmpty($aBody['comboSpecifications']);
		$this->assertNotEmpty($aBody['comboCategories']);
	}
}
