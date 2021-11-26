<?php

namespace IikoTransport\Entity\Loyalty\Customer;

class Exception extends \IikoTransport\Exception
{
	const INDEX_OF_GENDER_IS_NOT_IN_WHITE_LIST = 1;
	const INDEX_OF_CONSENT_STATUS_IS_NOT_IN_WHITE_LIST = 2;
	const INDEX_OF_BALANCE_TYPES_IS_NOT_IN_WHITE_LIST = 3;
}