<?php

$posts = $result["data"]['posts'];

?>

<h1>liste messages</h1>

<?php
foreach ($posts as $post) {
    // var_dump($post);die;
?>

    <p>message : </p><a href="id=<?= $post->getId() ?>"><?= $post->getContenue() ?></a>


<?php
}
