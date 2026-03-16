<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Controllers\Controller;
use App\Models\Metric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class MetricAssessmentController extends Controller {
    public function viewMetricAssessment(Metric $metric) {
        $userProgress = Cookie::get('user_progress') ?? null;

        if (!empty($userProgress)) {
            $userProgress = gzuncompress($userProgress);
            $userProgress = json_decode($userProgress, true);
        }

        return view('assessment.assess')
            ->with('metric', $metric)
            ->with('userProgress', $userProgress);
    }

    public function updateMetricWithRequest(Metric $metric, Request $request) {
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

        $userProgress = $this->updateUserProgressCookie($metric['ID'], $request['valueForMetric'], false);

        return view('assessment.assess')
            ->with('metric', $metric)
            ->with('userProgress', $userProgress)
            ->with('valueUpdated', true);
    }

    public function updateMetricWithValue(Metric $metric, int $valueForMetric, bool $wasAutofilled) {
        /* Validate the user-provided value */
        $possibleValues = array_keys(json_decode($metric['ValueList'], true));

        if (!empty($metric['NotApplicableIf'])) {
            $possibleValues[] = 'NA';
        }

        if (!in_array($valueForMetric, $possibleValues)) {
            return;
        }

        $this->updateUserProgressCookie($metric['ID'], $valueForMetric, $wasAutofilled);
    }

    private function updateUserProgressCookie(int $metricId, int $valueForMetric, bool $wasAutofilled) {
        /* Update the user progress cookie */
        $userProgress = Cookie::get('user_progress') ?? null;

        if (!empty($userProgress)) {
            $userProgress = gzuncompress($userProgress);
            $userProgress = json_decode($userProgress, true);

            $userProgress[$metricId] = [
                'value' => $valueForMetric,
                'autofilled' => $wasAutofilled
            ];
        } else {
            $userProgress = [
                $metricId => [
                    'value' => $valueForMetric,
                    'autofilled' => $wasAutofilled
                ]
            ];
        }

        $userProgressCookie = json_encode($userProgress);
        $userProgressCookie = gzcompress($userProgressCookie, 9);

        Cookie::queue(
            'user_progress',
            $userProgressCookie,
            time() + 60 * 60 * 24 * 400, // 400 days. "Forever", according to Laravel docs.
            httponly: true
        );

        return $userProgress;
    }
}
