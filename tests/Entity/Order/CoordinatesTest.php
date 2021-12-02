<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Coordinates as Entity;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends OrderTestCase 
{
	function createEntity(array $aVars)
	{
		extract($aVars);
		$oEntity = new Entity();
		return $oEntity;
	}

	function providerEntityVars(): array
	{
		$latitude = 10.001;
		$longitude = 20.001;

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
					'setLatitude' => $latitude,
					'setLongitude' => $longitude,
				],
				'aTests' => [
					'aData' => [
						'latitude' => $latitude,
						'longitude' => $longitude,
					],
				]
			],

			'without.longitude' => [
				'aSets' => [
					'setLatitude' => $latitude,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::LONGITUDE_IS_NOT_SET,
					],
				]
			],

			'without.latitude' => [
				'aSets' => [
					'setLongitude' => $longitude,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::LATITUDE_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}

	public function testSetCoorinates() {
		$latitude = 10.001;
		$longitude = 20.001;
		
		$oEntity = $this->createEntity([]);
		$oEntity->setCoordinates($latitude, $longitude);

		$aNeedleData = [
			'latitude' => $latitude,
			'longitude' => $longitude,
		];

		$this->assertEquals(
			$aNeedleData,
			$oEntity->toArray(),
			"toArray() method return bad data"
		);
	}
}
