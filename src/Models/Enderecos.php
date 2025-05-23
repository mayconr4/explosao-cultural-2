<?php
namespace ExplosaoCultural\Models; 


final class Enderecos 
{ 
    private ?int $id;
    private string $cep;
    private string $logradouro;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $estado; 

    
    public function __construct(
        string $cep,
        string $logradouro,
        string $numero,
        string $bairro,
        string $cidade,
        string $estado,
        ?int $id = null 

    ) {
        $this->setCep($cep);
        $this->setLogradouro($logradouro);
        $this->setNumero($numero);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setEstado($estado);
        $this->setId($id); 

        //$this->Validar();
    }


    //Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getEstado(): string
    {

        return $this->estado;
    }

    //setters  

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    private function setCep(string $cep): void
    {
        $this->cep = $cep;
    }

    private function setLogradouro(string $logradouro): void
    {
        $this->logradouro = $logradouro;
    }

    private function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    private function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    private function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    private function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }




}


