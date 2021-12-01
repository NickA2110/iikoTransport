<?php 

namespace IikoTransport\Tests\Entity\Order\Discount;

use IikoTransport\Entity\Order\Discount\Exception;
use IikoTransport\Entity\Order\Discount\RMS as Entity;
use IikoTransport\Tests\Entity\Order\OrderTestCase;
use PHPUnit\Framework\TestCase;

class RMSTest extends OrderTestCase 
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
					'setDiscountTypeId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'discountTypeId' => $someGuid,
						'sum' => 0,
						'type' => 'RMS',
					],
				]
			],

			'good.set.sum' => [
				'aSets' => [
					'setDiscountTypeId' => $someGuid,
					'setSum' => 100.01,
				],
				'aTests' => [
					'aData' => [
						'discountTypeId' => $someGuid,
						'sum' => 100.01,
						'type' => 'RMS',
					],
				]
			],

			'good.set.selectivePositions' => [
				'aSets' => [
					'setDiscountTypeId' => $someGuid,
					'setSelectivePositions' => [
						$someGuid,
					],
				],
				'aTests' => [
					'aData' => [
						'discountTypeId' => $someGuid,
						'sum' => 0,
						'selectivePositions' => [
							$someGuid,
						],
						'type' => 'RMS',
					],
				]
			],

			'without.discountTypeId' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::DISCOUNT_TYPE_ID_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
