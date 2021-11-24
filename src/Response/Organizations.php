<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\Organization\OrganizationExtended;
use IikoTransport\Entity\Organization\OrganizationSimple;
use IikoTransport\Entity\Organization\Exception as OrganizationException;

class Organizations extends Common {
	var $aOrganizations = [];

	public function parseBody(): self
	{
		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['organizations'])) {
			$this->aOrganizations = $this->getOrganizationFromResponseArray(
				$aBody['organizations']
			);
		}

		return $this;
	}

	function getOrganizationFromResponseArray(array $aOrganizations): array
	{
		$aResult = [];
		foreach ($aOrganizations as $aOrganization) {
			switch ($aOrganization['responseType']) {
				case 'Simple':
					$oOrganization = $this->getSimpleOrganization($aOrganization);
					break;
				case 'Extended':
					$oOrganization = $this->getExtendedOrganization($aOrganization);
					break;
				default:
					throw new OrganizationException(
						"Organization type '{$aOrganization['responseType']}' is not defined",
						OrganizationException::ORGANIZATION_TYPE_IS_NOT_DEFINED
					);
			}
			$aResult[] = $oOrganization;
		}
		return $aResult;
	}

	function getSimpleOrganization(array $aOrganization): OrganizationSimple {
		return new OrganizationSimple(
			$aOrganization['id'],
			$aOrganization['name']
		);
	}

	function getExtendedOrganization(array $aOrganization): OrganizationExtended {
		return new OrganizationExtended(
			$aOrganization['id'],
			$aOrganization['name'],
			$aOrganization['inn'],
			$aOrganization['orderItemCommentEnabled'],
			$aOrganization['defaultCallCenterPaymentTypeId'],
			$aOrganization['deliveryServiceType'],
			$aOrganization['deliveryCityIds'] ?? [],
			$aOrganization['defaultDeliveryCityId'],
			$aOrganization['marketingSourceRequiredInDelivery'],
			$aOrganization['countryPhoneCode'],
			$aOrganization['currencyMinimumDenomination'],
			$aOrganization['currencyIsoName'],
			$aOrganization['version'],
			$aOrganization['useUaeAddressingSystem'],
			$aOrganization['longitude'],
			$aOrganization['latitude'],
			$aOrganization['restaurantAddress'],
			$aOrganization['country']
		);
	}

	public function getOrganizations(): array
	{
		return $this->aOrganizations;
	}
}