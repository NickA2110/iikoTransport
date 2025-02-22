<?php 

namespace IikoTransport\Tests\Request\Deliveries;

use IikoTransport\Request\Deliveries\Create as Request;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\Request\CommonTrait;
use IikoTransport\Tests\Request\GetSimpleOrderTrait;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
	use CommonTrait,
		GetSimpleOrderTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'deliveries/create',
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
