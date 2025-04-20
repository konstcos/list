<?php

namespace Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxonomyCategory extends Model
{
    use SoftDeletes;

    protected $table = 'taxonomy_categories';

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
    ];



}

