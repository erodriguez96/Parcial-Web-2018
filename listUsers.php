<?php

include_once 'presentation.class.php';
include_once 'business.class.php';



View::start('Artencuentro');
View::navigation(User::getLoggedUser());

if(User::getLoggedUser()['id'] == 1){
    View::listUsers(User::getAllUsers());
} else{
    echo "usted intenta acceder a una funcion exclusiva de administrador.";
}

View::end();
