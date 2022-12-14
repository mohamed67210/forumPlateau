<?php

use App\Session;
//  var_dump(Session::getUser()->getId())
$posts = $result['data']['posts'];
$topics = $result['data']['topics'];
$user = $result['data']['user'];

?>
<div id="view_prifile">
    <div id="left">
        <div id="user_circle">
            <img src="public/img/<?= $user->getimage() ?>" alt="avatar">
        </div>
        <h5><?= $user->getPseudo() ?></h5>
        <h5><?= $user->getMail() ?></h5>
        <h5><?= $user->getRole() ?></h5>
        <h5>depuis : <?= $user->getDateCreation() ?></h5>


    </div>
    <div id="right">
        <h2>Activité : </h2>
        <div class="activite_container">
            <p>Dernier messages</p>

            <?php if ($posts) {
                foreach ($posts as $post) { ?>
                    <div class="post_container">
                        <p><?= $post->getContenue() ?></p>
                        <span><?= $post->getDateCreation() ?></span>
                    </div>
            <?php }
            } else {
                echo "Pas d'activité";
            } ?>

        </div>
        <div class="activite_container">
            <p>Dernier sujets</p>

            <?php if ($topics) {
                foreach ($topics as $topic) { ?>
                    <div class="post_container">
                        <p><?= $topic->getTitle() ?></p>
                        <span><?= $topic->getCreationdate() ?></span>
                    </div>
            <?php }
            } else {
                echo "Pas d'activité ";
            } ?>
        </div>

    </div>
</div>