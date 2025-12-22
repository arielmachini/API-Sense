<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **METRIC CLASS:**  
 * This Eloquent model class represents **a metric** from our usability model.  
 * Metrics are the third and last level (also known as the
 * *quantitative level*) of a *Goal-Question-Metric* (GQM) model, and in this
 * case can be used to score certain properties of a web API.
 * @see \App\Models\Goal
 * @see \App\Models\Question
 */
class Metric extends Model {
    protected $table = Constants::GQM_TABLE_METRIC;
    protected $primaryKey = 'ID';

    /**
     * Since usability attributes are **not** directly linked to metrics
     * (because of how the usability model was defined, they are linked to
     * *goals*), this method facilitates access to those usability attributes
     * related to the goal(s) from which a specific metric comes from.
     * @return array List of usability attributes (only their names) related to
     * the metric.
     * @see \App\Models\Attribute
     */
    public function getUsabilityAttributes() {
        $metricUsabilityAttributes = [];

        foreach ($this->questions as $question) {
            $goal = $question->goal;
            $goalUsabilityAttributes = $goal->usabilityAttributes;

            foreach ($goalUsabilityAttributes as $goalUsabilityAttribute) {
                if (!in_array($goalUsabilityAttribute['Name'], $metricUsabilityAttributes)) {
                    $metricUsabilityAttributes[] = $goalUsabilityAttribute['Name'];
                }
            }
        }

        return $metricUsabilityAttributes;
    }

    /** @see \App\Models\Component */
    public function components() {
        return $this->belongsToMany(Component::class, Constants::GQM_TABLE_METRIC_COMPONENT, 'MetricID', 'ComponentID');
    }

    /** @see \App\Models\Question */
    public function questions() {
        return $this->belongsToMany(Question::class, Constants::GQM_TABLE_QUESTION_METRIC, 'MetricID', 'QuestionID');
    }

    /** @see \App\Models\Source */
    public function sources() {
        return $this->belongsToMany(Source::class, Constants::GQM_TABLE_METRIC_SOURCE, 'MetricID', 'SourceID');
    }
}
