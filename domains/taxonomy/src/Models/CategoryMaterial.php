<?php

namespace Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMaterial extends Model
{
    use SoftDeletes;

    protected $table = 'category_material';

    protected $fillable = [
        'is_primary',
        'category_id',
        'material_id',
        'position',
    ];

}

