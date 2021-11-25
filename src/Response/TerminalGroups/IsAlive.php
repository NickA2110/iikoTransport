<?php

namespace IikoTransport\Response\TerminalGroups;

use IikoTransport\Entity\TerminalGroup\IsAliveStatus;
use IikoTransport\Response\Common;
use IikoTransport\Response\IResponse;

class IsAlive extends Common
{
	var $aIsAliveStatuses;

	public function parseBody(): IResponse
	{
		$this->aIsAliveStatuses = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['isAliveStatus'])) {
			$this->aIsAliveStatuses = $this->getIsAliveStatusesFromResponseArray(
				$aBody['isAliveStatus']
			);
		}

		return $this;
	}

	function getIsAliveStatusesFromResponseArray(array $aIsAliveStatuses): array
	{
		$aResult = [];
		foreach ($aIsAliveStatuses as $aIsAliveStatus) {
			$aResult[] = $this->getIsAliveStatus($aIsAliveStatus);
		}
		return $aResult;
	}

	function getIsAliveStatus(array $aIsAliveStatus): IsAliveStatus
	{
		return new IsAliveStatus(
			$aIsAliveStatus['isAlive'],
			$aIsAliveStatus['terminalGroupId'],
			$aIsAliveStatus['organizationId']
		);
	}

	public function getIsAliveStatuses(): array
	{
		if (!is_array($this->aIsAliveStatuses)) {
			$this->parseBody();
		}
		return $this->aIsAliveStatuses;
	}
}