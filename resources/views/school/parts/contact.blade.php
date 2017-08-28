@extends('school.layouts.master')


@section('content')
<main class="main-contact">
    <div class="content">
        <h2 class="title">Contact</h2>
        <p>Le lycée est ouvert de 7h30 à 19h30</p>
        <form method="post">
            <input type="text" name="nom" class="input-contact" required="" placeholder="Votre nom... *">
            <input type="text" name="mail" class="input-contact" required="" placeholder="Votre E-mail... *">
            <input type="text" name="sujet" class="input-contact" required="" placeholder="Sujet...">

            <textarea name="message" cols="30" rows="10" class="textarea-contact"></textarea>
        </form>
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
