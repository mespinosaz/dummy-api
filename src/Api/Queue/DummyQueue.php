<?php

namespace Bcn\Api\Queue;

use Rhumsaa\Uuid\Uuid;

class DummyQueue implements QueueInterface
{
    public function publish(Message $message)
    {
        return Uuid::uuid4()->toString();
    }
}
