<?php

namespace App\Services;

use Michelf\MarkdownExtra;
use Michelf\SmartyPants;

class MarkdownerService
{
    public function __construct()
    {
        //
    
    }
    public function toHTML($text){
        $text = $this->preTransformText($text);
        $text = MarkdownExtra::defaultTransform($text);
        $text = SmartyPants::defaultTransform($text);
        $text = $this->postTransformText($text);
        return $text;
    }
    protected function preTransformText($text)
    {
        return $text;
    }

    protected function postTransformText($text)
    {
        return $text;
    }

}
