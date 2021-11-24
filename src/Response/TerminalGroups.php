<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\TerminalGroup\TerminalGroups as TerminalGroupsEntity;

class TerminalGroups extends Common
{
	var $aTerminalGroups;

	public function parseBody(): IResponse
	{
		$this->aTerminalGroups = [];

		$aBody = $this->getBodyAsArray();

		if (!empty($aBody['terminalGroups'])) {
			$this->aTerminalGroups = $this->getTerminalGroupsFromResponseArray(
				$aBody['terminalGroups']
			);
		}

		return $this;
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

	use TerminalGroupTrait;

	public function getTerminalGroups(): array
	{
		if (!is_array($this->aTerminalGroups)) {
			$this->parseBody();
		}
		return $this->aTerminalGroups;
	}
}