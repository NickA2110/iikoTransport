<?php

namespace IikoTransport\Entity\Organization;

class OrganizationSimple implements OrganizationInterface
{
	public $id;

	public $name;

	function __construct(
		string $id,
		string $name
	) {
		$this->id = $id;
		$this->name = $name;
	}
}