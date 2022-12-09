<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <title>FORUM</title>
</head>

<body>
    <div id="wrapper">

        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->

            <header>
                <nav>
                    <div id="nav-left">
                        <a href="index.php">
                            <h3>Forum</h3>
                        </a>
                        <?php
                        if (App\Session::isAdmin()) {
                        ?>
                            <div class="dropdown">
                                <button>ADMIN</button>
                                <div class="dropdown-content">
                                    <a href="index.php?ctrl=home&action=users">liste des utilisateurs</a>
                                    <a href="index.php?ctrl=forum&action=listCategorys">Ajouter Categorie</a>
                                    <a href="index.php?ctrl=forum&action=verrouiller">verrouiller Sujet</a>
                                    <a href="index.php?ctrl=forum&action=deletePost">Supprimer message</a>
                                </div>
                            </div>
                        <?php
                            // var_dump(App\Session::isAdmin());
                        }
                        ?>
                    </div>
                    <div id="nav-right">
                        <?php

                        if (App\Session::getUser()) {
                            if (App\Session::getUser()->getIsBanish() != 1) {
                        ?>
                                <a href="index.php?ctrl=forum&action=listCategorys">la liste des Categorys</a>
                                <a href="index.php?ctrl=forum&action=listTopics">la liste des topics</a>
                                <a href="index.php?ctrl=forum&action=viewProfile"><i class="fa-solid fa-user"></i>&nbsp;<?= App\Session::getUser() ?></a>
                                <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                            <?php
                            } else { ?>
                                <a href="index.php?ctrl=security&action=logout">Déconnexion</a>

                            <?php }
                        } else {
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics">la liste des topics</a>
                            <a href="index.php?ctrl=forum&action=listCategorys">la liste des Categorys</a>
                            <a href="index.php?ctrl=security&action=loginform">Connexion</a>
                            <a href="index.php?ctrl=security&action=registerform">Inscription</a>
                        <?php
                        }
                        ?>
                    </div>
                </nav>
            </header>
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>

            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(".message").each(function() {
                if ($(this).text().length > 0) {
                    $(this).slideDown(500, function() {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })



        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>

</html>