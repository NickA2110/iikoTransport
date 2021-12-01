<?php

namespace IikoTransport\Entity\Order;

class PaymentAdditionalData
{
	const types = [
		'IikoCard' => 'IikoCard',
	];

	const searchScopes = [
		'Reserved' => 'Reserved',
		'Phone' => 'Phone',
		'CardNumber' => 'CardNumber',
		'CardTrack' => 'CardTrack',
		'PaymentToken' => 'PaymentToken',
		'FindFaceId' => 'FindFaceId',
	];

	public $credential;

	public $searchScope;

	public $type = PaymentAdditionalData::types['IikoCard'];

	public function setCredential(string $credential): self
	{
		$this->credential = $this->getValidCredential($credential);
		return $this;
	}

	function getValidCredential(?string $credential): string
	{
		if (empty($credential)) {
			throw new Exception(
				"PaymentAdditionalData credential is not set",
				Exception::PAYMENT_ADDITIONAL_DATA_CREDENTIAL_IS_NOT_SET
			);
		}
		return $credential;
	}

	public function setSearchScope(string $searchScope): self
	{
		$this->searchScope = $this->getValidSearchScope($searchScope);
		return $this;
	}

	function getValidSearchScope(?string $searchScope): string
	{
		if (!isset(static::searchScopes[$searchScope])) {
			throw new Exception(
				"SearchScope '{$searchScope}' is not in white list Order\\PaymentAdditionalData::searchScopes",
				Exception::SEARCH_SCOPE_IS_NOT_IN_WHITE_LIST
			);
		}
		return static::searchScopes[$searchScope];
	}

	public function setType(string $type): self
	{
		$this->type = $this->getValidType($type);
		return $this;
	}

	function getValidType(?string $type): string
	{
		if (!isset(static::types[$type])) {
			throw new Exception(
				"Type '{$type}' is not in white list Order\\PaymentAdditionalData::types",
				Exception::PAYMENT_ADDITIONAL_DATA_TYPE_IS_NOT_IN_WHITE_LIST
			);
		}
		return static::types[$type];
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['credential'] = $this->credential;
		$aData['searchScope'] = $this->searchScope;
		$aData['type'] = $this->type;

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidSearchScope($this->searchScope);
		$this->getValidCredential($this->credential);
		$this->getValidType($this->type);
		return $this;
	}
}