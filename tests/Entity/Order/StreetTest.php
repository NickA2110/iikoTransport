<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Street as Entity;
use PHPUnit\Framework\TestCase;

class StreetTest extends OrderTestCase 
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
		$someName = 'some combo name';
		$someString = 'someString';

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
				],
				'aTests' => [
					'aData' => [
					],
				]
			],

			'good.set.setClassifierId' => [
				'aSets' => [
					'setClassifierId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'classifierId' => $someGuid,
					],
				]
			],

			'good.set.id' => [
				'aSets' => [
					'setId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'id' => $someGuid,
					],
				]
			],

			'good.set.name' => [
				'aSets' => [
					'setName' => $someName,
				],
				'aTests' => [
					'aData' => [
						'name' => $someName,
					],
				]
			],

			'good.set.city' => [
				'aSets' => [
					'setCity' => $someString,
				],
				'aTests' => [
					'aData' => [
						'city' => $someString,
					],
				]
			],
	// --- tests end ---
		];
	}
}
