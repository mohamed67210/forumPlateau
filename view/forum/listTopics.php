<?php

$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>

<?php
foreach ($topics as $topic) {
    // var_dump($topic);die;

?>
    <p><?= $topic->getUser() ?></p>
    <p><?= $topic->getTitle() ?></p>

<?php
}
