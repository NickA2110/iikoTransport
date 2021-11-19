<?php

namespace IikoTransport\Service;

use IikoTransport\Response\Common as CommonResponse;

class Exception extends \IikoTransport\Exception
{
	protected $oResponse;

	const API_RESPONSE_ERROR_HTTP_STATUS = 1;
	const API_RESPONSE_EMPTY_TOKEN = 2;
	const API_ERROR_TO_GET_TOKEN = 3;

	public function setResponse(CommonResponse $oResponse): self
	{
		$this->oResponse = $oResponse;
		return $this;
	}

	public function getResponse(): CommonResponse
	{
		return $this->oResponse;
	}
}