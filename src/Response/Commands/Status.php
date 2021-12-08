<?php

namespace IikoTransport\Response\Commands;

use IikoTransport\Entity\Commands\Status as StatusEntity;
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
			$aStatus['state']
		);
		if (isset($aStatus['exception'])) {
			$oStatus->setException($aStatus['exception']);
		}
		return $oStatus;
	}

	public function getStatus(): StatusEntity
	{
		if (!is_array($this->status)) {
			$this->parseBody();
		}
		return $this->status;
	}
}