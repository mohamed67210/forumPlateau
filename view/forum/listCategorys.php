<?php

$categorys = $result["data"]['categorys'];

?>

<h1>liste categorys</h1>

<?php
foreach ($categorys as $category) {
    // var_dump($category->getTitle());die;

?>
    <p><?= $category->getId() ?></p>
    <p><?= $category->getNomCategory() ?></p>

<?php
}