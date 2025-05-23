<?php 

namespace ExplosaoCultural\Auth; 


final class ControleDeAcesso 
{

    private function
    __construct() 
    {
        // Construtor privado para impedir instâncias externas
    } 

    public static function iniciarSessao():void{

        if(!isset($_SESSION)) session_start();             
        
    } 

    public static function login(int $id, string $nome, string $tipo):void
    {
        self::iniciarSessao();

        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;
    }

    public static function logout():void{
        self::iniciarSessao();
        session_destroy();
        header("location:../login.php?logout");
        exit();
    } 

    public static function exigirAdmin(): void
    {
        self::iniciarSessao();

       if(!$_SESSION['tipo'] === ['Administrador']) 
       {
            header("location:nao-autorizado.php");
            exit();
        }
    }

}

