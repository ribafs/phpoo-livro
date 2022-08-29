# Clean Code - Qualidade de Código

## O que devemos evitar?

- Nomes de variáveis, constantes, funções e classes que não representam o que fazem. Devemos ser bem cuidadosos ao nomear algum elemento do nosso código, para que ao ler este código após algum tempo eprcebamos com facilidade o queu cada nome faz. E também quando outros integrantes da equipe lerem o código sintam facilidade de entender.
- Assim temném valores de variáveis. É melhor que sejam constantes, ou que sejam definidos no início do código.
- Uso desnecessário de else
- Falta de indentação 
- Importante fugir do código complexo
- Evitar comentário de linha que tenta explicar um código. Ao invés deixe o código claro, ao ponto que não precise ser explicado, mas que seja simples e claro
- Não mascare error usando @, ao invés sempre que existir a possibilidade de erro, crie código para tratá-lo. Exemplo: divisão de 2 números x/y. Prever que y seja zero.

## O que devemos perseguir?

- Para que a programação seja motivante, você procisa gostar do que faz, precisa dominar bastante
- O código precisa ser organizado, bem organizado
- Nomes devem ser bem claros e ser bem representativos do que fazem
- Criar código bem feito de forma a se sentir bem com o que fez, fazendo o nosso melhor e nos valorizando como profissional
- O código precisa funcionar, ser estável, menutenível, robusto
- Precisamos muito de um olhar crítico, para ficar o tempo todo ajustando o nosso código para algo melhor
- Bons programadores escrevem código que humanos entendem (Martin Fowler)
- Precisamos perseguir a simplicidade no código, o que requer refatoração
- Responsabilidade única para as classes
- Baixo acoplamento entre classes
- Grande potencial de reuso
- Ser proativo com o código. Nunca acumular situações problema. Resolver
- Usar boas ferramentas, issues, pull requests, sonar, etc
- Ao nomear bancos, tabelas, campos, arquivos, pastas, variáveis, funções, constantes, classes siga as boas práticas - https://www.php-fig.org/psr/psr-1/
- Aprender inglês e escrever nomes em inglês facilita e é recomendado
- Perseguir a coesão no código, com nomes coesos, com responsabilidades coesas. Todas as propriedades e métodos devem dizer respeito ao assunto da classe.
- Prefira sempre manter o código próximo da margem esquerda. Quanto mais distante, mais complexo. Os ifs com elses nos afastam
- Um código simples, claro e manutenível pode ficar maior que um código complexo. O mais importante não é o tamanho, mas a clareza.
- Criação de constantes e funções para deixar o código mais claro e reusável
- Evitar ao máximo o uso de else
- Encapsular todos os tipos primitivos com getter e setter (vantagens: validação e formatação)
- Não abrevie nomes
- Manter funções e classes pequenas
- Evite criar muitas variáveis de instãncia (recomendado até 5)
- Documente bem seu código com phpDoc. Isso ajuda os editores e IDEs a retornarem informações sobre o código
- Evitar código aninhado, que torna a leitura complexa. Evite ifs dentro de ifs e também outras estruturas aninhadas.
- Seja fiel aos eu código. Se uma classe tem uma função não adicione outras funções para a mesma e concentre-se na função da classe.
- Prefira argumentos default (argumentos com valores)
- Evite usar muitos argumentos em uma função. Dois ou menos.
- Os nomes de funções, variáveis e classes devem dizer o que eles fazem. Ser bem claros e explícitos
- As funções, como as classes devem ter somente uma única responsabilidade. Se necessário divida o código em outras funções ou classes.
- Evite efeito coalteral em funções e classes. Quando precisar escrever em um arquivo, modificar alguma variável global, ou acidentalmente transferir todo o seu dinheiro não o faça em funções ou classes.
- Não crie funções globais.
- Evite usar o padrão Singleton, que é um anti-pattern. Geralmente é usado como uma instância global.
- Encapsule condicionais. if ($article->isPublished()) {
- Evite condicionais. Parece uma tarefa impossível. Ao ouvir isso pela primeira vez, a maioria das pessoas diz: "como posso fazer qualquer coisa sem uma declaração if ou switch? " A resposta é que você pode usar o polimorfismo para realizar a mesma tarefa em muitos casos. A segundo pergunta geralmente é, "bem, isso é ótimo, mas por que eu iria querer fazer isso?" o resposta é um conceito de código limpo anterior que aprendemos: uma função só deve fazer uma coisa. Quando você tem classes e funções com instruções `if`, você está dizendo ao usuário que sua função faz mais de uma coisa. Lembrar, apenas faça uma coisa.
- Evite checar tipos
- Remova código morto
- Use encapsulamento de objetos com os modificadores de visibildiade
- Use bem os modificadores private e protected
- Usemos classes final sempre que possível

Evitando condicionais:

declare(strict_types=1);

interface Airplane
{
    // ...

    public function getCruisingAltitude(): int;
}

class Boeing777 implements Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
        return $this->getMaxAltitude() - $this->getPassengerCount();
    }
}

class AirForceOne implements Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
        return $this->getMaxAltitude();
    }
}

class Cessna implements Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
        return $this->getMaxAltitude() - $this->getFuelExpenditure();
    }
}

## SOLID

Princícios sólidos

- Classes e funções com uma única reponsabilidade
- Open/close - uma classe ou método devem estar fechados para edição e abertos para extensão. Ao invés de alterar classes devemos extendê-las e especializa
- liskov substitution - Uma classe filha pode e deve ser substituida pela classe pai
- interface segregation - toda classe deve implementar uma interface
- dependency injection - Injeção de dependências. Injetar uma classe em outra, ou seja, um objeto em outro

## Trabalho em equipe

- Que os integrantes possam sugerir e criticar o código de cada um
- Atualmente todos trabalhamos em equipe, mesmo os que são free lancers e os que trabalham sozinhos em seus desktops. Como divulgamos nossos projetos então precisamos nos preocupar com o nosso código, se ele está fácil e simples de ser lido, para que assim nosso conceito cresça para quem lê nosso código.

## Refatory

Refatorar é tornar o código mais fácil de ser entendido e menos custoso de ser modificado sem alterar seu comportamento observável (continue funcionando da mesma forma). Martin Fowler

Refatorar não é adicionar novas funcionalidades, mas apenas alterar uma existente. É uma forma de fazer com que o software seja sustentável e competitivo com o passar do tempo.

### Sequência

- Criar o código
- Refatorar

É importante que estejamos diariamente produzindo código assim, sempre seguido da refatoração. Além de sempre que precise fazer alguma alteração no código, aproveite e refatore o código.

Com um código ruim a motivação da cada integrante da equipe vai cair e com o tempo os problemas aumentarão, podendo chegar ao ponto de não ter solução.

Os administradores das empresas, os responsáveis pelas equipes, precisam entender a importância destes fatores para valorizá-los.

## Dicas

- O volume de linhas impacta na legibilidade. Mas para que isso aconteça precisamos ser mais claros em nosso código, usando nomes mais significativos
- Usar nomes em inglês é desejável e recomendádo e em algumas vezes é obrigatório. Então é ideal que usemos nomes em inglês.

## Funções

Devem ser pequenas e realmente focar na sua função.

DRY - Dont repeat yourself - não repita a si mesmo

## Comentários

Importante somente para documentação phpDoc. Deve ser evitado, pois o código deve ser claro ao ponto de não necessitar de comentário

## Tamanho da linha

Idealmente a largura da linha deve ser de no máximo a largura da tela, para facilitar a leitura

## Indentação

Seguir o padrão definido pela equipe

## Padrões

Importante que a equipe tenha padrões de desenvolvimento e que todos os sigam



## Referêncvias

- https://www.youtube.com/watch?v=pepkomxYcaY&list=PLQCmSnNFVYnSpfpwwQGO8QHQ3CcizaZsV&index=1
- https://www.youtube.com/watch?v=rzwtMb5Foew&list=PLQCmSnNFVYnSpfpwwQGO8QHQ3CcizaZsV&index=2
- https://www.youtube.com/watch?v=N7BY11LtpbM&list=PLQCmSnNFVYnSpfpwwQGO8QHQ3CcizaZsV&index=3
- https://www.youtube.com/watch?v=gWpgoBuOt7E
- https://www.youtube.com/watch?v=abpKrDzkR_w
- https://www.youtube.com/watch?v=9_T_Zn2I7qc
- https://www.youtube.com/playlist?list=PLXik_5Br-zO_5EGPG6_u-u0hVI_f_ThO_ 
- https://github.com/jeanjar/clean-code-php/tree/pt-br
Clean Code com Rodrigo Branas
- https://www.youtube.com/watch?v=Jw3oqUyPsL4
- https://www.youtube.com/watch?v=pepkomxYcaY
- https://www.youtube.com/watch?v=4EnLAQprzJU
- https://www.youtube.com/watch?v=DaRpFF-di4w
- https://www.youtube.com/watch?v=tlqpNTFa_YQ
- O poder do Clean Code - Rodrigo Branas - https://www.youtube.com/watch?v=2wjoy2FrzwI&feature=youtu.be
