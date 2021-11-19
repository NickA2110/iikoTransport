<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\Organizations as Request; 
use PHPUnit\Framework\TestCase;

class OrganizationsTest extends TestCase 
{
	var $sOrganizationGuid = 'some-guid';

	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'organizations',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	public function testSetOrganizationIds() {
		$oRequest = $this->getRequest();
		$oRequest->setOrganizationIds([$this->sOrganizationGuid]);
		$aData = $oRequest->getData();
		$this->assertContains(
			$this->sOrganizationGuid,
			$aData['organizationIds'],
			"Data in request 'organizationIds' not contains '{$this->sOrganizationGuid}'"
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

	public function testSetIncludeDisabled() {
		$oRequest = $this->getRequest();
		$oRequest->setIncludeDisabled();
		$aData = $oRequest->getData();
		$this->assertTrue(
			$aData['includeDisabled'],
			"Data in request 'includeDisabled' not is 'true'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request();
		return $oRequest;
	}

}
