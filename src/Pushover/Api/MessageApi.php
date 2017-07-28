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

namespace Pushover\Api;

use GuzzleHttp\Psr7\Response;
use Pushover\Message;

class MessageApi extends Api
{
    const API_VERSION = 1;

    public function push(Message $message): Response
    {
        $uri = '/' . self::API_VERSION . '/messages.json';

        $data = [
            'message' => $message->getMessage(),
            'title' => $message->getTitle(),
            'timestamp' => $message->getTimestamp()
        ];

        $options['form_params'] = $data;

        return $this->client->post($uri, $options);
    }
}