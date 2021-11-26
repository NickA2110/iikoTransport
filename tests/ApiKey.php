<?php 

namespace IikoTransport\Tests;

class ApiKey
{
	static $sApiKey;
	static $sOrganizationId;
	static $sTerminalGroupId;
	static $sCityId;
	static $sCustomerPhone;

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
}
