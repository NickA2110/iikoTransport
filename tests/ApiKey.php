<?php 

namespace IikoTransport\Tests;

use IikoTransport\Entity\Order\Customer;

class ApiKey
{
	static $sApiKey;
	static $sOrganizationId;
	static $sTerminalGroupId;
	static $sCityId;
	static $sCustomerPhone;
	static $oCustomer;
	static $sProductId;

	static public function getApiKey(): string
	{
		if (empty(static::$sApiKey)) {
			static::$sApiKey = trim(file_get_contents(__DIR__ . "/testKeys/apikey.txt"));
		}
		return static::$sApiKey;
	}

	static public function getOrganizationId(): string 
	{
		if (empty(static::$sOrganizationId)) {
			static::$sOrganizationId = trim(file_get_contents(__DIR__ . "/testKeys/organizationId.txt"));
		}
		return static::$sOrganizationId;
	}

	static public function getTermianlGroupId(): string 
	{
		if (empty(static::$sTerminalGroupId)) {
			static::$sTerminalGroupId = trim(file_get_contents(__DIR__ . "/testKeys/terminalGroupId.txt"));
		}
		return static::$sTerminalGroupId;
	}

	static public function getCityId(): string 
	{
		if (empty(static::$sCityId)) {
			static::$sCityId = trim(file_get_contents(__DIR__ . "/testKeys/cityId.txt"));
		}
		return static::$sCityId;
	}

	static public function getCustomerPhone(): string 
	{
		if (empty(static::$sCustomerPhone)) {
			static::$sCustomerPhone = trim(file_get_contents(__DIR__ . "/testKeys/customerPhone.txt"));
		}
		return static::$sCustomerPhone;
	}

	static public function getCustomer(): Customer
	{
		if (empty(static::$oCustomer)) {
			$aCustomer = json_decode(
				file_get_contents(__DIR__ . "/testKeys/customer.txt"),
				$bAsArray = true,
				$nDepth = 512,
				JSON_THROW_ON_ERROR
			);
			static::$oCustomer = new Customer();
			static::$oCustomer
				->setId($aCustomer['id'])
				->setName($aCustomer['name'])
				->setSurname($aCustomer['surname'])
				->setComment($aCustomer['comment'])
				->setBirthdate($aCustomer['birthdate'])
				->setEmail($aCustomer['email'])
				->setShouldReceivePromoActionsInfo(
					$aCustomer['shouldReceivePromoActionsInfo']
				)
				->setGender($aCustomer['gender']);
		}
		return static::$oCustomer;
	}

	static public function getProductId(): string
	{
		if (empty(static::$sProductId)) {
			static::$sProductId = trim(file_get_contents(__DIR__ . "/testKeys/productId.txt"));
		}
		return static::$sProductId;
	}
}
