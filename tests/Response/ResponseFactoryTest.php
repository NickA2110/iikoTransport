<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Common as CommonResponse;
use IikoTransport\Response\Factory as ResponseFactory; 
use PHPUnit\Framework\TestCase;

class ResponseFactoryTest extends TestCase 
{
	/** @dataProvider responseProvider */
	public function testFactory(CommonResponse $oResponse, string $sNeedleResponseClass)
	{
		$oResponseResult = ResponseFactory::getTypedResponse($oResponse);
		
		$sResponseClass = get_class($oResponseResult);
		
		$this->assertEquals(
			$sNeedleResponseClass,
			$sResponseClass,
			"Response class '{$sResponseClass}' needle '{$sNeedleResponseClass}'"
		);
	}

	public function responseProvider(): array
	{
		return [
			'CommonResponse' => [
				'oResponse' => new CommonResponse(
					new CommonRequest(),
					$nHttpStatus = 200,
					$aHeaders = [],
					$sBody = '[]'
				),
				'sNeedleResponseClass' => CommonResponse::class,
			],
		];
	}
}
