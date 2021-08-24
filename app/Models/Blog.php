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

    public function getTranslatedTitleAttribute()
    {
        if (app()->getLocale() === 'en') {
            return $this->title;
        }

        return $this->{"title_" . app()->getLocale()};
    }

    public function getTranslatedDescriptionAttribute()
    {
        if (app()->getLocale() === 'en') {
            return $this->description;
        }

        return $this->{"description_" . app()->getLocale()};
    }

    public function getTranslatedPublishedDateAttribute()
    {
        $months = months();
        return str_replace(
            $months['en'],
            $months[app()->getLocale()],
            date("M d, Y", strtotime($this->published_date))
        );
    }

    public function getFormattedTranslatedPublishedDateAttribute()
    {
        return __('Published on ') . $this->translated_published_date;
    }
}
