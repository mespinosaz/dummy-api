<?php

namespace Bcn\Api\Queue;

class Message 
{
    private $payload;

    public function __construct($payload)
    {

        $this->payload = $payload;
    }
}
