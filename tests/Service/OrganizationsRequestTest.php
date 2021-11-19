<?php 

namespace IikoTransport\Tests\Service;

use IikoTransport\Request\Organizations as OrganizationsRequest;
use IikoTransport\Service\Client;
use IikoTransport\Tests\ApiKey;
use PHPUnit\Framework\TestCase;

class OrganizationsRequestTest extends TestCase
{
	public function testGoodResponse() {
		$oClient = new Client(ApiKey::getApiKey());
		$oRequest = new OrganizationsRequest();
		
		$oResponse = $oClient->requestOnlyCommonResponse($oRequest);

		$aBody = $oResponse->getBodyAsArray();

		$this->assertNotEmpty($aBody['organizations']);
	}
}
