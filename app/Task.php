<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'uuid',
        'description',
        'done',
        'createdAt',
    ];
}
