<?php 

namespace IikoTransport\Tests\Entity\Order\Discount;

use IikoTransport\Entity\Order\Discount\DiscountItem;
use IikoTransport\Entity\Order\Discount\Exception;
use IikoTransport\Entity\Order\Discount\IikoCard as Entity;
use IikoTransport\Tests\Entity\Order\OrderTestCase;
use PHPUnit\Framework\TestCase;

class IikoCardTest extends OrderTestCase 
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
		$aItemsForSet = [
			(new DiscountItem())->setPositionId($someGuid),
		];
		$aItemsForCheck = [
			[
				'positionId' => $someGuid,
				'sum' => 0,
				'amount' => 0,
			]
		];

		return [
	// +++ start tests +++
			'without.programId' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PROGRAM_ID_IS_NOT_SET,
					],
				]
			],

			'without.programName' => [
				'aSets' => [
					'setProgramId' => $someGuid,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PROGRAM_NAME_IS_NOT_SET,
					],
				]
			],

			'without.discountItems' => [
				'aSets' => [
					'setProgramId' => $someGuid,
					'setProgramName' => $someString,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::DISCOUNT_ITEMS_IS_NOT_SET,
					],
				]
			],

			'good.minimal' => [
				'aSets' => [
					'setProgramId' => $someGuid,
					'setProgramName' => $someString,
					'setDiscountItems' => $aItemsForSet,
				],
				'aTests' => [
					'aData' => [
						'programId' => $someGuid,
						'programName' => $someString,
						'discountItems' => $aItemsForCheck,
						'type' => 'IikoCard',
					],
				]
			],
	// --- tests end ---
		];
	}
}
