<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $guarded = [];

    protected $casts = [
        'frameworks' => 'json',
        'tools' => 'json',
    ];
}
