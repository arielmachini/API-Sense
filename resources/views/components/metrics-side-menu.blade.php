@props(['currentMetricID', 'userProgress'])

<?php
use App\Constants;
use App\Http\Controllers\MetricController;

$listOfMetrics = MetricController::getListOfMetrics();
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
            <a {!! $metric['id'] == $currentMetricID ? 'aria-current="page"' : '' !!} class="{{ $metric['id'] == $currentMetricID ? 'active fw-bold' : '' }} nav-link" href="/{{ Constants::ROUTE_ASSESSMENT }}/{{ $metric['id'] }}" style="--bs-nav-pills-link-active-color: var(--text-secondary-emphasis); --bs-nav-pills-link-active-bg: #F8F9FA;"> {{-- The Bootstrap class "btn-light" uses #F8F9FA for background color. --}}
                {!! isset($userProgress[$metric['id']]) ? '<i class="bi bi-check-lg text-success"></i>' : '' !!}
                #{{ $metric['id'] }} {{$metric['name'] }}
            </a>
        </li>
    @endforeach
    </ul>

    <ul class="d-none flex-column nav nav-pills" id="metricsByAttribute">
    @foreach ($listOfMetrics as $metric)
    @endforeach
    </ul>
    
    <ul class="d-none flex-column nav nav-pills" id="metricsByComponent">
    @foreach ($listOfMetrics as $metric)
    @endforeach
    </ul>
</div>

<script type="text/javascript">
    const groupByRadios = document.querySelectorAll('#groupingCollapse input[type="radio"]');

    groupByRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const radioButtonName = this.getAttribute('id');

            const metricsMenuNoGrouping = document.getElementById('metricsNoGrouping');
            const metricsMenuByAttribute = document.getElementById('metricsByAttribute');
            const metricsMenuByComponent = document.getElementById('metricsByComponent');

            if (radioButtonName == 'noGrouping') {
                metricsMenuNoGrouping.classList.remove('d-none');
                metricsMenuByAttribute.classList.add('d-none');
                metricsMenuByComponent.classList.add('d-none');
            } else if (radioButtonName == 'groupByAttribute') {
                metricsMenuNoGrouping.classList.add('d-none');
                metricsMenuByAttribute.classList.remove('d-none');
                metricsMenuByComponent.classList.add('d-none');
            } else if (radioButtonName == 'groupByComponent') {
                metricsMenuNoGrouping.classList.add('d-none');
                metricsMenuByAttribute.classList.add('d-none');
                metricsMenuByComponent.classList.remove('d-none');
            }
        });
    });
</script>