<?php

namespace App\Services\Blog\Cache;

use Illuminate\Support\Facades\Redis;
use App\Contract\UseCache;

class CacheService
{
    private $cachePrefix = '';

    public function __construct(UseCache $newInstance)
    {
        //
        $this->newInstance = $newInstance;
        $this->cachePrefix = $this->newInstance->cachePrefix();

    }
    public function init()
    {
        return $this;
    }
    public function __call($name, $arguments)
    {
        if ($name == 'get') {

            if (Redis::hexists($this->cachePrefix, $arguments[0])) {
                return Redis::hget($this->cachePrefix, $arguments[0]);
            } else {
                $value = $this->newInstance->init()->get($arguments[0]);
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
        $method = new\ReflectionMethod($this->newInstance,$name);
        return $method->invokeArgs($this->newInstance,$arguments);
    }
}
