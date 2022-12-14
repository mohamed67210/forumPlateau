<?php

use App\Session;


$posts = $result["data"]['posts'];
$topic = $result["data"]['topics'];
// var_dump($topic->getClosed());
$isClosed = $topic->getClosed();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<h1>messages</h1>
<div id="messages_container">
    <?php
    if ($posts) {
        foreach ($posts as $post) {
            // var_dump($post);die;
    ?>
            <div class="card posts">
                <div class="left">
                    <p><i class="fa-solid fa-circle-user"></i>&nbsp;<a href="#"><?= $post->getUser() ?></a></p>
                    <span><i class="fa-regular fa-clock"></i>&nbsp;<?= $post->getDateCreation() ?></span>
                </div>
                <div class="circle1"></div>
                <div class="circle2"></div>
                <div class="right">
                    <form action="index.php?ctrl=security&action=editPost&idpost=<?= $post->getId() ?>&idtopic=<?= $post->getTopic() ?>" method="post">
                        <textarea name="contenue" readonly><?= $post->getContenue() ?></textarea>
                        <?php if (((Session::getUser()) == ($post->getUser())) || Session::isAdmin()) { ?>
                            <div id="edit_btns">
                                <input id="edit_btn" value="edit" type="button">
                                <button id='ok_btn' class="edit_btn" name="submit">
                                    Ok
                                </button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
                <?php if ((Session::isAdmin()) || ((Session::getUser()) == ($post->getUser()))) { ?>
                    <a class="red_btn" href="index.php?ctrl=security&action=deletePost&idpost=<?= $post->getId() ?>&idtopic=<?= $post->getTopic() ?>"><i class="fa-solid fa-trash"></i></a>
                <?php } ?>
            </div>
        <?php
        }
    } else {
        Session::addFlash('error', "Pas de message pour le moment");
    }

    if (Session::getUser()) {
        if ($isClosed == 0) {
        ?>
            <div id="newMessage_container">
                <form action="index.php?ctrl=forum&action=addPost&id=<?= $id ?>&user=<?= Session::getUser()->getId() ?>" method="post">
                    <textarea type="text" name="message" placeholder="Votre message ..."></textarea>
                    <button type="submit" name="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        <?php } else { ?>
            <div class="message_container">
                <p> vous ne pouvez pas envoyer un message car ce sujet est verrouillé </p>
            </div>
    <?php }
    } ?>
</div>