<?php

include_once 'presentation.class.php';
include_once 'business.class.php';

View::start('Artencuentro');
View::navigation(User::getLoggedUser());

if(isset($_POST['Enviar'])){
    
    $cuenta = User::validaCuenta(User::test_input($_POST['cuenta']));
    $clave = User::validaClave(User::test_input($_POST['clave']));
    $nombre = User::validaNombre(User::test_input($_POST['nombre']));
    $tipo = User::validaTipo(User::test_input($_POST['tipo']));
    $poblacion = User::validaPoblacion(User::test_input($_POST['poblacion']));
    $direccion = User::validaDireccion(User::test_input($_POST['direccion']));
    $telefono = User::validaTelefono(User::test_input($_POST['telefono']));
    
    if(!$cuenta || !$clave || !$nombre || !$tipo || !$poblacion || !$direccion || !$telefono){
        echo 'Alguno de los parametros mal introducidos, revisar condiciones del formulario.';
    }else{
        $query = DB::execute_sql("INSERT INTO usuarios(cuenta,clave,nombre,tipo,poblacion,direccion,telefono) VALUES (?,?,?,?,?,?,?)", array($cuenta,md5($clave),$nombre,$tipo,$poblacion,$direccion,$telefono));
        
        if($query){
            echo "Usuario añadido con exito";
        } else{
            echo "Error al añadir usuario.";
        }
    }
    
    header("location: index.php");
}

if(User::getLoggedUser()['id'] == 1){
    echo '
        <form class="formulario" method="post">
            <input type="text" name="cuenta" value="" placeholder="nombre de cuenta..."/>Cuenta (Entre 8 y 20 caracteres, sin coincidencias con otros usuarios)<br>
            <input type="text" name="clave" value="" placeholder="Contraseña..."/>Clave (Entre 8 y 16 caracteres, al menos un digito)<br>
            <input type="text" name="nombre" value="" placeholder="Su nombre..."/>Nombre (entre 8 y 16 caracteres)<br>
            <input type="number" name="tipo" value="" placeholder="tipo de la cuenta (adm, aut, emp)..."/>Tipo (1: adm, 2: aut, 3: emp)<br>
            <input type="text" name="poblacion" value="" placeholder="Poblacion..."/>Poblacion (máximo 100 caracteres)<br>
            <input type="text" name="direccion" value="" placeholder="Direccion..."/>Direccion (máximo 100 caracteres)<br>
            <input type="text" name="telefono" value="" placeholder="Telefono..."/>Telefono (máximo 15 caracteres)<br>
            <input type="submit" name="Enviar" value="Enviar"/> 
        </form>
    ';
} else{
    echo "usted intenta acceder a una funcion exclusiva de administrador.";
}
