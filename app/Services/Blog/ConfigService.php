<?php

namespace App\Services\Blog;

use App\Models\Admin\Config\BlogGlobalConfig as Config;

class ConfigService
{
    private $config;

    public function __construct()
    {
        //
    }

    public function init()
    {
        if (isset($this->config)) {
            return $this;
        }
        $this->config = Config::pluck('value', 'name')->all();
        return $this;
    }

    public function getAll()
    {
        return $this->config;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->config) && !empty($this->config[$name])) {
            return $this->config[$name];
        } else {
            return config('blog.'.$name);
        }
    }

    public function set($name,$value)
    {
        $config = Config::where('name',$name)->first();
        $config->value=$value;
        return $config->save();
    }
}
