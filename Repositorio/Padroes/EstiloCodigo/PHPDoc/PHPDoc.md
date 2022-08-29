# PSR-5: PHPDoc

https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md

Este documento é limitado a uma especificação formal de sintaxe e intenção.

Vale lembrar que bons editores de código e IDEs leem os comentários tipo phpDoc para retornanr informações sobre as classes do código e autocompletar código.

• "PHPDoc" é uma seção de documentação que fornece informações sobre aspectos de um "Elemento Estrutural".

      É importante notar que um PHPDoc e um DocBlock são duas entidades separadas. O DocBlock é a combinação de um DocComment, que é um tipo de comentário, e uma entidade PHPDoc. É a entidade PHPDoc que contém a sintaxe conforme descrito nesta especificação (como a descrição e as tags).

    • "Structural Element" é uma coleção de Construções de Programação que PODEM ser precedidas por um DocBlock. A coleção contém as seguintes construções:
        ◦ require(_once) 
        ◦ include(_once) 
        ◦ class 
        ◦ interface 
        ◦ trait 
        ◦ function (including methods) 
        ◦ property 
        ◦ constant 
        ◦ variables, both local and global scope. 

      É RECOMENDADO preceder um "Elemento Estrutural" com um DocBlock onde é definido e não com cada uso. É prática comum que o DocBlock preceda um Elemento Estrutural, mas também PODE ser separado por um número indeterminado de linhas vazias.

Exemplo

      /** @var int $int This is a counter. */
      $int = 0;
      
      // there should be no docblock here
      $int++;

      ou

      /**
       * This class acts as an example on where to position a DocBlock.
       */
      class Foo
      {
          /** @var string|null $title contains a title for the Foo */
          protected $title = null;
      
          /**
           * Sets a single-line title.
           *
           * @param string $title A text for the title.
           *
           * @return void
           */
          public function setTitle($title)
          {
              // there should be no docblock here
              $this->title = $title;
          }
      }

Um exemplo de uso que vai além do escopo desta Norma é documentar a variável em um foreach explicitamente; várias IDEs usam essas informações para auxiliar na funcionalidade de preenchimento automático.

       Esta Norma não cobre este caso específico, pois uma declaração foreach é considerada uma declaração de "Fluxo de Controle" ao invés de um "Elemento Estrutural".

      /** @var \Sqlite3 $sqlite */
      foreach ($connections as $sqlite) {
          // there should be no docblock here
          $sqlite->open('/my/database/path');
          <...>
      }

• "DocComment" é um tipo especial de comentário que DEVE conter:
         ◦ comece com a sequência de caracteres / ** seguido por um caractere de espaço em branco
         ◦ terminar com * / e
         ◦ tem zero ou mais linhas no meio.

No caso em que um DocComment abrange várias linhas, cada linha DEVE começar com um asterisco (*) que DEVE ser alinhado com o primeiro asterisco da cláusula de abertura.
       Exemplo de linha única:
       / ** <...> * /

       Exemplo multilinha:
         / **
          * <...>
          * /

• "DocBlock" é um "DocComment" contendo uma única estrutura "PHPDoc" e representa a representação básica in-source.
    • "Tag" é uma única meta informação relativa a um "Elemento Estrutural" ou a um componente dele.
    • “Tipo” é a determinação de qual tipo de dado está associado a um elemento. Isso é comumente usado para determinar os valores exatos de argumentos, constantes, propriedades e muito mais.
      Consulte o Apêndice A para obter informações mais detalhadas sobre os tipos.
    • "FQSEN" é uma abreviatura de Fully Qualified Structural Element Name. Esta notação expande o nome de classe totalmente qualificado e adiciona uma notação para identificar os membros da classe / interface / característica e reaplicar os princípios do FQCN a interfaces, características, funções e constantes globais.
      As seguintes notações podem ser usadas por tipo de "Elemento Estrutural":
        ◦ Namespace: \My\Space
        ◦ Function: \My\Space\myFunction()
        ◦ Constant: \My\Space\MY_CONSTANT
        ◦ Class: \My\Space\MyClass
        ◦ Interface: \My\Space\MyInterface
        ◦ Trait: \My\Space\MyTrait
        ◦ Method: \My\Space\MyClass::myMethod()
        ◦ Property: \My\Space\MyClass::$my_property
        ◦ Constante de classe: \My\Space\MyClass::MY_CONSTANT

      Um FQSEN tem a seguinte definição ABNF:

      FQSEN = fqnn / fqcn / constante / método / propriedade / função
      fqnn = "\" [nome] * ("\" [nome])
      fqcn = fqnn "\" nome
      nome constante = (fqnn "\" / fqcn "::")
      método = fqcn "::" nome "()"
      property = fqcn ":: $" name
      função = fqnn "\" nome "()"
      nome = (ALPHA / "_") * (ALPHA / DIGIT / "_")

## Princípios Básicos

• Um PHPDoc DEVE sempre estar contido em um "DocComment"; a combinação desses dois é chamada de "DocBlock".

• Um DocBlock DEVE preceder diretamente um "Elemento Estrutural"

## O formato do PHPDoc

O formato PHPDoc possui a seguinte definição ABNF:

PHPDoc             = [summary] [description] [tags]
summary            = *CHAR (2*CRLF)
description        = 1*(CHAR / inline-tag) 1*CRLF ; any amount of characters
                                                 ; with inline tags inside
tags               = *(tag 1*CRLF)
inline-tag         = "{" tag "}"
tag                = "@" tag-name [":" tag-specialization] [tag-details]
tag-name           = (ALPHA / "\") *(ALPHA / DIGIT / "\" / "-" / "_")
tag-specialization = 1*(ALPHA / DIGIT / "-")
tag-details        = *SP (SP tag-description / tag-signature )
tag-description    = 1*(CHAR / CRLF)
tag-signature      = "(" *tag-argument ")"
tag-argument       = *SP 1*CHAR [","] *SP

Exemplo:

/**
 * This is a Summary.
 *
 * This is a Description. It may span multiple lines
 * or contain 'code' examples using the _Markdown_ markup
 * language.
 *
 * @see Markdown
 *
 * @param int        $parameter1 A parameter description.
 * @param \Exception $e          Another parameter description.
 *
 * @\Doctrine\Orm\Mapper\Entity()
 *
 * @return string
 */
function test($parameter1, $e)
{
    ...
}

É permitido omitir a descrição

/**
 * This is a Summary.
 *
 * @see Markdown
 *
 * @param int        $parameter1 A parameter description.
 * @param \Exception $parameter2 Another parameter description.
 *
 * @\Doctrine\Orm\Mapper\Entity()
 *
 * @return string
 */
function test($parameter1, $parameter2)
{
}

## Sumário

Um Resumo DEVE conter um resumo do "Elemento Estrutural" que define o propósito. É RECOMENDADO que os Resumos ocupem uma única linha ou no máximo duas, mas não mais do que isso.

Um Resumo DEVE terminar com duas quebras de linha sequenciais, a menos que seja o único conteúdo no PHPDoc.

Se uma Descrição for fornecida, ela DEVE ser precedida por um Resumo. Caso contrário, a Descrição será considerada o Resumo, até que o final do Resumo seja alcançado.

Como um resumo é comparável a um título de capítulo, é benéfico usar o mínimo de formatação possível. Como tal, ao contrário da Descrição (consulte o próximo capítulo), nenhuma recomendação é feita para oferecer suporte a uma linguagem de marcação. É explicitamente deixado para o aplicativo de implementação se ele deseja oferecer suporte ou não.

## Descrição

A Descrição é OPCIONAL, mas DEVE ser incluída quando o "Elemento Estrutural", que este DocBlock precede, contém mais operações, ou operações mais complexas, do que pode ser descrito apenas no Resumo.

Qualquer aplicativo que analise a descrição é RECOMENDADO para suportar a linguagem de marcação Markdown para este campo, de modo que seja possível para o autor fornecer formatação e uma maneira clara de representar exemplos de código.

Os usos comuns da Descrição são (entre outros):
     • Para fornecer mais detalhes do que o Resumo sobre o que este método faz.
     • Para especificar de quais elementos filhos um array de entrada ou saída, ou objeto, é composto.
     • Para fornecer um conjunto de casos de uso comuns ou cenários nos quais o "Elemento Estrutural" pode ser aplicado.

## Tags

As tags fornecem uma maneira para os autores fornecerem metadados concisos sobre o "Elemento Estrutural" subsequente. Cada tag começa em uma nova linha, seguida por um sinal de arroba (@) e um nome de tag, seguido por espaço em branco e metadados (incluindo uma descrição).

Se metadados forem fornecidos, eles PODEM abranger várias linhas e PODEM seguir um formato estrito e, como tal, fornecer parâmetros, conforme ditado pelo tipo de tag. O tipo da tag pode ser derivado de seu nome.

Por exemplo:

@param string $ argument1 Este é um parâmetro.

A tag acima consiste em um nome ('param') e meta-dados ('string $ argument1 Este é um parâmetro.') Onde os meta-dados são divididos em um "Tipo" ('string'), nome de variável (' $ argumento ') e descrição (' Este é um parâmetro. ').

A descrição de uma tag DEVE suportar Markdown como linguagem de formatação. Devido à natureza do Markdown, é legal iniciar a descrição da tag na mesma linha ou na linha subsequente e interpretá-la da mesma forma.
Assim, as seguintes tags são semanticamente idênticas:

/**
 * @var string This is a description.
 * @var string This is a
 *    description.
 * @var string
 *    This is a description.
 */

Uma variação disso é onde, em vez de uma descrição, uma assinatura de tag é usada; na maioria dos casos, a tag será de fato uma "Anotação". A assinatura da tag é capaz de fornecer à anotação parâmetros relativos ao seu funcionamento.

Se uma assinatura de tag estiver presente, NÃO DEVE haver uma descrição presente na mesma tag.

Os metadados fornecidos por tags podem resultar em uma alteração do comportamento real do tempo de execução do "Elemento Estrutural" subsequente, caso em que o termo "Anotação" é comumente usado em vez de "Tag".

## Nomes de tags

Os nomes das tags indicam que tipo de informação é representada por esta tag, ou no caso de anotações, qual comportamento deve ser injetado no "Elemento Estrutural" seguinte.

No suporte de anotações, é permitido introduzir um conjunto de tags projetado especificamente para um aplicativo individual ou subconjunto de aplicativos (e, portanto, não coberto por esta especificação).

Essas tags, ou anotações, DEVEM fornecer um namespace por
    • prefixando o nome da tag com um namespace no estilo PHP ou por
    • prefixar o nome da tag com um único nome de fornecedor seguido por um hífen.

Exemplo de um nome de tag prefixado com um namespace de estilo php (a barra de prefixo é OPCIONAL):

@ \Doctrine\Orm\Mapping\Entity()

Nota: O padrão PHPDoc NÃO faz suposições sobre o significado de uma tag, a menos que especificado neste documento ou adições ou extensões subsequentes.

Isso significa que você PODE usar apelidos de namespace, desde que um elemento de namespace de prefixo seja fornecido. Portanto, o seguinte também é legal:

@Mapping\Entity()

Sua própria biblioteca ou aplicativo pode verificar aliases de namespace e fazer um FQCN a partir disso; isso não tem impacto sobre este padrão.

Importante: Ferramentas que usam o padrão PHPDoc PODEM interpretar namespaces que são registrados com aquele aplicativo e aplicar comportamento personalizado.

Exemplo de um nome de tag prefixado com um nome de fornecedor e hífen:

@ phpdoc-event transformer.transform.pre

Os nomes de tag que não são prefixados com um fornecedor ou namespace DEVEM ser descritos no Catálogo de tags PSR e / ou em qualquer adendo oficial.

## Especialização de Tag

A fim de fornecer um método pelo qual fornecer nuances para as marcas definidas neste padrão, mas sem expandir o conjunto de base, uma especialização de marca PODE ser fornecida após o nome da marca adicionando dois pontos seguidos por uma string que fornece uma descrição mais matizada da marca. A lista de especializações de tag com suporte não é mantida no Tag Catalog PSR, pois pode mudar com o tempo. O meta-documento PSR do Catálogo de tags pode conter uma série de recomendações por nome de tag, mas os projetos são livres para escolher suas próprias especializações de tag, se aplicável.

Importante: Ferramentas que usam o padrão PHPDoc PODEM interpretar especializações de tag que são registradas/compreendidas por esse aplicativo e aplicar comportamento personalizado, mas somente se espera que implementem o nome de tag anterior conforme definido no Tag Catalog PSR.

Por exemplo:

@ver: unit-test\Mapping\EntityTest::testGetId

A tag acima consiste em um nome ('ver') e especialização de tag ('teste de unidade') e, portanto, define uma relação com o teste de unidade para o método de procedimento.

## Assinatura de tag

As assinaturas de tag são comumente usadas para anotações para fornecer metadados adicionais específicos para a tag atual.

Os metadados fornecidos podem influenciar o comportamento da anotação proprietária e, como tal, influenciar o comportamento do "Elemento Estrutural" seguinte.

O conteúdo de uma assinatura deve ser determinado pelo tipo de marca (conforme descrito no nome da marca) e está além do escopo desta especificação. No entanto, uma assinatura de tag NÃO DEVE ser seguida por uma descrição ou outra forma de meta-dados.

## Exemplos

Os exemplos a seguir servem para ilustrar o uso básico de DocBlocks; é aconselhável ler a lista de tags no Tag Catalog PSR.

Um exemplo completo poderia ser assim:

/**
 * This is a Summary.
 *
 * This is a Description. It may span multiple lines
 * or contain 'code' examples using the _Markdown_ markup
 * language.
 *
 * @see Markdown
 *
 * @param int        $parameter1 A parameter description.
 * @param \Exception $e          Another parameter description.
 *
 * @\Doctrine\Orm\Mapper\Entity()
 *
 * @return string
 */
function test($parameter1, $e)
{
    ...
}

Também é permitido omitir a Descrição:

/**
 * This is a Summary.
 *
 * @see Markdown
 *
 * @param int        $parameter1 A parameter description.
 * @param \Exception $parameter2 Another parameter description.
 *
 * @\Doctrine\Orm\Mapper\Entity()
 *
 * @return string
 */
function test($parameter1, $parameter2)
{
}

Ou até mesmo omita a seção de tags também (embora não seja recomendado, já que faltam informações sobre os parâmetros e o valor de retorno):

/**
 * This is a Summary.
 */
function test($parameter1, $parameter2)
{
}

Um DocBlock também pode abranger uma única linha:

/** @var \ArrayObject $array */
public $array = null;

## ABNF
Um tipo tem a seguinte definição ABNF:

type-expression  = type *("|" type) *("&" type)
type             = class-name / keyword / array
array            = (type / array-expression) "[]"
array-expression = "(" type-expression ")"
class-name       = ["\"] label *("\" label)
label            = (ALPHA / %x7F-FF) *(ALPHA / DIGIT / %x7F-FF)
keyword          = "array" / "bool" / "callable" / "false" / "float" / "int" / "iterable" / "mixed" / "null" / "object" /
keyword          = "resource" / "self" / "static" / "string" / "true" / "void" / "$this"

Detalhes
Quando um "Tipo" é usado, o usuário espera um valor, ou conjunto de valores, conforme detalhado abaixo.

Quando o "Tipo" consiste em vários tipos, eles DEVEM ser separados com o sinal de barra vertical (|) para o tipo de união ou o e comercial (&) para o tipo de interseção. Qualquer intérprete que apoie esta especificação DEVE reconhecer isso e dividir o "Tipo" antes de avaliar.

Exemplo de tipo de união:

@return int|null

Exemplo de tipo de intersecção:

@var \MyClass&\PHPUnit\Framework\MockObject\MockObject $myMockObject

## Arrays
O valor representado por "Tipo" pode ser uma matriz/array. O tipo DEVE ser definido seguindo o formato de uma das seguintes opções:
     1. não especificado: nenhuma definição do conteúdo da matriz representada é fornecida. Exemplo: @return array
     2. especificado contendo um único tipo: a definição de tipo informa ao leitor o tipo de cada valor do array. Apenas um tipo é esperado para cada valor em uma determinada matriz.

        Exemplo: @return int []
        Observe que mixed também é um tipo único e com esta palavra-chave é possível indicar que cada valor de array contém qualquer tipo possível.
     3. especificado como contendo vários tipos: a definição de tipo informa o leitor sobre o tipo de cada valor da matriz. Cada valor pode ser de qualquer um dos tipos fornecidos. Exemplo: @return (int | string) []

## Nome de classe válido
Um nome de classe válido é visto com base no contexto em que esse tipo é mencionado. Portanto, pode ser um nome de classe totalmente qualificado (FQCN) ou um nome local, se presente em um namespace.

O elemento ao qual esse tipo se aplica é uma instância dessa classe ou uma instância de uma classe que é um (sub) filho de uma determinada classe.

Devido à natureza acima, é RECOMENDADO que os aplicativos que coletam e modelam essas informações mostrem uma lista de classes filhas com cada representação da classe. Isso tornaria óbvio para o usuário quais classes são aceitáveis como tipo.

## Palavra-chave

Uma palavra-chave define a finalidade desse tipo. Nem todo elemento é determinado por uma classe, mas ainda assim digno de classificação para auxiliar o desenvolvedor na compreensão do código coberto pelo DocBlock.

Nota:
A maioria dessas palavras-chaves são permitidas como nomes de classes em PHP e podem ser difíceis de distinguir de classes reais. Como tal, as palavras-chaves DEVEM ser minúsculas, já que a maioria dos nomes de classes começa com um primeiro caractere maiúsculo, e você NÃO DEVE usar classes com esses nomes em seu código.

Existem mais razões para não nomear classes com os nomes dessas palavras-chave, mas isso está além do escopo desta especificação.

As seguintes palavras-chaves são reconhecidas por este PSR:

    1. bool: o elemento ao qual este tipo se aplica tem apenas o estado TRUE ou FALSE.
    2. int: o elemento ao qual esse tipo se aplica é um número inteiro ou inteiro.
    3. float: o elemento ao qual esse tipo se aplica é um número contínuo ou real.
    4. string: o elemento ao qual esse tipo se aplica é uma string de caracteres binários.
    5. objeto: o elemento ao qual este tipo se aplica é a instância de uma classe indeterminada.
    6. array: o elemento ao qual este tipo se aplica é um array de valores.
    7. iterável: o elemento ao qual este tipo se aplica é um array ou objeto Traversable de acordo com a definição do PHP.
    8. recurso: o elemento ao qual este tipo se aplica é um recurso de acordo com a definição do PHP.
    9. misturado: o elemento ao qual esse tipo se aplica pode ser de qualquer tipo, conforme especificado aqui. Não se sabe em tempo de compilação qual tipo será usado.
    10. void: este tipo é comumente usado apenas ao definir o tipo de retorno de um método ou função, indicando "nada é retornado" e, portanto, o usuário não deve confiar em nenhum valor retornado.

Exemplo 1

       /**
        * @return void
        */
       function outputHello()
       {
           echo 'Hello world';
       }

No exemplo acima, nenhuma instrução de retorno é especificada e, portanto, o valor de retorno não é determinado.

Exemplo 2:

       /**
        * @param bool $quiet when true 'Hello world' is echo-ed.
        *
        * @return void
        */
       function outputHello($quiet)
       {
           if ($quiet) {
               return;
           }
           echo 'Hello world';
       }

Neste exemplo, a função contém uma instrução de retorno sem um determinado valor. Como não há valor real especificado, isso também se qualifica como tipo void.

null: o elemento ao qual este tipo se aplica é um valor NULL ou, em termos técnicos, não existe.

Uma grande diferença em relação ao void é que esse tipo é usado em qualquer situação onde o elemento descrito pode, a qualquer momento, conter um valor NULL explícito.

Exemplo 1

       /**
        * @return null
        */
       function foo()
       {
           echo 'Hello world';
           return null;
       }

Esse tipo é comumente usado em conjunto com outro tipo para indicar que é possível que nada seja retornado.

Exemplo 2

       /**
        * @param bool $create_new When true returns a new stdClass.
        *
        * @return stdClass|null
        */
       function foo($create_new)
       {
           if ($create_new) {
               return new stdClass();
           }
           return null;
       }

callable: o elemento ao qual esse tipo se aplica é um ponteiro para uma chamada de função. Pode ser qualquer tipo de chamada de acordo com a definição do PHP.

falso ou verdadeiro: o elemento ao qual este tipo se aplica terá o valor TRUE ou FALSE. Nenhum outro valor será retornado deste elemento.

self: o elemento ao qual esse tipo se aplica é da mesma classe em que o elemento documentado está originalmente contido.

Exemplo

O método c está contido na classe A. O DocBlock afirma que seu valor de retorno é do tipo self. Como tal, o método c retorna uma instância da classe A.

Isso pode levar a situações confusas quando a herança está envolvida.
       Exemplo (a situação de exemplo anterior ainda se aplica):
       A classe B estende a classe A e não redefine o método c. Como tal, é possível invocar o método c da classe B.
       Nessa situação, pode surgir ambigüidade, pois self pode ser interpretado como classe A ou B. Nesses casos, self DEVE ser interpretado como sendo uma instância da classe onde o DocBlock contendo o tipo self está escrito.
       Nos exemplos acima, self DEVE sempre se referir à classe A, uma vez que é definido com o método c na classe A.
       Devido à natureza acima, é RECOMENDADO que os aplicativos que coletam e modelam essas informações mostrem uma lista de classes filhas com cada representação da classe. Isso tornaria óbvio para o usuário quais classes são aceitáveis ​​como tipo.
    static: o elemento ao qual este tipo se aplica é da mesma classe em que o elemento documentado está contido ou, quando encontrado em uma subclasse, é do tipo dessa subclasse em vez da classe original.

    Esta palavra-chave se comporta da mesma forma que a palavra-chave para vinculação estática tardia (não o método estático, propriedade ou modificador de variável) conforme definido pelo PHP.

    $this: o elemento ao qual este tipo se aplica é a mesma instância exata da classe atual no contexto fornecido. Como tal, esse tipo é uma versão mais restrita de estático, porque a instância retornada não deve apenas ser da mesma classe, mas também a mesma instância.

    Este tipo é frequentemente usado como valor de retorno para métodos que implementam o padrão de design de Interface Fluent.


## PSR-19: PHPDoc tags

https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md

    • Tags 
        ◦ 5.1. @api 
        ◦ 5.2. @author 
        ◦ 5.3. @copyright 
        ◦ 5.4. @deprecated 
        ◦ 5.5. @internal 
        ◦ 5.6. @link 
        ◦ 5.7. @method 
        ◦ 5.8. @package 
        ◦ 5.9. @param 
        ◦ 5.10. @property 
        ◦ 5.11. @return 
        ◦ 5.12. @see 
        ◦ 5.13. @since 
        ◦ 5.14. @throws 
        ◦ 5.15. @todo 
        ◦ 5.16. @uses 
        ◦ 5.17. @var 
        ◦ 5.18. @version 

## A respeito de herança

Vamos supor que você tenha um método \SubClass::myMethod() e sua classe \SubClass estende a classe \SuperClass. E na classe \SuperClass existe um método com o mesmo nome (por exemplo, \SuperClass::myMethod).

Se o acima se aplicar, então o DocBlock de \SubClass::myMethod() irá herdar qualquer uma das partes mencionadas acima do PHPDoc de \SuperClass::myMethod. Portanto, se a tag @version não foi redefinida, assume-se que \SubClass::myMethod() terá a mesma tag @version.

A herança ocorre da raiz de um gráfico de hierarquia de classes para suas folhas. Isso significa que qualquer coisa herdada na parte inferior da árvore DEVE 'borbulhar' até o topo, a menos que seja substituída.

## Tornar a herança explícita usando a tag @inheritDoc

Como a herança está implícita, pode acontecer que não seja necessário incluir um PHPDoc com um "Elemento Estrutural". Isso pode causar confusão, pois agora é ambíguo se o PHPDoc foi omitido propositalmente ou se o autor do código se esqueceu de adicionar a documentação.

Para resolver essa ambigüidade, a tag @inheritDoc pode ser usada para indicar que esse elemento herdará suas informações de um superelemento.

Exemplo:

/**
 * This is a summary.
 */
class SuperClass
{
}

/**
 * @inheritDoc
 */
class SubClass extends SuperClass
{
}

## Usando a tag embutida {@inheritDoc} para aumentar uma Descrição

Às vezes, você deseja herdar a descrição de um superelemento e adicionar seu próprio texto a ela para fornecer informações específicas ao seu "Elemento estrutural". 
Isso DEVE ser feito usando a tag embutida {@inheritDoc}.

A tag in-line {@inheritDoc} indicará que nesse local a descrição do superelemento DEVE ser injetada ou inferida.

Exemplo:

/**
 * This is the Summary for this element.
 *
 * {@inheritDoc}
 *
 * In addition this description will contain more information that
 * will provide a detailed piece of information specific to this
 * element.
 */

Exemplos

/**
 * This is Foo
 * @version 2.1.7 MyApp
 * @since 2.0.0 introduced
 */
class Foo
{
    /**
     * Make a bar.
     *
     * @since 2.1.5 bar($arg1 = '', $arg2 = null)
     *        introduced the optional $arg2
     * @since 2.1.0 bar($arg1 = '')
     *        introduced the optional $arg1
     * @since 2.0.0 bar()
     *        introduced new method bar()
     */
    public function bar($arg1 = '', $arg2 = null)
    {
        <...>
    }
}

<?php

declare(strict_types=1);

namespace Vendor\Package;

use Vendor\Package\{ClassA as A, ClassB, ClassC as C};
use Vendor\Package\SomeNamespace\ClassD as D;

use function Vendor\Package\{functionA, functionB, functionC};

use const Vendor\Package\{ConstantA, ConstantB, ConstantC};

class Foo extends Bar implements FooInterface
{
    public function sampleFunction(int $a, int $b = null): array
    {
        if ($a === $b) {
            bar();
        } elseif ($a > $b) {
            $foo->bar($arg1);
        } else {
            BazClass::bar($arg2, $arg3);
        }
    }

    final public static function bar()
    {
        // method body
    }
}


## Mais detalhes em:

https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md


