<?php

include_once 'presentation.class.php';
include_once 'business.class.php';

View::start('Artencuentro');
View::navigation(User::getLoggedUser());


$id = $_GET['usuario'];

$query = DB::execute_sql("DELETE FROM usuarios WHERE id = ?", array($id));
        
if($query){
    echo "Usuario eliminado con exito";
} else{
    echo "Error al eliminar usuario.";
}

header('location: listUsers.php');