# Estilo de codificação

PSR-1
https://www.php-fig.org/psr/psr-1/

## Indentação

Usar 4 espaços

## Largura da linha

Limite soft - 120 caracteres

Limite hard - não existe

As linhas devem conter 80 caracteres ou menos

Para ter uma ideia a linha abaixo tem 80 caracteres:

0123456789001234567890012345678900123456789001234567890012345678900123456789001234567890

## Namespace

Os namespaces e classes DEVEM seguir um PSR-4 de "carregamento automático"].

Namespaces deve ser a primeira linha útil do arquivo

Manter uma linha em branco após a declaração do namespace

Deve haver uma linha em branco após o bloco de declarações de uso/use, como abaixo. 
Uma após o namespace e uma após os use. 
Usar apenas um único use por declaração, ou seja, por linha.

Código escrito em PHP 5.3 ou superior deve usar namespaces formal, como abaixo.

Código estrito em PHP 5.2 ou inferior precisam usar a convenção pseudo-namespacing com o rpefixo Vendor_ nos nomes das class, comom abaixo:

<?php
// PHP 5.2.x and earlier:
class Vendor_Model_Foo
{
}

## Classes

O termo class refere-se a todas as classes, interfaces e traits.

Os nomes das classes DEVEM ser declarados em StudlyCaps ou CamelCase, como nos grandes frameworks PHP.
StudlyCaps rpecisa ser entendido como PascalCase. Pascal Case é a prática de escrever palavras compostas ou frases de modo que cada palavra ou abreviatura comece com uma letra maiúscula. Não utiliza espaços nem pontuação.

A chave de abertura da classe deve ter sua própria linha, após a linha de definição da calsse.
A chave de fechamento da classe também precisa ter sua própria linha e vir após o corpo da classe.

## Traits

A palavra-chave use usada dentro das classes para implementar traits DEVE ser declarada na próxima linha após a chave de abertura.

<?php

namespace Vendor\Package;

use Vendor\Package\FirstTrait;

class ClassName
{
    use FirstTrait;
}

Cada trait individual que é importado para uma classe DEVE ser incluído um por linha e cada inclusão DEVE ter sua própria declaração de importação de uso.

<?php

namespace Vendor\Package;

use Vendor\Package\FirstTrait;
use Vendor\Package\SecondTrait;
use Vendor\Package\ThirdTrait;

class ClassName
{
    use FirstTrait;
    use SecondTrait;
    use ThirdTrait;
}

### Extends e implements

Devem vir sempre na mesma linha do nome da classe

<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface
{
    private $name;
    public $sex;
    protected $cpf;

    public function sampleMethod($a, $b = null)
    {
        if ($a === $b) {
            bar();
            return true;
        }
        return false;
    }

    final public static function bar()
    {
        //
    }
}

## Lista de implements

Listas de implements PODEM ser divididas em várias linhas, onde cada linha subsequente é recuada uma vez. Ao fazer isso, o primeiro item da lista DEVE estar na próxima linha e DEVE haver apenas uma interface por linha.

<?php
namespace Vendor\Package;

use FooClass;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class ClassName extends ParentClass implements
    \ArrayAccess,
    \Countable,
    \Serializable
{
    // constants, properties, methods
}

Cada classe deve vir em seu arquivo, ou seja, cada arquivo deve conter apenas uma única classe

Exemplo:

ClientController

A chave de abertura para a classe DEVE vir na próxima linha e a chave de fechamento DEVE vir na próxima linha após o corpo. Como na classe acima.

O aprêntese de abertura para métodos DEVE vir na próxima linha e o parêntese de fechamento DEVE vir na próxima linha após o corpo. Como nos métodos acima.

A visibilidade DEVE ser declarada em todas as propriedades e métodos; abstract e final DEVEM ser declarados antes da visibilidade nas propriedades e métodos; static DEVE ser declarado após a visibilidade.

As palavras-chave das estruturas de controle DEVEM ter um espaço após elas e antes das chaves (como no if acima); chamadas de métodos e funções NÃO DEVEM ter.

O parêntese de abertura para estruturas de controle DEVE ficar na mesma linha e o parêntese de fechamento DEVE vir na próxima linha após o corpo. Como acima, no if.
Evitar que blocos de código contíguo se tornem excessivamente longos.

Os parênteses de abertura para estruturas de controle NÃO DEVEM ter um espaço depois deles, e os parênteses de fechamento para estruturas de controle NÃO DEVEM ter um espaço antes. Como acima, no if ($a === $b).

Esta seção do padrão compreende o que deve ser considerado os elementos de codificação padrão necessários para garantir um alto nível de interoperabilidade técnica entre o código PHP compartilhado.


## Constantes de Classes

Precisam ser declaradas com todas em maiúsculas e palavras compostas separadas com sublinhado

Exemplos:

class Foo
{
    const VERSION = '1.0';
    const DATE_APPROVED = '2012-06-01';
}


## Métodos

Todas os métodos devem declarar a sua visibilidade.

Os nomes dos métodos NÃO DEVEM ser prefixados com um único sublinhado para indicar visibilidade protegida ou privada.

Os nomes dos métodos NÃO DEVEM ser declarados com um espaço após o nome do método. A chave de abertura DEVE vir em sua própria linha e a chave de fechamento DEVE vir na próxima linha seguinte ao corpo. NÃO DEVE haver um espaço após o parêntese de abertura, e NÃO DEVE haver um espaço antes do parêntese de fechamento.

    public function fooBarBaz($arg1, $arg2, $arg3 = [])
    {
        // method body
    }

Um arquivo DEVE declarar novos símbolos (classes, funções, constantes, etc.) e não causar nenhum outro efeito colateral, ou DEVE executar lógica com efeitos colaterais, mas NÃO DEVE fazer ambos.

A frase "efeitos colaterais" significa execução de lógica não diretamente relacionada à declaração de classes, funções, constantes, etc., apenas pela inclusão do arquivo.

"Efeitos colaterais" incluem, mas não estão limitados a: geração de saída, uso explícito de require ou include, conectar-se a serviços externos, modificar configurações INI, emitir erros ou exceções, modificar variáveis globais ou estáticas, ler ou gravar em um arquivo e em breve.

A seguir está um exemplo de um arquivo com declarações e efeitos colaterais; ou seja, um exemplo do que evitar:


<?php
// side effect: change ini settings
ini_set('error_reporting', E_ALL);

// side effect: loads a file
include "file.php";

// side effect: generates output
echo "<html>\n";

// declaration
function foo()
{
    // function body
}
The following example is of a file that contains declarations without side effects; i.e., an example of what to emulate:
<?php
// declaration
function foo()
{
    // function body
}

// conditional declaration is *not* a side effect
if (! function_exists('bar')) {
    function bar()
    {
        // function body
    }
}

A ideia é que, quando uma classe é carregada automaticamente, o estado do aplicativo não deve mudar. Qualquer código de modificação de estado (código que realmente executa) deve estar em um conjunto diferente de arquivos.

Isso o torna previsível e força você a manter sua lógica nos métodos de classe e implícita.

Lembre-se de que existem padrões de codificação, então as pessoas codificam em um estilo semelhante. O benefício em adotar um padrão de codificação é que sua base de código é autoconsistente e consistente com outros projetos que seguem as regras.

O PSR-1 segue em grande parte o que todos já estavam fazendo. Se você sentir a necessidade de executar a lógica no mesmo lugar onde uma classe é definida, é muito provável que haja um lugar ou abordagem melhor.

Por último ... não adote o PSR-1 apenas pelo. Se você tiver um motivo válido para não seguir as regras em determinados locais, quebre as regras. Eles não são leis. O bom senso reina supremo.

Fonte: Sou um dos contribuintes desse documento. (Tradução do Stackoverflow)

### Argumentos dos métodos

Na lista de argumentos, NÃO DEVE haver um espaço antes de cada vírgula e DEVE haver um espaço após cada vírgula.

Os argumentos do método com valores padrão DEVEM ir no final da lista de argumentos.

    public function foo($arg1, &$arg2, $arg3 = [])
    {
        // method body
    }

Listas de argumentos PODEM ser divididas em várias linhas, onde cada linha subsequente é recuada uma vez. Ao fazer isso, o primeiro item da lista DEVE estar na próxima linha e DEVE haver apenas um argumento por linha.

Quando a lista de argumentos é dividida em várias linhas, o parêntese de fechamento e a chave de abertura DEVEM ser colocados juntos em sua própria linha com um espaço entre eles.

    public function aVeryLongMethodName(
        ClassTypeHint $arg1,
        &$arg2,
        array $arg3 = []
    ) {
        // method body
    }

## abstract, final, and static

Quando presentes, o abstract e as declarações final DEVEM preceder a declaração de visibilidade.

Quando presente, a declaração static DEVE vir após a declaração de visibilidade.

<?php
namespace Vendor\Package;

abstract class ClassName
{
    protected static $foo;

    abstract protected function zim();

    final public static function bar()
    {
        // method body
    }
}

## Chamada de méodos e funções

Ao fazer uma chamada de método ou de função, NÃO DEVE haver um espaço entre o nome do método ou da função e o parêntese de abertura, NÃO DEVE haver um espaço após o parêntese de abertura e NÃO DEVE haver um espaço antes do parêntese de fechamento. Na lista de argumentos, NÃO DEVE haver um espaço antes de cada vírgula e DEVE haver um espaço após cada vírgula.

<?php
bar();
$foo->bar($arg1);
Foo::bar($arg2, $arg3);

Listas de argumentos PODEM ser divididas em várias linhas, onde cada linha subsequente é recuada uma vez. Ao fazer isso, o primeiro item da lista DEVE estar na próxima linha e DEVE haver apenas um argumento por linha.

<?php
$foo->bar(
    $longArgument,
    $longerArgument,
    $muchLongerArgument
);

## Propriedades/variáveis

Todas as propriedades devem declarar a sua visibilidade.

Nãod evemos usar a palavra chave "var" para declarar propriedades.

<?php

namespace Vendor\Package;

class ClassName
{
    public $foo = null;
    public static int $bar = 0;
}

NÃO DEVE haver mais de uma propriedade declarada por instrução, ou seja, somente uma propriedade por linha.

Os nomes das propriedades NÃO DEVEM ser prefixados com um único sublinhado para indicar visibilidade protegida ou privada.

Este guia evita intencionalmente qualquer recomendação sobre o uso de nomes de propriedade $StudlyCaps, $camelCase ou $under_score.
Qualquer convenção de nomenclatura usada DEVE ser aplicada de forma consistente dentro de um escopo razoável. Esse escopo pode ser no nível do fornecedor, no nível do pacote, no nível da classe ou no nível do método.

Se usar em um escopo a convenção camelCase use em todos os escopos a mesma convenção. A minha preferência é usar tanto para métodos quanto para propriedades o estilo camelCase, assim fica inclusive mais prático e é um estilo muito utilizado.

Exemplos:

private $myDate = '2021-01-22';


## Estruturas de controle

As regras gerais de estilo para estruturas de controle são as seguintes:
     • DEVE haver um espaço após a palavra-chave da estrutura de controle
     • NÃO DEVE haver um espaço após o parêntese de abertura
     • NÃO DEVE haver um espaço antes do parêntese de fechamento
     • DEVE haver um espaço entre o parêntese de fechamento e a chave de abertura
     • O corpo da estrutura DEVE ser indentado uma vez
     • A chave de fechamento DEVE estar na próxima linha após o corpo
O corpo de cada estrutura DEVE ser fechado por chaves. Isso padroniza a aparência das estruturas e reduz a probabilidade de introdução de erros à medida que novas linhas são adicionadas ao corpo.

### if, elseif, else

Uma estrutura if se parece com o seguinte. Observe a colocação de parênteses, espaços e colchetes; e que else e elseif estão na mesma linha que a chave de fechamento do corpo anterior.

<?php
if ($expr1) {
    // if body
} elseif ($expr2) {
    // elseif body
} else {
    // else body;
}

A palavra-chave elseif DEVE ser usada em vez de else se for assim que todas as palavras-chave de controle se parecem únicas.

### switch, case

Uma estrutura de switch se parece com a seguinte. Observe a colocação de parênteses, espaços e colchetes. A instrução case DEVE ser recuada uma vez a partir do switch, e a palavra-chave break (ou outra palavra-chave de terminação) DEVE ser recuada no mesmo nível do corpo do case. DEVE haver um comentário como // sem interrupção quando a falha for intencional em um corpo de caso não vazio.

<?php
switch ($expr) {
    case 0:
        echo 'First case, with a break';
        break;
    case 1:
        echo 'Second case, which falls through';
        // no break
    case 2:
    case 3:
    case 4:
        echo 'Third case, return instead of break';
        return;
    default:
        echo 'Default case';
        break;
}

### while, do while

Uma instrução while se parece com o seguinte. Observe a colocação de parênteses, espaços e chaves.

<?php
while ($expr) {
    // structure body
}

Da mesma forma, uma instrução do while se parece com o seguinte. Observe a colocação de parênteses, espaços e chaves.

<?php
do {
    // structure body;
} while ($expr);

### for

Uma instrução for se parece com o seguinte. Observe a colocação de parênteses, espaços e chaves.

<?php
for ($i = 0; $i < 10; $i++) {
    // for body
}

### foreach

Uma declaração foreach se parece com o seguinte. Observe a colocação de parênteses, espaços e chaves.

<?php
foreach ($iterable as $key => $value) {
    // foreach body
}

### try/catch

Um bloco try catch se parece com o seguinte. Observe a colocação de parênteses, espaços e chaves

<?php
try {
    // try body
} catch (FirstExceptionType $e) {
    // catch body
} catch (OtherExceptionType $e) {
    // catch body
}

## Closures

As closures/fechamentos DEVEM ser declaradas com um espaço após a palavra-chave de função e um espaço antes e depois da palavra-chave de uso.

A chave de abertura DEVE vir na mesma linha e a chave de fechamento DEVE vir na próxima linha após o corpo.

NÃO DEVE haver um espaço após o parêntese de abertura da lista de argumentos ou lista de variáveis, e NÃO DEVE haver um espaço antes do parêntese de fechamento da lista de argumentos ou lista de variáveis.

Na lista de argumentos e na lista de variáveis, NÃO DEVE haver um espaço antes de cada vírgula e DEVE haver um espaço após cada vírgula.

Argumentos de fechamento com valores padrão DEVEM ser colocados no final da lista de argumentos.

Uma declaração de closure se parece com o seguinte. Observe a colocação de parênteses, vírgulas, espaços e chaves:

<?php
$closureWithArgs = function ($arg1, $arg2) {
    // body
};

$closureWithArgsAndVars = function ($arg1, $arg2) use ($var1, $var2) {
    // body
};

Listas de argumentos e listas de variáveis PODEM ser divididas em várias linhas, onde cada linha subsequente é recuada uma vez. Ao fazer isso, o primeiro item da lista DEVE estar na próxima linha e DEVE haver apenas um argumento ou variável por linha.

Quando a lista final (seja de argumentos ou variáveis) é dividida em várias linhas, o parêntese de fechamento e a chave de abertura DEVEM ser colocados juntos em sua própria linha com um espaço entre eles.

A seguir estão exemplos de encerramentos com e sem listas de argumentos e listas de variáveis divididas em várias linhas.

<?php
$longArgs_noVars = function (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) {
    // body
};

$noArgs_longVars = function () use (
    $longVar1,
    $longerVar2,
    $muchLongerVar3
) {
    // body
};

$longArgs_longVars = function (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) use (
    $longVar1,
    $longerVar2,
    $muchLongerVar3
) {
    // body
};

$longArgs_shortVars = function (
    $longArgument,
    $longerArgument,
    $muchLongerArgument
) use ($var1) {
    // body
};

$shortArgs_longVars = function ($arg) use (
    $longVar1,
    $longerVar2,
    $muchLongerVar3
) {
    // body
};

Observe que as regras de formatação também se aplicam quando o encerramento é usado diretamente em uma função ou chamada de método como um argumento.

<?php
$foo->bar(
    $arg1,
    function ($arg2) use ($var1) {
        // body
    },
    $arg3
);

Existem muitos elementos de estilo e prática omitidos intencionalmente por este guia. Estes incluem, mas não estão limitados a:
     • Declaração de variáveis globais e constantes globais
     • Declaração de funções
     • Operadores e designação
     • Alinhamento inter-linhas
     • Comentários e blocos de documentação
     • Prefixos e sufixos do nome da classe
     • Melhores Práticas
Recomendações futuras PODEM revisar e estender este guia para abordar esses ou outros elementos de estilo e prática.
Enquanto isso use o bom senso para manter tudo dentro de um padrão único em todo o seu código, para melhor entendimento futuro seu e de terceiros.


PSR-1: Basic Coding Standard - Esta seção do padrão compreende o que devem ser considerados os elementos de codificação padrão necessários para garantir um alto nível de interoperabilidade técnica para o código PHP compartilhado.

PSR-2: Coding Style Guide - Obsoleto - a partir de 10/08/2019, o PSR-2 foi marcado como obsoleto. O PSR-12 agora é recomendado como alternativa.

## Tipos

Quaisquer novos tipos e palavras-chave adicionados a futuras versões do PHP DEVEM estar em letras minúsculas.

DEVEM ser usadas palavras-chave de tipo abreviado, ou seja, bool em vez de booleano, int em vez de inteiro etc.

## Declarar instruções, namespace e instruções de importação

O cabeçalho de um arquivo PHP pode consistir em vários blocos diferentes. Se presente, cada um dos blocos abaixo DEVE ser separado por uma única linha em branco e NÃO DEVE conter uma linha em branco. Cada bloco DEVE estar na ordem listada abaixo, embora os blocos que não são relevantes possam ser omitidos.
    • Tag de aebrtura <?php.
    • Docblock em nível de arquivo.
    • Uma ou mais declaração de declarações.
    • A declaração de namespace do arquivo.
    • Uma ou mais instruções de importação de uso baseado em classe.
    • Uma ou mais instruções de importação de uso baseado em função.
    • Uma ou mais instruções de importação de uso com base em constantes.
    • O restante do código no arquivo.

Quando um arquivo contém uma mistura de HTML e PHP, qualquer uma das seções acima ainda pode ser usada. Nesse caso, eles DEVEM estar presentes na parte superior do arquivo, mesmo que o restante do código consista em uma tag de fechamento do PHP e, em seguida, uma mistura de HTML e PHP.

Quando a tag de abertura <?php está na primeira linha do arquivo, ela DEVE estar em sua própria linha sozinha, sem outras instruções, a menos que seja um arquivo contendo marcação fora das tags de abertura e fechamento do PHP.

As instruções de importação nunca DEVEM começar com uma barra invertida, pois devem ser sempre totalmente qualificadas.

O exemplo a seguir ilustra uma lista completa de todos os blocos:

<?php

/**
 * This file contains an example of coding styles.
 */

declare(strict_types=1);

namespace Vendor\Package;

use Vendor\Package\{ClassA as A, ClassB, ClassC as C};
use Vendor\Package\SomeNamespace\ClassD as D;
use Vendor\Package\AnotherNamespace\ClassE as E;

use function Vendor\Package\{functionA, functionB, functionC};
use function Another\Vendor\functionD;

use const Vendor\Package\{CONSTANT_A, CONSTANT_B, CONSTANT_C};
use const Another\Vendor\CONSTANT_D;

/**
 * FooBar is an example class.
 */
class FooBar
{
    // ... additional PHP code ...
}

Namespaces compostos com uma profundidade de mais de dois NÃO DEVEM ser usados. Portanto, o seguinte é a profundidade máxima de composição permitida:

<?php

use Vendor\Package\SomeNamespace\{
    SubnamespaceOne\ClassA,
    SubnamespaceOne\ClassB,
    SubnamespaceTwo\ClassY,
    ClassZ,
};

E o seguinte não seria permitido:

<?php

use Vendor\Package\SomeNamespace\{
    SubnamespaceOne\AnotherNamespace\ClassA,
    SubnamespaceOne\ClassB,
    ClassZ,
};

## Operadores

As regras de estilo para operadores são agrupadas por aridade (o número de operandos que eles aceitam).

Quando o espaço é permitido ao redor de um operador, vários espaços PODEM ser usados para fins de legibilidade.

Todos os operadores não descritos aqui são deixados indefinidos.

### Operador unário

Os operadores de incremento/decremento NÃO DEVEM ter nenhum espaço entre o operador e o operando.

$i++;
++$j;

Cast de Operadores de tipo NÃO DEVEM ter nenhum espaço entre parênteses:

$intValue = (int) $input;

### Operadores binários

Todos os operadores de aritmética binária, de comparação, de atribuição, bit a bit, lógico, string e de tipo DEVEM ser precedidos e seguidos por pelo menos um espaço:

if ($a === $b) {
    $foo = $bar ?? $a ?? $b;
} elseif ($a > $b) {
    $foo = $a + $b * $c;
}

### Operadores ternários

O operador condicional, também conhecido simplesmente como operador ternário, DEVE ser precedido e seguido por pelo menos um espaço ao redor dos personagens ? e :

$variable = $foo ? 'foo' : 'bar';

Quando o operando do meio do operador condicional é omitido, o operador DEVE seguir as mesmas regras de estilo que outros operadores de comparação binários:

$variable = $foo ?: 'bar';


## Classes Anônimas

As classes anônimas DEVEM seguir as mesmas diretrizes e princípios que as closures.

<?php

$instance = new class {};

<?php

// Brace on the same line
$instance = new class extends \Foo implements \HandleableInterface {
    // Class content
};

// Brace on the next line
$instance = new class extends \Foo implements
    \ArrayAccess,
    \Countable,
    \Serializable
{
    // Class content
};


