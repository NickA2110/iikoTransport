<?php
namespace IikoTransport\Request;

/**
 *  Get streets by city request
 */
class StreetsByCity extends Common
{
	protected $sUri = 'streets/by_city';

	function __construct(
		string $sOrganizationId,
		string $sCityId
	){
		if (empty($sOrganizationId)) {
			throw new Exception(
				"Field 'organizationId' is not be empty",
				Exception::FIELD_ORGANIZATION_ID_IS_EMPTY
			);
		}
		if (empty($sCityId)) {
			throw new Exception(
				"Field 'cityId' is not be empty",
				Exception::FIELD_CITY_ID_IS_EMPTY
			);
		}
		$this->aData = [
			'organizationId' => $sOrganizationId,
			'cityId' => $sCityId,
		];
	}
}
