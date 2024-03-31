<?php

namespace App\Console\Commands;

use App\Models\Configuration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $mqtt->subscribe('FISHERYNET|CONFIG_REQUEST', function (string $topic, string $message) use ($mqtt) {
            match ($message) {
                'min_fish_size' => $this->handle_min_fish_size($message),
                default => Log::info(sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message))
            };
            Log::info(sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message));
        }, 0);
        // TODO: add a subscriber for FISHERYNET|CONFIG_REQUEST
        // insert the info to the database
        // use QOS 2 for better recording as this is a crucial part of the system
        // THINK ABOUT A WAY TO TRANSMIT THE DATA
        $mqtt->loop(true, true);
    }

    public function handle_min_fish_size(string $message): void
    {
        $mqtt = MQTT::connection();
        $fish_size = DB::table('configurations')
            ->where('key', $message)
            ->get();
        $fish_size = $fish_size->value("value");
        Log::info("Publishing min_fish_size: $fish_size to FISHERYNET|CONFIG_RESPONSE");
        $mqtt->publish('FISHERYNET|CONFIG_RESPONSE', "min_fish_size=$fish_size", 0, false);
        $mqtt->loop(true, true);
    }
}
