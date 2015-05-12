<?php

namespace Bcn\Api\Queue;

interface QueueInterface
{
    public function publish(Message $message);
}
