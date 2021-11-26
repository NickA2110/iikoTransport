<?php

namespace IikoTransport\Entity\Address;

class OrganizationCities
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