<?php 

namespace IikoTransport\Tests\Entity\Commands;

use IikoTransport\Entity\Commands\Exception;
use IikoTransport\Entity\Commands\Status as Entity; 
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase 
{
	/** @dataProvider providerEntityVars */
	public function testGoodCreate(array $aVars) {
		$oEntity = $this->createEntity($aVars);
		$this->assertNotEmpty($oEntity);
	}

	/** @dataProvider providerEntityVars */
	public function testBadState(array $aVars) {
		$aVars['state'] = 'UndefinedState';

		$this->expectException(
			Exception::class,
			"Bad state is not throwing exception"
		);
		$this->expectExceptionCode(Exception::STATE_IS_NOT_IN_WHITE_LIST);

		$this->createEntity($aVars);
	}

	function providerEntityVars(): array
	{
		return [
			[
				'aVars' => [
					'state' => 'Success',
					'exception' => null,
				]
			]
		];
	}

	function createEntity(array $aVars): Entity
	{
		extract($aVars);
		$oEntity = new Entity(
			$state,
			$exception
		);
		return $oEntity;
	}
}
