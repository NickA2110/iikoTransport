<?php

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Service\Client;
use IikoTransport\Tests\ApiKey;

trait SimpleTrait
{
	function getClient(): Client
	{
		return new Client(ApiKey::getApiKey());
	}

	abstract function getRequest(): CommonRequest;

	abstract function checkResponse(array $aBody);

	public function testGoodResponse()
	{
		$oClient = $this->getClient();

		$oResponse = $oClient->requestOnlyCommonResponse(
			$this->getRequest()
		);

		$this->checkResponse($oResponse->getBodyAsArray());
	}
}