<?php

namespace IikoTransport\Entity\Loyalty\Customer;

class Info
{
	const genders = [
		'NotSpecified' => 0,
		'Male' => 1,
		'Female' => 2,
	];

	const consentStatuses = [
		'Unknown' => 0,
		'Given' => 1,
		'Revoked' => 2,
	];

	public $id;

	public $referrerId;

	public $name;

	public $surname;

	public $middleName;

	public $comment;

	public $phone;

	public $cultureName;

	public $birthday;

	public $email;

	public $sex;

	public $consentStatus;

	public $anonymized;

	public $cards;

	public $categories;

	public $walletBalances;

	public $userData;

	public $shouldReceivePromoActionsInfo;

	public $shouldReceiveLoyaltyInfo;

	public $shouldReceiveOrderStatusInfo;

	public $personalDataConsentFrom;

	public $personalDataConsentTo;

	public $personalDataProcessingFrom;

	public $personalDataProcessingTo;

	public $isDeleted;


	function __construct(
		string $id,
		?string $referrerId,
		string $name,
		string $surname,
		?string $middleName,
		string $comment,
		string $phone,
		string $cultureName,
		string $birthday,
		string $email,
		int $sex,
		int $consentStatus,
		bool $anonymized,
		array $cards,
		array $categories,
		array $walletBalances,
		?string $userData,
		bool $shouldReceivePromoActionsInfo,
		bool $shouldReceiveLoyaltyInfo,
		bool $shouldReceiveOrderStatusInfo,
		?string $personalDataConsentFrom,
		?string $personalDataConsentTo,
		?string $personalDataProcessingFrom,
		?string $personalDataProcessingTo,
		bool $isDeleted
	) {
		$this->id = $id;
		$this->referrerId = $referrerId;
		$this->name = $name;
		$this->surname = $surname;
		$this->middleName = $middleName;
		$this->comment = $comment;
		$this->phone = $phone;
		$this->cultureName = $cultureName;
		$this->birthday = $birthday;
		$this->email = $email;
		$this->sex = $this->getValidGender($sex);
		$this->consentStatus = $this->getValidConsentStatus($consentStatus);
		$this->anonymized = $anonymized;
		$this->cards = $cards;
		$this->categories = $categories;
		$this->walletBalances = $walletBalances;
		$this->userData = $userData;
		$this->shouldReceivePromoActionsInfo = $shouldReceivePromoActionsInfo;
		$this->shouldReceiveLoyaltyInfo = $shouldReceiveLoyaltyInfo;
		$this->shouldReceiveOrderStatusInfo = $shouldReceiveOrderStatusInfo;
		$this->personalDataConsentFrom = $personalDataConsentFrom;
		$this->personalDataConsentTo = $personalDataConsentTo;
		$this->personalDataProcessingFrom = $personalDataProcessingFrom;
		$this->personalDataProcessingTo = $personalDataProcessingTo;
		$this->isDeleted = $isDeleted;
	}

	function getValidGender(int $sex): int
	{
		if (in_array($sex, static::genders)) {
			return $sex;
		}

		throw new Exception(
			"Index of gender (sex) '{$sex}' is not in white list Customer\\Info::genders",
			Exception::INDEX_OF_GENDER_IS_NOT_IN_WHITE_LIST
		);
	}

	function getValidConsentStatus(int $consentStatus): int
	{
		if (in_array($consentStatus, static::consentStatuses)) {
			return $consentStatus;
		}

		throw new Exception(
			"Index of consentStatuses '{$consentStatus}' is not in white list Customer\\Info::consentStatuses",
			Exception::INDEX_OF_CONSENT_STATUS_IS_NOT_IN_WHITE_LIST
		);
	}
}