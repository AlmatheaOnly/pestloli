<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Services\Blog\PostService;
use App\Http\Responses\JsonResponse;
use Illuminate\Foundation\Application;

class PostController extends Controller
{
    //
    private $postService;
    private $config;
    private $request;

    public function __construct(Request $request, Application $app)
    {
        //$this->postService = $app->make('\App\Services\Blog\PostService');
        $this->postService = $app->make('Blog\Post');
        $this->config = $app->make('Blog\Config');
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $postService = $this->postService;
        $config = $this->config;
        $posts = $postService->postList();
        $config->init();

        $array = [
            'name' => $config->get('blog_name'),
            'title' => $config->get('title'),
            'subtitle' => $config->get('subtitle'),
            'posts' => $posts,
            'page_image' => $config->get('page_image'),
            'meta_description' => $config->get('meta_describute'),
            'author' => $config->get('author'),
        ];

        return view('blog.index', $array);
    }

    public function show(Request $request, $id)
    {
        $postService = $this->postService;
        $config = $this->config;
        $post = $postService->get($id);
        $config->init();
        $post = json_decode($post, true);
        $post = new Post($post);
        $tags = $post->tags->pluck('tag')->toArray();

        $array = [
            'name' => $config->get('blog_name'),
            'title' => $config->get('title') . '-' . $post->title,
            'subtitle' => $config->get('subtitle'),
            'post' => $post,
            'page_image' => $config->get('page_image'),
            'meta_description' => $config->get('meta_describute'),
            'author' => $config->get('author'),
            'tags' => $tags,
        ];

        return view('blog.post', $array);
    }

    public function ajaxConfig(Application $app)
    {
        $config = $app->make('Blog\Config');
        $config->init();
        $postService = new PostService();
        $data = $postService->lists();
        return JsonResponse::Success('', $data);
    }
}
