<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\TerminalGroup\TerminalGroup as TerminalGroupEntity;
use IikoTransport\Entity\TerminalGroup\TerminalGroups as TerminalGroupsEntity;

class TerminalGroups
{
	var $aTerminalGroups = [];

	function __construct(array $aResponseBody)
	{
		if (!empty($aResponseBody['terminalGroups'])) {
			$this->aTerminalGroups = $this->getTerminalGroupsFromResponseArray(
				$aResponseBody['terminalGroups']
			);
		}
	}

	function getTerminalGroupsFromResponseArray(array $aTerminalGroups): array
	{
		$aResult = [];
		foreach ($aTerminalGroups as $aTerminalGroupsOfOrganization) {
			$aResult[] = $this->getTerminalGroupsOfOrganization(
				$aTerminalGroupsOfOrganization
			);
		}
		return $aResult;
	}

	function getTerminalGroupsOfOrganization(array $aTerminalGroups): TerminalGroupsEntity
	{
		$aTerminalItems = [];
		foreach ($aTerminalGroups['items'] as $aTerminalGroupItem) {
			$aTerminalItems[] = $this->getTerminalGroup(
				$aTerminalGroupItem
			);
		}
		return new TerminalGroupsEntity(
			$aTerminalGroups['organizationId'],
			$aTerminalItems
		);
	}

	function getTerminalGroup(array $aTerminalGroup): TerminalGroupEntity
	{
		return new TerminalGroupEntity(
			$aTerminalGroup['id'],
			$aTerminalGroup['organizationId'],
			$aTerminalGroup['name'],
		);
	}

	public function getTerminalGroups(): array
	{
		return $this->aTerminalGroups;
	}
}