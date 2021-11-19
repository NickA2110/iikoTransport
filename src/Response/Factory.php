<?php

namespace IikoTransport\Response;

abstract class Factory 
{
    static public function getTypedResponse(Common $oResponse): Common
    {
        return $oResponse;
    }
}
