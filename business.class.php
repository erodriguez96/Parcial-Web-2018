<?php
include_once 'data_access.class.php';
class User{
    public static function session_start(){
        if(session_status () === PHP_SESSION_NONE){
            session_start();
        }
    }
    public static function getLoggedUser(){ //Devuelve un array con los datos del cuenta o false
        self::session_start();
        if(!isset($_SESSION['user'])) return false;
        return $_SESSION['user'];
    }
    public static function login($usuario,$pass){ //Devuelve verdadero o falso según
        self::session_start();
        if(DB::user_exists($usuario, $pass, $res)){
            $_SESSION['user']=$res[0]; //Almacena datos del usuario en la sesión
            return true;
        }
        return false;
    }
    public static function logout(){
        self::session_start();
        unset($_SESSION['user']);
    }
    
    public static function getAllUsers(){
        return DB::getAllUsers();
    }
    
    public static function test_input($parametro){
        $parametro = trim($parametro);
        $parametro = stripslashes($parametro);
        $parametro = htmlspecialchars($parametro);
        return $parametro;
    }
    
    public static function validaCuenta($parametro){
        if(strlen($parametro) < 8 || strlen($parametro) > 20){
            return false;
        }else{
            return $parametro;
        }
    }
    
    public static function validaClave($parametro){
        if(strlen($parametro) < 8 || strlen($parametro) > 16){
            return false;
        }else{
            return $parametro;
        }
    }
    
    public static function validaNombre($parametro){
        if(strlen($parametro) < 8 || strlen($parametro) > 16){
            return false;
        }else{
            return $parametro;
        }
    }
    
    public static function validaTipo($parametro){
        if($parametro < 1 || $parametro > 3){
            return false;
        }else{
            return $parametro;
        }
    }
    
    public static function validaPoblacion($parametro){
        if(strlen($parametro) > 100){
            return false;
        }else{
            return $parametro;
        }
    }
    
    public static function validadireccion($parametro){
        if(strlen($parametro) > 100){
            return false;
        }else{
            return $parametro;
        }
    }
    
    public static function validaTelefono($parametro){
        if(strlen($parametro) > 15){
            return false;
        }else{
            return $parametro;
        }
    }
}
