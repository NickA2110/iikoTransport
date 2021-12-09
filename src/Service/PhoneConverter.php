<?php

namespace IikoTransport\Service;

class PhoneConverter
{
	static public function getFixedPhone(string $sPhone)
	{
		$sPhone = static::fixWithoutPlus($sPhone);
		$sPhone = static::fixBegin8($sPhone);
		return $sPhone;
	}

	static function fixWithoutPlus(string $sPhone): string
	{
		if (!preg_match("#^(\\d{11})$#ui", $sPhone, $aMatch)) {
			return $sPhone;
		}
		$sPhone = '+' . $aMatch[1];
		return $sPhone;
	}

	static function fixBegin8(string $sPhone): string
	{
		if (!preg_match("#^\\+8(\\d{10})$#ui", $sPhone, $aMatch)) {
			return $sPhone;
		}
		$sPhone = '+7' . $aMatch[1];
		return $sPhone;
	}
}