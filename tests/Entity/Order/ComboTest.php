<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Combo as Entity;
use PHPUnit\Framework\TestCase;

class ComboTest extends OrderTestCase 
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

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
					'setId' => $someGuid,
					'setName' => $someName,
					'setAmount' => 3,
					'setPrice' => 300.03,
					'setSourceId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'id' => $someGuid,
						'name' => $someName,
						'amount' => 3,
						'price' => 300.03,
						'sourceId' => $someGuid,
					],
				]
			],
			
			'without.id' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::ID_OF_COMBO_IS_NOT_SET,
					],
				]
			],

			'without.name' => [
				'aSets' => [
					'setId' => $someGuid,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::NAME_OF_COMBO_IS_NOT_SET,
					],
				]
			],

			'without.amount' => [
				'aSets' => [
					'setId' => $someGuid,
					'setName' => $someName,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::AMOUNT_OF_COMBO_IS_NOT_SET,
					],
				]
			],

			'without.price' => [
				'aSets' => [
					'setId' => $someGuid,
					'setName' => $someName,
					'setAmount' => 3,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PRICE_OF_COMBO_IS_NOT_SET,
					],
				]
			],

			'without.sourceId' => [
				'aSets' => [
					'setId' => $someGuid,
					'setName' => $someName,
					'setAmount' => 3,
					'setPrice' => 300.03,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::SOURCE_ID_OF_COMBO_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
