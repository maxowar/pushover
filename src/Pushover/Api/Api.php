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


use GuzzleHttp\Client;

class Api
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}