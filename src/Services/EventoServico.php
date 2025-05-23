<?php

namespace ExplosaoCultural\Services;

use Exception;
use ExplosaoCultural\DataBase\ConexaoDB;
use ExplosaoCultural\Enums\TipoGenero;
use ExplosaoCultural\Helpers\Utils;
use ExplosaoCultural\Models\Eventos;
use PDO;
use Throwable;

final class EventoServico
{
    private PDO $conexao;

    //construct
    public function __construct()
    {
        $this->conexao =  ConexaoDB::getConexao();
    }

    //listarTodos
    public function listarTodos(): array
    {
        $sql = "SELECT  
        eventos.id ,
        eventos.nome AS evento,
        DATE_FORMAT(eventos.datas, '%d/%m/%Y') AS data_evento,
        TIME_FORMAT(eventos.horario, '%Hh%i') AS horario,
        eventos.classificacao AS classificacao,
        eventos.telefone AS telefone,
        eventos.descricao AS descricao,
        eventos.imagem AS imagem,
        usuarios.nome AS criador,
        generos.tipo AS genero,
        enderecos.logradouro AS endereco
        FROM eventos
        JOIN usuarios ON eventos.usuario_id = usuarios.id
        JOIN generos ON eventos.genero_id = generos.id
        JOIN enderecos ON eventos.endereco_id = enderecos.id   
        ORDER BY eventos.nome";

        // WHERE eventos.status = 1 
        // ORDER BY eventos.datas DESC, eventos.horario DESC Olhar com calma está relacionado a o metofo que você tem que desenvolver para o evento mais proximos terem preferenci a de exibição

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            //Utils::registrarErro($erro);
            throw new Exception("erro ao listar eventos" . $erro->getMessage());
        }
    }

    //buscarPorId() 
    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM eventos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao buscar evento");
        }
    }

    //Mostrar eventos por genero
    public function listarPorGenero(int $generoId): array
    {
        $sql = "SELECT 
                    COLUMN_TYPE
                    FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_NAME = 'generos'
                    AND COLUMN_NAME = 'tipo'
                    AND TABLE_SCHEMA = 'explosao_cultural';
                    ";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":genero_id", $generoId, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao listar eventos por genero");
        }
    }

    //inserir() 
    public function inserir(Eventos $evento): bool
    {
        $sql = "INSERT INTO eventos (nome,datas,horario,classificacao,telefone,usuario_id,endereco_id,genero_id,descricao,imagem)
        vALUES (:nome,:datas,:horario,:classificacao,:telefone,:usuario_id,:endereco_id,:genero_id,:descricao,:imagem)";


        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $evento->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":datas", $evento->getData(), PDO::PARAM_STR);
            $consulta->bindValue(":horario", $evento->getHorario(), PDO::PARAM_STR);
            $consulta->bindValue(":classificacao", $evento->getClassificacao(), PDO::PARAM_STR);
            $consulta->bindValue(":telefone", $evento->getTelefone(), PDO::PARAM_STR);
            $consulta->bindValue(":usuario_id", $evento->getUsuarioId(), PDO::PARAM_INT);
            $consulta->bindValue(":endereco_id", $evento->getEnderecoId(), PDO::PARAM_INT);
            $consulta->bindValue(":genero_id", $evento->getGeneroId(), PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $evento->getDescricao(), PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $evento->getImagem(), PDO::PARAM_STR);

            return $consulta->execute();
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao inserir evento");
        }
    }

    //atualizar()
    public function atualizar(Eventos $evento): void
    {
        $sql = "UPDATE eventos SET nome = :nome,
        datas = :datas,
        horario = :horario,
        classificacao = :classificacao,
        telefone = :telefone,
        usuario_id = :usuario_id,
        endereco_id = :endereco_id,
        genero_id = :genero_id,
        descricao = :descricao,
        imagem = :imagem WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $evento->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":nome", $evento->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":datas", $evento->getData(), PDO::PARAM_STR);
            $consulta->bindValue(":horario", $evento->getHorario(), PDO::PARAM_STR);
            $consulta->bindValue(":classificacao", $evento->getClassificacao(), PDO::PARAM_STR);
            $consulta->bindValue(":telefone", $evento->getTelefone(), PDO::PARAM_STR);
            $consulta->bindValue(":usuario_id", $evento->getUsuarioId(), PDO::PARAM_INT);
            $consulta->bindValue(":endereco_id", $evento->getEnderecoId(), PDO::PARAM_INT);
            $consulta->bindValue(":genero_id", $evento->getGeneroId(), PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $evento->getDescricao(), PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $evento->getImagem(), PDO::PARAM_STR);

            if (!$consulta->execute()) {
                throw new Exception("erro ao atualizar evento");
            }
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao atualizar evento");
        }
    }

    //excluir()
    public function excluir(int $id): void
    {
        $sql = "DELETE FROM eventos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            Utils::registrarErro($erro);
            throw new Exception("erro ao excluir evento");
        }
    }
}
