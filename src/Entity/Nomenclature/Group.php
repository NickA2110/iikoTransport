<?php

namespace IikoTransport\Entity\Nomenclature;

class Group
{
	public $id;

	public $code;

	public $name;

	public $imageLinks;

	public $parentGroup;

	public $order;

	public $isIncludedInMenu;

	public $isGroupModifier;

	public $description;

	public $additionalInfo;

	public $tags;

	public $isDeleted;

	public $seoDescription;

	public $seoText;

	public $seoKeywords;

	public $seoTitle;


	function __construct(
		string $id,
		?string $code,
		string $name,
		array $imageLinks,
		?string $parentGroup,
		int $order,
		bool $isIncludedInMenu,
		bool $isGroupModifier,
		?string $description,
		?string $additionalInfo,
		array $tags,
		bool $isDeleted,
		?string $seoDescription,
		?string $seoText,
		?string $seoKeywords,
		?string $seoTitle
	) {

		$this->id = $id;
		$this->code = $code;
		$this->name = $name;
		$this->imageLinks = $imageLinks;
		$this->parentGroup = $parentGroup;
		$this->order = $order;
		$this->isIncludedInMenu = $isIncludedInMenu;
		$this->isGroupModifier = $isGroupModifier;
		$this->description = $description;
		$this->additionalInfo = $additionalInfo;
		$this->tags = $tags;
		$this->isDeleted = $isDeleted;
		$this->seoDescription = $seoDescription;
		$this->seoText = $seoText;
		$this->seoKeywords = $seoKeywords;
		$this->seoTitle = $seoTitle;
	}
}