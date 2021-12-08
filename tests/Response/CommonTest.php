<?php 

namespace IikoTransport\Tests\Response;

use PHPUnit\Framework\TestCase;
use IikoTransport\Request\Common as RequestCommon; 
use IikoTransport\Response\Common as ResponseCommon; 
use IikoTransport\Response\Exception as ResponseException; 

class CommonTest extends TestCase 
{
	const someCorrelationId = 'b1eba821-3b22-46e8-80ad-1c83432264f8';

	public function testStatusOfGoodResponse()
	{
		$oResponse = $this->getGoodResponse();
		$this->assertGoodResponse($oResponse);
	}

	function getGoodResponse()
	{
		$oResponse = new ResponseCommon(
			$oRequest = new RequestCommon(),
			$nHttpStatus = 200,
			$aHeaders = [
				'content-length' => [
					'219'
				],
				'content-type' => [
					'application/json; charset=utf-8',
				],
				'correlationid' => [
					static::someCorrelationId,
				],
				'date' => [
					'Wed, 08 Dec 2021 11:29:40 GMT',
				],
				'server' => [
					'Kestrel',
				],
			],
			$sBody = '[]'
		);
		return $oResponse;
	}

	function assertGoodResponse(ResponseCommon $oResponse)
	{
		$this->assertEquals(
			$nHttpStatus = 200,
			$nResposeCode = $oResponse->getStatusCode(),
			"Status of good response '{$nResposeCode}' is not equals '{$nHttpStatus}'"
		);
		$this->assertFalse(
			$oResponse->isHasError(),
			"The good response has error flag"
		);
	}

	public function testStatusOfBadResponse()
	{
		$oResponse = $this->getBadResponse();
		$this->assertBadResponse($oResponse);
	}

	function getBadResponse()
	{
		$oResponse = new ResponseCommon(
			$oRequest = new RequestCommon(),
			$nHttpStatus = 500,
			$aHeaders = [],
			$sBody = ''
		);
		return $oResponse;
	}

	function assertBadResponse(ResponseCommon $oResponse)
	{
		$this->assertEquals(
			$nHttpStatus = 500,
			$nResposeCode = $oResponse->getStatusCode(),
			"Status of bad response '{$nResposeCode}' is not equals '{$nHttpStatus}'"
		);
		$this->assertTrue(
			$oResponse->isHasError(),
			"The bad response not has error flag"
		);
	}

	public function testGetBodyAsString()
	{
		$oResponse = $this->getGoodResponse();
		$sBody = $oResponse->getBodyAsString();
		$this->assertNotEmpty(
			$sBody,
			"Response return empty body"
		);
	}

	public function testGetBodyAsArray()
	{
		$oResponse = $this->getGoodResponse();
		$aBody = $oResponse->getBodyAsArray();
		$this->assertTrue(
			is_array($aBody),
			"Returned body of response is not array"
		);
	}

	public function testGetBodyAsArrayFail()
	{
		$oResponse = $this->getBadResponse();
		$this->expectException(
			ResponseException::class,
			"Not array body is not throwing exception"
		);
		$this->expectExceptionCode(
			ResponseException::TYPE_OF_BODY_IS_NOT_ARRAY
		);
		$aBody = $oResponse->getBodyAsArray();
		$this->assertTrue(
			is_array($aBody),
			"Returned body of response is not array"
		);
	}

	public function testCorrelationId()
	{
		$oResponse = $this->getGoodResponse();
		$this->assertEquals(
			$sNeedleCorrelation = static::someCorrelationId,
			$sCorrelationId = $oResponse->getCorrelationId(),
			"CorrelationId of response '{$sCorrelationId}' not equals needle '{$sNeedleCorrelation}'"
		);
	}
}
