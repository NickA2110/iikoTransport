<?php 

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Nomenclature as Request;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class NomenclatureTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId()
		);
		return $oRequest;
	}

	function checkResponse(array $aBody, string $sBody)
	{
		file_put_contents(__DIR__ . '/menu.json', $sBody);
		$this->assertArrayHasKey('groups', $aBody);
		$this->assertArrayHasKey('productCategories', $aBody);
		$this->assertArrayHasKey('products', $aBody);
		$this->assertArrayHasKey('sizes', $aBody);
		$this->assertArrayHasKey('revision', $aBody);
		$this->assertNotEmpty($aBody['products']);
	}
}
