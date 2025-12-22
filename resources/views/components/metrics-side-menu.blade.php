@props(['currentMetricID', 'userProgress'])

<?php
use App\Constants;
use App\Http\Controllers\MetricController;

$listOfMetrics = MetricController::getListOfMetrics();
?>

<div class="border-end border-light-subtle col-3 me-3 small" id="side-menu" style="max-height: 1000px; overflow: scroll;">
    <ul class="flex-column nav nav-pills">
    @foreach ($listOfMetrics as $metric)
        <li class="nav-item">
            <a {!! $metric['id'] == $currentMetricID ? 'aria-current="page"' : '' !!} class="{{ $metric['id'] == $currentMetricID ? 'active fw-bold' : '' }} nav-link" href="/{{ Constants::ROUTE_ASSESSMENT }}/{{ $metric['id'] }}" style="--bs-nav-pills-link-active-color: var(--text-secondary-emphasis); --bs-nav-pills-link-active-bg: #F8F9FA;"> {{-- The Bootstrap class "btn-light" uses #F8F9FA for background color. --}}
                {!! isset($userProgress[$metric['id']]) ? '<i class="bi bi-check-lg text-success"></i>' : '' !!}
                #{{ $metric['id'] }} {{$metric['name'] }}
            </a>
        </li>
    @endforeach
    </ul>
</div>