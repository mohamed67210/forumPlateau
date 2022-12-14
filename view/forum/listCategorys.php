<?php

$categorys = $result["data"]['categorys'];

?>
<?php if (App\Session::isAdmin()) { ?>
    <div id="addcateg_form">
        <h1>nouvelle categorie</h1>
        <form action="index.php?ctrl=forum&action=addCategory" method="POST">
            <label>nom de la categorie :</label>
            <input type="text" name="nom_category" />
            <button class="add_btn" type="submit" name="submit">Ajouter</button>
        </form>
    </div>
<?php } ?>
<div id="container_categorys">
    <!-- <h1>liste categorys</h1> -->
    <div id="cards">
        <?php
        foreach ($categorys as $category) {
            // var_dump($category->getTitle());die;

        ?>
            <a href="index.php?ctrl=forum&action=findTopicsbyCat&id=<?= $category->getId() ?>">
                <h3><?= $category->getNomCategory() ?></h3>
                <h4>Topics : 15</h4>
            </a>
        <?php
        } ?>
    </div>
</div>