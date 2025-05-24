<?php

namespace ExplosaoCultural\Models;



final class Generos
{
    private ?int $id;
    private int  $tipoGenero;


    public function __construct(int $tipoGenero, ?int $id)
    {
        $this->setEvento($tipoGenero);
        $this->setId($id);
    }

    //Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenero(): int
    {
        return $this->tipoGenero;
    }

    //Setters

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    private function setEvento(int $tipoGenero): void
    {
        $this->tipoGenero = $tipoGenero;
    }
}
