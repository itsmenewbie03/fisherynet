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

        $mqtt->subscribe('FISHERYNET|CONFIG_REQUEST', function (string $topic, string $message) {
            $this->handle_configuration($message);
        }, 0);

        $mqtt->subscribe('FISHERYNET|REPORTS', function (string $topic, string $message) use ($mqtt) {
            Log::info(sprintf('Received QoS level 2 message on topic [%s]: %s', $topic, $message));
            // INFO: format would be est_size=x.x
            list($key, $value) = explode("=", $message);
            if($key !== "est_size") {
                Log::info("Invalid key: $key");
                return;
            }
            DB::table('reports')->insert([
                'est_size' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }, 2);

        $mqtt->loop(true, true);
    }

    // NOTE: idk about the penalties of multiple calls to MQTT::connection()
    // but we don't have time to deal with it right now xD
    public function handle_configuration(string $message): void
    {
        $mqtt = MQTT::connection();

        $configValue = $this->getConfigurationValue($message);

        if ($configValue !== null) {
            $topic = "FISHERYNET|CONFIG_RESPONSE";
            $message = "$message=$configValue";
            Log::info("Publishing $message to $topic");
            $mqtt->publish($topic, $message, 0, false);
            Log::info("Published $message to $topic");
        } else {
            Log::info("Configuration key $message not found in database");
        }
    }

    private function getConfigurationValue(string $key): ?string
    {
        $result = DB::table('configurations')
            ->where('key', $key)
            ->value('value');

        return $result !== null ? $result : null;
    }
}
