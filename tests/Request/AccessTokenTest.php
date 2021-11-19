<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\AccessToken as Request; 
use PHPUnit\Framework\TestCase;

class AccessTokenTest extends TestCase 
{
	var $sApiKey = 'someApiKey';

	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'access_token',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	public function testData() {
		$oRequest = $this->getRequest();
		$aData = $oRequest->getData();
		$this->assertEquals(
			$this->sApiKey,
			$aData['apiLogin'],
			"Data in request '{$aData['apiLogin']}' not equals '{$this->sApiKey}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request($this->sApiKey);
		return $oRequest;
	}

}
