<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\Organizations as Request; 
use PHPUnit\Framework\TestCase;

class OrganizationsTest extends TestCase 
{
	use CommonTrait,
		OrganizationsAndIncludeDisabledTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'organizations',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	public function testReturnAdditionalInfo() {
		$oRequest = $this->getRequest();
		$oRequest->setReturnAdditionalInfo();
		$aData = $oRequest->getData();
		$this->assertTrue(
			$aData['returnAdditionalInfo'],
			"Data in request 'returnAdditionalInfo' not is 'true'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request();
		return $oRequest;
	}

}
