<?php

namespace IikoTransport\Entity\Order;

class Customer
{
	const genders = [
		'NotSpecified' => 'NotSpecified',
		'Male' => 'Male',
		'Female' => 'Female',
	];

	public $id = null;

	public $name = null;

	public $surname = null;

	public $comment = null;

	public $birthdate = null;

	public $email = null;

	public $shouldReceivePromoActionsInfo = false;

	public $gender = Customer::genders['NotSpecified'];

	public function setId(?string $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function setName(?string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function setSurname(?string $surname): self
	{
		$this->surname = $surname;
		return $this;
	}

	public function setComment(?string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	public function setBirthdate(?string $birthdate): self
	{
		$this->birthdate = $birthdate;
		return $this;
	}

	public function setEmail(?string $email): self
	{
		$this->email = $email;
		return $this;
	}

	public function setShouldReceivePromoActionsInfo(bool $shouldReceivePromoActionsInfo): self
	{
		$this->shouldReceivePromoActionsInfo = $shouldReceivePromoActionsInfo;
		return $this;
	}

	public function setGender(string $gender): self
	{
		$this->gender = $this->getValidGender($gender);
		return $this;
	}

	function getValidGender(string $gender): string
	{
		if (!isset(static::genders[$gender])) {
			throw new Exception(
				"Gender '{$gender}' is not in white list Order\\Customer::genders",
				Exception::GENDER_IS_NOT_IN_WHITE_LIST
			);
		}
		return static::genders[$gender];
	}

	public function toArray(): array
	{
		$aData = [];

		if (!is_null($this->id)) {
			$aData['id'] = $this->id;
		}
		if (!is_null($this->name)) {
			$aData['name'] = $this->name;
		}
		if (!is_null($this->surname)) {
			$aData['surname'] = $this->surname;
		}
		if (!is_null($this->comment)) {
			$aData['comment'] = $this->comment;
		}
		if (!is_null($this->birthdate)) {
			$aData['birthdate'] = $this->birthdate;
		}
		if (!is_null($this->email)) {
			$aData['email'] = $this->email;
		}
		$aData['shouldReceivePromoActionsInfo'] = $this->shouldReceivePromoActionsInfo;
		$aData['gender'] = $this->gender;
		return $aData;
	}
}