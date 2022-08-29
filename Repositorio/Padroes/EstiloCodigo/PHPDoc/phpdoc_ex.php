<?php
/** 
 * Comentário de cabeçalho de arquivos
* Esta classe de upload de fotos
*
* @author leo genilhu <leo@genilhu.com>
* @version 0.1 
* @copyright  GPL © 2006, genilhu ltda. 
* @access public  
* @package Infra_Estrutura 
* @subpackage UploadGenilhu
* @example Classe uploadGenilhu. 
*/ 

/*

O PHPDoc foi baseado no JAVADoc da Sun e tem como objetivo padronizar a documentação de códigos PHP. Ele lê o código e analisa gramaticalmente procurando por tags especiais. A partir delas extrai toda documentação usando diferentes formatos (pdf, xml, html, chm Windows help e outros). Todas as tags especiais são escritas dentro do comentários do php comentários  e necessariamente começam com o @ (arroba).

Descrição de algumas tags especiais:

    @access Específica o tipo de acesso(public, protected e private).
    @author Específica o autor do código/classe/função.
    @copyright Específica os direitos autorais.
    @deprecated Específica elementos que não devem ser usados.
    @exemple Definir arquivo de exemplo, $path/to/example.php
    @ignore Igonarar código
    @internal Documenta função interna do código
    @link link do código http://www.exemplo.com
    @see
    @since
    @tutorial
    @name Específica o apelido(alias).
    @package Específica o nome do pacote pai, isto ajuda na organização das classes.
    @param Específica os paramêtros muito usado em funções.
    @return Específica o tipo de retorno muito usado em funções.
    @subpackage Específica o nome do pacote filho.
    @version Específica a versão da classe/função.
    Inline { @internal 
*/

/**
 * @author Um nome <a.name@example.com>
 * @link http://www.phpdoc.org/docs/latest/index.html
 * @package helper
 */
class DateTimeHelper
{
    /**
     * @param mixed $anything Tudo que podemos converter para um objeto \DateTime
     *
     * @return \DateTime
     * @throws \InvalidArgumentException
     */
    public function dateTimeFromAnything($anything)
    {
        $type = gettype($anything);

        switch ($type) {
            // Algum código que tenta retornar um objeto \DateTime
        }

        throw new \InvalidArgumentException(
            "Failed Converting param of type '{$type}' to DateTime object"
        );
    }

    /**
     * @param mixed $date Tudo que podemos converter para um objeto \DateTime
     *
     * @return void
     */
    public function printISO8601Date($date)
    {
        echo $this->dateTimeFromAnything($date)->format('c');
    }

    /**
     * @param mixed $date Tudo que podemos converter para um objeto \DateTime
     */
    public function printRFC2822Date($date)
    {
        echo $this->dateTimeFromAnything($date)->format('r');
    }
}
