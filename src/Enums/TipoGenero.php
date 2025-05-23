<?php
namespace ExplosaoCultural\Enums;

enum TipoGenero:string{

    case MUSICA = 'Musica' ;
    case ARTES_CENICAS = 'Artes Cenicas' ;
    case ARTES_VISUAIS = 'Artes Visuais';
    case  OUTROS = 'Outros';
    case LITERATURA = 'Literatura'; 

    public function getGenero(): string
    {
        return match($this) {
            self::MUSICA => 'Musica',
            self::ARTES_CENICAS => 'Artes Cenicas',
            self::ARTES_VISUAIS => 'Artes Visuais',
            self::OUTROS => 'Outros',
            self::LITERATURA => 'Literatura',
        };
    }
}

TipoGenero::MUSICA->getGenero(); // "Musica"
TipoGenero::ARTES_CENICAS->getGenero(); // "Artes Cenicas"
TipoGenero::ARTES_VISUAIS->getGenero(); // "Artes Visuais"
TipoGenero::OUTROS->getGenero(); // "Outros"
TipoGenero::LITERATURA->getGenero(); // "Literatura"
