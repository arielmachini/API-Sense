<?php use App\Constants; ?>

<x-layout pageTitle="{{ Constants::TITLE_RESTORE_PAGE }}">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <i class="bi bi-exclamation-triangle-fill pe-2"></i>You must enter a valid evaluation code.
            </div>
        @endif

        <p class="mb-4 text-justify">
            Please enter your <span class="fw-bold text-info" data-bs-placement="bottom" data-bs-title="When you saved your progress, you received an UUID: This is the code you have to enter in this page" data-bs-toggle="tooltip" style="cursor: help;">evaluation code<i class="bi bi-patch-question-fill ps-1"></i></span> to restore your progress.
        </p>

        <form action="/{{ Constants::ROUTE_RESTORE }}" method="POST" style="max-width: 70%;">
            @csrf
            
            <input class="form-control form-control-lg mb-3" id="code" maxlength="36" name="code" required type="text" value="{{ old('code') }}"> <!-- The length of a UUID is 36 characters. -->
            
            <button class="btn btn-lg btn-primary" type="submit">Restore progress</button>
        </form>
    </div>
</x-layout>

<script type="text/javascript">
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>