<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\PaymentAdditionalData as Entity;
use PHPUnit\Framework\TestCase;

class PaymentAdditionalDataTest extends OrderTestCase 
{
	function createEntity(array $aVars)
	{
		extract($aVars);
		$oEntity = new Entity();
		return $oEntity;
	}

	function providerEntityVars(): array
	{
		$somePhone = '+79998887766';

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
					'setSearchScope' => Entity::searchScopes['Phone'],
					'setCredential' => $somePhone,
				],
				'aTests' => [
					'aData' => [
						'credential' => $somePhone,
						'searchScope' => 'Phone',
						'type' => 'IikoCard',
					],
				]
			],

			'without.searchScope' => [
				'aSets' => [
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::SEARCH_SCOPE_IS_NOT_IN_WHITE_LIST,
					],
				]
			],

			'without.credential' => [
				'aSets' => [
					'setSearchScope' => Entity::searchScopes['Phone'],
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::PAYMENT_ADDITIONAL_DATA_CREDENTIAL_IS_NOT_SET,
					],
				]
			],

			'with.bad.searchScope' => [
				'aSets' => [
					'setSearchScope' => 'undefinedSearchScope',
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::SEARCH_SCOPE_IS_NOT_IN_WHITE_LIST,
					],
				]
			],
	// --- tests end ---
		];
	}
}
