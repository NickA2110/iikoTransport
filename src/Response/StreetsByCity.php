<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\Address\Street;

class StreetsByCity extends Common
{
	var $aStreets;

	public function parseBody(): IResponse
	{
		$this->aStreets = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['streets'])) {
			$this->aStreets = $this->getStreetsFromResponseArray(
				$aBody['streets']
			);
		}

		return $this;
	}

	function getStreetsFromResponseArray(array $aStreets): array
	{
		$aResult = [];
		foreach ($aStreets as $aStreet) {
			$aResult[] = $this->getStreet(
				$aStreet
			);
		}
		return $aResult;
	}

	function getStreet(array $aStreet): Street
	{
		return new Street(
			$aStreet['id'],
			$aStreet['name'],
			$aStreet['externalRevision'],
			$aStreet['classifierId'],
			$aStreet['isDeleted']
		);
	}

	public function getStreets(): array
	{
		if (!is_array($this->aStreets)) {
			$this->parseBody();
		}
		return $this->aStreets;
	}
}