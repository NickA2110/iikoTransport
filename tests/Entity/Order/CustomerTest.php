<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Customer as Entity;
use PHPUnit\Framework\TestCase;

class CustomerTest extends OrderTestCase 
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
		$aMinimalData = [
			'shouldReceivePromoActionsInfo' => false,
			'gender' => 'NotSpecified',
		];

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
				],
				'aTests' => [
					'aData' => $aMinimalData,
				],
			],

			'good.set.id' => [
				'aSets' => [
					'setId' => $someGuid,
				],
				'aTests' => [
					'aData' => [
						'id' => $someGuid,
					] + $aMinimalData,
				],
			],

			'good.set.name' => [
				'aSets' => [
					'setName' => $someString,
				],
				'aTests' => [
					'aData' => [
						'name' => $someString,
					] + $aMinimalData,
				],
			],

			'good.set.surname' => [
				'aSets' => [
					'setSurname' => $someString,
				],
				'aTests' => [
					'aData' => [
						'surname' => $someString,
					] + $aMinimalData,
				],
			],

			'good.set.comment' => [
				'aSets' => [
					'setComment' => $someString,
				],
				'aTests' => [
					'aData' => [
						'comment' => $someString,
					] + $aMinimalData,
				],
			],

			'good.set.birthdate' => [
				'aSets' => [
					'setBirthdate' => $someString,
				],
				'aTests' => [
					'aData' => [
						'birthdate' => $someString,
					] + $aMinimalData,
				],
			],

			'good.set.email' => [
				'aSets' => [
					'setEmail' => $someString,
				],
				'aTests' => [
					'aData' => [
						'email' => $someString,
					] + $aMinimalData,
				],
			],

			'good.set.gender' => [
				'aSets' => [
					'setGender' => 'Male',
				],
				'aTests' => [
					'aData' => [
						'gender' => 'Male',
					] + $aMinimalData,
				],
			],

			'set.bed.gender' => [
				'aSets' => [
					'setGender' => 'undefinedGender',
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::GENDER_IS_NOT_IN_WHITE_LIST,
					],
				]
			],
	// --- tests end ---
		];
	}
}
