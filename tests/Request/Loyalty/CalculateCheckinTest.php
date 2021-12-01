<?php 

namespace IikoTransport\Tests\Request\Loyalty;

use IikoTransport\Request\Loyalty\CalculateCheckin as Request; 
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\Request\CommonTrait;
use IikoTransport\Tests\Request\GetSimpleOrderTrait;
use PHPUnit\Framework\TestCase;

class CalculateCheckinTest extends TestCase 
{
	use CommonTrait,
		GetSimpleOrderTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'loyalty/iiko/calculate_checkin',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$oOrder = $this->getOrder(),
		);
		return $oRequest;
	}
}
