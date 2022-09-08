# phpoo-livro

Livro de introdução ao PHP orientado a objetos usando MVC com rotas.

Porque de forma prática, por conta da criação, passo a passo, de um aplicativo em PHP orientado a objetos usando MVC e rotas.

Aqui quero deixar minha gratidão ao Cris, autor do excelente aplicativo

https://github.com/panique/mini3

Que por cotna da sua clareza me permitiu entender como se cria um bom aplicativo em PHP usando MVC.

## Dica extra

Ao pesquisar projetos por php mvc ou framework mvc do zero, acontece muito de ao invés de usar o nome Route ou Router para a classe de rotas, o autor usar App ou Application. Alguns até recomendam por ser mais semântico e combinar melhor com sua função.

## Atualizações - visite para ver as últimas

Ficarei atualizando nesta pasta [atualizacoes](atualizacoes)

## Índice do Livro

[indice.pdf](indice.pdf)

## Livro

[phpoo.pdf](phpoo.pdf)

## Material de apois

Na pasta Repositório

- Aplicativos
    - [app-php-mvc](Repositorio/Aplicativos/app-php-mvc) (3 versões do aplicativo criado no livro)
    - app_phpoo
    
- BoasPraticas
- Classes
- ClassesUteis
- NameSpace
- Padroes
- PHPModerno
- Tutoriais

## Diagrama MVC

### Pequeno diagrama do fluxo de informações do MVC

- Usuário faz uma requisição através de um botão numa view ou diretamente por um link
- O sistema de rotas recebe e encaminha para o action  de um específico controller
- O conroller solicita do model as informações
- O model requisita do banco de dados
- O banco devolve para o model
- O model devolve para o controller
- O controller devolve para a view/usuário

![](mvc.png)

## Sugestões

Serão bem vindas. Use o forum para isso - [https://github.com/ribafs/phpoo-livro/discussions](https://github.com/ribafs/phpoo-livro/discussions)

## Licença

MIT
