<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    public function publish(string $queue, string $message): void
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USER'),
            env('RABBITMQ_PASS'),
        );
        $channel = $connection->channel();

        $channel->queue_declare($queue, false, false, false, false);
        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, '', $queue);
        $channel->close();
        $connection->close();
    }
}
