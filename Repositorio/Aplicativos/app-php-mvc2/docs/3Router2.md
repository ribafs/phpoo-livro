# Core/Router.php

O Router é uma classe com apenas dois métodos, o construtor e o splitUrl().
No início do construtor, ele chama o método splitUrl().
O método splitUrl() separa o conteúdo da URL em 3 partes: controller, action e parâmetros, caso existam

Então o construtor chama o método splitUrl() e verifica se o controller ClientsController foi passado pela URL
Caso não tenha sido passado ele assume o controller default, definido em Core/config.php, que no caso é o Clients. Como temos apenas um controller, aqui não tem erro. Isso será útil quando tivermos mais de um controller.

Ele verifica  se na URL veio algum action, caso não tenha vindo ele assume o index como default e o passa com o controller clients.

Agora é a hora de verificar se foram passados parâmetros, se sim ele os anexa à URL, juntamente com o controller e o action.

Caso tenha sido passado um controller diferente de clients, então o usuário receberá uma mensagem de erro dizendo que tal controller não existe.

Caso tenha sido passado um action que não exista no controller clients, o user será avisado que o action não existe.

Se for passado algum aprâmetro que não existe o user será avisado.

Vamos agora apra o

ClientsController


