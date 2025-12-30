@props(['progressMade' => 0])

<?php
use App\Constants;
$progressMade = intval($progressMade);
?>

<div class="bg-light mb-4 p-4 rounded-4">
    <ul class="nav nav-pills">
        <li>
            <x-nav-link href="/{{ Constants::ROUTE_ASSESSMENT }}/1" :active="preg_match('/^' . Constants::ROUTE_ASSESSMENT . '\/\d+$/', request()->path())">
                <i class="bi bi-code pe-2"></i>Metrics
            </x-nav-link>
        </li>

        <li>
            <x-nav-link href="/{{ Constants::ROUTE_ASSESSMENT_UPLOAD_OAS }}" title="Upload the OpenAPI specification of your web API to automate measurement" :active="request()->is(Constants::ROUTE_ASSESSMENT_UPLOAD_OAS)">
                <i class="bi bi-filetype-json pe-2"></i>Upload an OAS
            </x-nav-link>
        </li>

        <li class="dropdown nav-item">
            <a aria-expanded="false" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#" role="button">
                <i class="bi bi-clipboard-fill pe-2"></i>This assessment
            </a>

            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="/{{ Constants::ROUTE_ASSESSMENT_SAVE }}">
                        <i class="bi bi-floppy-fill pe-2"></i>Save
                    </a>
                </li>

                <li {!! $progressMade < 100 ? 'style="cursor: not-allowed;" title="To view the usability score for your web API, first you have to set a value for all metrics"' : ''!!}>
                    <a class="{{ $progressMade < 100 ? 'disabled' : ''}} dropdown-item" href="/{{ Constants::ROUTE_ASSESSMENT_SCORE }}">
                        <i class="bi bi-star-fill pe-2"></i>View score
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item" href="/{{ Constants::ROUTE_ASSESSMENT_END }}">
                        <i class="bi bi-x-lg pe-2"></i>Close
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    @if ($progressMade > 0)
        <div aria-label="Current assessment progress" aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{ $progressMade }}" class="mt-4 progress shadow-sm" role="progressbar" style="cursor: help;" title="Current assessment progress">
            <div class="{{ $progressMade == 100 ? 'bg-success' : 'bg-primary' }} font-monospace fw-bold progress-bar progress-bar-striped" style="width: {{ $progressMade }}%;">
                {{ round($progressMade) }} %
            </div>
        </div>
    @endif
</div>