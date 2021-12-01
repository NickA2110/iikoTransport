<?php

namespace IikoTransport\Entity\Order;

trait ObjectsToNestedArrayTrait
{
	function arrayObjectsToNestedArray(array $items): array
	{
		$aItems = [];
		foreach ($items as $item) {
			$aItems[] = $item->toArray();
		}
		return $aItems;
	}
}