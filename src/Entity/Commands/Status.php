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

	function __construct(
		string $state,
		$exception
	) {
		$this->state = $this->getValidState($state);
		$this->exception = $exception;
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

	public function stateIsSuccess(): bool
	{
		return ($this->state == static::states['Success']);
	}
	
	public function stateIsError(): bool
	{
		return ($this->state == static::states['Error']);
	}

	public function getException()
	{
		return $this->exception;
	}
}