<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use App\Models\ClientFeedback;
use Intervention\Image\ImageManagerStatic as Image;

class DummyTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $width = 200;
        $height = 200;
            
        DB::table("project_objectives")->where("id",">",0)->delete();
        DB::table("project_results")->where("id",">",0)->delete();
        DB::table("technology_tools")->where("id",">",0)->delete();
        DB::table("client_feedbacks")->where("id",">",0)->delete();
        DB::table("projects")->where("id",">",0)->delete();

        $pathImage = public_path()."/test.jpg";
        //$defImage = 'https://pilariu.com/storage/2020/12/Google-Office.jpg';
        //file_put_contents($pathImage, file_get_contents($defImage));

        for ($i=0; $i <= 1000; $i++) { 
        	$p = new Project;
            $p->project_name = "Project Get ".$i;
            $p->project_logo = "";
            $p->project_overview = "Overview generator ".$i;
            $p->project_challenge = "Project challange generator".$i;
            $p->project_solution = "Project solution".$i;
            $p->project_objective_desc = "Project Objective Description".$i;
            $p->project_result_desc = "Project Result Description".$i;
            $p->project_twu_desc = "Technology Tool Description".$i;
            $p->project_cf_desc = "Client Feedback Description".$i;
            $p->other_case = "Other Case Description".$i;
            $p->user_id = 1;
            $p->save();

            $path = 'uploads/images/project/logo/'.$p->id;
	        $dir_upload = public_path($path);
	        if (!file_exists($dir_upload)) {
	            mkdir($dir_upload, 0777, true);
	        }
	        $filename = "filename_".date("YmdHis").$i.".jpg";

            $image_resize = Image::make($pathImage);              
            $image_resize->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save($dir_upload.'/resize_'.$filename);

            copy($pathImage, $dir_upload."/".$filename);
			$p->project_logo = $filename;
			$p->save();

            $po = new ProjectObjective;
            $po->objective = "Objective Generator".$i;
            $po->project_id = $p->id;
            $po->save();
            $pr = new ProjectResult;
            $pr->result = "Result Generator".$i;
            $pr->project_id = $p->id;
            $pr->save();

            $tt = new TechnologyTool;
            $tt->name = "generator";
            $tt->logo = "";
            $tt->project_id = $p->id;
            $tt->save();
            $path = 'uploads/images/project/twu/'.$p->id;
	        $dir_upload = public_path($path);
	        if (!file_exists($dir_upload)) {
	            mkdir($dir_upload, 0777, true);
	        }
	        $filename = "filename_".date("YmdHis").$i.".jpg";
			copy($pathImage, $dir_upload."/".$filename);
			$tt->logo = $filename;
			$tt->save();

            $pr = new ClientFeedback;
            $pr->client_feedback = "Client Feedback Generator".$i;
            $pr->client_photo = "";
            $pr->client_name =  "Client Name Generator".$i;
            $pr->client_position = "";
            $pr->client_website = "https://www.google.com";
            $pr->project_id = $p->id;
            $pr->save();

            $path = 'uploads/images/project/cf/'.$p->id;
	        $dir_upload = public_path($path);
	        if (!file_exists($dir_upload)) {
	            mkdir($dir_upload, 0777, true);
	        }
	        $filename = "filename_".date("YmdHis").$i.".jpg";
			copy($pathImage, $dir_upload."/".$filename);
			$pr->client_photo = $filename;
			$pr->save();
		}

    }
}
