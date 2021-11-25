<?php 

namespace IikoTransport\Tests\Request\Combo;

use IikoTransport\Request\Combo\GetCombosInfo as Request; 
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\Request\CommonTrait;
use PHPUnit\Framework\TestCase;

class GetCombosInfoTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'combo/get_combos_info',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
		);
		return $oRequest;
	}

}
