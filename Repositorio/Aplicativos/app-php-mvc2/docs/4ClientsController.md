# App/Controllers

## ClientsController.php

Este controller extende o Controller.php

Aqui ficam apenas métodos bem resumidos:

index()
add()
edit()
update()
delete()

O código pra valer fica no Core/Controller.php

Cada método deste acima que é exibido natela, como index, add e edit recebem a inclusão de:
- header
- menu
- A view respectiva
- footer

A view index tem uma tabela com links de todos os registros e para cada registro um link para editar e outro para excluir cada registro.

Agora vejamos as views


