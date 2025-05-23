<?php 
namespace ExplosaoCultural\Services;

use Exception;
use ExplosaoCultural\DataBase\ConexaoDB;
use ExplosaoCultural\Enums\TipoUsuario;
use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Models\Usuarios;
use PDO;
use Throwable;

final class UsuarioServico 
{
    private PDO $conexao; 
    
     public function __construct()
    {
        $this->conexao = ConexaoDB::getConexao();
    }

    public function listarTodos(): array 
    { 
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        
        try{ 
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_CLASS);
        } catch(Throwable $erro){
          Utils::registrarErro($erro);
            throw new Exception("erro ao listar toos os usuarios");
        }
    } 

    public function buscarPorId(int $id): ?array 
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch(Throwable $erro){
            Utils::registrarErro($erro);
            throw new Exception("erro ao buscar usuario por id");
        }
    } 

    public function inserir(Usuarios $usuario): void 
    {
        $sql  = "INSERT INTO usuarios (nome, data_nascimento, email, senha, tipo)
                VALUES (:nome, :data_nascimento, :email, :senha, :tipo)"; 

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":data_nascimento", $usuario->getDataNascimento(), PDO::PARAM_STR);
            $consulta->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $consulta->bindValue(":senha", $usuario->getSenha(), PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $usuario->getTipoDoUser()->name, PDO::PARAM_STR);
            $consulta->execute();              
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao inserir usuario");
        }        
    } 

    public function atualizar(Usuarios $usuario): void 
    {
        $sql = "UPDATE usuarios SET nome = :nome, data_nascimento = :data_nascimento, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $usuario->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":data_nascimento", $usuario->getDataNascimento(), PDO::PARAM_STR);
            $consulta->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $consulta->bindValue(":senha", $usuario->getSenha(), PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $usuario->getTipoDoUser()->name, PDO::PARAM_STR);
            $consulta->bindValue(":id", $usuario->getId(), PDO::PARAM_INT);
            $consulta->execute();              
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao atualizar usuario");
        }        
    } 

    public function excluir(int $id): void 
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();              
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao excluir usuario");
        }        
    } 

     public function buscarPorEmail(string $email): ?array
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":email", $email, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $e) {
            Utils::registrarErro($e);
            throw new Exception("Erro ao buscar usuário por e-mail.");
        }
    }


}
