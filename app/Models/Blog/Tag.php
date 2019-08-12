<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Tag
 *
 * @property int $id
 * @property string $tag
 * @property string $title
 * @property string $subtitle
 * @property string $page_image
 * @property string $meta_description
 * @property string $layout
 * @property int $reverse_direction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag wherePageImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereReverseDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    //
}
