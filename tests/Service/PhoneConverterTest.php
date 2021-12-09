<?php 

namespace IikoTransport\Tests\Service;

use IikoTransport\Service\PhoneConverter;
use PHPUnit\Framework\TestCase;

class PhoneConverterTest extends TestCase 
{
	/** @dataProvider getFixedPhoneProvider */
	public function testGetFixedPhone(string $sInputPhone, string $sTestPhone)
	{
		$sOutput = PhoneConverter::getFixedPhone($sInputPhone);

		$this->assertEquals(
			$sTestPhone,
			$sOutput,
			"Phone number '{$sInputPhone}' not converted to '{$sTestPhone}'"
		);
	}

	public function getFixedPhoneProvider()
	{
		return [
			'normarl' => [
				'input' => '+79998887766',
				'test' => '+79998887766',
			],
			'without.plus' => [
				'input' => '79998887766',
				'test' => '+79998887766',
			],
			'begin.8' => [
				'input' => '89998887766',
				'test' => '+79998887766',
			],
		];
	}
}
