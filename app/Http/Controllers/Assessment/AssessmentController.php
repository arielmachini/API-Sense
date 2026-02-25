<?php

namespace App\Http\Controllers\Assessment;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadOASRequest;
use App\Models\Assessment;
use App\Rules\ValidOAS;
use cebe\openapi\Reader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

/**
 * Controller for handling usability assessments.
 */
class AssessmentController extends Controller {
    public function loadAssessment(Request $request) {
        if ($request->code) {
            $recoveredAssessment = Assessment::findOr(
                $request->code,
                'code',
                redirect('/assessment/1') // If the provided UUID does not match with any of the stored assessments, start a new assessment.
            );

            session()->put('userProgress', json_encode($recoveredAssessment->json)); // CHANGE THIS TO DIVIDE IN PARTS
        } else {
            return redirect('/assessment/1');
        }
    }

    /* --- VIEW FUNCTIONS --- */
    public function viewEnd() {
        return view('assessment.close')
            ->with('progressMade', $this->getCurrentUserProgress());
    }

    public function viewSave() {
        return view('assessment.save')
            ->with('progressMade', $this->getCurrentUserProgress());
    }

    public function viewScore() {
        return view('assessment.score')
            ->with('progressMade', $this->getCurrentUserProgress());
    }

    public function viewUploadOAS() {
        return view('assessment.upload')
            ->with('progressMade', $this->getCurrentUserProgress());
    }

    /* --- OPERATIONAL FUNCTIONS --- */
    public function endAssessment(Request $request) {
        setcookie(
            'user_progress',
            NULL,
            time() - 3600,
            path: '/' . Constants::ROUTE_ASSESSMENT,
            httponly: true
        );

        unset($_SESSION['OAS']);

        return redirect('/assessment/1');
    }

    public function saveAssessment(Request $request) {
        // Validate input and save assessment to database.
        // if assessment exists updatefunction
    }

    public function deleteOAS() {
        unset($_SESSION['OAS']);

        return view('assessment.assess')
            ->with('progressMade', $this->getCurrentUserProgress());
    }

    public function uploadOAS(UploadOASRequest $request) {
        $uploadedOAS = $request->validated()['OAS'];
        
        $uploadedOAS = $uploadedOAS === 'json' ? Reader::readFromJsonFile($uploadedOAS) : Reader::readFromYamlFile($uploadedOAS);

        session()->put('OAS', $uploadedOAS);

        return view('assessment.upload')
            ->with('progressMade', $this->getCurrentUserProgress());
    }

    /* --- PRIVATE FUNCTIONS --- */
    private function updateAssessment($uuid) {
        // Update only the date and JSON code of the row in the database.
    }

    private function getCurrentUserProgress() {
        $userProgress = $_COOKIE['user_progress'] ?? null;
        $progressMade = 0;

        if (!empty($userProgress)) {
            $userProgress = gzuncompress($userProgress);
            $userProgress = json_decode($userProgress, true);

            $progressMade = count($userProgress) * 100 / 45; // Note: 45 is the total number of metrics.
        }

        return $progressMade;
    }
}
