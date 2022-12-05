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

<?php
foreach ($posts as $post) {
    // var_dump($post);die;
?>
    <div class="card posts">
        <div class="left">
            <p>de :<a href="#"><?= $post->getUser() ?></a></p>
            <p>date : <?= $post->getDateCreation() ?></p>
        </div>
        <div class="right">
            <p>message : <?= $post->getContenue() ?></p>
        </div>
    </div>
<?php
}

if ($isClosed == 0) {
?>
    <h1>Nouveau message</h1>

    <form action="index.php?ctrl=forum&action=addPost&id=<?= $id ?>&user=<?= Session::getUser()->getId() ?>" method="post">
        <label>message :<input type="text" name="message" /></label>
        <input type="submit" value="Envoyer" name="submit" />
    </form>
<?php } else { ?>
    <div class="message_container">
        <p> vous ne pouvez pas envoyer un message car ce sujet est verrouillé </p>
    </div>
<?php } ?>