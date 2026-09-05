<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description',
    ];
    
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saved(function ($setting) {
            Cache::forget('setting_' . $setting->key);
        });
        
        static::deleted(function ($setting) {
            Cache::forget('setting_' . $setting->key);
        });
    }
    
    /**
     * Get a setting by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $value = Cache::remember('setting_' . $key, 60 * 24, function () use ($key) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : null;
        });
        
        return $value ?: $default;
    }
    
    /**
     * Set a setting value
     *
     * @param string $key
     * @param mixed $value
     * @param string $group
     * @param string $type
     * @param string|null $description
     * @return \App\Models\Setting
     */
    public static function set($key, $value, $group = 'general', $type = 'text', $description = null)
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->group = $group;
        $setting->type = $type;
        
        if ($description) {
            $setting->description = $description;
        }
        
        $setting->save();
        
        Cache::forget('setting_' . $key);
        
        return $setting;
    }
}
