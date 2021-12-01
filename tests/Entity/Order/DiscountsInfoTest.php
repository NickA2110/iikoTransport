<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Discount\RMS;
use IikoTransport\Entity\Order\Card;
use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\DiscountsInfo as Entity;
use PHPUnit\Framework\TestCase;

class DiscountsInfoTest extends OrderTestCase 
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

		$oCard = (new Card())
			->setTrack($someString);
		$aCard = [
			'track' => $someString,
		];

		$aDiscountsForSet = [
			(new RMS())
				->setDiscountTypeId($someGuid),
		];
		$aDiscountsForCheck = [
			[
				'discountTypeId' => $someGuid,
				'sum' => 0,
				'type' => 'RMS',
			],
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

			'good.set.card' => [
				'aSets' => [
					'setCard' => $oCard,
				],
				'aTests' => [
					'aData' => [
						'card' => $aCard,
					],
				]
			],

			'good.set.discounts' => [
				'aSets' => [
					'setDiscounts' => $aDiscountsForSet,
				],
				'aTests' => [
					'aData' => [
						'discounts' => $aDiscountsForCheck,
					],
				]
			],
	// --- tests end ---
		];
	}
}
