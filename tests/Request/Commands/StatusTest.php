<?php 

namespace IikoTransport\Tests\Request\Combo;

use IikoTransport\Request\Commands\Status as Request; 
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\Request\CommonTrait;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'commands/status',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$sCorrelationId = '01234567-0123-0123-0123-0123456789ab'
		);
		return $oRequest;
	}

}
