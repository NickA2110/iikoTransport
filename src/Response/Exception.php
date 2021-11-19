<?php

namespace IikoTransport\Response;

class Exception extends \IikoTransport\Exception
{
	protected $oResponse;

	const TYPE_OF_BODY_IS_NOT_ARRAY = 1;
	const API_RESPONSE_ERROR_HTTP_STATUS = 2;

	public function setResponse(Common $oResponse): self
	{
		$this->oResponse = $oResponse;
		return $this;
	}

	public function getResponse(): Common
	{
		return $this->oResponse;
	}
}