<?php 

namespace IikoTransport\Tests\Service;

use IikoTransport\Request\Common as RequestCommon;
use IikoTransport\Service\Client;
use IikoTransport\Service\Exception as ClientException;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
	public function testGoodResponse() {
		$oClient = new Client(ApiKey::getApiKey());
		$oRequest  = new RequestCommon();
		$oRequest
			->setUri('organizations')
			->setData([
				'organizationIds' => null,
				'returnAdditionalInfo' => false,
				'includeDisabled' => false,
			]);
		$oResponse = $oClient->requestOnlyCommonResponse($oRequest);

		$this->assertEquals(
			$nHttpCode = 200,
			$oResponse->getStatusCode(),
			"Code of HTTP response is not {$nHttpCode}"
		);
	}

	public function testResponseWithBadKey() {
		$oClient = new Client(ApiKey::getApiKey() . 'x');
		$oRequest  = new RequestCommon();
		$oRequest
			->setUri('organizations')
			->setData([
				'organizationIds' => null,
				'returnAdditionalInfo' => false,
				'includeDisabled' => false,
			]);
		$this->expectException(
			ClientException::class,
			"Bad apiKey is not thowing exception"
		);
		$this->expectExceptionCode(
			ClientException::API_ERROR_TO_GET_TOKEN
		);
		$oResponse = $oClient->requestOnlyCommonResponse($oRequest);

		$this->assertEquals(
			$nHttpCode = 200,
			$oResponse->getStatusCode(),
			"Code of HTTP response is not {$nHttpCode}"
		);
	}
}
