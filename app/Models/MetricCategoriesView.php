<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **METRIC CATEGORIES CLASS:**  
 * This Eloquent model class is used to access a MySQL view. This view contains
 * the IDs and names of the metrics from our usability model alongside their
 * respective usability attributes and REST API components.
 * @see \App\Models\Metric
 * @see \App\Models\Attribute
 * @see \App\Models\Component
 */
class MetricCategoriesView extends Model {
    protected $table = Constants::GQM_VIEW_METRIC_CATEGORIES;
    protected $primaryKey = 'ID';

    public function metric() { // TODO: Test if this relationship works.
        return belongsTo(Metric::class, Constants::GQM_TABLE_METRIC);
    }
}
