<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\MetricCategoriesView;
use cebe\openapi\spec\OpenApi;
use SebastianBergmann\CodeUnit\FunctionUnit;

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

    /* --- AUTOMATIC ASSESSMENT FUNCTIONS --- */
    public static function assessAvgURLsPerResource(OpenApi $userProvidedOAS): bool {
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
