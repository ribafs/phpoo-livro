# Convenções no Laravel

Ao seguirmos as convenções definidas por um framework estamos garantindo boa performance, facilidade de manutenção, baixa curva de aprendizagem ao contratar programadores, segurança e escalabilidade.

Um banco de dados que não atende a convenção pode gerar confusão e dificuldade de manutenção do código da aplicação.

Ao não utilizar a convenção de nomeclatura de banco de dados do framework é possível que o programador tenha trabalho para definir em cada model qual é a sua respectiva tabela. Imagine um cenário de 100 models ou mais…

Uma aplicação que segue as convenções de seu framework garante o principal objetivo da utilização da ferramenta: produtividade. Com isso também garante uma pequena curva de aprendizagem ao trocar ou expandir a equipe além, claro, dos fatores de segurança, performance e organização que são essenciais para uma aplicação robusta e escalável.
https://medium.com/@carloscarneiropmw/overview-das-conven%C3%A7%C3%B5es-do-laravel-d2e76b3db38a 

## Ajuda muito seguir algumas convenções do Laravel
- Nomes de tabelas e campos - no plural e tudo em minúsculas (snake case)
- Model - singular e inicial maiúscula (CamelCase)
- Controller - singular e inicial maiúscula e todas as acions em minúsculas (CamelCase com sufixo Controller)
- Views - mesmos nomes das actions do controller
- Rotas - mesmos nomes dos actions do controller
- Usa por padrão os timestamps: created_at e updated_at
- PrimaryKey - id
- Foreign Key - tabela_id. Ex: cliente_id
- Preferir usar nomes de variáveis e de arquivos, como também de tabelas e campos em inglês
- Nomes padrões dos actions dos controllers: index, create, show, store, edit, update, destroy

## Quando não seguirmos algumas das convenções podemos dizer ao Laravel para usar o nome que escolhemos. Isso se faz no Model, mas somente é aconselhado fazer em caso de necessidade. Exemplo:

  protected $table = "minha_tabela";
  protected $primaryKey = "minhaChave";
etc

  //Tipo da chave primária, sendo string
  protected $keyType = 'string';

  // Para usar nomes diferentes nos timestamps
  const CREATED_AT = 'creation_date';
  const UPDATED_AT = 'last_update';

## Validação
É muito comum os iniciantes acharem prático setar validações dentro dos models mas isso significa que o framework somente irá validar os dados no ato de salvar no banco e se por acaso não forem dados válidos teria ocorrido um processamento desnecessário e a aplicação lançará uma exceção — crash — possivelmente deixando o usuário frustrado.
```php
<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = 'clientes';
  protected $primaryKey = 'id';
  protected $fillable = ['nome', 'email'];
	public $timestamp = true;
	protected $connection = 'connection-name'; //Somente caso use uma conexão diferente da default
}
```
## Routes

resources no plural e minúsculas

Route::get('/users', 'UserController@index');
Route::resource('photos', 'PhotoController');


https://laravel.com/docs/7.x/eloquent#eloquent-model-conventions

