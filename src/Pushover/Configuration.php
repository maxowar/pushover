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


class Configuration
{
    private $app_token;

    private $user_key;

    public function __construct(string $token, string $user)
    {
        $this->app_token = $token;
        $this->user_key = $user;
    }

    /**
     * @return string
     */
    public function getAppToken(): string
    {
        return $this->app_token;
    }

    /**
     * @return string
     */
    public function getUserKey(): string
    {
        return $this->user_key;
    }

    public function getBaseUri()
    {
        return "https://api.pushover.net";
    }
}