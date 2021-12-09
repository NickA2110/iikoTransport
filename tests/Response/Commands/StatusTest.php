<?php 

namespace IikoTransport\Tests\Response\Commands;

use IikoTransport\Entity\Commands\Status;
use IikoTransport\Request\Common as CommonRequest;
use IikoTransport\Response\Commands\Status as Response;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase 
{

	/** @dataProvider providerCreateResponse */
	public function testCreateResponse($aResponse)
  {	
		$oResponse = $this->getResponseByArray($aResponse);
		
		$this->checkStatus($oResponse);
	}

  function getResponseByArray(array $aResponse): Response
  {
    $oResponse = new Response(
      $oRequest = $this->createMock(CommonRequest::class),
      $nHttpStatus = 200,
      $aHeaders = [],
      json_encode($aResponse)
    );
    return $oResponse->parseBody();
  }

	function checkStatus(Response $oResponse) {
		$oStatus = $oResponse->getStatus();
		$this->assertEquals(
			Status::class,
			get_class($oStatus),
			"The GetCombosInfo Response return instance of not ComboSpecification"
		);
	}

	public function providerCreateResponse() {
		$aResult = [];
    $aResult['aResponseWithSuccessStatus'] = [
      'aResponse' => $this->getSuccessStatus(),
    ];
    $aResult['aResponseWithInProgressStatus'] = [
      'aResponse' => $this->getInProgressStatus(),
    ];
    $aResult['aResponseWithErrorStatus'] = [
      'aResponse' => $this->getErrorStatus(),
    ];
		return $aResult;
	}

	function getSuccessStatus(): array
	{
		return json_decode('
    {
      "state": "Success"
    }
    ', true);
	}

  function getInProgressStatus(): array
  {
    return json_decode('
    {
      "state": "InProgress"
    }
    ', true);
  }

  function getErrorStatus(): array
  {
    return json_decode('{
  "state": "Error",
  "exception": {
    "orderId": "5c3899b4-df1e-4b72-834a-b3f76e667959",
    "terminalGroup": {
      "id": "01234567-0123-0123-0123-0123456789ad",
      "name": "Some Point"
    },
    "timestamp": 1639031980076,
    "code": 500,
    "message": "Resto.Front.Api.Exceptions.ConstraintViolationException: Cannot create self-service delivery with address.\r\n\r\nServer stack trace: \r\n   в Resto.Front.Api.V7.Editors.Actions.CreateDeliveryOrder.Check(Nullable`1 number, DateTime creationTime, String phone, AddressDto address, Nullable`1 duration, DateTime expectedDeliverTime, IOrderType type, ICustomerBuilder client, IUser deliveryOperator, SessionContext context) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Api\\\\Resto.Front.Api\\\\V7\\\\Editors\\\\Actions\\\\CreateDeliveryOrder.cs:строка 68\r\n   в Resto.Front.Api.V7.Editors.Actions.CreateDeliveryOrderWithPredefinedId.CheckArguments(Guid id, Guid deliveryId, Nullable`1 number, DateTime creationTime, String phone, AddressDto address, Nullable`1 duration, DateTime expectedDeliverTime, IOrderType type, ICustomerBuilder client, IUser deliveryOperator, SessionContext context) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Api\\\\Resto.Front.Api\\\\V7\\\\Editors\\\\Actions\\\\CreateDeliveryOrder.cs:строка 97\r\n   в Resto.Front.Api.V7.Editors.Actions.CreateDeliveryOrderWithPredefinedId.Resto.Front.Api.V7.Editors.IEditActionBase.WriteChanges(SessionContext context, IDictionary`2 createdEntities, IDictionary`2 actionNumbersToCreatedApiEntities, Int32 i) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Api\\\\Resto.Front.Api\\\\V7\\\\Editors\\\\Editors.g.cs:строка 201\r\n   в Resto.Front.Api.V7.Editors.EditSessionWriter.WriteChanges() в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Api\\\\Resto.Front.Api\\\\V7\\\\Editors\\\\EditSessionWriter.cs:строка 203\r\n   в Resto.Front.Api.V7.OperationService.SubmitChanges(IUser user, IEditSession editSession) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Api\\\\Resto.Front.Api\\\\V7\\\\OperationService.cs:строка 1660\r\n   в Resto.Front.Api.V7.OperationService.Resto.Front.Api.IOperationService.SubmitChanges(ICredentials credentials, IEditSession editSession) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Api\\\\Resto.Front.Api\\\\V7\\\\Operations.g.cs:строка 2292\r\n   в System.Runtime.Remoting.Messaging.StackBuilderSink._PrivateProcessMessage(IntPtr md, Object[] args, Object server, Object[]& outArgs)\r\n   в System.Runtime.Remoting.Messaging.StackBuilderSink.SyncProcessMessage(IMessage msg)\r\n\r\nException rethrown at [0]: \r\n   в System.Runtime.Remoting.Proxies.RealProxy.HandleReturnMessage(IMessage reqMsg, IMessage retMsg)\r\n   в System.Runtime.Remoting.Proxies.RealProxy.PrivateInvoke(MessageData& msgData, Int32 type)\r\n   в Resto.Front.Api.IOperationService.SubmitChanges(ICredentials credentials, IEditSession editSession)\r\n   в Resto.Front.Api.iikoTransport.CreateDeliveryOrder.OrderConverter.Convert(CreateOrderRequest request, IOrderType orderType) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Resto.Front.Api.iikoTransport\\\\CreateDeliveryOrder\\\\OrderConverter.cs:строка 51\r\n   в Resto.Front.Api.iikoTransport.CreateDeliveryOrder.CreateDeliveryOrderProcessor.Process(CreateOrderRequest request, Guid correlationId) в L:\\\\BuildAgent\\\\work\\\\master-installer\\\\dev\\\\iikoFront.Net\\\\Resto.Front.Api.iikoTransport\\\\CreateDeliveryOrder\\\\CreateDeliveryOrderProcessor.cs:строка 60",
    "description": "Cannot create self-service delivery with address.",
    "additionalData": null
  }
}', true);
  }
}
