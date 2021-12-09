<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Card;
use IikoTransport\Entity\Order\Combo;
use IikoTransport\Entity\Order\DeliveryPoint;
use IikoTransport\Entity\Order\DiscountsInfo;
use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Guests;
use IikoTransport\Entity\Order\IikoCard5Info;
use IikoTransport\Entity\Order\Item;
use IikoTransport\Entity\Order\Order as Entity;
use IikoTransport\Entity\Order\Payment;
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
		$someBadPhone = '79998887766';

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

		$oGuests = (new Guests())
			->setСount(2)
			->setSplitBetweenPersons(false);
		$aGuestsForCheck = [
			'count' => 2,
			'splitBetweenPersons' => false,
		];

		$oDeliveryPoint = (new DeliveryPoint());

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

		$aCombosForSet = [
			(new Combo())
				->setId($someGuid)
				->setName($someName)
				->setAmount(1)
				->setPrice(10.01)
				->setSourceId($someGuid),
		];
		$aCombosForCheck = [
			[
				'id' => $someGuid,
				'name' => $someName,
				'amount' => 1,
				'price' => 10.01,
				'sourceId' => $someGuid,
			]
		];

		$aPaymentsForSet = [
			(new Payment())
				->setPaymentTypeKind(Payment::paymentTypeKinds['Cash'])
				->setSum(10.01)
				->setPaymentTypeId($someGuid)
				->setIsProcessedExternally(false),
		];
		$aPaymentsForCheck = [
			[
				'paymentTypeKind' => Payment::paymentTypeKinds['Cash'],
				'sum' => 10.01,
				'paymentTypeId' => $someGuid,
				'isProcessedExternally' => false,
			]
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

			'good.minimal.with.badPhone' => [
				'aSets' => [
					'setPhone' => $someBadPhone,
				] + $aMinimalSets,
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

			'good.set.deliveryPoint' => [
				'aSets' => $aMinimalSets + [
					'setDeliveryPoint' => $oDeliveryPoint,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'deliveryPoint' => [],
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

			'good.set.guests' => [
				'aSets' => $aMinimalSets + [
					'setGuests' => $oGuests,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'guests' => $aGuestsForCheck,
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

			'good.set.combos' => [
				'aSets' => $aMinimalSets + [
					'setCombos' => $aCombosForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'combos' => $aCombosForCheck,
					],
				]
			],

			'good.set.payments' => [
				'aSets' => $aMinimalSets + [
					'setPayments' => $aPaymentsForSet,
				],
				'aTests' => [
					'aData' => $aMinimalData + [
						'payments' => $aPaymentsForCheck,
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


	/** @dataProvider phoneValidatorProvider */
	public function testPhoneValidator(
		string $sInputPhone,
		string $sTestPhone,
		array $aException
	) {
		if (!empty($aException)) {
			$this->expectException(
				$aException['class'],
				"Phone '{$sInputPhone}' not throw exception"
			);
			$this->expectExceptionCode($aException['code']);
		}

		$oEntity = new Entity();

		$oEntity->setPhone($sInputPhone);

		$this->assertEquals(
			$sTestPhone,
			$oEntity->phone,
			"Order phone '{$oEntity->phone}' not equals needle format '{$sTestPhone}'"
		);
	}

	public function phoneValidatorProvider() 
	{
		return [
			'normalized' => [
				'input' => '+79998887766',
				'test' => '+79998887766',
				'exception' => [],
			],
			'without.plus' => [
				'input' => '79998887766',
				'test' => '+79998887766',
				'exception' => [],
			],
			'from.8' => [
				'input' => '89998887766',
				'test' => '+79998887766',
				'exception' => [],
			],
			'short' => [
				'input' => '28887766',
				'test' => '',
				'exception' => [
					'class' => Exception::class,
					'code' => Exception::PHONE_IS_INVALID,
				]
			],
		];
	}
}
