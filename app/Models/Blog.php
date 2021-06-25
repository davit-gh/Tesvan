<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    protected $table = 'blogs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTranslatedDescriptionAttribute()
    {
        if (app()->getLocale() === 'en') {
            return $this->description;
        }

        return $this->{"description_" . app()->getLocale()};
    }
}
