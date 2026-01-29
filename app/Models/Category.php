<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
           'uuid',
           'name',
           'description',
           'slug',
           'status',
           'popular',
           'image',
           'meta_title',
           'meta_description',
           'meta_keyword',
            
    ];
}
