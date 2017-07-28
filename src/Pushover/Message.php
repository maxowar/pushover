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

use Symfony\Component\Validator\Constraints as Assert;

class Message
{
    const RESOURCE = "messages.json";

    /**
     * your message
     *
     * @Assert\Length(max="1024")
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $message;

    /**
     * your user's device name to send the message directly to that device, rather than all of the user's devices
     * (multiple devices may be separated by a comma)
     *
     * @var string
     */
    private $device;

    /**
     * your message's title, otherwise your app's name is used
     *
     * @Assert\Length(max="250")
     *
     * @var string
     */
    private $title;

    /**
     * a supplementary URL to show with your message
     *
     * @Assert\Length(max="512")
     *
     * @var string
     */
    private $url;

    /**
     * a title for your supplementary URL, otherwise just the URL is show
     *
     * @Assert\Length(max="100")
     *
     * @var string
     */
    private $url_title;

    /**
     * send as -2 to generate no notification/alert, -1 to always send as a quiet notification, 1 to display as high-priority
     * and bypass the user's quiet hours, or 2 to also require confirmation from the user
     *
     * @var integer
     */
    private $priority;

    /**
     * a Unix timestamp of your message's date and time to display to the user, rather than the time your message is received by our API
     *
     * @var integer
     */
    private $timestamp;

    /**
     * the name of one of the sounds supported by device clients to override the user's default sound choice
     *
     * @var string
     */
    private $sound;

    public function __construct(string $message)
    {
        $this->message = $message;
        $this->timestamp = time();
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getDevice(): ?string
    {
        return $this->device;
    }

    /**
     * @param string $device
     */
    public function setDevice(string $device)
    {
        $this->device = $device;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrlTitle(): ?string
    {
        return $this->url_title;
    }

    /**
     * @param string $url_title
     */
    public function setUrlTitle(string $url_title)
    {
        $this->url_title = $url_title;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getSound(): string
    {
        return $this->sound;
    }

    /**
     * @param string $sound
     */
    public function setSound(string $sound)
    {
        $this->sound = $sound;
    }

    public function getResource()
    {
        return self::RESOURCE;
    }


}