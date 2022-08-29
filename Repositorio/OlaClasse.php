<?php

class OlaClass
{
    private $nome = 'João Brito';

    public function getNome(){
        return $this->nome;
    }
}

$ola = new OlaClass();

//print $ola->getNome();
print $ola->nome; // Fatal error: Uncaught Error: Cannot access private property OlaClass::$nome. Fora da classe OlaClass, não podemos acessar uma propriedade private
