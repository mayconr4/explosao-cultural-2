<?php 

namespace ExplosaoCultural\Services;

use Exception;
use ExplosaoCultural\DataBase\ConexaoDB;
use ExplosaoCultural\Models\Enderecos;
use ExplosaoCultural\Models\Eventos;
use ExplosaoCultural\Services\EnderecosServicos;
use ExplosaoCultural\Services\EventoServico;
use PDO;
use Throwable;

final class EventoComEnderecoServico 
{
    private $eventoServico;
    private $enderecoServico;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoDB::getConexao();
        $this->eventoServico = new EventoServico();
        $this->enderecoServico = new EnderecosServicos();
    } 

    public function cadastrarCompleto(Eventos $evento, Enderecos $endereco): void {
        try {
            $this->conexao->beginTransaction();

            // Insere o endereco e pega o ID dele
            $idEndereco = $this->enderecoServico->inserir($endereco);

            // Acessa o objeto evento (que ja tem alguns dados) e adiciona o id do endereço que acabamos de inserir
            $evento->setEnderecoId($idEndereco);
            
            // Por fim, inserimos o evento com tudo completo
            $this->eventoServico->inserir($evento);
            
            // Só então, processamos tudo no banco
            $this->conexao->commit();
        } catch (Exception $e) {
            $this->conexao->rollBack(); // deu ruim? desfaz tudo
            throw $e; // Propaga o erro para o controlador
        }
    } 

    // public function atualizarCompleto(Eventos $evento, Enderecos $endereco): void {
    //     try {
    //         $this->conexao->beginTransaction();

    //         // Atualiza o endereco
    //          $this->enderecoServico->atualizar($endereco);

    //          $evento->setEnderecoId($endereco->getId()); // Atualiza o ID do endereço no evento

    //         // Atualiza o evento
    //         $this->eventoServico->atualizar($evento);

    //         // Só então, processamos tudo no banco
    //         $this->conexao->commit();
    //     } catch (Exception $e) {
    //         $this->conexao->rollBack(); // deu ruim? desfaz tudo
    //         throw $e; // Propaga o erro para o controlador
    //     }
    // }


    // Em EventoComEnderecoServico.php
public function atualizarCompleto(Eventos $evento, Enderecos $endereco): void
{
    try {
        $this->conexao->beginTransaction();

        // 1. O endereço é atualizado ou INSERIDO.
        // Se for inserido, o objeto $endereco AGORA terá o ID gerado pelo banco.
        $this->enderecoServico->atualizar($endereco);

        // 2. Garante que o evento está usando o ID do endereço que acabou de ser processado.
        // Se foi uma inserção, $endereco->getId() terá o novo ID.
        // Se foi uma atualização, $endereco->getId() já era o ID existente.
        $evento->setEnderecoId($endereco->getId()); 

        // 3. Atualiza o evento
        $this->eventoServico->atualizar($evento);

        // Só então, processamos tudo no banco
        $this->conexao->commit();
    } catch (Exception $e) {
        $this->conexao->rollBack(); // deu ruim? desfaz tudo
        throw $e; // Propaga o erro para o controlador
    }
}
}