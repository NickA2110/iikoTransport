<?php 

namespace IikoTransport\Tests\SimpleRequest\Loyalty;

use IikoTransport\Request\Loyalty\GetCustomerInfo as Request;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Tests\ApiKey;
use IikoTransport\Tests\SimpleRequest\SimpleTrait;
use PHPUnit\Framework\TestCase;

class GetCustomerInfoTest extends TestCase
{
	use SimpleTrait;

	function getRequest(): CommonRequest
	{
		$oRequest = new Request(
			$sOrganizationId = ApiKey::getOrganizationId(),
			$sType = 'phone',
			$sValue = ApiKey::getCustomerPhone(),
		);
		return $oRequest;
	}

	function checkResponse(array $aBody, string $sBody)
	{
		$aNeedleKeys = [
			'id',
			'referrerId',
			'name',
			'surname',
			'middleName',
			'comment',
			'phone',
			'cultureName',
			'birthday',
			'email',
			'sex',
			'consentStatus',
			'anonymized',
			'cards',
			'categories',
			'walletBalances',
			'userData',
			'shouldReceivePromoActionsInfo',
			'shouldReceiveLoyaltyInfo',
			'shouldReceiveOrderStatusInfo',
			'personalDataConsentFrom',
			'personalDataConsentTo',
			'personalDataProcessingFrom',
			'personalDataProcessingTo',
			'isDeleted',
		];
		$aBodyKeys = array_keys($aBody);
		$this->assertEquals(
			$aNeedleKeys,
			$aBodyKeys,
			"Response of 'Loyalty\\GetCustomerInfo' not containts needle keys"
		);
	}
}
