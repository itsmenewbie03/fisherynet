<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $est_size = session("est_size");
    return view('dashboard', $est_size ? ["est_size" => $est_size] : []);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // INFO: conifguration route
    Route::resource("/configurations", \App\Http\Controllers\ConfigurationController::class);
    // INFO: reports route
    Route::resource("/reports", \App\Http\Controllers\ReportsController::class);

    Route::post("/calibrate", function () {

        $est_size = -1;

        $mqtt = MQTT::connection();
        Log::info("STARTING DETECTION CALIBRATION");
        $mqtt->publish('FISHERYNET|COMMANDS', "START_DETECTION_CALIBRATION", 0, false);
        $mqtt->loop(true, true);

        $mqtt->subscribe('FISHERYNET|CALIBRATION_RESPONSE', function (string $topic, string $message) use ($mqtt, &$est_size) {
            Log::info("$topic |  $message");
            list($key, $value) = explode("=", $message);
            switch ($key) {
                case 'est_size':
                    Log::info("Estimated size from response: $value");
                    $est_size = $value;
                    $mqtt->unsubscribe('FISHERYNET|CALIBRATION_RESPONSE');
                    $mqtt->disconnect();
                    return;
                default:
                    Log::warning("Unexpected response key: $key on topic: $topic");
            }
        }, 0);

        $mqtt->loop(true, true);
        Log::info("Estimated size we will return to dashboard: $est_size");
        return redirect()->route('dashboard')->with('est_size', $est_size);

    })->name('calibrate');

    Route::post("/toggle", function (Request $request) {
        $port = $request->input('port');
        $mqtt = MQTT::connection();
        Log::info("TOGGLING $port");
        $mqtt->publish('FISHERYNET|TOGGLE_PORT', $port, 0, false);
        $mqtt->loop(true, true);
        // TODO: add a message about the toggle result
        return redirect()->route('dashboard');
    })->name('toggle');

    Route::post("/generator", function (Request $request) {
        $reportrangefilter = $request->input('reportrangefilter');
        dd($reportrangefilter);
    })->name('generator');

});

require __DIR__ . '/auth.php';
