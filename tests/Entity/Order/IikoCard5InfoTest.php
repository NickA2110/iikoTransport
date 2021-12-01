<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\IikoCard5Info as Entity;
use PHPUnit\Framework\TestCase;

class IikoCard5InfoTest extends OrderTestCase 
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
				],
				'aTests' => [
					'aData' => [
					],
				]
			],

			'good.set.coupon' => [
				'aSets' => [
					'setCoupon' => $someString,
				],
				'aTests' => [
					'aData' => [
						'coupon' => $someString,
					],
				]
			],

			'good.set.applicableManualConditions' => [
				'aSets' => [
					'setApplicableManualConditions' => [
						$someString,
						$someName,
					]
				],
				'aTests' => [
					'aData' => [
						'applicableManualConditions' => [
							$someString,
							$someName,
						]
					],
				]
			],
	// --- tests end ---
		];
	}
}
