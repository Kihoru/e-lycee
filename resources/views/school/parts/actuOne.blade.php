@extends('school.layouts.master')


@section('content')
<main class="main-content-actu">
    <div class="actualite">
        <div class="img">
            <img class="image" src="assets/images/actu-2.jpg">
        </div>
        <div class="desc">
            <h2 class="titre">Lorem Ipsum</h2>
            <p class="texte">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium eius doloribus laborum libero odit commodi dolores at. Illo quas sit molestias modi impedit delectus nemo, nesciunt adipisci perspiciatis ut, eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi quam odio consectetur illum consequuntur. Nobis sed asperiores ipsam fugiat temporibus cum deserunt neque, error odio hic perferendis laboriosam sapiente nulla! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam reprehenderit quia illo expedita aperiam dolor, quis ipsa quidem atque iste dolore totam et est similique! Unde nihil eius cum similique.</p>

            <p class="texte">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro molestiae consequatur autem, ratione qui, possimus aperiam laborum accusantium, repellendus ipsum mollitia ea accusamus ducimus odio fuga, iste consectetur voluptate ullam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae architecto doloribus eligendi neque aliquam ullam perspiciatis, voluptas similique quis molestiae enim, reprehenderit quos dolore officiis corporis voluptatibus voluptate impedit aspernatur!</p>

            <h3 class="auteur">Auteur : <span>Alan</span></h3>
            <p class="date">Publié le : 31/07/2017</p>

        </div>
        <div class="zone-com">
            <p class="nb-com"><i class="fa fa-comments" aria-hidden="true"></i> 297 commentaire(s) réagissez !</p>
            <div class="commentaires">
                <div class="com">
                    <div class="avatar">
                        <img src="assets/images/pikachu.png" alt="">
                    </div>
                    <div class="content-com">
                        <h3 class="auteur">Publié par <span>Gnonf-</span></h3>
                        <p class="heure">Il y a 2 heurs et 12 minutes</p>
                        <p class="texte">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus repellendus doloremque perspiciatis, magnam natus nam excepturi nobis quae sint laboriosam culpa illum aspernatur nulla provident enim distinctio. Aspernatur impedit, cumque.</p>
                        <a class="rep-com" href="#">Répondre à ce commentaire</a>
                    </div>
                    <a class="post-com" href="#">Ajouter un commentaire</a>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
