<?php

namespace App\Http\Requests\Blog;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Responses\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'subtitle' => 'required',
            'content' => 'required',
            'publish_date' => 'required',
            'publish_time' => 'required',
            'layout' => 'required',
        ];
    }

    public function postFillData()
    {
        $published_at = new Carbon($this->publish_date . ' ' . $this->publish_time);

        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'page_image' => $this->page_image,
            'content_raw' => $this->get('content'),
            'meta_description' => $this->meta_description,
            'is_draft' => (int)$this->is_draft,
            'published_at' => $published_at->toDateTimeString(),
            'layout' => $this->layout,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->all();
        throw new HttpResponseException(JsonResponse::Failed('新文章创建失败',$error), 200);
    }
}
