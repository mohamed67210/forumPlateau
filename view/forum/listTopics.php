<?php

use App\Session;

$topics = $result["data"]['topics'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = NULL;
}
?>
<div id="wrapper">
    <div id="container_topics">
        <h1>liste topics</h1>
        <div id="cards_container">
            <?php

            foreach ($topics as $topic) {
                // var_dump(Session::getUser()->getId());
                // die;

            ?>
                <div class="card">
                    <p>Sjuet : <?= $topic->getTitle() ?></p>
                    <p>Auteur : <?= $topic->getUser() ?></p>
                    <p>date : <?= $topic->getCreationdate() ?></p>

                    <a href="index.php?ctrl=forum&action=findPostbytopic&id=<?= $topic->getId() ?>">
                        Voir les messages
                    </a>
                </div>
        </div>

        <div id="addtopic_form">
            <h1>Nouveau Topic</h1>
            <form action="index.php?ctrl=forum&action=addTopic" method="post">
                <label>id categorie :</label>
                <input type="number" name="category" value="<?= $id ?>" />
                <label>Titre :</label>
                <input type="text" name="title" />
                <label>Message :</label>
                <input type="text" name="message" />
                <input type="text" name="closed" value="0" hidden readonly />
                <input class="add_btn" type="submit" value="Ajouter" name="submit" />
            </form>
        </div>
    </div>
</div>
<?php
            }
?>