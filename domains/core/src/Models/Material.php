<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Material extends Model
{
    use SoftDeletes;

    protected $table = 'materials';

    protected $fillable = [
        'user_id',
        'module_id',
        'title',
        'slug',
        'short_content',
        'parts_count',
        'position',
        'is_archive',
    ];

    protected static function booted(): void
    {
        static::creating(function (Material $material) {
            $material->ulid ??= (string) Str::ulid();
        });
    }

}

