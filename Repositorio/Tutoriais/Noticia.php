<?php
    // noticia.class.php
class Noticia
{
    public $titulo;
    public $texto;

    public function setTitulo($valor)
    {
        $this->titulo = $valor;
    }

    public function setTexto($valor)
    {
        $this->texto = $valor;
    }

    public function exibeNoticia()
    {
        $ret = "<center>";
        $ret .="<b>". $this->titulo ."</b><p>";
        $ret .= $this->texto;
        $ret .= "</center><p>";
        return $ret;
    }
}

$not = new Noticia;
$not->titulo = 'Novo curso de PHP Avançado';
$not->texto = 'Este curso contém os seguinte tópicos: POO, XML, etc.';
print $not->exibeNoticia();

/*
Obs: como os atributos são do tipo public, podemos atribuir valores diretamente para eles, sem a necessidade de utilizar os métodos. Para manipularmos variáveis
na classe, precisamos usar a variável $this, funções e o separador ->. A classe deve utilizar a variável $this para referenciar seus próprios métodos e atributos.
*/
