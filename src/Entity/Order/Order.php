<?php

namespace IikoTransport\Entity\Order;

use IikoTransport\Service\PhoneConverter;

class Order implements IOrder
{
	use ObjectsToNestedArrayTrait;

	const orderServiceTypes = [
		'DeliveryByClient' => 'DeliveryByClient',
		'DeliveryByCourier' => 'DeliveryByCourier',
	];

	public $id;

	public $completeBefore;

	public $phone;

	public $orderTypeId;

	public $orderServiceType;

	public $deliveryPoint;

	public $comment;

	public $guests;

	public $marketingSourceId;

	public $operatorId;

	public $sourceKey;

	public $customer;

	public $items = [];

	public $combos = [];

	public $payments = [];

	public $tips = [];

	public $discountsInfo;

	public $iikoCard5Info;

	function __construct()
	{
		$this->customer = new Customer();
	}

	public function setId(?string $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function setCompleteBefore(?string $completeBefore): self
	{
		$this->completeBefore = $completeBefore;
		return $this;
	}

	public function setPhone(string $phone): self
	{
		$this->phone = $this->getValidPhone($phone);
		return $this;
	}

	function getValidPhone(?string $phone): string
	{
		if (empty($phone)) {
			throw new Exception(
				"Phone is not set",
				Exception::PHONE_IS_NOT_SET
			);
		}
		
		$phone = PhoneConverter::getFixedPhone($phone);

		if (!preg_match("#^\\+\\d{11}$#ui", $phone)) {
			$format = '+\\d{11}';
			throw new Exception(
				"Invalid phone format of '{$phone}' needle '{$format}'",
				Exception::PHONE_IS_INVALID
			);
		}
		return $phone;
	}

	public function setOrderTypeId(?string $orderTypeId): self
	{
		$this->orderTypeId = $orderTypeId;
		return $this;
	}

	public function setOrderServiceType(string $orderServiceType): self
	{
		
		$this->orderServiceType = $this->getValidOrderServiceType($orderServiceType);
		return $this;
	}

	function getValidOrderServiceType(?string $orderServiceType): string
	{
		if (!isset(static::orderServiceTypes[$orderServiceType])) {
			throw new Exception(
				"OrderServiceType '{$orderServiceType}' is not in white list Order\\Order::orderServiceTypes",
				Exception::ORDER_SERVICE_TYPE_IS_NOT_IN_WHITE_LIST
			);
		}
		return static::orderServiceTypes[$orderServiceType];
	}

	public function setDeliveryPoint(?DeliveryPoint $deliveryPoint): self
	{
		$this->deliveryPoint = $deliveryPoint;
		return $this;
	}

	public function setComment(?string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	public function setGuests(?Guests $guests): self
	{
		$this->guests = $guests;
		return $this;
	}

	public function setMarketingSourceId(?string $marketingSourceId): self
	{
		$this->marketingSourceId = $marketingSourceId;
		return $this;
	}

	public function setOperatorId(?string $operatorId): self
	{
		$this->operatorId = $operatorId;
		return $this;
	}

	public function setCustomer(Customer $customer): self
	{
		$this->customer = $customer;
		return $this;
	}

	public function setItems(array $items): self
	{
		$this->items = $this->getValidItems($items);
		return $this;
	}

	function getValidItems(array $items): array
	{
		if (empty($items)) {
			throw new Exception(
				"Items is not set",
				Exception::ITEMS_IS_NOT_SET
			);
		}
		return $items;
	}

	public function setCombos(array $combos): self
	{
		$this->combos = $combos;
		return $this;
	}

	public function setPayments(array $payments): self
	{
		$this->payments = $payments;
		return $this;
	}

	public function setTips(array $tips): self
	{
		$this->tips = $tips;
		return $this;
	}

	public function setSourceKey(string $sourceKey): self
	{
		$this->sourceKey = $sourceKey;
		return $this;
	}

	public function setDiscountsInfo(?DiscountsInfo $discountsInfo): self
	{
		$this->discountsInfo = $discountsInfo;
		return $this;
	}

	public function setIikoCard5Info(?IikoCard5Info $iikoCard5Info): self
	{
		$this->iikoCard5Info = $iikoCard5Info;
		return $this;
	}

	public function toArray(): array
	{
		$this->checkFields();

		$aData = [];

		if (!is_null($this->id)) {
			$aData['id'] = $this->id;
		}
		if (!is_null($this->completeBefore)) {
			$aData['completeBefore'] = $this->completeBefore;
		}

		$aData['phone'] = $this->phone;

		if (!is_null($this->orderTypeId)) {
			$aData['orderTypeId'] = $this->orderTypeId;
		} else {
			$aData['orderServiceType'] = $this->orderServiceType;
		}

		if (!is_null($this->deliveryPoint)
			&& !is_null($this->orderServiceType)
			&& ($this->orderServiceType == static::orderServiceTypes['DeliveryByCourier'])
		) {
			$aData['deliveryPoint'] = $this->deliveryPoint->toArray();
		}
		if (!is_null($this->comment)) {
			$aData['comment'] = $this->comment;
		}
		
		$aData['customer'] = $this->customer->toArray();

		if (!is_null($this->guests)) {
			$aData['guests'] = $this->guests->toArray();
		}
		if (!is_null($this->marketingSourceId)) {
			$aData['marketingSourceId'] = $this->marketingSourceId;
		}
		if (!is_null($this->operatorId)) {
			$aData['operatorId'] = $this->operatorId;
		}

		$aData['items'] = $this->arrayObjectsToNestedArray($this->items);
		
		if (!empty($this->combos)) {
			$aData['combos'] = $this->arrayObjectsToNestedArray($this->combos);
		}
		if (!empty($this->payments)) {
			$aData['payments'] = $this->arrayObjectsToNestedArray($this->payments);
		}
		if (!empty($this->tips)) {
			$aData['tips'] = $this->arrayObjectsToNestedArray($this->tips);
		}
		if (!is_null($this->sourceKey)) {
			$aData['sourceKey'] = $this->sourceKey;
		}
		if (!is_null($this->discountsInfo)) {
			$aData['discountsInfo'] = $this->discountsInfo->toArray();
		}
		if (!is_null($this->iikoCard5Info)) {
			$aData['iikoCard5Info'] = $this->iikoCard5Info->toArray();
		}

		return $aData;
	}

	function checkFields(): self
	{
		if (empty($this->orderTypeId) && empty($this->orderServiceType)) {
			throw new Exception(
				"One of field OrderTypeId or orderServiceType required",
				Exception::ONE_OF_FIELD_ORDERTYPEID_OR_ORDERSERVICETYPE_REQUIRED
			);
		}
		$this->getValidOrderServiceType($this->orderServiceType);
		$this->getValidPhone($this->phone);
		$this->getValidItems($this->items);
		return $this;
	}
}