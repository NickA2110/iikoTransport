<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Address;
use IikoTransport\Entity\Order\Coordinates;
use IikoTransport\Entity\Order\DeliveryPoint as Entity;
use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Street;
use PHPUnit\Framework\TestCase;

class DeliveryPointTest extends OrderTestCase 
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

		$latitude = 10.001;
		$longitude = 20.002;
		$oCoordinates = (new Coordinates())
			->setCoordinates($latitude, $longitude);
		$aCoordinatesForCheck = [
			'latitude' => $latitude,
			'longitude' => $longitude,
		];

		$oAddress = (new Address())
			->setStreet(
				(new Street())
			)
			->setHouse($someString);
		$aAddressForCheck = [
			'street' => [],
			'house' => $someString,
		];

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

			'good.set.coordinates' => [
				'aSets' => [
					'setCoordinates' => $oCoordinates,
				],
				'aTests' => [
					'aData' => [
						'coordinates' => $aCoordinatesForCheck,
					],
				]
			],

			'good.set.address' => [
				'aSets' => [
					'setAddress' => $oAddress,
				],
				'aTests' => [
					'aData' => [
						'address' => $aAddressForCheck,
					],
				]
			],

			'good.set.externalCartographyId' => [
				'aSets' => [
					'setExternalCartographyId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'externalCartographyId' => $someGuid,
					],
				]
			],

			'good.set.comment' => [
				'aSets' => [
					'setComment' => $someString,
				],
				'aTests' => [
					'aData' => [
						'comment' => $someString,
					],
				]
			],
	// --- tests end ---
		];
	}
}
