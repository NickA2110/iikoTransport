<?php
namespace IikoTransport\Request;

/**
 *  Get cities request
 */
class Cities extends Common
{
	protected $sUri = 'cities';

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
}
