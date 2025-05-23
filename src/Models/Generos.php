<?php

namespace ExplosaoCultural\Models;

use ExplosaoCultural\Enums\TipoGenero;

final class Generos
{
    private ?int $id;
    private TipoGenero $evento;


    public function __construct(TipoGenero $evento, ?int $id)
    {
        $this->setEvento($evento);
        $this->setId($id);
    }

    //Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvento(): string
    {
        return $this->evento->value;
    }

    //Setters

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    private function setEvento(TipoGenero $evento): void
    {
        $this->evento = $evento;
    }
}
