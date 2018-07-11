<?php

include_once 'presentation.class.php';
include_once 'business.class.php';

if (isset($_POST['cuenta'])) {
    if(User::login($_POST['cuenta'],$_POST['clave'])) {
        include_once 'index.php';
        die;
    }
}

View::start('Artencuentro');
View::navigation(User::getLoggedUser());

View::loginForm();


View::end();
