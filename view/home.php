<div id="container_topics">
    <h1>BIENVENUE SUR LE FORUM</h1>

    <p></span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>
    <?php if (App\Session::getUser()) {
    ?>

    <?php } else { ?><p>
            <a href="/security/login.html">Se connecter</a>
            <span>&nbsp;-&nbsp;</span>
            <a href="view/security/register.php">S'inscrire</a>
        </p><?php } ?>

</div>