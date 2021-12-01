<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Card as Entity;
use PHPUnit\Framework\TestCase;

class CardTest extends OrderTestCase 
{
	function createEntity(array $aVars)
	{
		extract($aVars);
		$oEntity = new Entity();
		return $oEntity;
	}

	function providerEntityVars(): array
	{
		$someGuid = '01234567-0123-0123-0123-0123456789ab';
		$someString = 'someString';
		$someName = 'some combo name';

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
					'setTrack' => $someString,
				],
				'aTests' => [
					'aData' => [
						'track' => $someString,
					],
				]
			],

			'without.track' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::TRACK_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
