<?php

namespace IikoTransport\Entity\TerminalGroup;

class TerminalGroup
{
	public $id;

	public $organizationId;

	public $name;

	function __construct(
		string $id,
		string $organizationId,
		string $name
	) {
		$this->id = $id;
		$this->organizationId = $organizationId;
		$this->name = $name;
	}
}