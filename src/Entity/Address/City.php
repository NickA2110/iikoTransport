<?php

namespace IikoTransport\Entity\Address;

class City
{
	public $id;

	public $name;

	public $externalRevision;

	public $isDeleted;

	public $classifierId;

	public $additionalInfo;

	function __construct(
		string $id,
		string $name,
		?int $externalRevision,
		bool $isDeleted,
		?string $classifierId,
		?string $additionalInfo
	) {
		$this->id = $id;
		$this->name = $name;
		$this->externalRevision = $externalRevision;
		$this->isDeleted = $isDeleted;
		$this->classifierId = $classifierId;
		$this->additionalInfo = $additionalInfo;
	}
}