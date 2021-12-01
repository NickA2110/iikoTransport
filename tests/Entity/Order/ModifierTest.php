<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Modifier as Entity;
use PHPUnit\Framework\TestCase;

class ModifierTest extends OrderTestCase 
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
		$aMinimalSets = [
			'setProductId' => $someGuid,
			'setAmount' => 2.0,
		];
		$aMinimalData = [
			'productId' => $someGuid,
			'amount' => 2.0,
		];

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => $aMinimalSets,
				'aTests' => [
					'aData' => $aMinimalData,
				],
			],

			'good.with.price' => [
				'aSets' => $aMinimalSets + [
						'setPrice' => 100.01,
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'price' => 100.01,
					],
				],
			],

			'good.with.positionId' => [
				'aSets' => $aMinimalSets + [
						'setPositionId' => $someGuid,
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'positionId' => $someGuid,
					],
				],
			],

			'good.with.productGroupId' => [
				'aSets' => $aMinimalSets + [
						'setProductGroupId' => $someGuid,
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'productGroupId' => $someGuid,
					],
				],
			],
			
			'without.productId' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PRODUCT_ID_OF_MODIFIER_IS_NOT_SET,
					],
				]
			],

			'without.amount' => [
				'aSets' => [
					'setProductId' => $someGuid,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::AMOUNT_OF_MODIFIER_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
