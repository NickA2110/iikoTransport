<?php 

namespace IikoTransport\Tests\Request\Loyalty;

use IikoTransport\Request\Loyalty\GetCustomerInfo as Request; 
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\Request\CommonTrait;
use PHPUnit\Framework\TestCase;

class GetCustromerInfoTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'loyalty/iiko/get_customer',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$sType = 'phone',
			$sValue = ApiKey::getCustomerPhone(),
		);
		return $oRequest;
	}

}
