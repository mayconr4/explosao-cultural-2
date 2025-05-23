<?php 
namespace ExplosaoCultural\DataBase;

use Exception;
use PDO;
use Throwable;

abstract class ConexaoDB 
{ 
    private static PDO $conexao;
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "explosao_cultural";
    private static string $charset = "utf8";

    public static function getConexao():PDO 
    { 
        if(!isset(self::$conexao)){ 

            try{ 
                self::$conexao = new PDO( 
                    "mysql:host=".self::$servidor.";dbname=".self::$banco.";charset=utf8",
                    self::$usuario, self::$senha
                ); 


                self::$conexao->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
            }   catch (Throwable $erro){ 


                throw new Exception("erro ao conectar com o banco de dados !").$erro->getMessage();
            }
        }
        return self::$conexao;
    }

}