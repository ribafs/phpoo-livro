# App/views/clients

## add.php

Um form para adicionar um cliente.

É importante observar:

- O action do form

action="<?php echo URL; ?>clients/add

O name do submit

submit_add_client

Este name acima é usado no Core/Controller.php, no método add()

if (isset($_POST['submit_add_'.$tab])) {

Que corresponde a
if (isset($_POST['submit_add_clients'])) {

No caso ele testa se a requisição vem do respectivo form e somente adiciona o registro se isso for verdadeiro.


## edit.php

Aqui vale o name do submit, que é submit_update_client

É verificado no método update do Core/Controller.php

if (isset($_POST['submit_update_'.$tab])) {


## index.php

Este varre todos os registros com o laço abaixo, usando a variável $todos, definida no método index() co Core/Controller.php

<?php foreach ($todos as $client) { ?>


