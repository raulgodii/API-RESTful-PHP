<!DOCTYPE html>
<html lang="en">

<head>
    <title>CoderDocs - Bootstrap Documentation Template For Software Projects</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap 4 Template For Software Startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- FontAwesome JS-->
    <script defer src="<?= BASE_URL ?>/fontawesome/js/all.min.js"></script>

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/plugins/simplelightbox/simple-lightbox.min.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= BASE_URL ?>/css/theme.css">

    <style>
        .form-container {
            width: 300px;
            background: linear-gradient(180deg, #28b76b 25%, rgb(255, 255, 255) 20%);
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .form {
            width: 80%;
            display: flex;
            flex-direction: column;
            margin-top: 40px;
        }

        .form-container p {
            position: absolute;
            top: 10%;
            left: 10%;
            font-size: 30px;
            font-weight: 900;
            color: rgb(255, 255, 255);
        }

        .form-container label {
            color: rgb(40, 42, 44);
            margin-top: 15px;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .form-container .input {
            padding: 10px;
            height: 35px;
            border: none;
            background-color: rgb(224, 231, 236);
        }

        .form-container .input:focus {
            outline: none;
        }

        .form-container button {
            border: none;
            height: 35px;
            margin-top: 30px;
            background-color: #28b76b;
            color: white;
            font-size: 16px;
        }
    </style>

</head>

<body class="docs-page">
    <header class="header fixed-top">
        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
                    <div class="site-logo"><a class="navbar-brand" href="<?= BASE_URL ?>"><img class="logo-icon me-2" src="<?= BASE_URL ?>/images/coderdocs-logo.svg" alt="logo"><span class="logo-text">Power<span class="text-alt">Hispania API</span></span></a></div>
                </div><!--//docs-logo-wrapper-->
                <div class="docs-top-utilities d-flex justify-content-end align-items-center">
                    <?php if (!isset($_SESSION['login']) or $_SESSION['login'] == 'failed') : ?>
                        <a href="<?= BASE_URL ?>/iniciarSesion" class="btn btn-primary d-none d-lg-flex m-2">Iniciar Sesión</a>
                        <a href="<?= BASE_URL ?>/registro" class="btn btn-primary d-none d-lg-flex m-2">Registro</a>
                    <?php else : ?>
                        <a href="<?= BASE_URL ?>/cerrarSesion" class="btn btn-primary d-none d-lg-flex m-2">Cerrar Sesión</a>
                    <?php endif; ?>

                </div><!--//docs-top-utilities-->
            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->

    <div class="docs-wrapper">

        <div class="container d-flex flex-column align-items-center justify-content-center">
            <br><br><br><br><br>

            <?php if (isset($errores)) : ?>
                <h1 style="text-align:center;"><?= $errores ?></h1>
            <?php endif; ?>

            <footer class="footer">
                <div class="container text-center py-5">
                    <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                    <small class="copyright">Designed with
                        <span class="sr-only">love</span>
                        <i class="fas fa-heart" style="color: #fb866a;"></i>
                        by
                        <a class="theme-link" href="https://github.com/raulgodii" target="_blank">Raúl González</a>
                        for developers</small>
                    <ul class="social-list list-unstyled pt-4 mb-0">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-github fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-twitter fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-slack fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-product-hunt fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-facebook-f fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-instagram fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                    <!--//social-list-->
                </div>
            </footer>
        </div>
    </div>

    <!-- Javascript -->
    <script src="<?= BASE_URL ?>/plugins/popper.min.js"></script>
    <script src="<?= BASE_URL ?>/plugins/bootstrap/js/bootstrap.min.js"></script>


    <!-- Page Specific JS -->
    <script src="<?= BASE_URL ?>/plugins/smoothscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="<?= BASE_URL ?>/js/highlight-custom.js"></script>
    <script src="<?= BASE_URL ?>/plugins/simplelightbox/simple-lightbox.min.js"></script>
    <script src="<?= BASE_URL ?>/plugins/gumshoe/gumshoe.polyfills.min.js"></script>
    <script src="<?= BASE_URL ?>/js/docs.js"></script>

</body>

</html>