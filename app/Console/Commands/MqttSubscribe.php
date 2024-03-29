<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class MqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe('FISHERYNET|CONFIG_REQUEST', function (string $topic, string $message) {
            Log::info(sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message));
        }, 0);
        $mqtt->loop(true, true);
    }
}
