<?php

namespace IikoTransport\Tests\SimpleRequest;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Service\Client;
use IikoTransport\Tests\ApiKey;

trait SimpleTrait
{
	var $oClient;

	function getClient(): Client
	{
		if (empty($this->oClient)) {
			$this->oClient = new Client(ApiKey::getApiKey());
		}
		return $this->oClient;
	}

	abstract function getRequest(): CommonRequest;

	abstract function checkResponse(array $aBody, string $sBody);

	public function testGoodResponse()
	{
		$oClient = $this->getClient();

		$oResponse = $oClient->requestOnlyCommonResponse(
			$this->getRequest()
		);

		$this->checkResponse(
			$oResponse->getBodyAsArray(),
			$oResponse->getBodyAsString()
		);
	}
}