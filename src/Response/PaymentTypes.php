<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\PaymentType\PaymentType as PaymentType;

class PaymentTypes extends Common
{
	var $aPaymentTypes;

	public function parseBody(): IResponse
	{
		$this->aPaymentTypes = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['paymentTypes'])) {
			$this->aPaymentTypes = $this->getPaymentTypesFromResponseArray(
				$aBody['paymentTypes']
			);
		}

		return $this;
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
		if (!is_array($this->aPaymentTypes)) {
			$this->parseBody();
		}
		return $this->aPaymentTypes;
	}
}