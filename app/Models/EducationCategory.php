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

    public function latestPosts()
    {
        return $this->hasMany(Education::class)->published()->latest('published_date')->limit(3);
    }

    public function getSlugAttribute()
    {
        return slug(str_replace('-', '%2D', $this->name));
    }
}
