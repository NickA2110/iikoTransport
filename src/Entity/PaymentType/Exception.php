<?php

namespace IikoTransport\Entity\PaymentType;

class Exception extends \IikoTransport\Exception
{
	const PROCESSING_TYPE_IS_NOT_IN_WHITE_LIST = 1;
	const TYPE_KIND_IS_NOT_IN_WHITE_LIST = 2;
}