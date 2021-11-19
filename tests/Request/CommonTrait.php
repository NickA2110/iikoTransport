<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\Common as RequestCommon; 
use IikoTransport\Request\Exception as RequestException; 

trait CommonTrait
{
	public function testConstruct()
	{
		$oRequest = $this->getRequest();
		$this->assertNotEmpty($oRequest);
	}

	abstract function getRequest(): RequestCommon;

	public function testGetEmptyUri() {
		$oRequest = $this->getRequest();
		$this->expectException(
			RequestException::class,
			"Empty uri is not thowing exception"
		);
		$this->expectExceptionCode(
			RequestException::THE_URI_PROPERTY_IS_NOT_SET
		);
		$sUri = $oRequest->getUri();
	}

	/** @dataProvider providerSetMethodSelfReturn */
	public function testSetMethodSelfReturn($sMethod, $value) {
		$oRequest = $this->getRequest();
		$oRequestReturn = $oRequest->{$sMethod}($value);
		$this->assertEquals(
			$oRequest,
			$oRequestReturn,
			"Return of '{$sMethod}' is not self instance"
		);
	}

	/** @dataProvider providerSetMethodSelfReturn */
	public function testSetAndGetMethod($sMethod, $value) {
		$oRequest = $this->getRequest();
		$oRequest->{$sMethod}($value);
		$sGetMethod = implode('get', explode('set', $sMethod));
		$returnedValue = $oRequest->{$sGetMethod}();	
		$this->assertEquals(
			$value,
			$returnedValue,
			"Setted value not equals getted value of method '{$sMethod}'"
		);
	}

	public function providerSetMethodSelfReturn() {
		$aMethods = [];
		$aMethods['setUri'] = [
			'method' => 'setUri',
			'value' => '/test/uri',
		];
		$aMethods['setHeaders'] = [
			'method' => 'setHeaders',
			'value' => [
				'X-Header' => 'Test header value',
			],
		];
		$aMethods['setData'] = [
			'method' => 'setData',
			'value' => [
				'organizationIds' => [],
			],
		];
		return $aMethods;
	}

	public function testSetHeaderByNameAndGetThem() {
		$oRequest = $this->getRequest();
		$oRequest->setHeaderByName($sName = 'XXX-One-header', $sValue = 'Header string');
		$aHeaders = $oRequest->getHeaders();
		$this->assertNotEmpty(
			$aHeaders[$sName],
			"Header '{$sName}' is not setted"
		);
		$this->assertEquals(
			$aHeaders[$sName],
			$sValue,
			"Value of header '{$sName}' is wrong"
		);
	}
}
