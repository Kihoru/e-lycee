@extends('school.layouts.master')


@section('content')
<main class="main-content-actu">
    <div class="actualite">
        <div class="img">
            <img class="image" src="{{url('/upload/posts/'.$post->url_thumbnail)}}">
        </div>
        <div class="desc">
            <h2 class="titre">{{$post->title}}</h2>
            <p class="texte">{{$post->content}}</p>

            <h3 class="auteur">Auteur : <span>{{$post->user->username}}</span></h3>
            <p class="date">Publié le : {{$post->created_at}}</p>

        </div>
        <div class="zone-com">
            <p class="nb-com"><i class="fa fa-comments" aria-hidden="true"></i> {{ count($post->comments) }} commentaire(s) réagissez !</p>
            <div class="commentaires">
                @foreach($post->comments as $comment)
                <div class="com">
                    <div class="avatar">
                        <img src="{{url('/images/pikachu.png')}}" alt="">
                    </div>
                    <div class="content-com">
                        <h3 class="auteur">Publié par <span>-{{$comment->username}}-</span></h3>
                        <p class="heure">{{$comment->created_at}}</p>
                        <p class="texte">{{$comment->content}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="addComment">
                @if($errors->has('username'))
                    <p class='error'>{{$errors->first('username')}}</p>
                @endif
                @if($errors->has('content'))
                    <p class='error'>{{$errors->first('content')}}</p>
                @endif
                @if($errors->has('error'))
                    <p class='error'>{{$errors->first('error')}}</p>
                @endif
                <div class="com">
                    <form action="{{url('/comment/add/'.$post->id)}}" method="post">
                        {{csrf_field()}}
                        <input class="input_actu" type="text" value="{{old('username')}}" name="username" id="comment_user" placeholder="Pseudo...">
                        <textarea class="input_actu" value="{{old('content')}}" name="content" id="comment_content" placeholder="Message..."></textarea>
                        <div class="g-recaptcha" data-sitekey="6LfniS4UAAAAAB7E31ijSwPxGqMV80_jSH_p6Og2"></div>
                        <input type="submit" name="send" value="Commentez" class="input_submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
