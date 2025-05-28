<?php 

namespace ExplosaoCultural\Services;

use Exception;
use ExplosaoCultural\DataBase\ConexaoDB;
use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Models\Generos;
use PDO;
use Throwable;

final class GeneroServico 
{

    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoDB::getConexao();
    } 

    public function listarTodos(): array
    {
        $sql = "SELECT * FROM generos";

        try { 
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro ao listar os gêneros: "  );
        }
    } 

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM generos WHERE id = :id";

        try { 
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro ao buscar o gênero: "  );
        }
    } 

    public function inserir(Generos $generos): void
    { 
        $sql = "INSERT INTO generos(tipo) VALUES (:tipo)";

        try { 
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':tipo', $generos->getGenero(), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro ao inserir o gênero: "  );
        }


    } 

    public function atualizar(Generos $generos): void
    { 
        $sql = "UPDATE generos SET tipo = :tipo WHERE id = :id";

        try { 
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':tipo', $generos->getGenero() , PDO::PARAM_STR);
            $consulta->bindValue(':id', $generos->getId(), PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro ao atualizar o gênero: "  );
        }
    } 

    public function exluir(int $id): void 
    { 
        $sql = "DELETE FROM generos WHERE id = :id";

        try { 
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("Erro ao excluir o gênero: "  );
        }

    } 

    
}