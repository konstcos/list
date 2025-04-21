<?php

namespace Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMaterial extends Model
{
    use SoftDeletes;

    protected $table = 'category_material';

    protected $fillable = [
        'user_id',
        'category_id',
        'material_id',
        'position',
    ];

}

