@extends('school.layouts.master')


@section('content')
<main class="main-lycee">
    <div class="content">
        <h2 class="title">Présentation du Lycée</h2>
        <ul class="first-list">
            <li>Proviseur&nbsp;: S.MARLIN</li>
            <li>Proviseure adjointe : S.OCCULTI</li>
            <li>Gestionnaire-Agent Comptable&nbsp;: M-F.GRANDPIERRE</li>
            <li>Adjoint-gestionnaire : A.ENDRASS</li>
            <li>Secrétariat élèves et de direction&nbsp;: M.BAROGHEL</li>

            <li class="second-list">Secrétariat intendance&nbsp;:
                <ul >
                    <li>C.TARRIEUX</li>
                    <li>S.BELOUADI</li>
                </ul>
            </li>

            <li class="second-list">Conseillères principales d’éducation :
                <ul >
                    <li>J.FELZINE</li>
                    <li>K.YATTASSAYE</li>
                </ul>
            </li>

            <li>Infirmière&nbsp;: N. IARICHENE</li>
            <li>Assistante sociale&nbsp;: V.FOUCHER</li>

            <li class="second-list">Conseillers d’Orientation Psychologues :
                <ul >
                    <li>J DE VALVERDE</li>
                </ul>
            </li>

            <li>Documentaliste&nbsp;: D. DOUROJEANNI</li>
        </ul>
    </div>

    <div class="sidebar">
        <div class="contenu-supp">
            <h2 class="titre">A lire aussi</h2>
            <ul>
                <li><a href="#">Philae endormi</a></li>
                <li><a href="#">Fusée Antares</a></li>
            </ul>
        </div>
        <div class="twitter">
            <h2><i class="fa fa-twitter" aria-hidden="true"></i>Les derniers Tweets </h2>
            <div class="fil-twitter">
                <a class="twitter-timeline" data-dnt="true" data-theme="light" data-link-color="#2B7BB9" href="https://twitter.com/EMdevNetwork"></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div>
</main>
@stop
