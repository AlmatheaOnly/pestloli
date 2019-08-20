<?php

namespace App\Services\Blog\Cache;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ConfigService
{
    private $cachePrefix = 'blog_config';

    public function __construct($newInstance)
    {
        //
        $this->newInstance = $newInstance;
    }

    public function __call($name, $arguments)
    {
        if ($name == 'get') {
            if (Redis::hexists($this->cachePrefix, $arguments[0])) {
                return Redis::hget($this->cachePrefix, $arguments[0]);
            } else {
                $reflect = new \ReflectionMethod($this->newInstance, $name);
                $value = $reflect->invoke($this->newInstance->init(), $arguments[0]);
                Redis::hset($this->cachePrefix, $arguments[0], $value);
                return $value;
            }
        }
        if ($name == 'set') {
            if ($this->newInstance->set($arguments[0], $arguments[1])) {
                Redis::hdel($this->cachePrefix, $arguments[0]);
                return true;
            }
            return false;
        }
        // TODO: Implement __call() method.
    }

    public function init()
    {
        return $this;
    }
}
