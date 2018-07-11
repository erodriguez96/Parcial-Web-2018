<?php

include_once 'presentation.class.php';
include_once 'business.class.php';

View::start('Artencuentro');
View::navigation(User::getLoggedUser());


$id = $_GET['usuario'];
$cuenta = $_GET['cuenta'];
$nombre = $_GET['nombre'];
$poblacion = $_GET['poblacion'];
$direccion = $_GET['direccion'];
$telefono = $_GET['telefono'];


if(isset($_POST['Enviar'])){
    $cuenta = User::validaCuenta(User::test_input($_POST['cuenta']));
    $clave = User::validaClave(User::test_input($_POST['clave']));
    $nombre = User::validaNombre(User::test_input($_POST['nombre']));
    $poblacion = User::validaPoblacion(User::test_input($_POST['poblacion']));
    $direccion = User::validaDireccion(User::test_input($_POST['direccion']));
    $telefono = User::validaTelefono(User::test_input($_POST['telefono']));

    if(!$cuenta || !$clave || !$nombre || !$poblacion || !$direccion || !$telefono){
        echo 'Alguno de los parametros mal introducidos, revisar condiciones del formulario.';
    }else{
        $query = DB::execute_sql("UPDATE usuarios SET cuenta = ?, clave = ?, nombre = ?, poblacion = ?, direccion = ?, telefono = ? WHERE id = $id", array($cuenta,md5($clave),$nombre,$poblacion,$direccion,$telefono));
        
        if($query){
            echo "Usuario modificado con exito";
        } else{
            echo "Error al modificar usuario.";
        }
    }
    header('location: listUsers.php');
}

if(User::getLoggedUser()['id'] == 1){
    echo "
        <form class='formulario' method='post'>
            <input type='text' name='cuenta' value='$cuenta' placeholder='nombre de cuenta...'/>Cuenta (Entre 8 y 20 caracteres, sin coincidencias con otros usuarios)<br>
            <input type='text' name='clave' value='' placeholder='Contraseña...'/>Clave (Entre 8 y 16 caracteres, al menos un digito)<br>
            <input type='text' name='nombre' value='$nombre' placeholder='Su nombre...'/>Nombre (entre 8 y 16 caracteres)<br>
            <input type='text' name='poblacion' value='$poblacion' placeholder='Poblacion...'/>Poblacion (máximo 100 caracteres)<br>
            <input type='text' name='direccion' value='$direccion' placeholder='Direccion...'/>Direccion (máximo 100 caracteres)<br>
            <input type='text' name='telefono' value='$telefono' placeholder='Telefono...'/>Telefono (máximo 15 caracteres)<br>
            <input type='submit' name='Enviar' value='Enviar'/> 
        </form>
    ";
} else{
    echo "usted intenta acceder a una funcion exclusiva de administrador.";
}