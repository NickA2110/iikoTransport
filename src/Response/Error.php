<?php

namespace IikoTransport\Response;

class Error extends Common
{
    public function getErrorMessage(): string {
        $aData = $this->getBodyAsArray();
        return $aData['errorDescription'];
    }
}
