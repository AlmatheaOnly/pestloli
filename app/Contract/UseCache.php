<?php

namespace App\Contract;

interface UseCache
{
    public function get($key);

    public function set($key,$value);

    public function init();

    public function cachePrefix();
}