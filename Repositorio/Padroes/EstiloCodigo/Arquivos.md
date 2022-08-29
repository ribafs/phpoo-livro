# Convenções para arquivos PHP

# O que devem conter

Os arquivos DEVEM declarar símbolos (classes, funções, constantes, etc.) ou causar efeitos colaterais (por exemplo, gerar saída, alterar configurações .ini, etc.), mas NÃO DEVEM conterr ambos.

## TAGs do PHP

Usar somente as tags longas

<?php

?>

ou curtas

<?= ?>

Não usar outras tags diferentes destas.

Arquivos com apenas código PHP não usar a tag de fechamento (?>)


## Todos os arquivos PHP DEVEM usar o final de linha Unix LF (alimentação de linha).

A principal razão por trás disso é scv (controle de versão do código-fonte), em que a alteração de terminações de linha causa diferenças e conflitos desnecessários.

Em segundo lugar, normalmente servimos nossos serviços em Linux, que é baseado em Unix, que usa a terminação de arquivo LF.

O primeiro causa a necessidade de um padrão, e o segundo diz porque você deve usar o padrão LF.

windows: CRLF = '\ r \ n'
unix: LF = '\ n'
mac: CR = '\ r' // macOS também mudou para LF há muito tempo btw.

Update: também note que, enquanto PHP - e imo. todas as outras linguagens de script - realmente não depende de uma terminação de linha específica, em outras linguagens isso pode causar problemas.

EOL é um ponto de conflito

PSR é feito para resolver os conflitos de estilo de codificação. EOL é um ponto de conflito, portanto o definiu de alguma forma. O grupo de trabalho PSR votou na questão de line_endings como?: 5, LF: 17. https://groups.google.com/forum/#!msg/php-fig/c-QVvnZdMQ0/TdDMdzKFpdIJ

Mesmo que não cause diferença sintática, no padrão PSR-2 foi definido dessa forma.


## UTF-8

Os arquivos DEVEM ser criados apenas usando editores com suporte ao UTF-8 sem BOM para código PHP.

No Windows

- Notepad++

No Linux

- Xed
- Gedit

Em qualquer sistema

- VSCode
- NetBeans
- Eclipse PDT
- ...

Os arquivos DEVEM declarar símbolos (classes, funções, constantes, etc.) ou causar efeitos colaterais (por exemplo, gerar saída, alterar configurações .ini, etc.), mas NÃO DEVEM fazer ambos.


## Final do arquivo PHP

Todos os arquivos PHP DEVEM terminar com uma única linha em branco.

A tag ?> precisa ser otimida em arquivos cujo conteúdo seja somente PHP.


## Comprimeiro das linhas

NÃO DEVE haver um limite rígido no comprimento da linha.

O limite flexível do comprimento da linha DEVE ser 120 caracteres; Os verificadores de estilo automatizados DEVEM avisar, mas NÃO DEVEM gerar erros para limite flexível.

NÃO DEVE haver espaço em branco no final das linhas.

NÃO DEVE haver mais de uma instrução por linha.

Linhas em branco PODEM ser adicionadas para melhorar a legibilidade e indicar blocos de código relacionados, exceto onde explicitamente proibido.

Largura recomendads

As linhas NÃO DEVEM ter mais de 80 caracteres; linhas maiores do que isso DEVEM ser divididas em várias linhas subsequentes de não mais de 80 caracteres cada.

NÃO DEVE haver espaço em branco à direita no final das linhas não em branco. Linhas em branco não devem conter espaço algum.

Linhas em branco PODEM ser adicionadas para melhorar a legibilidade e para indicar blocos de código relacionados.

NÃO DEVE haver mais de uma instrução por linha. O final da instrução é indicado por (;).

## Indentação

O código DEVE usar indentação de 4 espaços e NÃO DEVE usar tabulações para isso.

N.b .: Usar apenas espaços, e não misturar espaços com tabulações, ajuda a evitar problemas com diffs, patches, histórico e anotações. O uso de espaços também facilita a inserção de sub-indentação de granulação fina para o alinhamento entre linhas.

## Palavras chaves do PHP e null/false/true

Todas as palavras chaves do PHP e null, false e true devem ser escritos com minúsculas
