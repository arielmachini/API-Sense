<?php
use App\Constants;

$progressMade = 0;

$valueListForMetric = json_decode($metric['ValueList'], true);
ksort($valueListForMetric);

if (!empty($userProgress)) { // Check if the user progress cookie exists.
    $progressMade = count($userProgress) * 100 / 45; // Note: 45 is the total number of metrics.

    if (isset($userProgress[$metric['ID']])) {
        $selectedValue = $userProgress[$metric['ID']]['value'];
        $wasAutofilled = $userProgress[$metric['ID']]['autofilled'];
    }
}
?>

<x-layout pageTitle="{{ Constants::TITLE_ASSESSMENT_PAGE }}">
    <x-assessment-menu :progressMade="$progressMade" />

    <div class="row">
        <x-metrics-side-menu :currentMetricID="$metric['ID']" :userProgress="$userProgress" />

        <div class="col">
            <h5 class="mb-3">
                <strong>#{{ $metric['ID'] }}</strong> {{ $metric->Name }}
                
                @if ($wasAutofilled ?? false)
                    <span class="badge ms-1 rounded-pill text-bg-secondary" title="The value for this metric was autofilled using the uploaded OpenAPI specification.">Autofilled</span>
                @endif
                
                @if (isset($selectedValue))
                    <span class="badge ms-1 rounded-pill text-bg-success">Set</span>
                @endif
            </h5>

            <div class="border-bottom border-light-subtle mb-4 pb-4 row">
                <div class="border-end border-light-subtle col" style="text-align: justify;">
                    {{ $metric['Description'] }}
                    @if ($metric['NotApplicableIf'] !== null)
                        <span class="badge rounded-pill text-bg-warning">Note</span> This metric <strong>does not apply</strong> {{ lcfirst($metric['NotApplicableIf']) }}
                    @endif
                </div>
                <div class="col-4 small text-secondary">
                    <strong>Usability attributes:</strong>
                    @foreach ($metric->getUsabilityAttributes() as $usabilityAttribute)
                        <br>- {{ $usabilityAttribute }}
                    @endforeach
                </div>
            </div>

            @if ($valueUpdated ?? false) {{-- Display an alert if the value for this metric was just updated. --}}
                <div class="alert alert-dismissible alert-info fade show small" id="alertProgressUpdated" role="alert">
                    <i class="bi bi-check-lg pe-2"></i>The value for this metric was updated successfully.
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
            @endif

            <form action="/{{ Constants::ROUTE_ASSESSMENT }}/{{ $metric['ID'] }}" method="POST">
                @csrf
                @method('PUT')

                @if ($wasAutofilled ?? false) {{-- Displays if the metric was automatically assessed (using the user-provided OAS). --}}
                    <div class="form-floating">
                        <select class="form-select mb-3" disabled required style="cursor: not-allowed;" title="The value for this metric was autofilled and cannot be changed">
                            <option selected value="{{ $selectedValue }}">
                                {{ $selectedValue }}: {{ $valueListForMetric[$selectedValue] }}
                            </option>
                        </select>
                        
                        <label for="metricAssessment">Please select the most appropriate value</label>
                    </div>
                    
                    <button class="btn btn-outline-success" disabled type="button">Set value</button>
                @else {{-- Displays if the metric was not automatically assessed (using the user-provided OAS). --}}
                    <div class="form-floating">
                        <select class="form-select mb-3" name="valueForMetric" required>
                        @foreach ($valueListForMetric as $value => $reason)
                            <option {{ ($selectedValue ?? null) == $value ? 'selected' : '' }} value="{{ $value }}">
                                {{ $value }}: {{ $reason }}
                            </option>
                        @endforeach

                        @if ($metric['NotApplicableIf'] !== null)
                            <option {{ ($selectedValue ?? null) == 'NA' ? 'selected' : '' }} value="NA">
                                None: This metric does not apply to my web API
                            </option>
                        @endif
                        </select>
                        
                        <label for="metricAssessment">Please select the most appropriate value</label>
                    </div>

                    @if (isset($selectedValue))
                        <div class="mb-4 small text-info-emphasis">
                            <i class="bi bi-info-circle"></i>
                            @if ($selectedValue == 'NA')
                                <strong>You stated that this metric does not apply to your web API</strong>
                            @else
                                <strong>Current value:</strong> {{ $valueListForMetric[$selectedValue] }}
                            @endif
                        </div>
                    @endif
                    
                    <button class="btn btn-outline-success" type="submit">Set value</button>
                @endif
            </form>
        </div>
    </div>
</x-layout>

<script src="{{ asset(Constants::FOLDER_JS . 'assessment-remember-scrollbars.js') }}"></script>