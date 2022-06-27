<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientFeedback extends Model
{
    protected $table = 'client_feedbacks';

    public function getTranslatedFeedbackAttribute()
            {
                if (app()->getLocale() === 'en') {
                    return $this->client_feedback;
                }

                return $this->{"client_feedback_" . app()->getLocale()};
            }
    public function getTranslatedClientNameAttribute()
            {
                if (app()->getLocale() === 'en') {
                    return $this->client_name;
                }

                return $this->{"client_name_" . app()->getLocale()};
            }
    public function getTranslatedClientPositionAttribute()
            {
                if (app()->getLocale() === 'en') {
                    return $this->client_position;
                }

                return $this->{"client_position_" . app()->getLocale()};
            }

}
