<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectResult extends Model
{
    protected $table = 'project_results';

    public function getTranslatedResultAttribute()
                {
                    if (app()->getLocale() === 'en') {
                        return $this->result;
                    }

                    return $this->{"result_" . app()->getLocale()};
                }

}
