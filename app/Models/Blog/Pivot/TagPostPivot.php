<?php

namespace App\Models\Blog\Pivot;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Pivot\TagPostPivot
 *
 * @property int $id
 * @property int $post_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Pivot\TagPostPivot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TagPostPivot extends Model
{
    //
}
