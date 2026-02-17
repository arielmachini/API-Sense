<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\MetricCategoriesView;

/**
 * Controller for handling Metrics.
 * @see \App\Models\Metric
 */
class MetricController extends Controller {
    public static function index() {
        return Metric::all();
    }

    /**
     * Returns a collection containing only the ID and name of the metrics
     * alongside their respective usability attributes and REST API components.
     * This method was meant to be used to build the side menu of the
     * assessment page, as this only requires IDs and names.
     */
    public static function getMetricsAndCategories() {
        return MetricCategoriesView::all();
    }
}
