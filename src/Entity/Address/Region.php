<?php

namespace IikoTransport\Entity\Address;

class Region
{
	public $id;

	public $name;

	public $externalRevision;

	public $isDeleted;

	function __construct(
		string $id,
		string $name,
		?int $externalRevision,
		bool $isDeleted
	) {
		$this->id = $id;
		$this->name = $name;
		$this->externalRevision = $externalRevision;
		$this->isDeleted = $isDeleted;
	}
}