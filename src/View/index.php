<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.2.0/css/fork-awesome.min.css" integrity="sha256-XoaMnoYC5TH6/+ihMEnospgm0J1PM/nioxbOUdnM8HY=" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <? if (!isset($_SESSION['id'])) : ?>

                        <div class="buttons">
                            <a class="button is-primary" href="/register">
                                <strong>Sign up</strong>
                            </a>
                            <a href="/login" class="button is-light">
                                Log in
                            </a>
                        </div>

                    <? else : ?>

                        <div id="navbarBasicExample" class="navbar-menu">
                            <div class="navbar-start">
                                <a class="navbar-item" href="/">
                                    Movie
                                </a>
                                <a class="navbar-item" href="/genres">
                                    Genre
                                </a>

                                <a class="navbar-item" href="/profile">
                                    Profile
                                </a>
                            </div>
                        </div>

                        <div class="buttons">
                            <form action="/logout" method="POST">
                                <button class="button is-primary">
                                    Logout
                                    </buttton>
                            </form>
                        </div>
                    <? endif ?>
                </div>
            </div>
        </div>
    </nav>
    <?= $view ?>
</body>

</html>