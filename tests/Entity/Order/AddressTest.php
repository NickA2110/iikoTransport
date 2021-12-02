<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Street;
use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Address as Entity;
use PHPUnit\Framework\TestCase;

class AddressTest extends OrderTestCase 
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

		$aMinimalSet = [
			'setStreet' => (new Street()),
			'setHouse' => $someString,
		];
		$aMinimalData = [
			'street' => [],
			'house' => $someString,
		];

		return [
	// +++ start tests +++
			'without.street' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::STREET_IS_NOT_SET,
					],
				]
			],

			'without.house' => [
				'aSets' => [
					'setStreet' => $aMinimalSet['setStreet'],
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::HOUSE_IS_NOT_SET,
					],
				]
			],

			'good.minimal' => [
				'aSets' => $aMinimalSet,
				'aTests' => [
					'aData' => $aMinimalData,
				]
			],

			'good.set.index' => [
				'aSets' => $aMinimalSet + [
					'setIndex' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'index' => $someString,
					],
				],
			],

			'good.set.building' => [
				'aSets' => $aMinimalSet + [
					'setBuilding' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'building' => $someString,
					],
				],
			],

			'good.set.flat' => [
				'aSets' => $aMinimalSet + [
					'setFlat' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'flat' => $someString,
					],
				],
			],

			'good.set.entrance' => [
				'aSets' => $aMinimalSet + [
					'setEntrance' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'entrance' => $someString,
					],
				],
			],

			'good.set.floor' => [
				'aSets' => $aMinimalSet + [
					'setFloor' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'floor' => $someString,
					],
				],
			],

			'good.set.doorphone' => [
				'aSets' => $aMinimalSet + [
					'setDoorphone' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'doorphone' => $someString,
					],
				],
			],

			'good.set.regionId' => [
				'aSets' => $aMinimalSet + [
					'setRegionId' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'regionId' => $someString,
					],
				],
			],
	// --- tests end ---
		];
	}
}
