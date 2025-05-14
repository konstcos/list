<?php

namespace Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxonomyTag extends Model
{
    use SoftDeletes;

    protected $table = 'taxonomy_tags';

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'color',
    ];

}

