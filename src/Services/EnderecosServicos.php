<?php 

namespace ExplosaoCultural\Services;

use Exception;
use ExplosaoCultural\DataBase\ConexaoDB;
use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Models\Enderecos;
use PDO;
use Throwable;

final class EnderecosServicos 
{ 
    private PDO $conexao; 

    public function __construct() 
    { 
        $this->conexao = ConexaoDB::getConexao(); 
    } 

    public function listarTodos(): array 
    { 
       $sql = "SELECT * FROM enderecos"; 

        try { 
            $consulta = $this->conexao->prepare($sql); 
            $consulta->execute(); 
            return $consulta->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Throwable $erro) { 
            Utils::registrarErro($erro); 
            throw new Exception("Erro ao listar os endereços: "  ); 
        }
    } 

    public function buscarPorId(int $id): ?array 
    { 
        $sql = "SELECT * FROM enderecos WHERE id = :id"; 

        try { 
            $consulta = $this->conexao->prepare($sql); 
            $consulta->bindValue(':id', $id, PDO::PARAM_INT); 
            $consulta->execute(); 
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null; 
        } catch (Throwable $erro) { 
            Utils::registrarErro($erro); 
            throw new Exception("Erro ao buscar o endereço: "  ); 
        } 
    } 


    public function inserir(Enderecos $endereco): bool
    {
        $sql = "INSERT INTO enderecos (cep,logradouro,  bairro, cidade,estado)VALUES (:cep, :logradouro,  :bairro, :cidade, :estado)"; 

        try {
            $consulta = $this->conexao->prepare($sql); 
            $consulta->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR); 
            $consulta->bindValue(':logradouro', $endereco->getLogradouro(), PDO::PARAM_STR);             
            $consulta->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR); 
            $consulta->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR); 
            $consulta->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR); 

            return $consulta->execute();
        } catch (Throwable $erro) {
            UTILS::registrarErro($erro);
            throw new Exception("Erro ao inserir o endereço: ");
        }
    }  

    public function atualizar(Enderecos $endereco): void
    {
        $sql = "UPDATE enderecos SET cep = :cep, 
        logradouro = :logradouro,           
        bairro = :bairro, 
        cidade = :cidade, 
        estado = :estado WHERE id = :id"; 

        try {
            $consulta = $this->conexao->prepare($sql); 
            $consulta->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR); 
            $consulta->bindValue(':logradouro', $endereco->getLogradouro(), PDO::PARAM_STR);              
            $consulta->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR); 
            $consulta->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR); 
            $consulta->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR); 
            $consulta->bindValue(':id', $endereco->getId(), PDO::PARAM_INT); 

            if (!$consulta->execute()) {
                throw new Exception("Erro ao atualizar o endereço: ");
            }
        } catch (Throwable $erro) {
            UTILS::registrarErro($erro);
            throw new Exception("Erro ao atualizar o endereço: ");
        }
    } 

    public function exluir(int $id): void 
    {
        $sql = "DELETE FROM enderecos WHERE id = :id"; 
        try{ 
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) { 
            Utils::registrarErro($erro); 
            throw new Exception("Erro ao excluir o endereço: "  ); 
        }
    }

}