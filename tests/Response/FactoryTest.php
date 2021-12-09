<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport;
use IikoTransport\Response\Common as CommonResponse;
use IikoTransport\Response\Factory as ResponseFactory;
use IikoTransport\Response\IResponse;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase 
{
	/** @dataProvider responseProvider */
	public function testFactory(IResponse $oResponse, string $sNeedleResponseClass)
	{
		$oResultResponse = ResponseFactory::getTypedResponse($oResponse);
		
		$sResponseClass = get_class($oResultResponse);
		$this->assertEquals(
			$sNeedleResponseClass,
			$sResponseClass,
			"Response\Factory return '{$sResponseClass}' needle '{$sNeedleResponseClass}'"
		);
	}

	public function responseProvider()
	{
		return [
			'Common' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Common::class),
				'sClass' => IikoTransport\Response\Common::class,
			],
			'Organizations' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Organizations::class),
				'sClass' => IikoTransport\Response\Organizations::class,
			],
			'Nomenclature' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Nomenclature::class),
				'sClass' => IikoTransport\Response\Nomenclature::class,
			],
			'PaymentTypes' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\PaymentTypes::class),
				'sClass' => IikoTransport\Response\PaymentTypes::class,
			],
			'TerminalGroups' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\TerminalGroups::class),
				'sClass' => IikoTransport\Response\TerminalGroups::class,
			],
			'Combo.GetCombosInfo' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Combo\GetCombosInfo::class),
				'sClass' => IikoTransport\Response\Combo\GetCombosInfo::class,
			],
			'TerminalGroups.IsAlive' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\TerminalGroups\IsAlive::class),
				'sClass' => IikoTransport\Response\TerminalGroups\IsAlive::class,
			],
			'Regions' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Regions::class),
				'sClass' => IikoTransport\Response\Regions::class,
			],
			'Cities' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Cities::class),
				'sClass' => IikoTransport\Response\Cities::class,
			],
			'StreetsByCity' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\StreetsByCity::class),
				'sClass' => IikoTransport\Response\StreetsByCity::class,
			],
			'Loyalty.GetCustomerInfo' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Loyalty\GetCustomerInfo::class),
				'sClass' => IikoTransport\Response\Loyalty\GetCustomerInfo::class,
			],
			'Commands.Status' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Commands\Status::class),
				'sClass' => IikoTransport\Response\Commands\Status::class,
			],
			'Deliveries.Create' => [
				'oResponse' => $this->getResponse(IikoTransport\Request\Deliveries\Create::class),
				'sClass' => IikoTransport\Response\Deliveries\Create::class,
			],
		];
	}

	function getResponse(string $sRequestClass): IResponse
	{
		$oResponse = new CommonResponse(
			$oRequest = $this->createMock($sRequestClass),
			$nHttpStatus = 200,
			$aHeaders = [],
			json_encode('[]')
		);
		return $oResponse;
	}
}
