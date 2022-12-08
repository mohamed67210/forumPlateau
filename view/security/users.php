<?php
$users = $result['data']['users'];
?>


<div id="users_container">
    <table>
        <tr>
            <th>id</th>
            <th>Pseudo</th>
            <th>Mail</th>
            <th>Date inscription</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?= $user->getId(); ?></td>
                <td><?= $user->getPseudo(); ?></td>
                <td><?= $user->getMail(); ?></td>
                <td><?= $user->getDateCreation(); ?></td>
                <td><?= $user->getRole(); ?></td>
                <td><a class="red_btn" href="index.php?ctrl=security&action=deleteuser&id=<?= $user->getId() ?>"><i class="fa-solid fa-user-slash"></i></a></td>
            </tr>
        <?php }  ?>
    </table>



</div>