<?php

namespace IikoTransport\Entity\TerminalGroup;

class TerminalGroups implements TerminalGroupsInterface
{
	public $organizationId;

	public $items;

	function __construct(
		string $organizationId,
		array $items
	) {
		$this->organizationId = $organizationId;
		$this->items = $items;
	}
}