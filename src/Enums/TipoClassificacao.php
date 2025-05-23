<?php 
namespace ExplosaoCultural\Enums; 

enum TipoClassificacao{ 
    case INFANTIL;  
    case  ADULTO; 

    public function getClassificacao(): string
    {
        return match($this) {
            self::INFANTIL => 'Classificação Infantil',
            self::ADULTO => 'Classificação Adulto',
        };
    }
}


TipoClassificacao::INFANTIL->getClassificacao(); // "Classificação Infantil"
TipoClassificacao::ADULTO->getClassificacao(); // "Classificação Adulto"