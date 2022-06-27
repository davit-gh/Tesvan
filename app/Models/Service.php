<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    protected $table = 'services';

        protected $casts = [
            'published_date' => 'date',
            'description' => 'json',
            'description_am' => 'json',
            'description_ru' => 'json',
            'meta_description' => 'json',
            'meta_description_am' => 'json',
            'meta_description_ru' => 'json',
            'approach' => 'json',
            'approach_am' => 'json',
            'approach_ru' => 'json',
            'benefit' => 'json',
            'benefit_am' => 'json',
            'benefit_ru' => 'json',
        ];

        public function category()
        {
            return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
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

        public function getTranslatedMetaTitleAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->meta_title;
            }

            return $this->{"meta_title_" . app()->getLocale()};
        }

        public function getTranslatedDescriptionAttribute()
        {
            if (app()->getLocale() === 'en') {
                return EdJSParser::parse($this->description)->toHtml();
            }

            return EdJSParser::parse($this->{"description_" . app()->getLocale()})->toHtml();
        }

        public function getTranslatedMetaDescriptionAttribute()
        {
            if (app()->getLocale() === 'en') {
                return EdJSParser::parse($this->meta_description)->toHtml();
            }

            return EdJSParser::parse($this->{"meta_description_" . app()->getLocale()})->toHtml();
        }

        public function getTranslatedApproachAttribute()
        {
            if (app()->getLocale() === 'en') {
                return EdJSParser::parse($this->approach)->toHtml();
            }

            return EdJSParser::parse($this->{"approach_" . app()->getLocale()})->toHtml();
        }

        public function getTranslatedBenefitAttribute()
        {
            if (app()->getLocale() === 'en') {
                return EdJSParser::parse($this->benefit)->toHtml();
            }

            return EdJSParser::parse($this->{"benefit_" . app()->getLocale()})->toHtml();
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

            if (str_starts_with($description, 'Content')) {
                $replaceCount = 1;
                $description = trim(str_replace('Content', '', $description, $replaceCount));
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

        public static function getDetail($id){
            	$data = static::select(
            		'services.id',
            		'services.service_faq'
            	)
            	->where('projects.id',$id)->first();
            	return $data;
            }

        public function getFormattedTranslatedPublishedDateAttribute()
        {
            return __('Published on ') . $this->translated_published_date;
        }
}
