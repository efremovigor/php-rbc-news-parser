<?php

namespace App\Service;

use Kluatr\DynamicServices\Components\Logger\MailMessage;
use Psr\Log\LoggerInterface;

class MailLogger implements LoggerInterface
{


    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param MailMessage $message
     * @param array $context
     * @return bool
     */
    public function log($level, $message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function emergency($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function alert($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function critical($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function error($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function warning($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function notice($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function info($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function debug($message, array $context = []): bool
    {
        return $this->send($message);
    }

    /**
     * @param $message
     * @return bool
     */
    protected function send($message): bool
    {
        if ($message instanceof MailMessage) {
            print_r($message->getSubject());
            print_r($message->getBody());
            return true;
        }
        return false;
    }
}