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
        return slug(str_replace('-', '~', $this->title));
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

    public function getMetaDescriptionAttribute()
    {
        $description = $this->translated_description;
        // remove special tags
        $imgRegex = '(<img[^>]+\>)';
        $tableRegex = '(\<table\ .+\>.+\<\/table\>)';
        $olRegex = '(\<ol\>.+\<\/ol\>)';
        $ulRegex = '(\<ul\>.+\<\/ul\>)';
        $description = trim(preg_replace("/{$imgRegex}|{$tableRegex}|{$olRegex}|{$ulRegex}/i", '', $description));
        // remove special tags

        $description = strip_tags($description);
        $description = html_entity_decode($description, ENT_QUOTES, "UTF-8");

        if (str_starts_with('Content', $description)) {
            $description = str_replace('Content', '', $description, 1);
        }

        return mb_substr($description, 0, 160) . '...';
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
