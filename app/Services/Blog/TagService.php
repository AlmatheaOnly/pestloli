<?php

namespace App\Services\Blog;

use Carbon\Carbon;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Services\Blog\ConfigService;


class TagService
{

    public function __construct()
    {

    }
    public function getAllTag(){
        $tags = Tag::all();
        return $tags;
    }
}
