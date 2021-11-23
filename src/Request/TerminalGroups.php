<?php
namespace IikoTransport\Request;

/**
 *  Get terminal groups request
 */
class TerminalGroups extends Common
{
	protected $sUri = 'terminal_groups';

	function __construct(array $aOrganizationIds)
	{
		if (empty($aOrganizationIds)) {
			throw new Exception(
				"Field 'organizationIds' is not be empty",
				Exception::FIELD_ORGANIZATION_IDS_IS_EMPTY
			);
		}
		$this->aData = [
			'organizationIds' => $aOrganizationIds,
		];
	}

	public function setOrganizationIds(array $aIds): self
	{
		$this->aData['organizationIds'] = $aIds;
		return $this;
	}

	public function setIncludeDisabled(bool $bIncludeDisabled = true): self
	{
		$this->aData['includeDisabled'] = $bIncludeDisabled;
		return $this;
	}
}
