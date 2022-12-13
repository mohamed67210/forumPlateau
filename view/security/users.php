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
            <!-- <th>satatu</th> -->
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user) {
            $isBanish = $user->getIsBanish() ?>
            <tr>
                <td><?= $user->getId(); ?></td>
                <td><?= $user->getPseudo(); ?></td>
                <td><?= $user->getMail(); ?></td>
                <td><?= $user->getDateCreation(); ?></td>
                <td><?= $user->getRole(); ?></td>
                <!-- <td><?= $user->getIsBanish(); ?></td> -->
                <?php if ($isBanish != true) { ?>
                    <td><a class="red_btn" href="index.php?ctrl=security&action=deleteuser&id=<?= $user->getId() ?>"><i class="fa-solid fa-user-slash"></i></a>
                        <form id="form_editUser" action="index.php?ctrl=security&action=editUserRole&id=<?= $user->getId() ?>" method="POST">
                            <select name="role_select">
                                <option value="admin">Admin</option>
                                <option value="membre">Membre</option>
                            </select>
                            <button type="submit" name="submit">Edit</button>
                        </form>
                    </td>
                <?php } else { ?>
                    <td><a class="green_btn" href="index.php?ctrl=security&action=activeuser&id=<?= $user->getId() ?>"><i class="fa-solid fa-user-slash"></i></a></td>
                <?php } ?>
            </tr>
        <?php }  ?>
    </table>



</div>