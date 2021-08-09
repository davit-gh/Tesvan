<?php

namespace App\Models;

use App\Services\EdJSParser;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $casts = [
        'published_date' => 'date',
        'description' => 'json',
        'description_am' => 'json',
        'description_ru' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(EducationCategory::class, 'education_category_id', 'id');
    }

    public function scopePublished($query)
    {
        $query->where('status', 'Publish');
    }

    public function getSlugAttribute()
    {
        return slug($this->title . ' ' . strtotime($this->created_at));
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
            return EdJSParser::parse($this->description)->toHtml();
        }

        return EdJSParser::parse($this->{"description_" . app()->getLocale()})->toHtml();
    }
}
