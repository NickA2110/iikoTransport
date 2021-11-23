<?php

namespace IikoTransport\Entity\PaymentType;

class PaymentType implements EInterface
{
	const paymentProcessingTypes = [
		'External',
		'Internal',
		'Both',
	];

	const paymentTypeKinds = [
		'Unknown',
		'Cash',
		'Card',
		'Credit',
		'Writeoff',
		'Voucher',
		'External',
		'IikoCard',
	];

	public $id;

	public $code;

	public $name;

	public $comment;

	public $combinable;

	public $externalRevision;

	public $applicableMarketingCampaigns;

	public $isDeleted;

	public $printCheque;

	public $paymentProcessingType;

	public $paymentTypeKind;

	public $terminalGroups;

	function __construct(
		string $id,
		string $code,
		string $name,
		string $comment,
		bool $combinable,
		int $externalRevision,
		array $applicableMarketingCampaigns,
		bool $isDeleted,
		bool $printCheque,
		string $paymentProcessingType,
		string $paymentTypeKind,
		array $terminalGroups
	) {

		$this->id = $id;
		$this->code = $code;
		$this->name = $name;
		$this->comment = $comment;
		$this->combinable = $combinable;
		$this->externalRevision = $externalRevision;
		$this->applicableMarketingCampaigns = $applicableMarketingCampaigns ?? [];
		$this->isDeleted = $isDeleted;
		$this->printCheque = $printCheque;
		$this->paymentProcessingType = $this->getValidPaymentProcessingType($paymentProcessingType);
		$this->paymentTypeKind =$this->getValidPaymentTypeKind($paymentTypeKind);
		$this->terminalGroups = $terminalGroups ?? [];
	}

	function getValidPaymentProcessingType(string $paymentProcessingType): string
	{
		if (in_array($paymentProcessingType, static::paymentProcessingTypes)) {
			return $paymentProcessingType;
		}

		throw new Exception(
			"Processing type '{$paymentProcessingType}' is not in white list static::paymentProcessingTypes",
			Exception::PROCESSING_TYPE_IS_NOT_IN_WHITE_LIST
		);
	}

	function getValidPaymentTypeKind(string $paymentTypeKind): string
	{
		if (in_array($paymentTypeKind, static::paymentTypeKinds)) {
			return $paymentTypeKind;
		}

		throw new Exception(
			"Type kind '{$paymentTypeKind}' is not in white list static::paymentTypeKinds",
			Exception::TYPE_KIND_IS_NOT_IN_WHITE_LIST
		);
	}
}