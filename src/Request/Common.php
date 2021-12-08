<?php
namespace IikoTransport\Request;

/**
 *  API Request
 */
class Common implements IRequest
{
    protected $sUri;

    protected $sMethod = 'POST';

    protected $aHeaders = [];
  
    protected $aData = [];

    public function getUri(): string
    {
        if (empty($this->sUri)) {
            throw new Exception(
                "The 'Uri' poperty is not set",
                Exception::THE_URI_PROPERTY_IS_NOT_SET
            );
        }
        return $this->sUri;
    }

    public function setUri(string $sUri): self
    {
        $this->sUri = $sUri;
        return $this;
    }

    public function getMethod(): string
    {
        return $this->sMethod;
    }

    public function getHeaders(): array
    {
        return $this->aHeaders;
    }

    public function setHeaders(array $aHeaders)
    {
        $this->aHeaders = $aHeaders;
        return $this;
    }

    public function setHeaderByName(string $sName, $value) {
        if (empty($sName)) {
            throw new Exception(
                "Empty name of header is not allow",
                Exception::EMPTY_NAME_OF_HEADER
            );
        }
        $this->aHeaders[$sName] = $value;
    }

    public function setData(array $aData)
    {
        $this->aData = $aData;
        return $this;
    }

    public function getData(): array 
    {
        return $this->aData;
    }
}
