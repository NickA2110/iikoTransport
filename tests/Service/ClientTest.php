<?php 

namespace IikoTransport\Tests;

use IikoTransport\Request\Common as RequestCommon;
use IikoTransport\Service\Client;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
	public function testRequest() {
		$oClient = new Client(ApiKey::getApiKey());
		$oRequest  = new RequestCommon();
		$oRequest
			->setUri('organizations')
			->setData([
				'organizationIds' => null,
				'returnAdditionalInfo' => false,
				'includeDisabled' => false,
			]);
		$oResponse = $oClient->request($oRequest);

		$this->assertEquals(
			$nHttpCode = 200,
			$oResponse->getStatusCode(),
			"Code of HTTP response is not {$nHttpCode}"
		);
	}
}
