<?php

namespace IikoTransport\Entity\Order;

class IikoCard5Info
{
	public $coupon;

	public $applicableManualConditions;

	public function setCoupon(string $coupon): self
	{
		$this->coupon = $coupon;
		return $this;
	}

	public function setApplicableManualConditions(array $applicableManualConditions): self
	{
		$this->applicableManualConditions = $applicableManualConditions;
		return $this;
	}

	public function toArray(): array
	{
		$aData = [];

		if (!is_null($this->coupon)) {
			$aData['coupon'] = $this->coupon;
		}
		if (!empty($this->applicableManualConditions)) {
			$aData['applicableManualConditions'] = $this->applicableManualConditions;
		}

		return $aData;
	}
}