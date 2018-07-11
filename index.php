<?php

include_once 'presentation.class.php';

View::start('Artencuentro');
View::navigation(User::getLoggedUser());

echo '<h1> Artencuentro </h1>';

echo '<p> Bienvenido a artencuentro, el punto de encuentro online para empresas, autores y visitantes interesados en arte de talla mundial y calidad suprema. </p>';

View::end();
