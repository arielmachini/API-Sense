<?php
use App\Constants;
?>

<x-layout pageTitle="{{ Constants::TITLE_ASSESSMENT_SAVE_PAGE }}">
    <x-assessment-menu :progressMade="$progressMade" />

    <div class="row">
        <p class="mb-4 text-justify">
            You can save your current progress at any point to continue your assessment later. After you save an assessment, you will receive an evaluation code which you can use to <a href="/{{ Constants::ROUTE_RESTORE }}">restore your saved progress</a>.
        </p>

        @if (empty($progressMade))
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-exclamation-triangle-fill pe-2"></i>You have not made any progress yet.
        </div>
        @else
            @if ($progressMade <= 20)
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle-fill pe-2"></i>Please assess at least ten metrics before saving your progress.
                </div>
            @else
                @if (!empty($evaluationCode)) {{-- Display an alert if the assessment progress was saved. --}}
                    <div class="alert alert-dismissible alert-success fade mb-4 show small" id="alertProgressSaved" role="alert">
                        <i class="bi bi-check-lg pe-2"></i>Your assessment progress was saved successfully. <span class="fw-bold" data-bs-placement="bottom" data-bs-title="Remember to write down this code so you can restore your progress at a later time" data-bs-toggle="tooltip" style="cursor: help;">Evaluation code<i class="bi bi-patch-question-fill pe-1 ps-1"></i>:</span> {{ $evaluationCode }}.
                        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                    </div>
                @endif

                <form action="/{{ Constants::ROUTE_ASSESSMENT }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-lg btn-outline-primary" type="submit">Save progress</button>
                </form>
                
                @if (!empty($evaluationCode))
                    <p class="fw-bold mt-3 small text-secondary"><i class="bi bi-info-circle pe-2"></i>Your current evaluation code is {{ $evaluationCode }}.</p>
                @endif
            @endif
        @endif
    </div>
</x-layout>

<script type="text/javascript">
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>