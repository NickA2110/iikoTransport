<?php 

namespace IikoTransport\Tests;

class ApiKey
{
	static $sApiKey;

	static public function getApiKey(): string {
		if (empty(static::$sApiKey)) {
			static::$sApiKey = trim(file_get_contents(__DIR__ . "/apikey.txt"));
		}
		return static::$sApiKey;
	}
}
