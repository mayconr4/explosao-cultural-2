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


    public function inserir(Enderecos $endereco): int
    {
        $sql = "INSERT INTO enderecos (cep, logradouro, bairro, cidade, estado) 
            VALUES (:cep, :logradouro, :bairro, :cidade, :estado)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);
            $consulta->bindValue(':logradouro', $endereco->getLogradouro(), PDO::PARAM_STR);
            $consulta->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
            $consulta->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
            $consulta->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR);

            $consulta->execute();

            // Retorna o ID do endereço inserido
            return (int) $this->conexao->lastInsertId();
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro ao inserir o endereço.");
        }
    }


    public function atualizar(Enderecos $endereco): void
    {
        try {
            if ($endereco->getId() === null) {
                // Se o ID é null, é um NOVO ENDEREÇO, então INSERE
                $sql = "INSERT INTO enderecos (cep, logradouro, bairro, cidade, estado) 
                        VALUES (:cep, :logradouro, :bairro, :cidade, :estado)";
                $consulta = $this->conexao->prepare($sql);
                $consulta->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);
                $consulta->bindValue(':logradouro', $endereco->getLogradouro(), PDO::PARAM_STR);
                $consulta->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
                $consulta->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
                $consulta->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR);

                if (!$consulta->execute()) {
                    throw new Exception("Erro ao inserir o endereço.");
                }

                // IMPORTANTE: Define o ID gerado no objeto Enderecos
                $endereco->setId((int)$this->conexao->lastInsertId());

            } else {
                // Se o ID existe, é um ENDEREÇO EXISTENTE, então ATUALIZA
                $sql = "UPDATE enderecos SET cep = :cep, 
                        logradouro = :logradouro,            
                        bairro = :bairro, 
                        cidade = :cidade, 
                        estado = :estado 
                        WHERE id = :id"; 
                $consulta = $this->conexao->prepare($sql); 
                $consulta->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR); 
                $consulta->bindValue(':logradouro', $endereco->getLogradouro(), PDO::PARAM_STR);              
                $consulta->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR); 
                $consulta->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR); 
                $consulta->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR); 
                $consulta->bindValue(':id', $endereco->getId(), PDO::PARAM_INT); 

                if (!$consulta->execute()) {
                    throw new Exception("Erro ao atualizar o endereço existente.");
                }
            }
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro no serviço de endereço: " . $erro->getMessage());
        }
    }


    // public function atualizar(Enderecos $endereco): void
    // {
    //     $sql = "UPDATE enderecos SET cep = :cep, 
    //     logradouro = :logradouro,           
    //     bairro = :bairro, 
    //     cidade = :cidade, 
    //     estado = :estado WHERE id = :id"; 

    //     try {
    //         $consulta = $this->conexao->prepare($sql); 
    //         $consulta->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR); 
    //         $consulta->bindValue(':logradouro', $endereco->getLogradouro(), PDO::PARAM_STR);              
    //         $consulta->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR); 
    //         $consulta->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR); 
    //         $consulta->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR); 
    //         $consulta->bindValue(':id', $endereco->getId(), PDO::PARAM_INT); 

    //         if (!$consulta->execute()) {
    //             throw new Exception("Erro ao atualizar o endereço: ");
    //         }
    //     } catch (Throwable $erro) {
    //         UTILS::registrarErro($erro);
    //         throw new Exception("Erro ao atualizar o endereço: ");
    //     }
    // } 

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