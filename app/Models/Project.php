<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $table = 'projects';

    public static function getList(){
    	$data = static::
    	join('project_objectives','project_objectives.project_id','=','projects.id')
    	->join('project_results','project_results.project_id','=','projects.id')
    	->join('technology_tools','technology_tools.project_id','=','projects.id')
    	->join('client_feedbacks','client_feedbacks.project_id','=','projects.id')
    	->select('projects.id','projects.project_name','projects.project_logo')
    	->get();
    	return $data;
    }

    public static function getDetail($id){
    	$data = static::select(
    		'projects.id',
    		'projects.project_overview',
    		'projects.project_challenge',
    		'projects.project_solution'
    	)
    	->where('projects.id',$id)->first();
    	return $data;
    }

}
