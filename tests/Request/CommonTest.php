<?php 

namespace IikoTransport\Tests\Request;

use PHPUnit\Framework\TestCase;
use IikoTransport\Request\Common as RequestCommon; 
use IikoTransport\Request\Exception as RequestException; 

class CommonTest extends TestCase 
{
	use CommonTrait;

	function getRequest(): RequestCommon {
		$oRequest = new RequestCommon();
		return $oRequest;
	}
}
