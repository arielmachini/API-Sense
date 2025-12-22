<?php

namespace App\Http\Controllers;

use App\Models\Metric;

class MetricController extends Controller {
    public static function index() {
        return Metric::all();
    }

    /**
     * Returns a collection containing **only** the ID and name of the metrics.
     * This method was meant to be used to build the side menu of the
     * assessment page, as this only requires IDs and names.
     */
    public static function getListOfMetrics() {
        return Metric::select('id', 'name')->orderBy('id')->get();
    }
}
