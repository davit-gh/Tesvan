<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

        public function posts()
        {
            return $this->hasMany(Service::class);
        }

        public function getTranslatedNameAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->name;
            }

            return $this->{"name_" . app()->getLocale()};
        }

        public function getSlugAttribute()
        {
            return slug(str_replace('-', '~', $this->name));
        }
}
