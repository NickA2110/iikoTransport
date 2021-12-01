<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Card;
use IikoTransport\Entity\Order\DiscountsInfo;
use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\IikoCard5Info;
use IikoTransport\Entity\Order\Item;
use IikoTransport\Entity\Order\Order as Entity;
use IikoTransport\Entity\Order\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends OrderTestCase 
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
		$someServiceType = 'DeliveryByClient';
		$somePhone = '+79998887766';

		$aCustomerForCheck = [
			'shouldReceivePromoActionsInfo' => false,
			'gender' => 'NotSpecified',
		];

		$aItemsForSet = [
			$this->getProduct()
		];
		$aItemsForCheck = [
			[
				'productId' => '01234567-0123-0123-0123-0123456789ab',
				'type' => 'Product',
				'amount' => 1.0,
			]
		];

		$aMinimalSets = [
			'setOrderServiceType' => $someServiceType,
			'setPhone' => $somePhone,
			'setItems' => $aItemsForSet,
		];

		$aMinimalDataWithoutServiceType = [
			'phone' => $somePhone,
			'customer' => $aCustomerForCheck,
			'items' => $aItemsForCheck,
		];
		$aMinimalData = $aMinimalDataWithoutServiceType + [
			'orderServiceType' => $someServiceType,
		];

		$oIikoCard5InfoForSet = (new IikoCard5Info())
			->setCoupon($someString);
		$aIikoCard5InfoForCheck = [
			'coupon' => $someString,
		];

		$oDiscountsInfoForSet = (new DiscountsInfo())
			->setCard(
				(new Card())->setTrack($someString)
			);
		$aDiscountsInfoForCheck = [
			'card' => [
				'track' => $someString,
			],
		];

		return [
	// +++ start tests +++
			'without.orderServiceType' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::ONE_OF_FIELD_ORDERTYPEID_OR_ORDERSERVICETYPE_REQUIRED,
					],
				]
			],

			'without.phone' => [
				'aSets' => [
					'setOrderServiceType' => $someServiceType,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PHONE_IS_NOT_SET,
					],
				]
			],

			'without.items' => [
				'aSets' => [
					'setOrderServiceType' => $someServiceType,
					'setPhone' => $somePhone,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::ITEMS_IS_NOT_SET,
					],
				]
			],

			'good.minimal' => [
				'aSets' => $aMinimalSets,
				'aTests' => [
					'aData' => $aMinimalData,
				]
			],

			'good.set.id' => [
				'aSets' => $aMinimalSets + [
					'setId' => $someGuid,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'id' => $someGuid,
					],
				]
			],

			'good.set.completeBefore' => [
				'aSets' => $aMinimalSets + [
					'setCompleteBefore' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'completeBefore' => $someString,
					],
				]
			],

			'good.set.orderTypeId' => [
				'aSets' => $aMinimalSets + [
					'setOrderTypeId' => $someGuid,
				],
				'aTests' => [
					'aData' => $aMinimalDataWithoutServiceType + [
						'orderTypeId' => $someGuid,
					],
				]
			],

			/** @todo deliveryPoint test */
			'good.set.deliveryPoint' => [
				'aSets' => $aMinimalSets + [
					'setDeliveryPoint' => null,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						// 'deliveryPoint' => null,
					],
				]
			],

			'good.set.comment' => [
				'aSets' => $aMinimalSets + [
					'setComment' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'comment' => $someString,
					],
				]
			],

			/** @todo guests test */
			'good.set.guests' => [
				'aSets' => $aMinimalSets + [
					'setGuests' => null,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						// 'guests' => null,
					],
				]
			],

			'good.set.marketingSourceId' => [
				'aSets' => $aMinimalSets + [
					'setMarketingSourceId' => $someGuid,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'marketingSourceId' => $someGuid,
					],
				]
			],

			'good.set.operatorId' => [
				'aSets' => $aMinimalSets + [
					'setOperatorId' => $someGuid,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'operatorId' => $someGuid,
					],
				]
			],

			/** @todo combos test */
			'good.set.combos' => [
				'aSets' => $aMinimalSets + [
					'setCombos' => [], // $aCombosForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						// 'combos' => $aCombosForCheck,
					],
				]
			],

			/** @todo payments test */
			'good.set.payments' => [
				'aSets' => $aMinimalSets + [
					'setPayments' => [], // $aPaymentsForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						// 'payments' => $aPaymentsForCheck,
					],
				]
			],

			/** @todo tips test */
			'good.set.tips' => [
				'aSets' => $aMinimalSets + [
					'setTips' => [], // $aTipsForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						// 'tips' => $aTipsForCheck,
					],
				]
			],

			'good.set.sourceKey' => [
				'aSets' => $aMinimalSets + [
					'setSourceKey' => $someString,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'sourceKey' => $someString,
					],
				]
			],

			'good.set.discountsInfo' => [
				'aSets' => $aMinimalSets + [
					'setDiscountsInfo' => $oDiscountsInfoForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'discountsInfo' => $aDiscountsInfoForCheck,
					],
				]
			],

			'good.set.iikoCard5Info' => [
				'aSets' => $aMinimalSets + [
					'setIikoCard5Info' => $oIikoCard5InfoForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'iikoCard5Info' => $aIikoCard5InfoForCheck,
					],
				]
			],
	// --- tests end ---
		];
	}

	function getProduct(): Item
	{
		$oProduct = new Product();
		$oProduct
			->setProductId('01234567-0123-0123-0123-0123456789ab')
			->setAmount(1.0);
		return $oProduct;
	}
}
