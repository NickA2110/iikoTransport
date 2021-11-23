<?php 

namespace IikoTransport\Tests\Response;

use IikoTransport\Entity\Organization\OrganizationInterface;
use IikoTransport\Entity\Organization\Exception as OrganizationException;
use IikoTransport\Response\Organizations as OrganizationsResponse; 
use PHPUnit\Framework\TestCase;

class OrganizationsTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse) {
		
		$oOrganizationsResponse = new OrganizationsResponse(
			$aResponse
		);
		
		$aOrganizations = $oOrganizationsResponse->getOrganizations();
		$this->assertNotEmpty($aOrganizations);

		$oOrganization = reset($aOrganizations);
		$this->assertTrue(
			is_subclass_of($oOrganization, OrganizationInterface::class),
			"The OrganizationsResponse return instance of not OrganizationInterface"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
		$aResult['aResponseWithSimpleOrganizations'] = [
			'aResponse' => [
				'organizations' => 
json_decode('[
    {
      "responseType": "Simple",
      "id": "01234567-89ab-cdef-0123-456789abcdef",
      "name": "Simple-Organization"
    }
  ]', true),
			],
		];
		$aResult['aResponseWithExtendedOrganizations'] = [
			'aResponse' => [
				'organizations' => 
json_decode('[
    {
      "responseType": "Extended",
      "country": "Россия",
      "restaurantAddress": "Московская обл., Москва, ул Дзержинского д 2",
      "latitude": 49.579211,
      "longitude": 133.8037431,
      "useUaeAddressingSystem": false,
      "version": "7.2.8006.0.1111111111111",
      "currencyIsoName": "RUB",
      "currencyMinimumDenomination": 0.0,
      "countryPhoneCode": "7",
      "marketingSourceRequiredInDelivery": false,
      "defaultDeliveryCityId": "11111111-2222-3333-4444-555555555555",
      "deliveryCityIds": null,
      "deliveryServiceType": "CourierAndSelfService",
      "defaultCallCenterPaymentTypeId": "09322f46-1234-1234-1234-123456789012",
      "orderItemCommentEnabled": false,
      "inn": "1234567890",
      "id": "01234567-89ab-cdef-0123-456789abcdef",
      "name": "Simple-Organization"
    }
  ]', true),
			]
		];
		return $aResult;
	}

	public function testFailTypeResponse() {
		$aResponse = [
			'organizations' => [
				[
					'responseType' => 'UndefinedDefinedType',
					'id' => '01234567-89ab-cdef-0123-456789abcdef',
					'name' => 'Simple-Organization',
				]
			],
		];

		$this->expectException(
			OrganizationException::class,
			"Undefined organization type is not throwing exception"
		);
		$this->expectExceptionCode(OrganizationException::ORGANIZATION_TYPE_IS_NOT_DEFINED);
		
		$oOrganizationsResponse = new OrganizationsResponse(
			$aResponse
		);
		
	}

}
