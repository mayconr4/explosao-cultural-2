<?php 
namespace ExplosaoCultural\Models;

use ExplosaoCultural\Enums\TipoClassificacao;
use InvalidArgumentException;

final class Eventos 
{
    private ?int $id; 
    private string $nome; 
    private string $data;
    private string $horario;
    private TipoClassificacao $classificacao ; 
    private string $telefone;
    private ?string $descricao; 
    private string $imagem; 
    private int $enderecoId;
    private int $generoId;
    private int $usuarioId;  

    public function __construct(
        string $nome,
        string $data,
        string $horario,
        TipoClassificacao $classificacao,
        string $telefone,
        int $enderecoId,
        int $generoId,
        int $usuarioId, 
        string $imagem,
        ?string $descricao = null,
        ?int $id = null

    ) {
        $this->setNome($nome);
        $this->setData($data);
        $this->setHorario($horario);
        $this->setClassificacao($classificacao);
        $this->setTelefone($telefone);
        $this->setDescricao($descricao);
        $this->setImagem($imagem);
        // $this->setEnderecoId($enderecoId);
        $this->enderecoId = $enderecoId;
        $this->setGeneroId($generoId);
        $this->setUsuarioId($usuarioId);
        $this->setID($id); 

        //$this->Vlidar();
     }
     
    
    //getters
    public function getId(): ?int 
    { 
        return $this->id;
    }

    public function getDescricao(): ?string 
    { 
        return $this->descricao;
    } 

    public function getImagem(): string 
    { 
        return $this->imagem;
    }
    
    public function getNome(): string
    { 
        return $this->nome;
    }

     public function getData(): string 
    { 
        return $this->data;
    } 

     public function gethorario(): string 
    { 
        return $this->horario;
    } 

     public function getClassificacao(): TipoClassificacao 
    { 
        return $this->classificacao;
    } 

    public function getTelefone(): string 
    {
        return $this->telefone;
    }  

     public function getEnderecoId(): int 
    { 
        return $this->enderecoId;
    }

     public function getGeneroId(): int 
    { 
        return $this->generoId;
    } 

     public function getUsuarioId(): int 
    { 
        return $this->usuarioId;
    } 

    //Setters     
    private function setID(?int $id):void
    { 

        $this->id = $id;
    } 

    private function setDescricao(?string $descricao): void 
    {
        $this->descricao = $descricao;
    }  

    private function setImagem(string $imagem): void 
    {
        $this->imagem = $imagem;
    }

    private function setNome(string $nome):void
    { 

        $this->nome = $nome;
    } 
    
    private function setData(string $data):void
    { 

        $this->data = $data;
    }  


    private function setHorario(string $horario):void
    { 

        $this->horario = $horario;
    } 


    private function setClassificacao(TipoClassificacao $classificacao):void
    { 

        $this->classificacao = $classificacao;
    } 

    private function setTelefone(string $telefone):void
    { 

        $this->telefone = $telefone;
    }  

    private function setEnderecoId(int $enderecoId):void
    { 

        $this->enderecoId = $enderecoId;
    }  

    private function setGeneroId(int $enderecoId):void
    { 

        $this->enderecoId = $enderecoId;
    }  

    private function setUsuarioId(int $usuarioId):void
    { 

        $this->usuarioId = $usuarioId;
    } 





}
