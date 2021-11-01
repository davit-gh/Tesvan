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
        $dateIndex = str_replace("0","",date("m", strtotime($this->published_date)));

        if (app()->getLocale() === 'en') {
            return date("M d, Y", strtotime($this->published_date));
        } elseif (app()->getLocale() === 'ru') {
            return  str_replace("0","",date("d", strtotime($this->published_date)))." ".$months['ru'][$dateIndex]." ".date("Y", strtotime($this->published_date))." r.";
        } elseif (app()->getLocale() === 'am') {
            return date("M d, Y", strtotime($this->published_date));
        }

    }

    public function getFormattedTranslatedPublishedDateAttribute()
    {
        return __('Published on ') . $this->translated_published_date;
    }
}
