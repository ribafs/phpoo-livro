<div class="container">
    <h2 class="text-center">Clientes</h2>
	<a class="btn btn-primary btn-sm" href="<?=URL . 'clients/add'; ?>">Add Cliente</a>

    <div>
        <br>        
        <b>Lista de clientes (dados vindos do model)</b><div class="text-right"><b>Soma de clientes: <?php echo $soma; ?></b></div>
        <table class="table table-hover table-stripped">
            <thead>
            <tr class="bg-gray">
                <td><b>ID</b></td>
                <td><b>Nome</b></td>
                <td><b>E-mail</b></td>
                <td colspan="2" align="center">AÇÕES</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($todos as $client) { ?>
                <tr>
                    <td><?php if (isset($client->id)) echo htmlspecialchars($client->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($client->name)) echo htmlspecialchars($client->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($client->email)) echo htmlspecialchars($client->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'clients/edit/' . htmlspecialchars($client->id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a></td>
                    <td><a onclick="return confirm('Realmente excluir o cliente ?')" href="<?php echo URL . 'clients/delete/' . htmlspecialchars($client->id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
