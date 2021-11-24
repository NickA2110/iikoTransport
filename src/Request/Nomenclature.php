<?php
namespace IikoTransport\Request;

/**
 *  Get nomenclature request
 */
class Nomenclature extends Common
{
	protected $sUri = 'nomenclature';

	function __construct(string $sOrganizationId)
	{
		if (empty($sOrganizationId)) {
			throw new Exception(
				"Field 'organizationId' is not be empty",
				Exception::FIELD_ORGANIZATION_ID_IS_EMPTY
			);
		}
		$this->aData = [
			'organizationId' => $sOrganizationId,
			'startRevision' => 0,
		];
	}

	public function setStartRevision(int $nStartRevision): self
	{
		$this->aData['startRevision'] = $nStartRevision;
		return $this;
	}

	public function getStartRevision(): int
	{
		return $this->aData['startRevision'];
	}
}
