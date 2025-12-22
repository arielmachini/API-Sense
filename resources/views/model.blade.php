<?php use App\Constants; ?>

<x-layout pageTitle="{{ Constants::TITLE_MODEL_PAGE }}">
    <div class="mb-5 text-center">
        <a href="{{ Constants::URL_MODEL_DIAGRAM }}" style="cursor: zoom-in;" target="_blank" title="Click to open this diagram in a new tab">
            <img alt="Diagram representing our usability model." class="img-fluid" src="{{ Constants::URL_MODEL_DIAGRAM }}" style="max-width: 60%;">
        </a>
    </div>

    <h5>Notes</h5>
    <p class="mb-4 text-justify">
        Next to each metric's name, there is a set of parentheses enclosing a letter. According to the authors of the GQM model [<a href="/{{Constants::ROUTE_SOURCES }}#1" target="_blank">1</a>]:
    </p>
    <ul>
        <li>
            <strong>(O)bjective:</strong> A metric is objective if its value depends only on the object that is being measured and not on the viewpoint from which it is taken.
        </li>
        <li>
            <strong>(S)ubjective:</strong> A metric is subjective if its value depends on <strong>both</strong> the object that is being measured and the viewpoint from which it is taken.
        </li>
    </ul>

    <h5>Definition</h5>
    <p class="text-justify">
        Here you can see the full definition of the GQM model proposed.
    </p>
</x-layout>