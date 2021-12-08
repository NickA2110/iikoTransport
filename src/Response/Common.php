<?php

namespace IikoTransport\Response;

use IikoTransport\Request\Common as CommonRequest;

class Common implements IResponse
{
    protected $oRequest;

    protected $nStatusCode;

    protected $aHeaders;
    
    protected $sBody;

    protected $aBody;

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
        $this->aBody = json_decode($this->sBody, true);
    }

    public function isHasError(): bool
    {
        return $this->nStatusCode != 200;
    }

    public function getStatusCode(): int
    {
        return $this->nStatusCode;
    }

    public function getHeaders(): array 
    {
        return $this->aHeaders;
    }

    public function getBodyAsString(): string
    {
        return $this->sBody;
    }

    public function getBodyAsArray(): array
    {
        if (!is_array($this->aBody)) {
            throw new Exception(
                "Type of body is not array",
                Exception::TYPE_OF_BODY_IS_NOT_ARRAY
            );
        }
        return $this->aBody;
    }

    public function getRequest(): CommonRequest
    {
        return $this->oRequest;
    }

    public function parseBody(): IResponse
    {
        return $this;
    }

    public function getCorrelationId(): string
    {
        return $this->aHeaders['correlationid'][0];
    }
}
