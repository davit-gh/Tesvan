<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $table = 'projects';

    public static function getList(){
    	$data = static::select('projects.id','projects.project_name','projects.project_logo')->orderBy("id","desc")
    	->get();
    	return $data;
    }

    public function getTranslatedOverviewAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->project_overview;
            }

            return $this->{"project_overview_" . app()->getLocale()};
        }
    public function getTranslatedMetaDescriptionAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->meta_description;
            }

            return $this->{"meta_description_" . app()->getLocale()};
        }
    public function getTranslatedChallengeAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->project_challenge;
            }

            return $this->{"project_challenge_" . app()->getLocale()};
        }
    public function getTranslatedSolutionAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->project_solution;
            }

            return $this->{"project_solution_" . app()->getLocale()};
        }
    public function getTranslatedResultDescAttribute()
        {
            if (app()->getLocale() === 'en') {
                return $this->project_result_desc;
            }

            return $this->{"project_result_desc_" . app()->getLocale()};
        }

    public static function getDetail($id){
    	$data = static::select(
    		'projects.id',
    		'projects.meta_title',
    		'projects.meta_description',
    		'projects.meta_description_am',
    		'projects.meta_description_ru',
    		'projects.project_logo_alt_description',
    		'projects.project_overview',
    		'projects.project_overview_am',
    		'projects.project_overview_ru',
    		'projects.project_challenge',
    		'projects.project_challenge_am',
    		'projects.project_challenge_ru',
    		'projects.project_solution',
    		'projects.project_solution_am',
    		'projects.project_solution_ru',
    	)
    	->where('projects.id',$id)->first();
    	return $data;
    }
    public static function getUrl(){
    	$data = static::select(

            'projects.url_slug',
    	)->first();
    	return $data;
    }

}
