<?php

$categorys = $result["data"]['categorys'];

?>
<div id="container_categorys">
    <h1>liste categorys</h1>
    <div id="cards">
        <?php
        foreach ($categorys as $category) {
            // var_dump($category->getTitle());die;

        ?>
            <div class="card">
                <a href="index.php?ctrl=forum&action=findTopicsbyCat&id=<?= $category->getId() ?>">
                    <p><?= $category->getNomCategory() ?></p>
                </a>
            </div>
        <?php
        } ?>
    </div>
</div>