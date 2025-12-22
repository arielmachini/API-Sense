<?php

namespace App\Http\Controllers\Assessment;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Metric;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MetricAssessmentController extends Controller {
    public function viewMetricAssessment(Metric $metric) {
        $userProgress = $_COOKIE['user_progress'] ?? null;

        if (!empty($userProgress)) {
            $userProgress = gzuncompress($userProgress);
            $userProgress = json_decode($userProgress, true);
        }

        return view('assessment.assess')
            ->with('metric', $metric)
            ->with('userProgress', $userProgress);
    }

    public function updateMetric(Metric $metric, Request $request) {
        /* Validate the user-provided value */
        $possibleValues = array_keys(json_decode($metric['ValueList'], true));

        if (!empty($metric['NotApplicableIf'])) {
            $possibleValues[] = 'NA';
        }

        $request->validate([
            'valueForMetric' => [
                'required',
                Rule::in($possibleValues)
            ]
        ]);

        /* Update the user progress cookie */
        $userProgress = $_COOKIE['user_progress'] ?? null;

        if (!empty($userProgress)) {
            $userProgress = gzuncompress($userProgress);
            $userProgress = json_decode($userProgress, true);

            $userProgress[$metric['ID']] = [
                'value' => $request['valueForMetric'],
                'autofilled' => false
            ];
        } else {
            $userProgress = array($metric['ID'] => [
                'value' => $request['valueForMetric'],
                'autofilled' => false
            ]);
        }

        $userProgressCookie = json_encode($userProgress);
        $userProgressCookie = gzcompress($userProgressCookie, 9);

        setcookie(
            'user_progress',
            $userProgressCookie,
            time() + 60 * 60 * 24 * 400, // 400 days. "Forever", according to Laravel docs.
            path: '/' . Constants::ROUTE_ASSESSMENT,
            httponly: true
        );

        return view('assessment.assess')
            ->with('metric', $metric)
            ->with('userProgress', $userProgress)
            ->with('valueUpdated', true);
    }
}
