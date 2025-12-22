<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **QUESTION CLASS:**  
 * This Eloquent model class represents **a question** from our usability
 * model.  
 * Questions are the second level (also known as the *operational level*) of a
 * *Goal-Question-Metric* (GQM) model.
 * @see \App\Models\Goal
 * @see \App\Models\Metric
 */
class Question extends Model {
    protected $table = Constants::GQM_TABLE_QUESTION;
    protected $primaryKey = 'ID';

    /** @see \App\Models\Goal */
    public function goal() {
        return $this->belongsTo(Goal::class, 'GoalID', 'ID');
    }

    /** @see \App\Models\Metric */
    public function metrics() {
        return $this->belongsToMany(Metric::class, Constants::GQM_TABLE_QUESTION_METRIC, 'QuestionID', 'MetricID');
    }
}
