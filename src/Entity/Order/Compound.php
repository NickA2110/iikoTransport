<?php

namespace IikoTransport\Entity\Order;

class Compound extends Item
{
	public $primaryComponent;

	public $secondaryComponent;

	public $commonModifiers;

	function __construct()
	{
		$this->type = static::types['compound'];
	}

	public function primaryComponent(CompoundComponent $primaryComponent): self
	{
		$this->primaryComponent = $primaryComponent;
		return $this;
	}

	public function secondaryComponent(?CompoundComponent $secondaryComponent): self
	{
		$this->secondaryComponent = $secondaryComponent;
		return $this;
	}

	public function commonModifiers(?array $commonModifiers): self
	{
		$this->commonModifiers = $commonModifiers;
		return $this;
	}

	public function toArray(): array
	{
		return [];
	}
}