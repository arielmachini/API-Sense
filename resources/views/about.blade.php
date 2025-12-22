<?php use App\Constants; ?>

<x-layout pageTitle="{{ Constants::TITLE_ABOUT_PAGE }}">
    <div class="mb-4 row">
        <div class="col-3">
            <img alt="A photo of Ariel Machini." class="img-fluid img-thumbnail" src="{{ Constants::URL_AUTHOR_PHOTO }}">
        </div>
        <div class="col">
            <p class="fs-5 text-justify">
                Hello, and thank you for your interest in our tool, <span class="application-name" style="cursor: auto;">API Sense</span>! My name is <strong>Ariel Machini</strong>, and I enjoy programming: It is a form of art, and it allows me to express myself creatively. I am a Graduate in Systems, a researcher at <a href="https://www.unpa.edu.ar" target="_blank">Universidad Nacional de la Patagonia Austral</a> (<a href="https://www.uarg.unpa.edu.ar" target="_blank">Unidad Académica de Río Gallegos</a>) under the guidance of <a href="#" target="_blank">PhD Sandra Casas</a> and <a href="https://lifia.info.unlp.edu.ar/dr-gustavo-rossi-en" target="_blank">PhD Gustavo Rossi</a>, and a <a href="https://www.conicet.gov.ar/new_scp/detalle.php?keywords=&id=63664&datos_academicos=yes" target="_blank">PhD scholar at CONICET</a>.
            </p>
            <p class="fw-bold mb-3">Links:</p>
            <ul>
                <li><img class="icon" src="{{ Constants::URL_ICON_GOOGLE_SCHOLAR }}"><a href="https://scholar.google.com/citations?user=pbkyWyMAAAAJ" target="_blank">Google Scholar</a></li>
                <li><img class="icon" src="{{ Constants::URL_ICON_LINKEDIN }}"><a href="https://www.linkedin.com/in/amachini" target="_blank">LinkedIn</a></li>
                <li><img class="icon" src="{{ Constants::URL_ICON_ORCID }}"><a href="https://orcid.org/0000-0002-2589-8182" target="_blank">ORCID</a></li>
                <li><img class="icon" src="{{ Constants::URL_ICON_RESEARCHGATE }}"><a href="https://www.researchgate.net/profile/Ariel-Machini-2" target="_blank">ResearchGate</a></li>
            </ul>
        </div>
        <div class="col-1">
            <a href="https://www.uarg.unpa.edu.ar" target="_blank"><img class="img-fluid mb-4" src="{{ Constants::URL_ICON_UARG }}"></a>
            <a href="https://www.conicet.gov.ar/new_scp/detalle.php?keywords=&id=63664&datos_academicos=yes" target="_blank"><img class="img-fluid mb-4" src="{{ Constants::URL_ICON_CONICET }}"></a>
            <a href="https://sites.google.com/uarg.unpa.edu.ar/gisp/staff#h.l3j3sownfvgm" target="_blank"><img class="img-fluid" src="{{ Constants::URL_ICON_GISP }}"></a>
        </div>
    </div>

    <h5>Goal</h5>
    <p class="mb-4 text-justify">
        The goal of my research is <strong>to help improve the usability of web APIs</strong>, since it is known to be a critical factor for their adoption. The tool and usability model here presented are meant for assessing certain aspects of a web API that can influence its usability. All metrics included in the model were extracted from <a href="/{{ Constants::ROUTE_SOURCES }}">reliable sources</a>, such as academic research papers and blogs/guides written by web API experts.
    </p>

    <h5>Usability model</h5>
    <p class="mb-4 text-justify">
        <span class="application-name">API Sense</span> is built on top of a usability model which we developed over several years and validated in different occasions. This model leverages the Goal-Question-Metric (GQM) approach [<a href="/{{Constants::ROUTE_SOURCES }}#1" target="_blank">1</a>] and consists of six goals, eight questions, and 45 usability metrics. You can learn more about our model <a href="/{{ Constants::ROUTE_MODEL }}">here</a>.
    </p>

    <h5>Contact</h5>
    <p class="text-justify">
        If you want, you can reach out to me through my <a href="https://www.linkedin.com/in/amachini" target="_blank">LinkedIn page</a> or by <a href="mailto:amachini@conicet.gov.ar">e-mailing me</a>.
    </p>
</x-layout>