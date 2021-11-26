<?php

namespace IikoTransport\Response\Loyalty;

use IikoTransport\Entity\Loyalty\Customer\Card;
use IikoTransport\Entity\Loyalty\Customer\Category;
use IikoTransport\Entity\Loyalty\Customer\Info;
use IikoTransport\Entity\Loyalty\Customer\WalletBalance;
use IikoTransport\Response\Common;
use IikoTransport\Response\IResponse;

class GetCustomerInfo extends Common
{
	var $oCustomerInfo;

	public function parseBody(): IResponse
	{
		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['id'])) {
			$this->oCustomerInfo = $this->getCustomerInfoFromResponseArray(
				$aBody
			);
		}

		return $this;
	}

	function getCustomerInfoFromResponseArray(array $aCustomerInfo): Info
	{
		return new Info(
			$aCustomerInfo['id'],
			$aCustomerInfo['referrerId'],
			$aCustomerInfo['name'],
			$aCustomerInfo['surname'],
			$aCustomerInfo['middleName'],
			$aCustomerInfo['comment'],
			$aCustomerInfo['phone'],
			$aCustomerInfo['cultureName'],
			$aCustomerInfo['birthday'],
			$aCustomerInfo['email'],
			$aCustomerInfo['sex'],
			$aCustomerInfo['consentStatus'],
			$aCustomerInfo['anonymized'],
			$this->getCards($aCustomerInfo['cards']),
			$this->getCategories($aCustomerInfo['categories']),
			$this->getWalletBalances($aCustomerInfo['walletBalances']),
			$aCustomerInfo['userData'],
			$aCustomerInfo['shouldReceivePromoActionsInfo'],
			$aCustomerInfo['shouldReceiveLoyaltyInfo'],
			$aCustomerInfo['shouldReceiveOrderStatusInfo'],
			$aCustomerInfo['personalDataConsentFrom'],
			$aCustomerInfo['personalDataConsentTo'],
			$aCustomerInfo['personalDataProcessingFrom'],
			$aCustomerInfo['personalDataProcessingTo'],
			$aCustomerInfo['isDeleted']
		);
	}

	function getCards(array $aCards): array
	{
		$aResult = [];
		foreach ($aCards as $aCard) {
			$aResult[] = $this->getCard($aCard);
		}
		return $aResult;
	}

	function getCard(array $aCard): Card
	{
		return new Card(
			$aCard['id'],
			$aCard['track'],
			$aCard['number'],
			$aCard['validToDate']
		);
	}

	function getCategories(array $aCategories): array
	{
		$aResult = [];
		foreach ($aCategories as $aCategory) {
			$aResult[] = $this->getCategory($aCategory);
		}
		return $aResult;
	}

	function getCategory(array $aCategory): Category
	{
		return new Category(
			$aCategory['id'],
			$aCategory['name'],
			$aCategory['isActive'],
			$aCategory['isDefaultForNewGuests']
		);
	}

	function getWalletBalances(array $aWalletBalances): array
	{
		$aResult = [];
		foreach ($aWalletBalances as $aWalletBalance) {
			$aResult[] = $this->getWalletBalance($aWalletBalance);
		}
		return $aResult;
	}

	function getWalletBalance(array $aWalletBalance): WalletBalance
	{
		return new WalletBalance(
			$aWalletBalance['id'],
			$aWalletBalance['name'],
			$aWalletBalance['type'],
			$aWalletBalance['balance']
		);
	}

	public function getCustomerInfo(): Info
	{
		if (!is_array($this->oCustomerInfo)) {
			$this->parseBody();
		}
		return $this->oCustomerInfo;
	}
}