<?php

$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>

<?php
foreach ($topics as $topic) {
    // var_dump($topic);die;

?>
    <div class="card">
        <p>Sjuet : <?= $topic->getTitle() ?></p>
        <p>Auteur : <?= $topic->getUser() ?></p>
        <p>date : <?= $topic->getCreationdate() ?></p>

        <a href="index.php?ctrl=forum&action=findPostbytopic&id=<?= $topic->getId() ?>">
            Voir les messages
        </a>
    </div>

<?php
}
?>
<h1>Nouveau Sujet</h1>

<form action="index.php?ctrl=forum&action=addTopic" method="post">
    <label>categorie :<input type="number" name="category" /></label>
    <label>Titre :<input type="text" name="title" /></label>
    <label>Message :<input type="text" name="message" /></label>
    <input type="text" name="closed" value="0" hidden readonly />
    <input type="submit" value="Ajouter" name="submit" />
</form>