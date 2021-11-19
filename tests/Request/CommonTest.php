<?php 

namespace IikoTransport\Tests\Request;

use IikoTransport\Request\Common as Request; 
use PHPUnit\Framework\TestCase;

class CommonTest extends TestCase 
{
	use CommonTrait;

	function getRequest(): Request {
		$oRequest = new Request();
		return $oRequest;
	}
}
