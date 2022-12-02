<?php

$posts = $result["data"]['posts'];

?>

<h1>messages</h1>

<?php
foreach ($posts as $post) {
    // var_dump($post);die;
?>
<div class="card">
    <p>message : <?= $post->getContenue() ?></p>
    <p>de :<a href="#"><?= $post->getUser() ?></a></p>
</div>
<?php
}
?>
<h1>Nouveau message</h1>

<form action="index.php?ctrl=forum&action=addPost" method="post">
    <label>message :<input type="text" name="message" /></label>
    <input type="submit" value="Envoyer" name="submit" />
</form>