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
		$this->credential = $credential;
		return $this;
	}

	public function setSearchScope(string $searchScope): self
	{
		if (!isset(static::searchScopes[$searchScope])) {
			throw new Exception(
				"SearchScope '{$searchScope}' is not in white list Order\\PaymentAdditionalData::searchScopes",
				Exception::SEARCH_SCOPE_IS_NOT_IN_WHITE_LIST
			);
		}
		$this->searchScope = $searchScope;
		return $this;
	}

	public function setType(string $type): self
	{
		if (!isset(static::types[$type])) {
			throw new Exception(
				"Type '{$type}' is not in white list Order\\PaymentAdditionalData::types",
				Exception::PAYMENT_ADDITIONAL_DATA_TYPE_IS_NOT_IN_WHITE_LIST
			);
		}
		$this->type = $type;
		return $this;
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
		if (!isset(static::searchScopes[$this->searchScope])) {
			throw new Exception(
				"SearchScope '{$this->searchScope}' is not in white list Order\\PaymentAdditionalData::searchScopes",
				Exception::SEARCH_SCOPE_IS_NOT_IN_WHITE_LIST
			);
		}
		if (is_null($this->credential)) {
			throw new Exception(
				"PaymentAdditionalData credential is not set",
				Exception::PAYMENT_ADDITIONAL_DATA_CREDENTIAL_IS_NOT_SET
			);
		}
		return $this;
	}
}