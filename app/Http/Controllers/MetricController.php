<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Assessment\MetricAssessmentController;
use App\Models\Metric;
use App\Models\MetricCategoriesView;
use cebe\openapi\spec\OpenApi;

/**
 * Controller for handling Metrics.
 * @see \App\Models\Metric
 */
class MetricController extends Controller {
    public static function index() {
        return Metric::all();
    }

    public static function findByName($name) {
        return Metric::where('Name', '=', $name)->first();
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

    /* --- AUTOMATIC ASSESSMENT FUNCTIONS --- */
    public static function assessAvgURLsPerResource(OpenApi $userProvidedOAS): bool {
        $metric = MetricController::findByName('Average base URLs per resource'); // Fetch the assessed metric by name.

        $pathDepthCounts = [];

        foreach ($userProvidedOAS->paths as $path => $pathItem) {
            $explodedPath = explode('\/', $path);
            $pathDepth = count($explodedPath);

            if (preg_match('/^v\d+(\.\d+)*$/i', $explodedPath[0])) { // Excludes versioning (if present) from the path length. The character ^ means "at the start of the string", v matches the character "v" (case insensitive), \d+ means "one or more digits", \. matches the character ".", * means "zero or more", and $ means "at the end of the string".
                $pathDepth -= 1;
            }

            $pathDepthCounts[] = $pathDepth;
        }

        $averagePathDepth = array_sum($pathDepthCounts) / count($pathDepthCounts);

        /* Determine the value for the metric */
        if ($averagePathDepth <= 2) {
            $metricValue = 1;
        } else if ($averagePathDepth == 3) {
            $metricValue = 0.5;
        } else { // > 3.
            $metricValue = 0;
        }

        (new MetricAssessmentController())->updateMetricWithValue($metric, $metricValue, true);

        return true;
    }

    public static function assessAvgNumberOfParameters(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessConsistencyOfParameterTypes(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessDocumentationOfEndpoints(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessDocumentationOfHTTPMethods(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessEndpointGroupingByFunctionality(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessIdentificationOfRequiredParameters(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessIdentificationOfRequiredPropertiesInResponses(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessInclusionOfAuthenticationInformation(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessInclusionOfErrorInformation(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessInclusionOfUsageExamples(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessJSONSupport(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessOAuthUsage(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessSpecificationUsage(): bool {
        // Set value for metric to 1.

        return true;
    }

    public static function assessSimilarityOfEndpointNames(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessSpecificityOfStatusCodes(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessUsageOfComponents(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessUsageOfFormatsOrPatterns(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessUsageOfVerbsInBaseURLs(OpenApi $userProvidedOAS): bool {
        return true;
    }

    public static function assessVersioning(OpenApi $userProvidedOAS): bool {
        return true;
    }
}
