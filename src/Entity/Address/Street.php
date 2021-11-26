<?php

namespace IikoTransport\Entity\Address;

class Street
{
	public $id;

	public $name;

	public $externalRevision;

	public $classifierId;

	public $isDeleted;

	function __construct(
		string $id,
		string $name,
		?int $externalRevision,
		?string $classifierId,
		bool $isDeleted
	) {
		$this->id = $id;
		$this->name = $name;
		$this->externalRevision = $externalRevision;
		$this->classifierId = $classifierId;
		$this->isDeleted = $isDeleted;
	}
}