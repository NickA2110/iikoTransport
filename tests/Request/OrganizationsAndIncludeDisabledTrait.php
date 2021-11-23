<?php 

namespace IikoTransport\Tests\Request;

trait OrganizationsAndIncludeDisabledTrait
{
	var $sOrganizationGuid = 'some-guid';

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

	public function testSetIncludeDisabled() {
		$oRequest = $this->getRequest();
		$oRequest->setIncludeDisabled();
		$aData = $oRequest->getData();
		$this->assertTrue(
			$aData['includeDisabled'],
			"Data in request 'includeDisabled' not is 'true'"
		);
	}
}
