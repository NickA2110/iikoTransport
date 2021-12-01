<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Payment as Entity;
use IikoTransport\Entity\Order\PaymentAdditionalData;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class PaymentTest extends OrderTestCase 
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

		$oPaymentAdditionalData = (new PaymentAdditionalData())
			->setSearchScope(PaymentAdditionalData::searchScopes['Phone'])
			->setCredential(ApiKey::getCustomerPhone());
		$aPaymentAdditionalData = [
			'credential' => ApiKey::getCustomerPhone(),
			'searchScope' => PaymentAdditionalData::searchScopes['Phone'],
			'type' => PaymentAdditionalData::types['IikoCard'],
		];

		return [
	// +++ start tests +++
			'good' => [
				'aSets' => [
					'setPaymentTypeKind' => Entity::paymentTypeKinds['Cash'],
					'setSum' => 100.01,
					'setPaymentTypeId' => $someGuid,
					'setIsProcessedExternally' => false,
				],
				'aTests' => [
					'aData' => [
						'paymentTypeKind' => 'Cash',
						'sum' => 100.01,
						'paymentTypeId' => $someGuid,
						'isProcessedExternally' => false,
					],
				]
			],

			'good.with.paymentAdditionalData' => [
				'aSets' => [
					'setPaymentTypeKind' => Entity::paymentTypeKinds['Cash'],
					'setSum' => 100.01,
					'setPaymentTypeId' => $someGuid,
					'setIsProcessedExternally' => false,
					'setPaymentAdditionalData' => $oPaymentAdditionalData,
				],
				'aTests' => [
					'aData' => [
						'paymentTypeKind' => 'Cash',
						'sum' => 100.01,
						'paymentTypeId' => $someGuid,
						'isProcessedExternally' => false,
						'paymentAdditionalData' => $aPaymentAdditionalData,
					],
				]
			],

			'without.paymentTypeKind' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PAYMENT_TYPE_KIND_IS_NOT_IN_WHITE_LIST,
					],
				]
			],

			'without.sum' => [
				'aSets' => [
					'setPaymentTypeKind' => Entity::paymentTypeKinds['Cash'],
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PAYMENT_SUM_IS_NOT_SET,
					],
				]
			],

			'without.paymentTypeId' => [
				'aSets' => [
					'setPaymentTypeKind' => Entity::paymentTypeKinds['Cash'],
					'setSum' => 100.01,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PAYMENT_TYPE_ID_IS_NOT_SET,
					],
				]
			],

			'without.isProcessedExternally' => [
				'aSets' => [
					'setPaymentTypeKind' => Entity::paymentTypeKinds['Cash'],
					'setSum' => 100.01,
					'setPaymentTypeId' => $someGuid,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::IS_PROCESSED_EXTERNALLY_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
