<?php

namespace App\Services;

use App\Models\Setting;



class Settings{


    protected $settings = [];

    public function __construct(){

        $this->loadSettings();

    }

    public function set($key,$value)
    {
        //return 'asdasdasd';
        //dd($key);
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );

        //dd($this->get($key));
        return 'inserted';
    }

    public function get($key)
    {
        if( is_array($key) ) {
            $keys = [];

            foreach($key as $k) {
                $keys[$k] = $this->settings[$k];
            }

            return $keys;
        }

        return $this->settings[$key];
    }

    public function all(){

        return $this->settings;
        return [
            'count'=> 'all',
            'type' => '$this->type'
        ];
    }

    protected function loadSettings()
    {
        // $settings = Cache::remember('settings', 24*60, function() {
        //     return \App\Models\Setting::all()->toArray();
        // });

        $settings = Setting::all()->toArray();
        $this->settings = array_pluck($settings, 'value', 'key');
    }

}
