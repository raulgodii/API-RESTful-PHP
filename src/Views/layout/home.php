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
        <div id="docs-sidebar" class="docs-sidebar">

            <div class="d-flex justify-content-center d-lg-none p-3">
                <a href="" class="btn btn-primary d-lg-flex">Iniciar Sesión</a>
            </div>

            <div class="d-flex justify-content-center d-lg-none p-3">
                <a href="" class="btn btn-primary d-lg-flex">Registro</a>
            </div>



            <nav id="docs-nav" class="docs-nav navbar">
                <ul class="section-items list-unstyled nav flex-column pb-3">
                    <li class="nav-item section-title">
                        <a class="nav-link scrollto active" href="#section-1">
                            <span class="theme-icon-holder me-2">
                                <i class="fas fa-map-signs"></i>
                            </span>Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scrollto" href="#bienvenida">Bienvenida</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scrollto" href="#todasCompeticiones">Competiciones (Get)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scrollto" href="#unaCompeticion">Competicion (Get)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scrollto" href="#creaCompeticion">Competicion (POST)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scrollto" href="#eliminaCompeticion">Competicion (DELETE)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scrollto" href="#modificaCompeticion">Competicion (PUT)</a>
                    </li>
                </ul>

            </nav>
            <!--//docs-nav-->
        </div>
        <!--//docs-sidebar-->
        <div class="docs-content">
            <div class="container">
                <article class="docs-article" id="bienvenida">
                    <header class="docs-header">
                        <h1 class="docs-heading">Bienvenido
                            <span class="docs-time">Última modificación: 2024-02-02</span>
                        </h1>
                        <section class="docs-intro">
                            <p>PowerHispania API es una plataforma dedicada al mundo del powerlifting, diseñada para proporcionar acceso rápido y sencillo a información detallada sobre competiciones. Ya sea que estés buscando eventos pasados, planeando tu participación, o necesitas realizar cambios en la información de una competición, PowerHispania API te ofrece las herramientas necesarias.</p>
                        </section>
                        <!--//docs-intro-->

                        <h5>Características Principales:</h5>
                        <div class="table-responsive my-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Consultas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Consulta de Competiciones</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Creación de Competiciones</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Edición de Competiciones</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Borrado de Competiciones</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <section class="docs-section" id="todasCompeticiones">
                            <h2 class="section-heading"><a class="btn btn-light">GET</a> Competiciones </h2>
                            <h2><code>/competiciones</code></h2>

                            <p>Obtén información detallada sobre todos los eventos pasados y futuros.
                            </p>
                            <?php
                            // Verificar si no hay sesión activa o si el inicio de sesión ha fallado
                            if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') :
                            ?>
                                <a class="btn btn-secondary obtener-token-btn">GET TOKEN</a>
                                <br>

                                <ul>
                                    <li>
                                        <strong class="me-1">TOKEN:</strong>
                                        <code class="token-code"></code>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code class="json hljs">
[
    {
        "title": "apples",
        "count": [12000, 20000],
        "description": {"text": "...", "sensitive": false}
    },
    {
        "title": "oranges",
        "count": [17500, null],
        "description": {"text": "...", "sensitive": false}
    }
]


</code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="unaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-light">GET</a> Competicion </h2>
                            <h2><code>/competicion/:id</code></h2>

                            <p>Obtén información detallada sobre una competicion en concreto.
                            </p>
                            <?php
                            // Verificar si no hay sesión activa o si el inicio de sesión ha fallado
                            if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') :
                            ?>
                                <a class="btn btn-secondary obtener-token-btn">GET TOKEN</a>
                                <br>

                                <ul>
                                    <li>
                                        <strong class="me-1">TOKEN:</strong>
                                        <code class="token-code"></code>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code class="json hljs">
[
    {
        "title": "apples",
        "count": [12000, 20000],
        "description": {"text": "...", "sensitive": false}
    },
    {
        "title": "oranges",
        "count": [17500, null],
        "description": {"text": "...", "sensitive": false}
    }
]


</code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="creaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-info">POST</a> Competicion </h2>
                            <h2><code>/competicion</code></h2>

                            <p>Creación de una competición.
                            </p>
                            <?php
                            // Verificar si no hay sesión activa o si el inicio de sesión ha fallado
                            if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') :
                            ?>
                                <a class="btn btn-secondary obtener-token-btn">GET TOKEN</a>
                                <br>

                                <ul>
                                    <li>
                                        <strong class="me-1">TOKEN:</strong>
                                        <code class="token-code"></code>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code class="json hljs">
[
    {
        "title": "apples",
        "count": [12000, 20000],
        "description": {"text": "...", "sensitive": false}
    },
    {
        "title": "oranges",
        "count": [17500, null],
        "description": {"text": "...", "sensitive": false}
    }
]


</code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="eliminaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-danger">DELETE</a> Competicion </h2>
                            <h2><code>/competicion/:id</code></h2>

                            <p>Eliminación de una competición.
                            </p>
                            <?php
                            // Verificar si no hay sesión activa o si el inicio de sesión ha fallado
                            if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') :
                            ?>
                                <a class="btn btn-secondary obtener-token-btn">GET TOKEN</a>
                                <br>

                                <ul>
                                    <li>
                                        <strong class="me-1">TOKEN:</strong>
                                        <code class="token-code"></code>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code class="json hljs">
[
    {
        "title": "apples",
        "count": [12000, 20000],
        "description": {"text": "...", "sensitive": false}
    },
    {
        "title": "oranges",
        "count": [17500, null],
        "description": {"text": "...", "sensitive": false}
    }
]


</code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="modificaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-warning">PUT</a> Competicion </h2>
                            <h2><code>/competicion/:id</code></h2>

                            <p>Modficación de una competición.
                            </p>
                            <?php
                            // Verificar si no hay sesión activa o si el inicio de sesión ha fallado
                            if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') :
                            ?>
                                <a class="btn btn-secondary obtener-token-btn">GET TOKEN</a>
                                <br>

                                <ul>
                                    <li>
                                        <strong class="me-1">TOKEN:</strong>
                                        <code class="token-code"></code>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code class="json hljs">
[
    {
        "title": "apples",
        "count": [12000, 20000],
        "description": {"text": "...", "sensitive": false}
    },
    {
        "title": "oranges",
        "count": [17500, null],
        "description": {"text": "...", "sensitive": false}
    }
]


</code></pre>
                                </div>

                            <?php endif; ?>

                        </section>



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
    </div>

    <script>
        // Función común para manejar el evento clic de todos los botones
        function obtenerToken() {
            // Obtener el índice del botón que fue clicado
            var indice = Array.from(document.getElementsByClassName('obtener-token-btn')).indexOf(this);

            // Realizar una solicitud AJAX para obtener el token desde el servidor PHP
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost/API-RESTful-PHP/obtenerToken', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Actualizar el contenido del código con el token recibido
                    var tokenCode = document.getElementsByClassName('token-code')[indice];
                    tokenCode.textContent = xhr.responseText;
                } else {
                    console.error('Error al obtener el token.');
                }
            };

            xhr.send();
        }

        // Obtener todos los elementos con la clase 'obtener-token-btn' y asignar la misma función de clic
        var botones = document.getElementsByClassName('obtener-token-btn');
        for (var i = 0; i < botones.length; i++) {
            botones[i].addEventListener('click', obtenerToken);
        }
    </script>

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