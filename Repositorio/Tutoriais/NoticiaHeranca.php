<?php
// NoticiaHeranca.php
include_once('Noticia.php');

class NoticiaPrincipal extends Noticia
{
    public $imagem;

    public function setImagem($valor)
    {
        $this->imagem = $valor;
    }

    public function exibeNoticia()
    {
        $ret = "<center>";
        $ret .= "<img src=\"". $this->imagem ."\"><p>";
        $ret .= "<b>". $this->titulo ."</b><p>";
        $ret .= $this->texto;
        $ret .= "<p></center>";
        return $ret;
    }
}

$not = new NoticiaPrincipal();
$not->titulo = 'Vestibular da Unicamp termina nesta quarta-feira';
$not->texto = 'Um dos maiores vestibulares do país acaba nesta quarta-feira,';
$not->texto .= 'com número recorde de inscritos';
$not->imagem = 'img_unicamp.jpg';
$not->exibeNoticia();

/*
Como mostra o exemplo, a classe NoticiaPrincipal herdou todas as características da classe Noticia, e ainda foi adicionado o método que dá suporte à exibição de imagens nas notícias principais. Nessas sub-classes é possível redefinir métodos, podendo modificá-los da forma que o programador quiser, como foi o caso do método exibeNoticia(). Sobrescrever métodos é algo bastante comum no processo de herança, visto que os métodos que foram criados na classe “pai” não precisam ser necessariamente os mesmos que os definidos nas classes “filhas”.
*/
