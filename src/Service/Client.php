<?php
namespace IikoTransport\Service; 

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response as HttpResponse;
use IikoTransport\Request\AccessToken as AccessTokenRequest;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Common as CommonResponse;
use IikoTransport\Response\Error as ErrorResponse;
use IikoTransport\Response\Factory as ResponseFactory;

class Client 
{
	const BASE_API_URL = 'https://api-ru.iiko.services/api/1/';

	protected $apiKey; 

	protected $oHttpClient; 

	protected $sToken; 

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
		$oCommonResponse = $this->requestOnlyCommonResponse($oRequest);
		return ResponseFactory::getTypedResponse($oCommonResponse);
	}

	public function requestOnlyCommonResponse(CommonRequest $oRequest): CommonResponse {
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
		$oResponse = new CommonResponse(
			$oRequest,
			$oResponse->getStatusCode(),
			$oResponse->getHeaders(),
			$oResponse->getBody()
		);
		if ($oResponse->getStatusCode() != 200) {
			$this->throwError($oResponse);
		}
		return $oResponse;
	}

	function throwError(CommonResponse $oResponse) {
		$oErrorResponse = new ErrorResponse(
			$oResponse->getRequest(),
			$oResponse->getStatusCode(),
			$oResponse->getHeaders(),
			$oResponse->getBodyAsString()
		);
		$nErrorCode = $oErrorResponse->getStatusCode();
		$sErrorMessage = $oErrorResponse->getErrorMessage();
		$oException = new Exception(
			"API response error ({$nErrorCode}: {$sErrorMessage})",
			Exception::API_RESPONSE_ERROR_HTTP_STATUS
		);
		$oException->setResponse($oErrorResponse);
		throw $oException;
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
