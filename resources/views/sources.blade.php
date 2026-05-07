<?php use App\Constants; ?>

<x-layout pageTitle="Sources">
    <div class="row">
        <div class="col">
            <table class="table table-hover table-striped" id="sources-table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Source</th>
                        <th class="text-center" scope="col">Type</th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach ($sources as $source)
                    <tr id="{{ $source->ID }}">
                        <th class="text-center" scope="row">{{ $source->ID }}</th>
                        <td class="text-justify" style="font-size: small;">{{ $source->Description }}</td>
                        <td class="text-center">{{ $source->Type }}</td>
                    </tr>
                <!-- $source->usabilityAttributes() ToDo: Investigar -->
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

<script type="text/javascript">
    const sourcesTable = document.getElementById("sources-table");
    const sources = sourcesTable.querySelectorAll('td:nth-of-type(1)');

    /* Replace URLs in plain text with clickable links. */
    /* ToDo: Fix. I think that Laravel fills the table contents *after* this JS function executes. Execute the JS code after the table contents change, or check if Laravel supports "lazy loading" the table contents. */
    sources.forEach(function(source) {
        $(source).html($(source).html().replace(/((http:|https:)[^\s]+[\w])/g, '<a href="$1" target="_blank">$1</a>'));
    });
</script>