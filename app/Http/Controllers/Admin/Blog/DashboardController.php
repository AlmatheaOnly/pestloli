<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Config\BlogGlobalConfig;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.blog.dashboard.config', ['config' => BlogGlobalConfig::all()]);
    }

    public function ajaxIndex()
    {
        return BlogGlobalConfig::all();
    }

    public function ajaxUpdate(Request $request)
    {
        $config = app()->make('Blog\Config');
        $flag = $config->set($request->name,$request->value);
        return response()->json(['msg'=>$flag]);
    }


    /*
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $post->tags()->attach(Tag::whereIn('tag',$request->get('tags',[])));

        return redirect()
            ->route('admin.blog.post.index')
            ->with('success', '新文章创建成功.');
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
       $post->tags()->sync(Tag::whereIn('tag',$request->get('tags',[]))->pluck('id')->all());
        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->with('success', '文章已保存.');
        }

        return redirect()
            ->route('admin.blog.post.index')
            ->with('success', '文章已保存.');
    }

    */

}
