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

        <div id="cards_container">
            <?php
            if ($topics == null) {
                Session::addFlash('error', "Il n'ya pas encore des topics dans cette categorie ") ?>
                <div id="addtopic_form">
                    <h1>Nouveau Topic</h1>
                    <form action="index.php?ctrl=forum&action=addTopic&user=<?= Session::getUser()->getId(); ?>" method="post">
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

                <?php } else {

                foreach ($topics as $topic) {
                    // var_dump(Session::getUser()->getId());
                    // die;

                ?>
                    <div class="card">
                        <p>Sujet : <?= $topic->getTitle() ?></p>
                        <p><i class="fa-solid fa-user"></i>&nbsp;<?= $topic->getUser() ?></p>
                        <p><i class="fa-solid fa-calendar-days"></i>&nbsp; <?= $topic->getCreationdate() ?></p>

                        <a href="index.php?ctrl=forum&action=findPostbytopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-eye"></i>
                            Voir les messages
                        </a>
                    </div>
                <?php } ?>
        </div>
        <?php if (Session::getUser()) { ?>
            <div id="addtopic_form">
                <h1>Nouveau Topic</h1>
                <form action="index.php?ctrl=forum&action=addTopic<?php if (Session::getUser()) {
                                                                        echo '&user=' . Session::getUser()->getId();
                                                                    } ?>" method="post">
                    <label>id categorie :</label>
                    <input type="number" name="category" value="<?= $id ?>" />
                    <label>Titre :</label>
                    <input type="text" name="title" />
                    <label>Message :</label>
                    <textarea type="text" name="message"></textarea>
                    <input type="text" name="closed" value="0" hidden readonly />
                    <button class="add_btn" type="submit" name="submit">Ajouter</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<?php
            }
            // }
?>