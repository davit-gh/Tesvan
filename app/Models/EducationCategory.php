<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EducationCategory extends Model
{
    protected $table = 'education_categories';

    public function posts()
    {
        return $this->hasMany(Education::class);
    }

    public function getSlugAttribute()
    {
        return slug(str_replace('-', '~', $this->name));
    }
}
