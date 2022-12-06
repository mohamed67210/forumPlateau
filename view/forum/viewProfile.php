<?php

use App\Session;
// var_dump(Session::getUser())
?>
<div id="view_prifile">
    <div id="left">
        <div id="user_circle"></div>
        <h5><?= Session::getUser()->getPseudo() ?></h5>
        <h5><?= Session::getUser()->getMail() ?></h5>
    </div>
    <div id="right">
        <h2>Activité : </h2>
        <div class="activite_container">
            <p>Dernier messages</p>

        </div>
        <div class="activite_container">
            <p>Dernier sujets</p>
        </div>

    </div>
</div>