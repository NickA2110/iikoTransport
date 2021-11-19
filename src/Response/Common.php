<?php

namespace IikoTransport\Response;

use IikoTransport\Request\Common as CommonRequest;

class Common
{
    protected $oRequest;

    protected $nStatusCode;

    protected $aHeaders;

    protected $sBody;

    public function __construct(
        CommonRequest $oRequest,
        int $nStatusCode,
        array $aHeaders,
        string $sBody
    ) {
        $this->oRequest = $oRequest;
        $this->nStatusCode = $nStatusCode;
        $this->aHeaders = $aHeaders;
        $this->sBody = $sBody;
    }

    public function isHasError(): bool
    {
        return $this->nStatusCode != 200;
    }

    public function getBody(): string
    {
        return $this->sBody;
    }

    public function getStatusCode(): int
    {
        return $this->nStatusCode;
    }
    
    public function toArray(): array
    {
      return json_decode($this->getBody(), true); 
    }
}
