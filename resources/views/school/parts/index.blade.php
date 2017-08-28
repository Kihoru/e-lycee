@extends('school.layouts.master')


@section('content')
<main class="main-content-accueil">
    <div class="colonne-centrale">
        <div class="actualite">
            <h2 class="titre">Lorem Ipsum</h2>
            <img class="image" src="{{url('/images/actu-2.jpg')}}">
            <p class="texte">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium eius doloribus laborum libero odit commodi dolores at. Illo quas sit molestias modi impedit delectus nemo, nesciunt adipisci perspiciatis ut, eos.</p>

            <a class="lien" href="#">Lire la suite</a>

            <h3 class="auteur">Auteur : <span>Alan</span></h3>
            <p class="date">Publié le : 31/07/2017</p>
            <p class="commentaire"><i class="fa fa-comments" aria-hidden="true"></i> 297 commentaire(s) réagissez !</p>
        </div>
        <div class="fil-actu">
            <div class="actu">
                <h2 class="titre">La machine de Turing</h2>
                <img class="image" src="{{url('/images/actu-1.jpg')}}">

                <p class="texte">Alors que, connaissant le caractère lu sur le ruban et l'état courant, une ...</p>

                <a class="lien" href="#">Lire la suite ..</a>
            </div>

            <div class="actu">
                <h2 class="titre">La machine de Turing</h2>
                <img class="image" src="{{url('/images/actu-1.jpg')}}">

                <p class="texte">Alors que, connaissant le caractère lu sur le ruban et l'état courant, une ...</p>

                <a class="lien" href="#">Lire la suite ..</a>
            </div>

            <div class="actu">
                <h2 class="titre">La machine de Turing</h2>
                <img class="image" src="{{url('/images/actu-1.jpg')}}">

                <p class="texte">Alors que, connaissant le caractère lu sur le ruban et l'état courant, une ...</p>

                <a class="lien" href="#">Lire la suite ..</a>
            </div>

            <div class="actu">
                <h2 class="titre">La machine de Turing</h2>
                <img class="image" src="{{url('/images/actu-1.jpg')}}">

                <p class="texte">Alors que, connaissant le caractère lu sur le ruban et l'état courant, une ...</p>

                <a class="lien" href="#">Lire la suite ..</a>
            </div>

            <div class="actu">
                <h2 class="titre">La machine de Turing</h2>
                <img class="image" src="{{url('/images/actu-1.jpg')}}">

                <p class="texte">Alors que, connaissant le caractère lu sur le ruban et l'état courant, une ...</p>

                <a class="lien" href="#">Lire la suite ..</a>
            </div>
        </div>
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
