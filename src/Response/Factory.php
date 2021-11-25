<?php

namespace IikoTransport\Response;

use IikoTransport\Request\{
    Nomenclature,
    Organizations,
    PaymentTypes,
    TerminalGroups,
    TerminalGroups\IsAlive,
    Combo\GetCombosInfo,
};

class Factory 
{
    var $oResponse;

    static public function getTypedResponse(IResponse $oResponse): IResponse
    {
        $oFactory = new self($oResponse);
        try {
            $oResponse = $oFactory->returnTypedResponse($oResponse);
        } catch (Exception $e) {
            if ($e->getCode() == Exception::RESPONSE_CLASS_IS_NOT_EXISTS) {
                return $oResponse;
            }
            throw $e;
        }
        return $oResponse;
    }

    function __construct(IResponse $oResponse)
    {
        $this->oResponse = $oResponse;
    }

    function returnTypedResponse(): IResponse
    {
        $oRequest = $this->oResponse->getRequest();

        switch (true) {
            case $oRequest instanceof Nomenclature:
                return $this->getResponseByRequestClass(Nomenclature::class);
            case $oRequest instanceof Organizations:
                return $this->getResponseByRequestClass(Organizations::class);
            case $oRequest instanceof PaymentTypes:
                return $this->getResponseByRequestClass(PaymentTypes::class);
            case $oRequest instanceof TerminalGroups:
                return $this->getResponseByRequestClass(TerminalGroups::class);
            case $oRequest instanceof GetCombosInfo:
                return $this->getResponseByRequestClass(GetCombosInfo::class);
            case $oRequest instanceof IsAlive:
                return $this->getResponseByRequestClass(IsAlive::class);
        }

        return $this->oResponse;
    }

    function getResponseByRequestClass(string $sRequestClass): IResponse
    {
        $sClassName = $this->getResponseClassOfRequest($sRequestClass);
        $oNewResponse = new $sClassName(
            $this->oResponse->getRequest(),
            $this->oResponse->getStatusCode(),
            $this->oResponse->getHeaders(),
            $this->oResponse->getBodyAsString()
        );
        return $oNewResponse;
    }

    function getResponseClassOfRequest(string $sRequestClass): string
    {
        $aClassName = explode('IikoTransport\\Request\\', $sRequestClass);
        $sClassName = implode('IikoTransport\\Response\\', $aClassName);
        
        if (!class_exists($sClassName)) {
            throw new Exception(
                "Response class '{$sClassName}' is not exists",
                Exception::RESPONSE_CLASS_IS_NOT_EXISTS
            );
        }
        
        return $sClassName;
    }
}
