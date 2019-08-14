<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use \App\Services\MarkdownerService;

/**
 * App\Models\Blog\Post
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property string|null $deleted_at
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    //
    protected $dates = ['published_at'];
    protected $fillable = [
        'title', 'subtitle', 'content_raw', 'page_image', 'meta_description','layout', 'is_draft', 'published_at',
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class, 'tag_post_pivots');
    }


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (!$this->exists) {
            $value = uniqid(str_random(8));
            $this->setUniqueSlug($value, 0);
        }
    }

    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title . '-' . $extra);

        if (static::where('slug', $slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Set the HTML content automatically when the raw content is set
     *
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new MarkdownerService();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }



// 然后在 Post 模型类中添加如下几个方法

    /**
     * 返回 published_at 字段的日期部分
     */
    public function getPublishDateAttribute($value)
    {
        return $this->published_at->format('Y-m-d');
    }

    /**
     * 返回 published_at 字段的时间部分
     */
    public function getPublishTimeAttribute($value)
    {
        return $this->published_at->format('g:i A');
    }

    /**
     * content_raw 字段别名
     */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }
}
