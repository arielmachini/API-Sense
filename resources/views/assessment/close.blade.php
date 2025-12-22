<?php
use App\Constants;

$progressMade = 0;

if (!empty($userProgress)) { // Check if the user progress cookie exists.
    $progressMade = count($userProgress) * 100 / 45; // Note: 45 is the total number of metrics.
}
?>

<x-layout pageTitle="{{ Constants::TITLE_ASSESSMENT_CLOSE_PAGE }}">
    <x-assessment-menu :progressMade="$progressMade" />

    <div class="row">
        <div class="col">
            placeholder
        </div>
    </div>
</x-layout>