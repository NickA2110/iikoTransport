<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\PaymentType\PaymentType as PaymentType;

class PaymentTypes
{
	var $aPaymentTypes = [];

	function __construct(array $aResponseBody)
	{
		if (!empty($aResponseBody['paymentTypes'])) {
			$this->aPaymentTypes = $this->getPaymentTypesFromResponseArray(
				$aResponseBody['paymentTypes']
			);
		}
	}

	function getPaymentTypesFromResponseArray(array $aPaymentTypes): array
	{
		$aResult = [];
		foreach ($aPaymentTypes as $aPaymentType) {
			$aResult[] = $this->getPaymentType(
				$aPaymentType
			);
		}
		return $aResult;
	}

	function getPaymentType(array $aPaymentType): PaymentType
	{
		return new PaymentType(
			$aPaymentType['id'],
			$aPaymentType['code'],
			$aPaymentType['name'],
			$aPaymentType['comment'],
			$aPaymentType['combinable'],
			$aPaymentType['externalRevision'],
			$aPaymentType['applicableMarketingCampaigns'],
			$aPaymentType['isDeleted'],
			$aPaymentType['printCheque'],
			$aPaymentType['paymentProcessingType'],
			$aPaymentType['paymentTypeKind'],
			$this->getTerminalGroups($aPaymentType['terminalGroups'])
		);
	}

	function getTerminalGroups(array $aTerminalGroups): array
	{
		$aGroups = [];
		foreach ($aTerminalGroups as $aTermianlGroup) {
			$aGroups[] = $this->getTerminalGroup(
				$aTermianlGroup
			);
		}
		return $aGroups;
	}

	use TerminalGroupTrait;

	public function getPaymentTypes(): array
	{
		return $this->aPaymentTypes;
	}
}