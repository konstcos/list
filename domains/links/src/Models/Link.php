<?php

namespace Links\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;

    protected $table = 'links';

    protected $fillable = [
        'user_id',
        'link'
    ];



}

