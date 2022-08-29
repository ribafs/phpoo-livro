# PSR-4: Autoloader

https://www.php-fig.org/psr/psr-4/

Este PSR descreve uma especificação para classes de carregamento automático de caminhos de arquivo, como alternativa ao uso dos includes.

Este PSR também descreve onde colocar os arquivos que serão carregados automaticamente de acordo com a especificação.

Um nome de classe totalmente qualificado tem o seguinte formato:
    \<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>
    1. O nome de classe totalmente qualificado DEVE ter um nome de namespace de nível superior, também conhecido como “namespace de fornecedor”.
    2. O nome de classe totalmente qualificado PODE ter um ou mais nomes de sub-namespace.
    3. O nome de classe totalmente qualificado DEVE ter um nome da classe final.
    4. Os sublinhados não têm nenhum significado especial em qualquer parte do nome totalmente qualificado da classe.
    5. Os caracteres alfabéticos no nome de classe totalmente qualificado PODEM ser qualquer combinação de letras minúsculas e maiúsculas.
    6. Todos os nomes de classe DEVEM ser referenciados diferenciando maiúsculas de minúsculas.

Ao carregar um arquivo que corresponde a um nome de classe totalmente qualificado ...

    1. Uma série contígua de um ou mais nomes de namespace e sub-namespace principais, não incluindo o separador de namespace principal, no nome de classe totalmente qualificado (um “prefixo de namespace”) corresponde a pelo menos um “diretório base”.
    2. Os nomes de sub-namespace contíguos após o “prefixo de namespace” correspondem a um subdiretório dentro de um “diretório base”, no qual os separadores de namespace representam separadores de diretório. O nome do subdiretório DEVE corresponder às maiúsculas e minúsculas dos nomes do sub-namespace.
    3. O nome da classe de encerramento corresponde a um nome de arquivo que termina em .php. O nome do arquivo DEVE corresponder ao caso do nome da classe final.
    4. As implementações do Autoloader NÃO DEVEM lançar exceções, NÃO DEVEM gerar erros de nenhum nível e NÃO DEVEM retornar um valor.


