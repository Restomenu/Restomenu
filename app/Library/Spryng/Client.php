<?php

namespace App\Library\Spryng;

use App\Library\Spryng\Sms;
use SpryngApiHttpPhp\Exception\AuthenticationException;
use SpryngApiHttpPhp\Exception\InvalidRequestException;
use SpryngApiHttpPhp\Client as SpryngClient;

class Client extends SpryngClient
{
    public function __construct($username, $password, $sender, $isSecret = false)
    {
        $this->getCompatibilityChecker()->checkCompatibility();

        $this->setCredentials($username, $password, $sender);
        $this->setIsSecret($isSecret);

        $this->sms = new Sms($this);
    }
}
