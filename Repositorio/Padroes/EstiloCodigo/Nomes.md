# Convenções para nomes

Não são leis fixas, regras imutáveis mas apenas convenções, padrões que ajudam a trabalhar, especialmente em equipe. Como atualmente compartilhamos código com o mundo, mesmo os que trabalham sozinho, então todos trabalhamos, na prática, em equipe. Portanto é importante que todos sigamos algum padrão e, de pre ferência, sigamos um padrão adotado pela maioria ou por muitos, para facilitar para a mioria dos que leiam nosso código.

## Idioma

Idealmente todos os nomes devem ser escritos em inglês. Isso dificulta no início mas evitará erros causados por palavras em português. A linguagem PHP e praticamente todas as outras usam termos em inglês e os grandes frameworks usam este idioma ainda mais intersamente.

## Nomes de arquivos e pastas

Em geral devem ser com todas as letras em minúsculas e palavras compostas separadas por sublinhado.

Exemplos: 

- file.txt, 
- my_file.txt
- folder
- my_folder

### Exceções

Nomes de arquivos que contém classes devem ser escritos usando CamelCase.

Exemplos (usando as convenções do framework PHP mais popular atualmente):

- Controllers
    ClientController.php
- Models
    User.php

## Bancos de dados

Nome do banco - tudo em minúsculas e no singular. Palavras compostas separadas por sublinhado.

Exemplos:

- register
- client_register

Nomes de tabelas - tudo em minúsculas e no plural e palavras compostas separadas por sublinhado.

Exemplos:

- clients
- my_clients

Nomes de campos - também tudo no singular e palavras compostas separadas por sublinhado.

Exemplos:

- name
- client_name


