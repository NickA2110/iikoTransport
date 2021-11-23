<?php

namespace IikoTransport\Response;

use IikoTransport\Entity\TerminalGroup\TerminalGroup as TerminalGroupEntity;

trait TerminalGroupTrait
{
	function getTerminalGroup(array $aTerminalGroup): TerminalGroupEntity
	{
		return new TerminalGroupEntity(
			$aTerminalGroup['id'],
			$aTerminalGroup['organizationId'],
			$aTerminalGroup['name'],
		);
	}
}