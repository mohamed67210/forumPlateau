<?php
$users = $result["data"]['Users'];

?>
<div id="container">
    <form id="login_form" action="index.php?ctrl=security&action=addUser" method="post" enctype="multipart/form-data">
        <label>Mail :</label>
        <input type="email" name="mail" />
        <label>Pseudo :</label>
        <input type="text" name="pseudo" />
        <label>Mot de passe :</label>
        <input type="password" name="password1" />
        <label>repeter mot de passe :</label>
        <input type="password" name="password2" />
        <input name="role" value="membre" readonly hidden/>
        <input type="file" name="image" />
        <button type="submit" name="submit">Je m'inscris</button>
    </form>
</div>