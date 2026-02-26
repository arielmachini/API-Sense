@props(['currentMetricID', 'userProgress'])

<?php
use App\Constants;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\MetricController;

$listOfMetrics = MetricController::getMetricsAndCategories();

$listOfAttributes = AttributeController::index();
$listOfComponents = ComponentController::index();
?>

<div class="border-end border-light-subtle col-3 me-3 small" id="side-menu" style="max-height: 1000px; overflow: scroll;">
    <div class="mb-3">
        <a aria-controls="groupingCollapse" aria-expanded="false" class="text-end" data-bs-toggle="collapse" href="#groupingCollapse" role="button">
            <p class="fw-bold small">Grouping<i class="bi bi-gear-fill ms-2"></i></p>
        </a>

        <div class="bg-light border-bottom border-light-subtle collapse p-2 rounded-3" id="groupingCollapse">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="groupMetricsBy" id="noGrouping" checked>
                <label class="form-check-label" for="noGrouping">
                    No grouping
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="groupMetricsBy" id="groupByAttribute">
                <label class="form-check-label" for="groupByAttribute">
                    By usability attribute
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="groupMetricsBy" id="groupByComponent">
                <label class="form-check-label" for="groupByComponent">
                    By API component
                </label>
            </div>
        </div>
    </div>

    <ul class="flex-column nav nav-pills" id="metricsNoGrouping">
    @foreach ($listOfMetrics as $metric)
        <li class="nav-item">
            <a {!! $metric['ID'] == $currentMetricID ? 'aria-current="page"' : '' !!} class="{{ $metric['ID'] == $currentMetricID ? 'active fw-bold' : '' }} nav-link" href="/{{ Constants::ROUTE_ASSESSMENT }}/{{ $metric['ID'] }}" style="--bs-nav-pills-link-active-color: var(--text-secondary-emphasis); --bs-nav-pills-link-active-bg: #F8F9FA;"> {{-- The Bootstrap class "btn-light" uses #F8F9FA for background color. --}}
                {!! isset($userProgress[$metric['ID']]) ? '<i class="bi bi-check-lg text-success"></i>' : '' !!}
                {{ $metric['Name'] }}
            </a>
        </li>
    @endforeach
    </ul>

    <div class="d-none" id="metricsByAttribute">
    @foreach ($listOfAttributes as $attribute)
        <p class="bg-dark bg-gradient fw-bold p-2 rounded text-light">{{ $attribute['Name'] }}</p>
        <ul class="flex-column nav nav-pills mb-3">
        @foreach ($listOfMetrics as $metric)
            @if (in_array($attribute['Name'], str_getcsv($metric['Usability_Attributes'])))
                <li class="nav-item">
                    <a {!! $metric['ID'] == $currentMetricID ? 'aria-current="page"' : '' !!} class="{{ $metric['ID'] == $currentMetricID ? 'active fw-bold' : '' }} nav-link" href="/{{ Constants::ROUTE_ASSESSMENT }}/{{ $metric['ID'] }}" style="--bs-nav-pills-link-active-color: var(--text-secondary-emphasis); --bs-nav-pills-link-active-bg: #F8F9FA;">
                        {!! isset($userProgress[$metric['ID']]) ? '<i class="bi bi-check-lg text-success"></i>' : '' !!}
                        {{ $metric['Name'] }}
                    </a>
                </li>
            @endif
        @endforeach
        </ul>
    @endforeach
    </div>
    
    <div class="d-none" id="metricsByComponent">
    @foreach ($listOfComponents as $component)
        @if ($component['ParentComponent'] === null)
            <p class="bg-dark bg-gradient fw-bold p-2 rounded text-light">{{ $component['Name'] }}</p>
            <ul class="flex-column nav nav-pills">
            @foreach ($listOfMetrics as $metric)
                @if (in_array($component['Name'], str_getcsv($metric['REST_Components'])))
                    <li class="nav-item">
                        <a {!! $metric['ID'] == $currentMetricID ? 'aria-current="page"' : '' !!} class="{{ $metric['ID'] == $currentMetricID ? 'active fw-bold' : '' }} nav-link" href="/{{ Constants::ROUTE_ASSESSMENT }}/{{ $metric['ID'] }}" style="--bs-nav-pills-link-active-color: var(--text-secondary-emphasis); --bs-nav-pills-link-active-bg: #F8F9FA;">
                            {!! isset($userProgress[$metric['ID']]) ? '<i class="bi bi-check-lg text-success"></i>' : '' !!}
                            {{ $metric['Name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
            </ul>
        @endif
    @endforeach
    </div>
</div>

<script type="text/javascript">
    const metricsMenuNoGrouping = document.getElementById('metricsNoGrouping');
    const metricsMenuByAttribute = document.getElementById('metricsByAttribute');
    const metricsMenuByComponent = document.getElementById('metricsByComponent');

    const groupByRadios = document.querySelectorAll('#groupingCollapse input[type="radio"]');

    function groupMetricsNoGrouping() {
        groupByRadios[0].checked = true;
        groupByRadios[1].checked = false;
        groupByRadios[2].checked = false;

        metricsMenuNoGrouping.classList.remove('d-none');
        metricsMenuByAttribute.classList.add('d-none');
        metricsMenuByComponent.classList.add('d-none');
    }

    function groupMetricsByAttribute() {
        groupByRadios[0].checked = false;
        groupByRadios[1].checked = true;
        groupByRadios[2].checked = false;

        metricsMenuNoGrouping.classList.add('d-none');
        metricsMenuByAttribute.classList.remove('d-none');
        metricsMenuByComponent.classList.add('d-none');
    }

    function groupMetricsByComponent() {
        groupByRadios[0].checked = false;
        groupByRadios[1].checked = false;
        groupByRadios[2].checked = true;

        metricsMenuNoGrouping.classList.add('d-none');
        metricsMenuByAttribute.classList.add('d-none');
        metricsMenuByComponent.classList.remove('d-none');
    }

    if (document.cookie.includes('groupingPreference=')) { // This block of code restores the user's preference for grouping metrics.
        let groupingPreference = document.cookie.split('; ')
            .find((cookie) => cookie.startsWith('groupingPreference=')) // Find the cookie...
            ?.split('=')[1]; // ...and retrieve its value.

        switch (groupingPreference) {
            case 'noGrouping':
                groupMetricsNoGrouping();

                break;
            case 'groupByAttribute':
                groupMetricsByAttribute();

                break;
            case 'groupByComponent':
                groupMetricsByComponent();

                break;
            default:
                groupMetricsNoGrouping();

                document.cookie = 'groupingPreference=noGrouping; /{{ Constants::ROUTE_ASSESSMENT }}';

                break;
        }
    }

    groupByRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const radioButtonName = this.getAttribute('id');

            if (radioButtonName == 'noGrouping') {
                groupMetricsNoGrouping();

                document.cookie = 'groupingPreference=noGrouping; /{{ Constants::ROUTE_ASSESSMENT }}';
            } else if (radioButtonName == 'groupByAttribute') {
                groupMetricsByAttribute();

                document.cookie = 'groupingPreference=groupByAttribute; /{{ Constants::ROUTE_ASSESSMENT }}';
            } else if (radioButtonName == 'groupByComponent') {
                groupMetricsByComponent();

                document.cookie = 'groupingPreference=groupByComponent; /{{ Constants::ROUTE_ASSESSMENT }}';
            }
        });
    });
</script>