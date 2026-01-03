<?php

use App\Http\Controllers\Assessment\AssessmentController;
use App\Http\Controllers\Assessment\MetricAssessmentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/about', 'about');
Route::view('/model', 'model');
Route::view('/sources', 'sources');
Route::get('/sources/{id}', function() {
    request()->validate(
        ['id' => 'integer']
    );

    return view('sources', ['id']);
});

/* Restore progress with an evaluation code */
Route::view('/restore', 'restore');
Route::post('/restore', function() { // MAYBE CHANGE THIS? GET THE ASSESSMENT OBJECT
    request()->validate(
        ['code' => ['required', 'uuid']]
    );

    $evaluationCode = request('code');

    return to_route('loadAssessment', ['code' => $evaluationCode]);
});

Route::group(['prefix' => 'assessment'], function() {
    Route::controller(AssessmentController::class)->group(function() {
        Route::get('/', 'loadAssessment')->name('loadAssessment');

        /* Upload an OpenAPI specification */
        Route::get('/oas', 'viewUploadOAS');
        Route::post('/oas', 'uploadOAS');

        /* Save progress */
        Route::get('/save', 'viewSave');
        Route::put('/', 'saveAssessment'); // The PUT request is made to the assessment route.

        /* Discard progress */
        Route::get('/close', 'viewEnd');
        Route::post('/close', 'endAssessment'); // I chose not to use the DELETE verb on the base route because this function does not delete the user's progress.

        /* View assessment score */
        Route::get('/score', 'viewScore');
    });

    Route::controller(MetricAssessmentController::class)->group(function() {
        Route::get('/{metric}', 'viewMetricAssessment');
        Route::put('/{metric}', 'updateMetric');
    });
});