# Dependency Injection (Injeção de Dependência)

Fonte Wikipedia:

Dependency Injection é um Design Pattern que permite retirar as dependências hard-coded e torna possível mudá-las, seja em tempo de execução ou em tempo de compilação.

Esta citação torna o conceito muito mais complicado do que realmente é. Dependency Injection fornece um componente com suas dependências, seja por injeção no construtor, chamada de método ou na definição de propriedades. É simples assim.

Demostraremos o conceito com um simples exemplo.

Temos uma classe Database que requer um adaptador para se comunicar com o banco de dados. Instanciaremos o adaptador no construtor e assim criamos uma forte de dependência. Isto dificulta os testes e significa que a classe Database está fortemente acoplada ao adaptador.

<?php
namespace Database;

class Database
{
    protected $adapter;

    public function __construct()
    {
        $this->adapter = new MySqlAdapter;
    }
}

class MysqlAdapter {}

Este código pode ser refatorado para usar a Dependency Injection para desacoplar a dependência.

<?php
namespace Database;

class Database
{
    protected $adapter;

    public function __construct(MySqlAdapter $adapter)
    {
        $this->adapter = $adapter;
    }
}

class MysqlAdapter {}

Agora, damos a classe Database a sua dependência em vez de criar dentro dela. Poderiamos também, criar um método que aceitaria um argumento da dependência e defini-la dessa forma, ou definir a propriedade $adapter como public para defini-la diretamente.


