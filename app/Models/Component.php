<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Model;

/**
 * **COMPONENT CLASS:**  
 * This Eloquent model class represents **a REST API component**, which is
 * associated to one or more metrics from our usability model.
 * @see https://blog.postman.com/what-are-the-components-of-an-api
 */
class Component extends Model {
    protected $table = Constants::GQM_TABLE_COMPONENT;
    protected $primaryKey = 'ID';

    /** @see \App\Models\Metric */
    public function metrics() {
        return $this->belongsToMany(Metric::class, Constants::GQM_TABLE_METRIC_COMPONENT, 'ComponentID', 'MetricID');
    }

    /**
     * @return \App\Models\Component|null The component's parent component, or `null` if the
     * component does not have a parent component.
     */
    public function parentComponent() {
        return $this->hasOne(Component::class, 'ID', 'ParentComponentID');
    }
}
