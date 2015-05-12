<?php

namespace Bcn\Api\Controller;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use Bcn\Api\Queue\Message;
use Bcn\Api\Queue\QueueInterface;
use Rhumsaa\Uuid\Console\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController
{
    /**
     * @var QueueInterface
     */
    private $queue;

    public function __construct(QueueInterface $queue)
    {
        $this->queue = $queue;
    }

    public function postAction(Request $request)
    {
        try {
            $order = $this->parseOrderFromRequest($request);
        } catch (InvalidArgumentException $e) {
            return new Response(json_encode(['error' => $e->getMessage()]), Response::HTTP_BAD_REQUEST);
        }

        $message = new Message($order);
        $reference = $this->queue->publish($message);
        return new Response(json_encode(['id' => $reference]), Response::HTTP_ACCEPTED);
    }

    public function getAction($orderId)
    {
        if ($orderId[0] != 'A') {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }

        $json = file_get_contents(__DIR__ . '/../../../resources/successful-order-post-request.json');
        $json = str_replace('%%ORDER_ID%%', $orderId, $json);
        return new Response($json, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function parseOrderFromRequest(Request $request)
    {
        $json = $request->get('order');
        $this->validateJson($json);
        $data = json_decode($json, true);
        $order = $data['order'];
        $this->validateOrder($order);
        return $order;
    }

    /**
     * @param $json
     */
    protected function validateJson($json)
    {
        Assertion::isJsonString($json);
        Assertion::notEmpty($json);
    }

    /**
     * @param $order
     */
    protected function validateOrder($order)
    {
        Assertion::notBlank($order['id']);
        Assertion::notEmpty($order['lines']);
        Assertion::length($order['currency'], 3);
        Assertion::length($order['country'], 2);
        Assertion::numeric($order['customerId']);
    }
}
