<?php

namespace IikoTransport\Entity\Order\Discount;

class Exception extends \IikoTransport\Entity\Order\Exception {
	const TYPE_OF_DISCOUNT_IS_NOT_IN_WHITE_LIST = 1;
	const DISCOUNT_TYPE_ID_IS_NOT_SET = 2;

	const PROGRAM_ID_IS_NOT_SET = 3;
	const PROGRAM_NAME_IS_NOT_SET = 4;
	const DISCOUNT_ITEMS_IS_NOT_SET = 5;

	const POSITION_ID_IS_NOT_SET = 6;
}