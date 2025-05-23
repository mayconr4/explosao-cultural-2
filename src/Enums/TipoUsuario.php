<?php

namespace ExplosaoCultural\Enums; 


enum TipoUsuario:string{
    case ADMINISTRADOR = 'Administrador';
    case USUARIO = 'Usuario';
    
    

    public function getTipoUsuario(): string
    {
        return match($this) {
            self::ADMINISTRADOR => 'Administrador',
            self::USUARIO => 'Usuario',             
           
        };
    }
} 

TipoUsuario::ADMINISTRADOR->getTipoUsuario(); // "Administrador"
TipoUsuario::USUARIO->getTipoUsuario(); // "Usuario"