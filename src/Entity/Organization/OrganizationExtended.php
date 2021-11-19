<?php

namespace IikoTransport\Entity\Organization;

class OrganizationExtended implements OrganizationInterface
{
	public $id;

	public $name;

	public $inn;

	public $orderItemCommentEnabled;

	public $defaultCallCenterPaymentTypeId;

	public $deliveryServiceType;

	public $deliveryCityIds;

	public $defaultDeliveryCityId;

	public $marketingSourceRequiredInDelivery;

	public $countryPhoneCode;

	public $currencyMinimumDenomination;

	public $currencyIsoName;

	public $version;

	public $useUaeAddressingSystem;

	public $longitude;

	public $latitude;

	public $restaurantAddress;

	public $country;

	function __construct(
		string $id,
		string $name,
		string $inn,
		bool $orderItemCommentEnabled,
		string $defaultCallCenterPaymentTypeId,
		string $deliveryServiceType,
		array $deliveryCityIds,
		string $defaultDeliveryCityId,
		bool $marketingSourceRequiredInDelivery,
		string $countryPhoneCode,
		float $currencyMinimumDenomination,
		string $currencyIsoName,
		string $version,
		bool $useUaeAddressingSystem,
		float $longitude,
		float $latitude,
		string $restaurantAddress,
		string $country
	) {
		$this->id = $id;
		$this->name = $name;
		$this->inn = $inn;
		$this->orderItemCommentEnabled = $orderItemCommentEnabled;
		$this->defaultCallCenterPaymentTypeId = $defaultCallCenterPaymentTypeId;
		$this->deliveryServiceType = $deliveryServiceType;
		$this->deliveryCityIds = $deliveryCityIds;
		$this->defaultDeliveryCityId = $defaultDeliveryCityId;
		$this->marketingSourceRequiredInDelivery = $marketingSourceRequiredInDelivery;
		$this->countryPhoneCode = $countryPhoneCode;
		$this->currencyMinimumDenomination = $currencyMinimumDenomination;
		$this->currencyIsoName = $currencyIsoName;
		$this->version = $version;
		$this->useUaeAddressingSystem = $useUaeAddressingSystem;
		$this->longitude = $longitude;
		$this->latitude = $latitude;
		$this->restaurantAddress = $restaurantAddress;
		$this->country = $country;
	}
}