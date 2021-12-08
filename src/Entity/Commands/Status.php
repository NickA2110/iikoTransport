<?php

namespace IikoTransport\Entity\Commands;

class Status
{
	const states = [
		'Error' => 'Error',
		'InProgress' => 'InProgress',
		'Success' => 'Success',
	];

	public $state;

	public $exception;

	function __construct(string $state)
	{
		$this->state = $this->getValidState($state);
	}

	function getValidState(?string $state): string
	{
		if (!in_array($state, static::states)) {
			throw new Exception(
				"State '{$state}' is not in white list Status::states",
				Exception::STATE_IS_NOT_IN_WHITE_LIST
			);
		}
		return $state;
	}

	public function setException(?string $exception): self
	{
		$this->exception = $exception;
		return $this;
	}

	public function stateIsSuccess(): bool
	{
		return ($this->state == static::states['Success']);
	}
}