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
                <p><?= $post->getContenue() ?></p>
            </div>
        </div>
        <?php
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