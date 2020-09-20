<?php

namespace App\Library\Spryng;

use SpryngApiHttpPhp\Utilities\Validator;
use SpryngApiHttpPhp\Utilities\RequestHandler;
use SpryngApiHttpPhp\Exception\InvalidRequestException;
use SpryngApiHttpPhp\Resources\Sms as SpryngSms;

class Sms extends SpryngSms
{
    public function send($recipient, $body, $options)
    {
        if (!isset($options['route'])) {
            $options['route'] = $this->defaultSendOptions['route'];
        }

        try {
            $options = Validator::validateSendOptions($options, $body);
            $recipient = Validator::validateMessageRecipient($recipient);
        } catch (\Exception $e) {
            throw new InvalidRequestException('Request malformed: ' . $e->getMessage());
        }

        // Prepare the request
        $requestHandler = new RequestHandler();
        $requestHandler->setHttpMethod("POST");
        $requestHandler->setBaseUrl($this->api->getApiEndpoint());
        $requestHandler->setQueryString(static::SMS_URI);
        $requestHandler->addGetParameter($this->api->getUsername(), 'username', false);

        // Add either PASSWORD or SECRET accordingly
        $auth = $this->api->getIsSecret() ? 'secret' : 'password';
        $requestHandler->addGetParameter($this->api->getPassword(), $auth, false);

        $requestHandler->addGetParameter($recipient, 'destination', true);
        $requestHandler->addGetParameter($this->api->getSender(), 'sender', true);
        $requestHandler->addGetParameter($body, 'body', true);
        $requestHandler->addGetParameter($options['route'], 'route', true);
        $requestHandler->addGetParameter($options['allowlong'], 'allowlong', true);

        // Add optional reference
        if (isset($options['reference'])) {
            $requestHandler->addGetParameter($options['reference'], 'reference', true);
        }

        $requestHandler->doRequest();

        return $requestHandler->getResponse();
    }
}
