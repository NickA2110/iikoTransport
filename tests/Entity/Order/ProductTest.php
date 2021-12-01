<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\ComboInformation;
use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Modifier;
use IikoTransport\Entity\Order\Product as Entity;
use PHPUnit\Framework\TestCase;

class PaymentTypeTest extends OrderTestCase 
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
			'setAmount' => 2,
		];
		$aMinimalData = [
			'type' => 'Product',
			'productId' => $someGuid,
			'amount' => 2,
		];
		$someComment = 'Test comment for product';

		$oComboInformation = (new ComboInformation())
			->setComboId($someGuid)
			->setComboSourceId($someGuid)
			->setComboGroupId($someGuid);
		$aComboInformation = [
			'comboId' => $someGuid,
			'comboSourceId' => $someGuid,
			'comboGroupId' => $someGuid,
		];

		$oModifier = (new Modifier())
			->setProductId($someGuid)
			->setProductGroupId($someGuid)
			->setAmount(3);
		$aModifier = [
			'productId' => $someGuid,
			'amount' => 3,
			'productGroupId' => $someGuid,
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

			'good.with.comment' => [
				'aSets' => $aMinimalSets + [
						'setComment' => $someComment,
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'comment' => $someComment,
					],
				],
			],

			'good.with.productSizeId' => [
				'aSets' => $aMinimalSets + [
						'setProductSizeId' => $someGuid,
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'productSizeId' => $someGuid,
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

			'good.with.comboInformation' => [
				'aSets' => $aMinimalSets + [
						'setComboInformation' => $oComboInformation,
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'comboInformation' => $aComboInformation,
					],
				],
			],

			'good.with.modifiers' => [
				'aSets' => $aMinimalSets + [
						'setModifiers' => [ $oModifier ],
					],
				'aTests' => [
					'aData' => $aMinimalData + [
						'modifiers' => [ $aModifier ],
					],
				],
			],
			
			'without.productId' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PRODUCT_ID_OF_PRODUCT_IS_NOT_SET,
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
						'code' => Exception::AMOUNT_OF_PRODUCT_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
