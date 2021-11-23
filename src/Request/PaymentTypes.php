<?php
namespace IikoTransport\Request;

/**
 *  Get payment types request
 */
class PaymentTypes extends Common
{
	protected $sUri = 'payment_types';

	function __construct(array $aOrganizationIds)
	{
		if (empty($aOrganizationIds)) {
			throw new Exception(
				"Field 'organizationIds' is not be empty",
				Exception::FIELD_ORGANIZATION_IDS_IS_EMPTY
			);
		}
		$this->aData = [
			'organizationIds' => $aOrganizationIds,
		];
	}
}
