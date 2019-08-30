<?php

namespace App\Services\Blog;

use Carbon\Carbon;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Services\Blog\ConfigService;
use App\Contract\UseCache;


class PostService implements UseCache
{
    protected $tag;

    /**
     * 控制器
     *
     * @param string|null $tag
     */
    public function __construct()
    {

    }

    public function init()
    {
        return $this;
    }

    public function get($id)
    {
        return Post::where('id', $id)->first();
    }

    public function set($id, $data)
    {
        return Post::firstOrCreate(
            ['id' => $id],
            $data
        );
    }



    public function postList()
    {
        $posts = Post::with('tags')
            ->orderBy('published_at', 'desc')
            ->limit('20')
            ->simplePaginate(config('blog.posts_per_page'));
        return $posts;
    }

    public function cachePrefix()
    {
        return "blog_post";
    }
}
