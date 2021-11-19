<?php
namespace IikoTransport\Request;

/**
 *  Get acess token request
 */
class AccessToken extends Common
{
    protected $sUri = 'access_token';

    function __construct(string $sApiKey) {
        $this->aData['apiLogin'] = $sApiKey;
    }
}
