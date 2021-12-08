<?php 

namespace IikoTransport\Tests\SimpleRequest\Commands;

use IikoTransport\Request\Commands\Status as Request;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Request\Organizations;
use IikoTransport\Service\Exception as ClientException;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			ApiKey::getOrganizationId(),
			$this->getNewCorrelationId()
		);

		$this->expectException(
			ClientException::class,
			"Commands/Status request not throw Exception"
		);
		$this->expectExceptionCode(
			ClientException::API_RESPONSE_ERROR_HTTP_STATUS
		);

		return $oRequest;
	}

	function getNewCorrelationId(): string
	{
		return '01234567-0123-0123-0123-0123456789ab';
	}

	function checkResponse(array $aBody, string $sBody)
	{
	}
}
