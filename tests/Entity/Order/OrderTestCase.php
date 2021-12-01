<?php 

namespace IikoTransport\Tests\Entity\Order;

use PHPUnit\Framework\TestCase;

abstract class OrderTestCase extends TestCase 
{
	/** @dataProvider providerEntityVars */
	public function testEntityToArray(array $aSets, array $aTests) {
		if (!empty($aTests['aException'])) {
			$this->expectException($aTests['aException']['exception']);
			$this->expectExceptionCode($aTests['aException']['code']);
		}
		
		$oEntity = $this->entitySets(
			$this->createEntity([]),
			$aSets
		);

		$this->entityTests($oEntity, $aTests);
	}

	function entitySets($oEntity, $aSets)
	{
		foreach ($aSets as $sMethod => $value) {
			$oEntity->$sMethod($value);
		}
		return $oEntity;
	}

	function entityTests($oEntity, $aTests)
	{
		$aData = $oEntity->toArray();

		$this->assertEquals(
			$aTests['aData'],
			$aData,
			"toArray() method return bad data"
		);
	}

	abstract function providerEntityVars(): array;

	abstract function createEntity(array $aVars);

}
