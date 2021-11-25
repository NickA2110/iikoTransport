<?php
namespace IikoTransport\Request;

/**
 *  Get regions request
 */
class Regions extends Common
{
	protected $sUri = 'regions';

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
