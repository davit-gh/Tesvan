<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectObjective extends Model
{
    protected $table = 'project_objectives';

    public function getTranslatedObjectiveAttribute()
            {
                if (app()->getLocale() === 'en') {
                    return $this->objective;
                }

                return $this->{"objective_" . app()->getLocale()};
            }
}
