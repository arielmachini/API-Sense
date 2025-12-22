<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **SOURCE CLASS:**  
 * This Eloquent model class represents **a source**. The metrics that comprise
 * our model and the usability attributes related to these metrics were
 * extracted from various sources, including scientific and gray literature
 * from the web API industry.
 */
class Source extends Model {
    protected $table = Constants::GQM_TABLE_SOURCE;
    protected $primaryKey = 'ID';
    
    /** @see \App\Models\Attribute */
    public function usabilityAttributes() {
        return $this->belongsToMany(Attribute::class, Constants::GQM_TABLE_ATTRIBUTE_SOURCE, 'SourceID', 'AttributeID');
    }

    /** @see \App\Models\Metric */
    public function metrics() {
        return $this->belongsToMany(Metric::class, Constants::GQM_TABLE_METRIC_SOURCE, 'SourceID', 'MetricID');
    }
}
