<?php

namespace IikoTransport\Entity\TerminalGroup;

class IsAliveStatus
{
	public $isAlive;

	public $terminalGroupId;

	public $organizationId;

	function __construct(
		bool $isAlive,
		string $terminalGroupId,
		string $organizationId
	) {
		$this->isAlive = $isAlive;
		$this->terminalGroupId = $terminalGroupId;
		$this->organizationId = $organizationId;
	}
}