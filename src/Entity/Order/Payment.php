<?php

namespace IikoTransport\Entity\Order;

class Payment
{
	const paymentTypeKinds = [
		'cash' => 'cash',
		'card' => 'card',
		'iikoCard' => 'iikoCard',
		'external' => 'external',
	];

	public $paymentTypeKind;

	public $sum;

	public $paymentTypeId;

	public $isProcessedExternally;

	public $number = null;

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
}