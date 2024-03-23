<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value'];

    public static function getValue(string $key)
    {
        $config = self::where('key', $key)->first();
        return $config ? $config->value : null; // Handle missing key gracefully
    }

    public static function setValue(string $key, $value)
    {
        $config = self::where('key', $key)->first();
        if ($config) {
            $config->value = $value;
            $config->save();
        } else {
            self::create(['key' => $key, 'value' => $value]);
        }
    }
}
