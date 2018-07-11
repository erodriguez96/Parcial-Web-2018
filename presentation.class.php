<?php
include_once 'business.class.php';
class View{
    public static function  start($title){
        $html = "<!DOCTYPE html>
        <html>
        <head>
        <meta charset=\"utf-8\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">
        <script src=\"jquery.js\"></script>
        <script src=\"scripts.js\"></script>
        <title>$title</title>
        </head>
        <body>";
        User::session_start();
        echo $html;
    }
    public static function navigation($user = false){
        
        $autenticado = $log = "";
        if ($user) {
            $autenticado = $user['nombre'];
        }
        
        //cambio de boton en caso de estar ya logueado
        
        if(User::getLoggedUser()){
            $log = '<a href="logout.php">Logout</a>';
        }else{
            $log = '<a href="login.php">Login</a>';
        }
        
        echo '
            <div>
                <nav>
                '.$log.'
                <a href="addUser.php">Añade usuario</a>
                <a href="listUsers.php">Lista usuarios</a>
                <a id="nombre">'.$autenticado.'</a>
                </nav>
            </div>
        ';
        
        
    }
    
    public static function listUsers($users){
        if(User::getLoggedUser()['id'] == 1){
            if (count($users) > 0) {
                echo '<table id="tabla">';
                echo '<tr>';
                echo '<th>Cuenta</th>';
                echo '<th>Nombre</th>';
                echo '<th>Tipo</th>';
                echo '<th>Población</th>';
                echo '<th>Dirección</th>';
                echo '<th>Teléfono</th>';
                echo '</tr>';
                foreach($users as $user) {
                    $id = $user['id'];
                    echo "<tr id=$id>";
                    echo "<td>{$user['cuenta']}</td>";
                    echo "<td>{$user['nombre']}</td>";
                    $tipostr = (['Administrador', 'Autor', 'Empresa'])[$user['tipo']-1];
                    echo "<td>$tipostr</td>";
                    echo "<td>{$user['poblacion']}</td>";
                    echo "<td>{$user['direccion']}</td>";
                    echo "<td>{$user['telefono']}</td>";
                    
                    
                    $cuenta = $user['cuenta'];
                    $nombre = $user['nombre'];
                    $poblacion = $user['poblacion'];
                    $direccion = $user['direccion'];
                    $telefono = $user['telefono'];
                    echo "<td><a href='editUser.php?usuario=$id&cuenta=$cuenta&nombre=$nombre&poblacion=$poblacion&direccion=$direccion&telefono=$telefono'> Editar usuario </a></td>";
                    
                    echo "<td><a href='deleteUser.php?usuario=$id'> Eliminar usuario </a></td>";
                    //llamada a javascript que no funciona, no tiempo para solucionar, se hace con php
                    //echo "<td><button id='boton' value='Eliminar' onclick='return elimina($id)'></td>";
                    
                    echo '</tr>';
                }
                
                echo "</table>";
            }
        } else{
            echo "Esto es una funcion exclusiva de administrador, loguearse como tal para continuar.";
        }
    }
    
    public static function loginForm(){
            echo '<form class="formulario" method="post">';
            
            echo '<input type="text" name="cuenta" id="cuenta">';
            echo '<label for="cuenta"> Cuenta</label><br>';
            
            
            echo '<input type="password" name="clave" id="clave">';
            echo '<label for="clave"> Clave</label><br>';
            
            echo '<input type="submit" value="Entrar">';
            echo "</form>";
    }

    public static function end(){
        echo '</body>
</html>';
    }
}
