<?php 

namespace IikoTransport\Tests\Entity\Order\Discount;

use IikoTransport\Entity\Order\Discount\Exception;
use IikoTransport\Entity\Order\Discount\DiscountItem as Entity;
use IikoTransport\Tests\Entity\Order\OrderTestCase;
use PHPUnit\Framework\TestCase;

class DiscountItemTest extends OrderTestCase 
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
					'setPositionId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'positionId' => $someGuid,
						'sum' => 0,
						'amount' => 0,
					],
				]
			],

			'good.set.sum' => [
				'aSets' => [
					'setPositionId' => $someGuid,
					'setSum' => 100.01,
				],
				'aTests' => [
					'aData' => [
						'positionId' => $someGuid,
						'sum' => 100.01,
						'amount' => 0,
					],
				]
			],

			'good.set.amount' => [
				'aSets' => [
					'setPositionId' => $someGuid,
					'setAmount' => 10.1,
				],
				'aTests' => [
					'aData' => [
						'positionId' => $someGuid,
						'sum' => 0,
						'amount' => 10.1,
					],
				]
			],

			'without.positionId' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::POSITION_ID_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
