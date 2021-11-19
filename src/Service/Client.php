<?php
namespace IikoTransport\Service; 

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Common as CommonResponse;
use GuzzleHttp\Client as HttpClient;

class Client 
{
	const BASE_API_URL = 'https://api-ru.iiko.services/api/1/';

	const AUTH_URL = 'access_token';

	protected $sToken; 

	protected $apiKey; 

	protected $oHttpClient; 

	public function __construct(string $apiKey) {
		$this->apiKey = $apiKey; 
		$aHttpClientOptions = [
			'base_uri' => static::BASE_API_URL,
			'allow_redirects' => false,
			'timeout' => 20,
			'http_errors' => false,
			'headers' => [
				'Content-Type' => 'application/json',
				'Accept' => 'application/json'
			]
		];
		$this->oHttpClient = new HttpClient($aHttpClientOptions);
	}

	public function request(CommonRequest $oRequest): CommonResponse {
		$sToken = $this->getToken(); 
		$oResponse = $this->oHttpClient->request(
			$oRequest->getMethod(),
			$oRequest->getUri(),
			[
				'headers' => [
					'Authorization' => 'Bearer ' . $sToken,
				],  
				'json' => $oRequest->getData()
			]
		); 
		$oResponse = new CommonResponse(
			$oRequest,
			$oResponse->getStatusCode(),
			$oResponse->getHeaders(),
			$oResponse->getBody()
		);
		return $oResponse;
	}

	public function getToken(): string
	{
		if (!empty($this->sToken)) {
			return $this->sToken;
		}

		$oResponse = $this->oHttpClient->request(
			"POST",
			static::AUTH_URL,
			[
				'json' => [
					'apiLogin' => $this->getApiKey(),
				],
			],
		); 
		if ($oResponse->getStatusCode() != 200) {
			throw new AuthException($oResponse->getBody());
		};
		$aResult = json_decode(
			(string) $oResponse->getBody(),
			true
		);
		$this->setToken($aResult['token']);

		return $this->sToken;
	}
	
	public function setToken(string $sToken): self
	{
		$this->sToken = $sToken;
		return $this;
	}
	
	public function getApiKey(): string
	{
		return $this->apiKey;
	}
	
	public function setApiKey(string $apiKey): self
	{
		$this->apiKey = $apiKey;
		return $this;
	}
}
