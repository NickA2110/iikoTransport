<?php
namespace IikoTransport\Service; 

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response as HttpResponse;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\AccessToken as AccessTokenRequest;
use IikoTransport\Response\Common as CommonResponse;
use IikoTransport\Response\Error as ErrorResponse;

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
		$this->getToken(); 
		return $this->doApiCall($oRequest);
	}

	public function getToken(): string
	{
		if (!empty($this->sToken)) {
			return $this->sToken;
		}

		$oRequest = new AccessTokenRequest($this->getApiKey());

		try {
			$oResponse = $this->doApiCall($oRequest);
		} catch (Exception $e) {
			$oException = new Exception(
				"API error to get token",
				Exception::API_ERROR_TO_GET_TOKEN
			);
			$oException->setResponse($e->getResponse());
			throw $oException;
		}

		$aResult = $oResponse->getBodyAsArray();
		
		if (empty($aResult['token'])) {
			$oException = new Exception(
				"API response empty token",
				Exception::API_RESPONSE_EMPTY_TOKEN
			);
			$oException->setResponse($oResponse);
			throw $oException;
		}

		$this->setToken($aResult['token']);

		return $this->sToken;
	}

	public function setToken(string $sToken): self
	{
		$this->sToken = $sToken;
		return $this;
	}

	function doApiCall(CommonRequest $oRequest): CommonResponse {
		if (!empty($this->sToken)) {
			$oRequest->setHeaderByName('Authorization', 'Bearer ' . $this->sToken);
		}
		$oResponse = $this->oHttpClient->request(
			$oRequest->getMethod(),
			$oRequest->getUri(),
			[
				'headers' => $oRequest->getHeaders(),
				'json' => $oRequest->getData()
			]
		);
		return $this->processHttpRequest($oRequest, $oResponse);
	}

	function processHttpRequest(CommonRequest $oRequest, HttpResponse $oResponse): CommonResponse {
		if ($oResponse->getStatusCode() == 200) {
			$oResponse = new CommonResponse(
				$oRequest,
				$oResponse->getStatusCode(),
				$oResponse->getHeaders(),
				$oResponse->getBody()
			);
		} else {
			$oResponse = new ErrorResponse(
				$oRequest,
				$oResponse->getStatusCode(),
				$oResponse->getHeaders(),
				$oResponse->getBody()
			);
			$nErrorCode = $oResponse->getStatusCode();
			$sErrorMessage = $oResponse->getErrorMessage();
			$oException = new Exception(
				"API response error ({$nErrorCode}: {$sErrorMessage})",
				Exception::API_RESPONSE_ERROR_HTTP_STATUS
			);
			$oException->setResponse($oResponse);
			throw $oException;
		}
		return $oResponse;
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
