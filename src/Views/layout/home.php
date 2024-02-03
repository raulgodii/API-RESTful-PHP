<!DOCTYPE html>
<html lang="en">

<head>
    <title>PowerHispania API</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap 4 Template For Software Startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/images/coderdocs-logo.svg">

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

                                <a class="btn btn-info" id="mostrar_competiciones">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>
                                <br>
                                <span id="mostrar_competiciones_error" style="color:red"></span>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code id="mostrar_competiciones_res" class="json hljs"></code></pre>
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

                                <input type="text" id="mostrar_competicion_input" placeholder="Introduce el ID"><br><br>

                                <a class="btn btn-info" id="mostrar_competicion">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>
                                <br>
                                <span id="mostrar_competicion_error" style="color:red"></span>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code id="mostrar_competicion_res" class="json hljs"></code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="creaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-info">POST</a> Crear competicion </h2>
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

                                <form id="formularioCompeticion">
                                    <label for="crear_competicion_nombre">Nombre de la Competición:</label>
                                    <input type="text" id="crear_competicion_nombre" name="nombre" value="" placeholder="Nombre de la Competición" required><br>

                                    <label for="crear_competicion_fecha">Fecha:</label>
                                    <input type="date" id="crear_competicion_fecha" name="fecha" value="" placeholder="Fecha de la Competición" required><br>

                                    <label for="crear_competicion_ubicacion">Ubicación de la Competición:</label>
                                    <input type="text" id="crear_competicion_ubicacion" name="ubicacion" value="" placeholder="Ubicación de la Competición" required><br>

                                    <label for="crear_competicion_organizador">Organizador de la Competición:</label>
                                    <input type="text" id="crear_competicion_organizador" name="organizador" value="" placeholder="Organizador de la Competición" required><br>

                                    <label for="crear_competicion_nivel">Nivel de la Competición:</label>
                                    <input type="text" id="crear_competicion_nivel" name="nivel" value="" placeholder="Nivel de la Competición" required><br>

                                    <label for="crear_competicion_division">División de la Competición:</label>
                                    <input type="text" id="crear_competicion_division" name="division" value="" placeholder="División de la Competición" required><br>
                                </form>


                                <a class="btn btn-info" id="crear_competicion">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>
                                <br>

                                <span id="crear_competicion_error" style="color:red"></span>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code id="crear_competicion_res" class="json hljs"></code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="eliminaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-danger">DELETE</a> Eliminar competicion </h2>
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

                                <input type="text" id="eliminar_competicion_input" placeholder="Introduce el ID"><br><br>

                                <a class="btn btn-info" id="eliminar_competicion">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>
                                <br>
                                <span id="eliminar_competicion_error" style="color:red"></span>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code id="eliminar_competicion_res" class="json hljs"></code></pre>
                                </div>

                            <?php endif; ?>

                        </section>

                        <section class="docs-section" id="modificaCompeticion">
                            <h2 class="section-heading"><a class="btn btn-warning">PUT</a> Modificar competicion </h2>
                            <h2><code>/competicion/:id</code></h2>

                            <p>Modificación de una competición.
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

                                <input type="text" id="modificar_competicion_input" placeholder="Introduce el ID"><br><br>

                                <form id="formularioCompeticion">
                                    <label for="modificar_competicion_nombre">Nombre de la Competición:</label>
                                    <input type="text" id="modificar_competicion_nombre" name="nombre" value="" placeholder="Nombre de la Competición" required><br>

                                    <label for="modificar_competicion_fecha">Fecha:</label>
                                    <input type="date" id="modificar_competicion_fecha" name="fecha" value="" placeholder="Fecha de la Competición" required><br>

                                    <label for="modificar_competicion_ubicacion">Ubicación de la Competición:</label>
                                    <input type="text" id="modificar_competicion_ubicacion" name="ubicacion" value="" placeholder="Ubicación de la Competición" required><br>

                                    <label for="modificar_competicion_organizador">Organizador de la Competición:</label>
                                    <input type="text" id="modificar_competicion_organizador" name="organizador" value="" placeholder="Organizador de la Competición" required><br>

                                    <label for="modificar_competicion_nivel">Nivel de la Competición:</label>
                                    <input type="text" id="modificar_competicion_nivel" name="nivel" value="" placeholder="Nivel de la Competición" required><br>

                                    <label for="modificar_competicion_division">División de la Competición:</label>
                                    <input type="text" id="modificar_competicion_division" name="division" value="" placeholder="División de la Competición" required><br>
                                </form>

                                <a class="btn btn-info" id="modificar_competicion">
                                    <i class="fas fa-play-circle me-2"></i>
                                    Ejecutar</a>
                                <br>
                                <span id="modificar_competicion_error" style="color:red"></span>

                                <div class="docs-code-block">
                                    <pre class="shadow-lg rounded"><code id="modificar_competicion_res" class="json hljs"></code></pre>
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

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Actualizar el contenido del código con el token recibido
                    var tokenCode = document.getElementsByClassName('token-code')[indice];
                    tokenCode.textContent = xhr.responseText;
                    token = xhr.responseText;
                } else {
                    console.error('Error al obtener el token.');
                }
            };

            xhr.send();
        }

        var token;

        // Obtener todos los elementos con la clase 'obtener-token-btn' y asignar la misma función de clic
        var botones = document.getElementsByClassName('obtener-token-btn');
        for (var i = 0; i < botones.length; i++) {
            botones[i].addEventListener('click', obtenerToken);
        }
    </script>

    <script>
        function mostrar_competiciones_func() {
            // Crear objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud (método, URL, asíncrona)
            xhr.open('GET', 'http://localhost/API-RESTful-PHP/competiciones', true);

            xhr.setRequestHeader('Authorization', 'Bearer ' + token);

            // Configurar la función de devolución de llamada cuando la solicitud se complete
            xhr.onload = function() {

                // Manejar la respuesta exitosa

                console.log(xhr.responseText);

                // Decodificar caracteres de escape
                var jsonObject = JSON.parse(xhr.responseText);

                // Convertir el objeto JSON a una cadena con formato
                var formattedJson = JSON.stringify(jsonObject, null, 2);

                // Insertar la cadena en el elemento con id "jsonRes"
                document.getElementById('mostrar_competiciones_res').textContent = formattedJson;

                // Resaltar la sintaxis del JSON
                hljs.highlightBlock(document.getElementById('mostrar_competiciones_res'));
            };

            // Establecer la cabecera de autorización con el token
            if (!token) {
                document.getElementById("mostrar_competiciones_error").innerText = "Primero solicita el token";
            } else {
                // Enviar la solicitud
                document.getElementById("mostrar_competiciones_error").innerText = "";
                xhr.send();
            }
        }

        function mostrar_competicion_func() {
            // Crear objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();

            id = document.getElementById("mostrar_competicion_input").value;

            // Configurar la solicitud (método, URL, asíncrona)
            xhr.open('GET', 'http://localhost/API-RESTful-PHP/competicion/' + id, true);

            xhr.setRequestHeader('Authorization', 'Bearer ' + token);

            // Configurar la función de devolución de llamada cuando la solicitud se complete
            xhr.onload = function() {

                // Manejar la respuesta exitosa

                console.log(xhr.responseText);

                // Decodificar caracteres de escape
                var jsonObject = JSON.parse(xhr.responseText);

                // Convertir el objeto JSON a una cadena con formato
                var formattedJson = JSON.stringify(jsonObject, null, 2);

                // Insertar la cadena en el elemento con id "jsonRes"
                document.getElementById('mostrar_competicion_res').textContent = formattedJson;

                // Resaltar la sintaxis del JSON
                hljs.highlightBlock(document.getElementById('mostrar_competicion_res'));
            };

            // Establecer la cabecera de autorización con el token
            if (!token) {
                document.getElementById("mostrar_competicion_error").innerText = "Primero solicita el token";
            } else {
                // Enviar la solicitud
                document.getElementById("mostrar_competicion_error").innerText = "";
                xhr.send();
            }
        }

        function crear_competicion_func() {
            // Crear objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud (método, URL, asíncrona)
            xhr.open('POST', 'http://localhost/API-RESTful-PHP/competicion', true);

            xhr.setRequestHeader('Authorization', 'Bearer ' + token);

            // Configurar la función de devolución de llamada cuando la solicitud se complete
            xhr.onload = function() {

                // Manejar la respuesta exitosa

                console.log(xhr.responseText);

                // Decodificar caracteres de escape
                var jsonObject = JSON.parse(xhr.responseText);

                // Convertir el objeto JSON a una cadena con formato
                var formattedJson = JSON.stringify(jsonObject, null, 2);

                // Insertar la cadena en el elemento con id "jsonRes"
                document.getElementById('crear_competicion_res').textContent = formattedJson;

                // Resaltar la sintaxis del JSON
                hljs.highlightBlock(document.getElementById('crear_competicion_res'));
            };

            // Obtener valores de los campos del formulario
            var nombre = document.getElementById('crear_competicion_nombre').value;
            var fecha = document.getElementById('crear_competicion_fecha').value;
            var ubicacion = document.getElementById('crear_competicion_ubicacion').value;
            var organizador = document.getElementById('crear_competicion_organizador').value;
            var nivel = document.getElementById('crear_competicion_nivel').value;
            var division = document.getElementById('crear_competicion_division').value;

            var data = {
                'nombre': nombre,
                'fecha': fecha,
                'ubicacion': ubicacion,
                'organizador': organizador,
                'nivel': nivel,
                'division': division
            };

            // Establecer la cabecera de autorización con el token
            if (!token) {
                document.getElementById("crear_competicion_error").innerText = "Primero solicita el token";
            } else {
                // Enviar la solicitud
                document.getElementById("crear_competicion_error").innerText = "";
                xhr.send(JSON.stringify(data));
            }
        }

        function eliminar_competicion_func() {
            // Crear objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();

            id = document.getElementById("eliminar_competicion_input").value;

            // Configurar la solicitud (método, URL, asíncrona)
            xhr.open('DELETE', 'http://localhost/API-RESTful-PHP/competicion/' + id, true);

            xhr.setRequestHeader('Authorization', 'Bearer ' + token);

            // Configurar la función de devolución de llamada cuando la solicitud se complete
            xhr.onload = function() {

                // Manejar la respuesta exitosa

                console.log(xhr.responseText);

                // Decodificar caracteres de escape
                var jsonObject = JSON.parse(xhr.responseText);

                // Convertir el objeto JSON a una cadena con formato
                var formattedJson = JSON.stringify(jsonObject, null, 2);

                // Insertar la cadena en el elemento con id "jsonRes"
                document.getElementById('eliminar_competicion_res').textContent = formattedJson;

                // Resaltar la sintaxis del JSON
                hljs.highlightBlock(document.getElementById('eliminar_competicion_res'));
            };

            // Establecer la cabecera de autorización con el token
            if (!token) {
                document.getElementById("eliminar_competicion_error").innerText = "Primero solicita el token";
            } else {
                // Enviar la solicitud
                document.getElementById("eliminar_competicion_error").innerText = "";
                xhr.send();
            }
        }

        function modificar_competicion_func() {
            // Crear objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();

            id = document.getElementById("modificar_competicion_input").value;

            // Configurar la solicitud (método, URL, asíncrona)
            xhr.open('PUT', 'http://localhost/API-RESTful-PHP/competicion/' + id, true);

            xhr.setRequestHeader('Authorization', 'Bearer ' + token);

            // Configurar la función de devolución de llamada cuando la solicitud se complete
            xhr.onload = function() {

                // Manejar la respuesta exitosa

                console.log(xhr.responseText);

                // Decodificar caracteres de escape
                var jsonObject = JSON.parse(xhr.responseText);

                // Convertir el objeto JSON a una cadena con formato
                var formattedJson = JSON.stringify(jsonObject, null, 2);

                // Insertar la cadena en el elemento con id "jsonRes"
                document.getElementById('modificar_competicion_res').textContent = formattedJson;

                // Resaltar la sintaxis del JSON
                hljs.highlightBlock(document.getElementById('modificar_competicion_res'));
            };
            
            // Obtener valores de los campos del formulario
            var nombre = document.getElementById('modificar_competicion_nombre').value;
            var fecha = document.getElementById('modificar_competicion_fecha').value;
            var ubicacion = document.getElementById('modificar_competicion_ubicacion').value;
            var organizador = document.getElementById('modificar_competicion_organizador').value;
            var nivel = document.getElementById('modificar_competicion_nivel').value;
            var division = document.getElementById('modificar_competicion_division').value;

            var data = {
                'nombre': nombre,
                'fecha': fecha,
                'ubicacion': ubicacion,
                'organizador': organizador,
                'nivel': nivel,
                'division': division
            };

            // Establecer la cabecera de autorización con el token
            if (!token) {
                document.getElementById("modificar_competicion_error").innerText = "Primero solicita el token";
            } else {
                // Enviar la solicitud
                document.getElementById("modificar_competicion_error").innerText = "";
                xhr.send(JSON.stringify(data));
            }
        }

        var botones = document.getElementsByClassName('enviarPeticionBtn');

        var mostrar_competiciones = document.getElementById("mostrar_competiciones");
        mostrar_competiciones.addEventListener('click', mostrar_competiciones_func);

        var mostrar_competicion = document.getElementById("mostrar_competicion");
        mostrar_competicion.addEventListener('click', mostrar_competicion_func);

        var crear_competicion = document.getElementById("crear_competicion");
        crear_competicion.addEventListener('click', crear_competicion_func);

        var eliminar_competicion = document.getElementById("eliminar_competicion");
        eliminar_competicion.addEventListener('click', eliminar_competicion_func);

        var modificar_competicion = document.getElementById("modificar_competicion");
        modificar_competicion.addEventListener('click', modificar_competicion_func);
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