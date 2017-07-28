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

use PHPUnit\Framework\TestCase;

class PushoverTest extends TestCase
{
    public function testSendMessage(): void
    {
        require_once "../../.pushover";

        $configuration = new Configuration(PUSHOVER_APP_TOKEN, PUSHOVER_USER_KEY);

        $pushover = new Pushover($configuration);

        $message = new Message('Hello world');
        $message->setTitle('PHP Pushover');

        $this->assertTrue($pushover->send($message));
    }
}