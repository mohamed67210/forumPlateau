<?php

 ?>

<div id="container">
    <form action="../../index.php?ctrl=security&action=addUser" method="post">
        <label>Mail :</label>
        <input type="email" name="mail" />
        <label>Pseudo :</label>
        <input type="text" name="pseudo" />
        <label>Mot de passe :</label>
        <input type="password" name="password1" />
        <label>repeter mot de passe :</label>
        <input type="password" name="password2" />
        <select name="role">
            <option value="">Admin</option>
            <option value="">Membre</option>
        </select>
        <input type="submit" value="S'inscrire" name="submit" />
    </form>
</div>