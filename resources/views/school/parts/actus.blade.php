@extends('school.layouts.master')


@section('content')
<main class="main-content-actualites">
    <div class="colonne-centrale">
        @foreach($posts as $post)
        <div class="actualite">
            <div class="img">
                <img class="image" src="{{url('/upload/posts/'.$post->url_thumbnail)}}">
            </div>
            <div class="desc">
                <h2 class="titre">{{$post->title}}</h2>
                <p class="texte">{{$post->abstract}}</p>

                <a class="lien" href="/actuOne/{{$post->id}}">Lire la suite</a>

                <h3 class="auteur">Auteur : <span>{{$post->user->username}}</span></h3>
                <p class="date">Publié le : {{$post->created_at}}</p>
                <p class="commentaire"><i class="fa fa-comments" aria-hidden="true"></i> {{count($post->comments)}} commentaire(s) réagissez !</p>
            </div>
        </div>
        <div class="underline"></div>
        @endforeach
        {{$posts->links()}}
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
