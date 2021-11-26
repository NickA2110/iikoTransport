<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\Address\OrganizationRegions;
use IikoTransport\Entity\Address\Region;

class Regions extends Common
{
	var $aOrganizationRegions;

	public function parseBody(): IResponse
	{
		$this->aOrganizationRegions = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['regions'])) {
			$this->aOrganizationRegions = $this->getRegionsFromResponseArray(
				$aBody['regions']
			);
		}

		return $this;
	}

	function getRegionsFromResponseArray(array $aOrganizationsRegions): array
	{
		$aResult = [];
		foreach ($aOrganizationsRegions as $aOrganizationRegions) {
			$aResult[] = $this->getRegionsOfOrganization(
				$aOrganizationRegions
			);
		}
		return $aResult;
	}

	function getRegionsOfOrganization(array $aOrganizationRegions): OrganizationRegions
	{
		return new OrganizationRegions(
			$aOrganizationRegions['organizationId'],
			$this->getRegions($aOrganizationRegions['items'])
		);
	}

	function getRegions(array $aRegions): array
	{
		$aResult = [];
		foreach ($aRegions as $aRegion) {
			$aResult[] = $this->getRegion(
				$aRegion
			);
		}
		return $aResult;
	}

	function getRegion(array $aRegion): Region
	{
		return new Region(
			$aRegion['id'],
			$aRegion['name'],
			$aRegion['externalRevision'],
			$aRegion['isDeleted']
		);
	}

	public function getOrganizationRegions(): array
	{
		if (!is_array($this->aOrganizationRegions)) {
			$this->parseBody();
		}
		return $this->aOrganizationRegions;
	}
}