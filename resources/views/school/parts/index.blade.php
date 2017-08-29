@extends('school.layouts.master')


@section('content')
<?php //echo "<pre>";var_dump($lastPost);echo "</pre>";die(); ?>
<main class="main-content-accueil">
    <div class="colonne-centrale">
        <div class="actualite">
            <h2 class="titre">{{$lastPost[0]->title}}</h2>
            <img class="image" src="{{url('/upload/posts/'.$lastPost[0]->url_thumbnail)}}">
            <p class="texte">{{$lastPost[0]->abstract}}</p>

            <a class="lien" href="/actuOne/{{$lastPost[0]->id}}">Lire la suite</a>

            <h3 class="auteur">Auteur : <span>{{$lastPost[0]->user->username}}</span></h3>
            <p class="date">Publié le : {{$lastPost[0]->created_at}}</p>
            <p class="commentaire"><i class="fa fa-comments" aria-hidden="true"></i> {{count($lastPost[0]->comments)}} commentaire(s) réagissez !</p>
        </div>
        <div class="fil-actu">
            @foreach($latestPosts as $post)
            <div class="actu">
                <h2 class="titre">{{$post->title}}</h2>
                <img class="image" src="{{url('/upload/posts/'.$post->url_thumbnail)}}">

                <p class="texte">{{$lastPost[0]->abstract}}</p>

                <a class="lien" href="/actuOne/{{$post->id}}">Lire la suite ..</a>
            </div>
            @endforeach
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
