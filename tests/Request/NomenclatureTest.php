<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\Nomenclature as Request; 
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class NomenclatureTest extends TestCase 
{
	use CommonTrait;

	public function testUri() {
		$oRequest = $this->getRequest();
		$this->assertEquals(
			$sUri = 'nomenclature',
			$sUriResult = $oRequest->getUri(),
			"Request url '{$sUriResult}' is not equals '{$sUri}'"
		);
	}

	function getRequest(): Request {
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getApiKey()
		);
		return $oRequest;
	}

	public function testSetRevision() {
		$oRequest = $this->getRequest();
		$oRequest->setStartRevision($nStartRevision = 11111);
		
		$nStartRevisionResult = $oRequest->getStartRevision();

		$this->assertEquals(
			$nStartRevision,
			$nStartRevisionResult,
			"Return of 'getStartRevision' '{$nStartRevisionResult}' is not equals set value '{$nStartRevision}'"
		);
	}

}
