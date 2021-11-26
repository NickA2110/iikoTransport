<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\Address\City;
use IikoTransport\Entity\Address\OrganizationCities;

class Cities extends Common
{
	var $aOrganizationCities;

	public function parseBody(): IResponse
	{
		$this->aOrganizationCities = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['cities'])) {
			$this->aOrganizationCities = $this->getCitiesFromResponseArray(
				$aBody['cities']
			);
		}

		return $this;
	}

	function getCitiesFromResponseArray(array $aOrganizationsCities): array
	{
		$aResult = [];
		foreach ($aOrganizationsCities as $aOrganizationCities) {
			$aResult[] = $this->getCitiesOfOrganization(
				$aOrganizationCities
			);
		}
		return $aResult;
	}

	function getCitiesOfOrganization(array $aOrganizationCities): OrganizationCities
	{
		return new OrganizationCities(
			$aOrganizationCities['organizationId'],
			$this->getCities($aOrganizationCities['items'])
		);
	}

	function getCities(array $aCities): array
	{
		$aResult = [];
		foreach ($aCities as $aCity) {
			$aResult[] = $this->getCity(
				$aCity
			);
		}
		return $aResult;
	}

	function getCity(array $aCity): City
	{
		return new City(
			$aCity['id'],
			$aCity['name'],
			$aCity['externalRevision'],
			$aCity['isDeleted'],
			$aCity['classifierId'],
			$aCity['additionalInfo']
		);
	}

	public function getOrganizationCities(): array
	{
		if (!is_array($this->aOrganizationCities)) {
			$this->parseBody();
		}
		return $this->aOrganizationCities;
	}
}