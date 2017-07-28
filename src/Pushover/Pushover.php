<?php
/**
 * This file is part of the pushover package.
 *
 * (c) Massimo Naccari "maxowar"
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Pushover;

use function GuzzleHttp\choose_handler;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use function GuzzleHttp\Psr7\stream_for;
use Psr\Http\Message\RequestInterface;
use Pushover\Api\GroupApi;
use Pushover\Api\MessageApi;

class Pushover
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var \SplQueue
     */
    private $queue;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;

        $this->queue = new \SplQueue();
        $this->queue->setIteratorMode(\SplDoublyLinkedList::IT_MODE_FIFO | \SplDoublyLinkedList::IT_MODE_DELETE);
    }

    public function send(Message $message)
    {
        $response = $this->getMessageApi()->push($message);

        $result = json_decode($response->getBody(), true);

        return true;
    }

    public function getMessageApi()
    {
        return new MessageApi($this->getHttpClient());
    }

    public function getGroupApi()
    {
        return new GroupApi($this->getHttpClient());
    }

    /**
     * @return Client
     */
    private function getHttpClient(): Client
    {
        $stack = new HandlerStack();
        $stack->setHandler(choose_handler());
        $stack->push(function(callable $handler) {
            return function(RequestInterface $request, array $options) use ($handler){

                // aggiungere a tutte le request 'token' e 'user'
                $auth = [
                    'token' => $this->configuration->getAppToken(),
                    'user' => $this->configuration->getUserKey(),
                ];
                $request = $request->withBody(stream_for($request->getBody()->getContents() . '&' . http_build_query($auth)));

                return $handler($request, $options);
            };
        });

        $client = new Client([
            'base_uri' => $this->configuration->getBaseUri(),
            'curl' => [
                CURLOPT_SAFE_UPLOAD     => true,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_SSL_VERIFYHOST  => 0,
                CURLOPT_SSL_VERIFYPEER  => false
            ],
            'handler' => $stack
        ]);

        return $client;
    }

    public function enqueue(Message $message)
    {
        $this->queue->enqueue($message);
    }

    public function flush()
    {
        foreach ($this->queue as $message) {
            $this->send($message);
        }
    }
}