<?php
namespace IikoTransport\Request;

/**
 *  Get organizations request
 */
class Organizations extends Common
{
	protected $sUri = 'organizations';

	function __construct()
	{
		$this->aData = [
			'organizationIds' => null,
		];
	}

	public function setOrganizationIds(array $aIds): self
	{
		$this->aData['organizationIds'] = $aIds;
		return $this;
	}

	public function setReturnAdditionalInfo(bool $bReturnAdditionalInfo = true): self
	{
		$this->aData['returnAdditionalInfo'] = $bReturnAdditionalInfo;
		return $this;
	}

	public function setIncludeDisabled(bool $bIncludeDisabled = true): self
	{
		$this->aData['includeDisabled'] = $bIncludeDisabled;
		return $this;
	}
}
