<div id="container_home">
    <h1><span> <?php if ((app\Session::getUser())) {
                    echo app\Session::getUser()->getPseudo();
                } else {
                }  ?></span>&nbsp;BIENVENUE SUR LE FORUM </h1>
    <div id="Lorem_container">
        <p></span>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid,
            facere rerum in laborum debitis labore aliquam ullam cumque.</p>
    </div>
    <?php if ((App\Session::getUser())) {
        if ((App\Session::getUser()->getIsBanish()) == 1) { ?>
            <div id="message_container">
                <h4>Vous ne pouvez pas acceder a votre compte parce que vous etes banni</h4>
            </div>
        <?php }
        ?>

    <?php } else { ?><p>
            <a href="/security/login.html">Se connecter</a>
            <span>&nbsp;-&nbsp;</span>
            <a href="view/security/register.php">S'inscrire</a>
        </p><?php } ?>

</div>