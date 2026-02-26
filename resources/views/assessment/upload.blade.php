<?php
use App\Constants;
use cebe\openapi\spec\OpenApi;

if (session()->has('OAS')) {
    $uploadedOAS = session()->get('OAS');
}
?>

<x-layout pageTitle="{{ Constants::TITLE_ASSESSMENT_UPLOAD_OAS_PAGE }}">
    <x-assessment-menu :progressMade="$progressMade" />

    <div class="mb-4 row">
        <div class="col">
            <figure class="border-bottom border-light-subtle me-5">
                <blockquote class="blockquote">
                    <p class="text-justify text-body-secondary">
                        [An] OpenAPI Specification (OAS) provides a consistent means to carry information through each stage of the API lifecycle. It is a specification language for HTTP APIs that defines structure and syntax [regardless of] the programming language the API is created in.
                    </p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <cite style="cursor: help;" title="Source">The OpenAPI Initiative</cite>
                </figcaption>
            </figure>

            <p class="me-5 text-justify">
                In this page, you can upload the OpenAPI specification of your web API to automate some of the measurements needed to obtain a usability score. <strong>Please note that:</strong>
            </p>
            <ul>
                <li>Only versions 3.0.x of OpenAPI are supported.</li>
                <li>The specification must be in JSON or YAML format, and must be valid.</li>
                <li>Only a limited number of (objective) metrics can be automatically measured with an specification.</li>
                <li>The maximum permitted file size is 2 MB.</li>
            </ul>
        </div>
        <div class="col-2">
            <a href="https://www.openapis.org/what-is-openapi" style="cursor: help;" target="_blank"><img class="img-fluid mb-4" src="/{{ Constants::URL_ICON_OPENAPI }}"></a>
        </div>
    </div>

    @if (session()->has('OAS'))
        <div class="row border-bottom border-light-subtle mb-4">
            <div class="alert alert-success">
                <h6 class="fw-bold">You have uploaded the following OpenAPI specification:</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-info"><strong>Title:</strong> {{ $uploadedOAS->info->title }}</li>
                    <li class="list-group-item list-group-item-success"><strong>Description:</strong> {{ $uploadedOAS->info->description }}</li>
                </ul>
            </div>
        </div>
    @endif

    <div class="row">
        @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <i class="bi bi-exclamation-triangle-fill pe-2"></i>Please upload a valid OpenAPI specification file.
            </div>
        @endif

        <form action="/{{ Constants::ROUTE_ASSESSMENT_UPLOAD_OAS }}" enctype="multipart/form-data" method="POST" style="max-width: 70%;">
            @csrf

            <input class="form-control form-control-lg mb-3" id="OAS" name="OAS" required type="file">

            <button class="btn btn-lg btn-outline-success" type="submit">Upload</button>
        </form>
    </div>
</x-layout>