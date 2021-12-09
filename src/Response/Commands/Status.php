<?php

namespace IikoTransport\Response\Commands;

use IikoTransport\Entity\Commands\Status as StatusEntity;
use IikoTransport\Entity\Commands\StatusException;
use IikoTransport\Response\Common;
use IikoTransport\Response\IResponse;

class Status extends Common
{
	var $status;

	public function parseBody(): IResponse
	{
		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['state'])) {
			$this->status = $this->getStatusFromResponseArray(
				$aBody
			);
		}

		return $this;
	}

	function getStatusFromResponseArray(array $aStatus): StatusEntity
	{
		$oStatus = new StatusEntity(
			$aStatus['state'],
			$aStatus['exception'] ?? null
		);
		return $oStatus;
	}

	public function getStatus(): StatusEntity
	{
		if (is_null($this->status)) {
			$this->parseBody();
		}
		return $this->status;
	}
}