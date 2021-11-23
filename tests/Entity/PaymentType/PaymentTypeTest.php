<?php 

namespace IikoTransport\Tests\Entity\PaymentType;

use IikoTransport\Entity\PaymentType\Exception;
use IikoTransport\Entity\PaymentType\PaymentType as Entity; 
use PHPUnit\Framework\TestCase;

class PaymentTypeTest extends TestCase 
{
	/** @dataProvider providerEntityVars */
	public function testGoodCreate(array $aVars) {
		$oEntity = $this->createEntity($aVars);
		$this->assertNotEmpty($oEntity);
	}

	/** @dataProvider providerEntityVars */
	public function testBadProcessingType(array $aVars) {
		$aVars['paymentProcessingType'] = 'UndefinedPaymentProcessingType';

		$this->expectException(
			Exception::class,
			"Bad paymentProcessingType is not throwing exception"
		);
		$this->expectExceptionCode(Exception::PROCESSING_TYPE_IS_NOT_IN_WHITE_LIST);

		$this->createEntity($aVars);
	}

	/** @dataProvider providerEntityVars */
	public function testBadTypeKind(array $aVars) {
		$aVars['paymentTypeKind'] = 'UndefinedPaymentTypeKind';

		$this->expectException(
			Exception::class,
			"Bad paymentTypeKind is not throwing exception"
		);
		$this->expectExceptionCode(Exception::TYPE_KIND_IS_NOT_IN_WHITE_LIST);

		$this->createEntity($aVars);
	}

	function providerEntityVars(): array
	{
		return [
			[
				'aVars' => [
					'id' => '034d363e-3e73-4d83-842d-a7db91e465d7',
					'code' => 'CARDO',
					'name' => 'Картой Курьеру',
					'comment' => '',
					'combinable' => true,
					'externalRevision' => 3301064,
					'applicableMarketingCampaigns' => [],
					'isDeleted' => true,
					'printCheque' => true,
					'paymentProcessingType' => 'Internal',
					'paymentTypeKind' => 'Card',
					'terminalGroups' => [],
				]
			]
		];
	}

	function createEntity(array $aVars): Entity
	{
		extract($aVars);
		$oEntity = new Entity(
			$id,
			$code,
			$name,
			$comment,
			$combinable,
			$externalRevision,
			$applicableMarketingCampaigns,
			$isDeleted,
			$printCheque,
			$paymentProcessingType,
			$paymentTypeKind,
			$terminalGroups
		);
		return $oEntity;
	}
}
