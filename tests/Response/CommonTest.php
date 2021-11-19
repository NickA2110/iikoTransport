<?php 

namespace IikoTransport\Tests\Response;

use PHPUnit\Framework\TestCase;
use IikoTransport\Request\Common as RequestCommon; 
use IikoTransport\Response\Common as ResponseCommon; 
use IikoTransport\Response\Exception as ResponseException; 

class CommonTest extends TestCase 
{
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
			$aHeaders = [],
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

	public function testGetBodyAsString() {
		$oResponse = $this->getGoodResponse();
		$sBody = $oResponse->getBodyAsString();
		$this->assertNotEmpty(
			$sBody,
			"Response return empty body"
		);
	}

	public function testGetBodyAsArray() {
		$oResponse = $this->getGoodResponse();
		$aBody = $oResponse->getBodyAsArray();
		$this->assertTrue(
			is_array($aBody),
			"Returned body of response is not array"
		);
	}

	public function testGetBodyAsArrayFail() {
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
}
