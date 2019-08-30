<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Carbon\Carbon;
use App\Http\Requests\Blog\PostUpdateRequest;
use App\Http\Requests\Blog\PostCreateRequest;
use App\Http\Responses\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $fieldList = [
        'title' => '',
        'slug' => '',
        'subtitle' => '',
        'page_image' => '',
        'content' => '',
        'meta_description' => '',
        'is_draft' => "0",
        'publish_date' => '',
        'publish_time' => '',
        'layout' => '',
        'tags' => [],
    ];

    public function show($slug)
    {
        //
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.post', ['post' => $post]);
    }

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        return view('admin.blog.post.index', ['posts' => Post::all()]);
    }

    public function ajaxIndex(){
        return Post::all();
    }
    /**
     * Show the new post form
     */
    public function create()
    {
        $fields = $this->fieldList;
        $when = Carbon::now()->addHour();
        $fields['publish_date'] = $when->format('Y-m-d');
        $fields['publish_time'] = $when->format('h:s:i');

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        $data = array_merge(
            $fields,
            ['allTags' => Tag::all()->pluck('tag')->all()]
        );

        return view('admin.blog.post.create', $data);
    }

    /**
     * Store a newly created Post
     *
     * @param PostCreateRequest $request
     */
    public function store(PostCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $post = Post::create($request->postFillData());
            $post->tags()->attach($request->get('tags', []));
        } catch (\Exception $errors) {
            DB::rollBack();
            return JsonResponse::Failed('新文章创建失败');

        }
        DB::commit();
        return JsonResponse::Success('新文章创建成功');
    }

    /**
     * Show the post edit form
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $fields = $this->fieldsFromModel($id, $this->fieldList);

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        $data = array_merge(
            $fields,
            ['allTags' => Tag::all()->pluck('tag')->all()]
        );

        return view('admin.blog.post.edit', $data);
    }

    /**
     * 更新文章
     *
     * @param PostUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->tags()->sync(Tag::whereIn('tag', $request->get('tags', []))->pluck('id')->all());
        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->with('success', '文章已保存.');
        }

        return redirect()
            ->route('admin.blog.post.index')
            ->with('success', '文章已保存.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('admin.blog.post.index')
            ->with('success', '文章已删除.');
    }

    /**
     * Return the field values from the model
     *
     * @param integer $id
     * @param array $fields
     * @return array
     */
    private function fieldsFromModel($id, array $fields)
    {
        $post = Post::findOrFail($id);

        $fieldNames = array_keys(array_except($fields, ['tags']));

        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $post->{$field};
        }
        $fields['tags'] = $post->tags->pluck('tag')->all();


        return $fields;
    }
}
