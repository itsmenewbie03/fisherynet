<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory
    {
        $configs = Configuration::all();
        return view("configurations.index", ["configs" => $configs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $action_id = $request->input('action_id');
        // FIX: this looks like trash because it is, but who cares?
        // jk, Dear future me, please refactor this xD
        switch ($action_id) {
            case 'sorting_toggle':
                $enabled = $request->input('enabled');
                if(is_null($enabled)) {
                    return redirect()->back()->with('error', 'Please select an option for sorting status.');
                }
                if ($enabled == 1) {
                    DB::table('configurations')->where('key', 'sorting_enabled')->update(['value' => 1]);
                    return redirect()->back()->with('success', 'Sorting is now enabled.');
                } else {
                    DB::table('configurations')->where('key', 'sorting_enabled')->update(['value' => 0]);
                    return redirect()->back()->with('success', 'Sorting is now disabled.');
                }
                break;

            case 'schedule_power_off':
                $daterange = $request->input('daterange');
                if(is_null($daterange)) {
                    return redirect()->back()->with('error', 'Please select a date range');
                }

                list($start_dt_str, $end_dt_str) = explode(' - ', $daterange);
                $start_dt = new DateTime($start_dt_str);
                $end_dt = new DateTime($end_dt_str);
                $start_ts = $start_dt->getTimestamp();
                $end_ts = $end_dt->getTimestamp();
                DB::table('configurations')->where('key', 'sleep_time')->update(['value' => "$start_ts - $end_ts"]);
                return redirect()->back()->with('success', 'Power off scheduled');

                break;

            case 'update_min_fish_size':
                $min_fish_size = $request->input('min_fish_size');
                if(is_null($min_fish_size)) {
                    return redirect()->back()->with('error', 'Please enter a minimum fish size');
                }
                if ($min_fish_size < 1) {
                    return redirect()->back()->with('error', 'Minimum fish size must be at least 1');
                }
                DB::table('configurations')->where('key', 'min_fish_size')->update(['value' => $min_fish_size]);
                return redirect()->back()->with('success', 'Minimum fish size updated');
                break;

            case 'update_calibration_factor':
                $calibration_factor = $request->input('calibration_factor');
                if(is_null($calibration_factor)) {
                    return redirect()->back()->with('error', 'Please enter the calibration factor');
                }
                if ($calibration_factor < 1) {
                    return redirect()->back()->with('error', 'Calibration factor must be at least 1');
                }
                DB::table('configurations')->where('key', 'calibration_factor')->update(['value' => $calibration_factor]);
                return redirect()->back()->with('success', 'Calibration factor updated');
                break;

            default:
                # code...
                break;
        }
        return redirect()->back()->with('error', 'we got a ligma');
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuration $configuration): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Configuration $configuration): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration): void
    {
        //
    }
}
