<?php

namespace IikoTransport\Entity\Deliveries;

class OrderInfo
{
	const statuses = [
		'Error' => 'Error',
		'InProgress' => 'InProgress',
		'Success' => 'Success',
	];

	public $id;

	public $organizationId;

	public $timestamp;

	public $creationStatus;

	public $errorInfo;

	public $order;


	function __construct(
		string $id,
		string $organizationId,
		int $timestamp,
		string $creationStatus,
		$errorInfo,
		$order
	) {
		$this->id = $id;
		$this->organizationId = $organizationId;
		$this->timestamp = $timestamp;
		$this->creationStatus = $this->getValidStatus($creationStatus);
		$this->errorInfo = $errorInfo;
		$this->order = $order;
	}

	function getValidStatus(?string $status): string
	{
		if (!in_array($status, static::statuses)) {
			throw new Exception(
				"Status '{$status}' is not in white list OrderInfo::statuses",
				Exception::STATUS_IS_NOT_IN_WHITE_LIST
			);
		}
		return $status;
	}
}