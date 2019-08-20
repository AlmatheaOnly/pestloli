<?php
namespace App\Contract;

interface UseCache{
    public function getCache();
    public function setCache();
    public function dataType();
}