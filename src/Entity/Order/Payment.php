<?php

namespace IikoTransport\Entity\Order;

class Payment
{
	const paymentTypeKinds = [
		'Cash' => 'Cash',
		'Card' => 'Card',
		'IikoCard' => 'IikoCard',
		'External' => 'External',
	];

	public $paymentTypeKind;

	public $sum;

	public $paymentTypeId;

	public $isProcessedExternally;

	public $number = null;

	public $paymentAdditionalData = null;

	public function setPaymentTypeKind(string $paymentTypeKind): self
	{
		$this->paymentTypeKind = $this->getValidPaymentTypeKind($paymentTypeKind);
		return $this;
	}

	function getValidPaymentTypeKind(?string $paymentTypeKind): string
	{
		if (!isset(static::paymentTypeKinds[$paymentTypeKind])) {
			throw new Exception(
				"PaymentTypeKind '{$paymentTypeKind}' is not in white list Order\\Payment::paymentTypeKinds",
				Exception::PAYMENT_TYPE_KIND_IS_NOT_IN_WHITE_LIST
			);
		}
		return $paymentTypeKind;
	}

	public function setSum(float $sum): self
	{
		$this->sum = $this->getValidSum($sum);
		return $this;
	}

	function getValidSum(?float $sum): float
	{
		if (is_null($sum)) {
			throw new Exception(
				"Payment sum is not set",
				Exception::PAYMENT_SUM_IS_NOT_SET
			);
		}
		return $sum;
	}

	public function setPaymentTypeId(string $paymentTypeId): self
	{
		$this->paymentTypeId = $this->getValidPaymentTypeId($paymentTypeId);
		return $this;
	}

	function getValidPaymentTypeId(?string $paymentTypeId): string
	{
		if (is_null($paymentTypeId)) {
			throw new Exception(
				"Payment type id is not set",
				Exception::PAYMENT_TYPE_ID_IS_NOT_SET
			);
		}
		return $paymentTypeId;
	}

	public function setIsProcessedExternally(bool $isProcessedExternally): self
	{
		$this->isProcessedExternally = $this->getValidIsProcessedExternally($isProcessedExternally);
		return $this;
	}

	function getValidIsProcessedExternally(?bool $isProcessedExternally): bool
	{
		if (is_null($isProcessedExternally)) {
			throw new Exception(
				"Is Externally Processed is not set",
				Exception::IS_PROCESSED_EXTERNALLY_IS_NOT_SET
			);
		}
		return $isProcessedExternally;
	}

	public function setNumber(?string $number): self
	{
		$this->number = $number;
		return $this;
	}

	public function setPaymentAdditionalData(?PaymentAdditionalData $paymentAdditionalData): self
	{
		$this->paymentAdditionalData = $paymentAdditionalData;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];
		
		$aData['paymentTypeKind'] = $this->paymentTypeKind;
		$aData['sum'] = $this->sum;
		$aData['paymentTypeId'] = $this->paymentTypeId;
		$aData['isProcessedExternally'] = $this->isProcessedExternally;
		
		if (!empty($this->paymentAdditionalData)) {
			$aData['paymentAdditionalData'] = $this->paymentAdditionalData->toArray();
		}

		return $aData;
	}

	function checkFields(): self
	{
		$this->getValidPaymentTypeKind($this->paymentTypeKind);
		$this->getValidSum($this->sum);
		$this->getValidPaymentTypeId($this->paymentTypeId);
		$this->getValidIsProcessedExternally($this->isProcessedExternally);
		return $this;
	}
}