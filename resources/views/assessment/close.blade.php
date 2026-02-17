<?php
use App\Constants;
?>

<x-layout pageTitle="{{ Constants::TITLE_ASSESSMENT_END_PAGE }}">
    <x-assessment-menu :progressMade="$progressMade" />

    <div class="row">
        <p class="mb-4 text-justify">
            Closing the current assessment allows for starting a new assessment, and will discard any unsaved progress. Make sure to <a href="/{{ Constants::ROUTE_ASSESSMENT_SAVE }}">save your progress</a> if needed before closing this assessment.

            @if ($progressMade > 0)
                <form action="/{{ Constants::ROUTE_ASSESSMENT_END }}" method="POST">
                    @csrf

                    <button class="btn btn-outline-danger" type="submit">Close current assessment</button>
                </form>
            @else
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle-fill pe-2"></i>This assessment cannot be closed because you have not made any progress yet.
                </div>
            @endif
        </p>
    </div>
</x-layout>