<?php
namespace IikoTransport\Request\Loyalty;

use IikoTransport\Request\Common;

/**
 *  Get customer info request
 */
class GetCustomerInfo extends Common
{
	protected $sUri = 'loyalty/iiko/get_customer';

	const aTypes = [
		'phone',
		'cardTrack',
		'cardNumber',
	];

	function __construct(
		string $sOrganizationId,
		string $sType,
		string $sValue
	) {
		if (!in_array($sType, static::aTypes)) {
			throw new Exception(
				"Error Processing Request",
				1
			);
		}
		$this->aData = [
			'organizationId' => $sOrganizationId,
			'type' => $sType,
			$sType => $sValue,
		];
	}
}
