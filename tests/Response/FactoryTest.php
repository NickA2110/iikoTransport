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
