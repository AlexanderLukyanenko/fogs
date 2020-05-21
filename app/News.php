<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="News",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="title",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="short_description",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="img",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="date",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="updated_at",
 *      type="string"
 *  ),
 * )
 */

class News extends Model
{
    protected $fillable = [
        'title', 'short_description', 'img', 'date'
    ];
}
