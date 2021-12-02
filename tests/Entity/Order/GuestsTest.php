<?php 

namespace IikoTransport\Tests\Entity\Order;

use IikoTransport\Entity\Order\Exception;
use IikoTransport\Entity\Order\Guests as Entity;
use PHPUnit\Framework\TestCase;

class GuestsTest extends OrderTestCase 
{
	function createEntity(array $aVars)
	{
		extract($aVars);
		$oEntity = new Entity();
		return $oEntity;
	}

	function providerEntityVars(): array
	{
		$nCount = 2;
		$bSplit = true;

		return [
	// +++ start tests +++
			'good.minimal' => [
				'aSets' => [
					'setСount' => $nCount,
					'setSplitBetweenPersons' => $bSplit,
				],
				'aTests' => [
					'aData' => [
						'count' => $nCount,
						'splitBetweenPersons' => $bSplit,
					],
				]
			],

			'without.count' => [
				'aSets' => [
					'setSplitBetweenPersons' => $bSplit,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::COUNT_IS_NOT_SET,
					],
				]
			],

			'without.splitBetweenPersons' => [
				'aSets' => [
					'setСount' => $nCount,
				],
				'aTests' => [
					'aException' => [
						'exception' => Exception::class,
						'code' => Exception::SPLIT_BETWEEN_PERSONS_IS_NOT_SET,
					],
				]
			],
	// --- tests end ---
		];
	}
}
