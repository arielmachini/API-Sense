<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **GOAL CLASS:**  
 * This Eloquent model class represents **a goal** from our usability model.  
 * Goals are the first level (also known as the *conceptual level*) of a
 * *Goal-Question-Metric* (GQM) model.
 * @see \App\Models\Question
 * @see \App\Models\Metric
 */
class Goal extends Model {
    protected $table = Constants::GQM_TABLE_GOAL;
    protected $primaryKey = 'ID';

    /** @see \App\Models\Attribute */
    public function usabilityAttributes() {
        return $this->belongsToMany(Attribute::class, Constants::GQM_TABLE_GOAL_ATTRIBUTE, 'GoalID', 'AttributeID');
    }

    /** @see \App\Models\Question */
    public function questions() {
        return $this->hasMany(Question::class, 'GoalID');
    }
}
