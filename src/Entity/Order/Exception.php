<?php

namespace IikoTransport\Entity\Order;

class Exception extends \IikoTransport\Exception {
	const GENDER_IS_NOT_IN_WHITE_LIST = 1;
	const PAYMENT_TYPE_KIND_IS_NOT_IN_WHITE_LIST = 2;
	const TYPE_IS_NOT_IN_WHITE_LIST = 3;
}