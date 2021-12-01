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
		if (!isset(static::paymentTypeKinds[$paymentTypeKind])) {
			throw new Exception(
				"PaymentTypeKind '{$paymentTypeKind}' is not in white list Order\\Payment::paymentTypeKinds",
				Exception::PAYMENT_TYPE_KIND_IS_NOT_IN_WHITE_LIST
			);
		}
		$this->paymentTypeKind = $paymentTypeKind;
		return $this;
	}

	public function setSum(float $sum): self
	{
		$this->sum = $sum;
		return $this;
	}

	public function setPaymentTypeId(string $paymentTypeId): self
	{
		$this->paymentTypeId = $paymentTypeId;
		return $this;
	}

	public function setIsProcessedExternally(bool $isProcessedExternally): self
	{
		$this->isProcessedExternally = $isProcessedExternally;
		return $this;
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
		if (!in_array($this->paymentTypeKind, static::paymentTypeKinds)) {
			throw new Exception(
				"PaymentTypeKind '{$this->paymentTypeKind}' is not in white list Order\\Payment::paymentTypeKinds",
				Exception::PAYMENT_TYPE_KIND_IS_NOT_IN_WHITE_LIST
			);
		}
		if (is_null($this->sum)) {
			throw new Exception(
				"Payment sum is not set",
				Exception::PAYMENT_SUM_IS_NOT_SET
			);
		}
		if (is_null($this->paymentTypeId)) {
			throw new Exception(
				"Payment type id is not set",
				Exception::PAYMENT_TYPE_ID_IS_NOT_SET
			);
		}
		if (is_null($this->isProcessedExternally)) {
			throw new Exception(
				"Is Externally Processed is not set",
				Exception::IS_PROCESSED_EXTERNALLY_IS_NOT_SET
			);
		}
		
		return $this;
	}
}