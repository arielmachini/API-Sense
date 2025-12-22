<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **ATTRIBUTE CLASS:**  
 * This Eloquent model class represents **a usability attribute**, which is
 * associated to one or more goals (and, by extension, *metrics*) from our
 * usability model.
 */
class Attribute extends Model {
    protected $table = Constants::GQM_TABLE_ATTRIBUTE;
    protected $primaryKey = 'ID';

    /** @see \App\Models\Goal */
    public function goals() {
        return $this->belongsToMany(Goal::class, Constants::GQM_TABLE_GOAL_ATTRIBUTE, 'AttributeID', 'GoalID');
    }

    /** @see \App\Models\Source */
    public function sources() {
        return $this->belongsToMany(Source::class, Constants::GQM_TABLE_ATTRIBUTE_SOURCE, 'AttributeID', 'SourceID');
    }
}
