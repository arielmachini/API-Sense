<?php
use App\Constants;
?>

<x-layout pageTitle="{{ Constants::TITLE_ASSESSMENT_PAGE }}">
    <x-assessment-menu/>

    <div class="row">
        <div class="col">
            <p class="mb-4 me-4 text-justify">
                In this page, you can upload the OpenAPI specification of your web API to automate some of the measurements needed to obtain a usability score. <strong>Please note that:</strong>
            </p>
            <ul>
                <li>
                    The specification must be in JSON format, and must be valid.
                </li>
                <li>
                    Only a limited number of (objective) metrics can be automatically measured with an specification.
                </li>
            </ul>
        </div>
        <div class="col-2">
            <a href="https://www.openapis.org/what-is-openapi" target="_blank"><img class="img-fluid mb-4" src="/{{ Constants::URL_ICON_OPENAPI }}"></a>
        </div>
    </div>
</x-layout>

<script src="{{ asset(Constants::FOLDER_JS . 'assessment-remember-scrollbars.js') }}"></script>