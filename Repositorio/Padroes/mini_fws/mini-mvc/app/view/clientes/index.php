<div class="container">
    <h1>Clientes</h1>
    <h2>Você está na View: application/view/clientes/index.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add cliente form -->
    <div class="box">
        <h3>Adicionar um cliente</h3>
        <form action="<?php echo URL; ?>clientes/add" method="POST">
            <label>Nome</label>
            <input type="text" name="nome" value="" required />
            <label>E-mail</label>
            <input type="email" name="email" value="" required />
            <label>Nascimento</label>
            <input type="text" name="data_nasc" value="" />
            <label>CPF</label>
            <input type="text" name="cpf" value="" />
            <input type="submit" name="submit_add_cliente" value="Enviar" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>Total de clientes: <?php echo $amount_of_clientes; ?></h3>
        <h3>Total de clientes (via AJAX)</h3>
        <div id="javascript-ajax-result-box"></div>
        <div>
            <button id="javascript-ajax-button">Clique aqui para obter a quantidade de clientes via Ajax (será exibido em # javascript-ajax-result-box acima)</button>
        </div>
        <h3>Lista de clientes (dados do model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Nascimento</td>
                <td>CPF</td>
                <td>Excluir</td>
                <td>Editar</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $cliente) { ?>
                <tr>
                    <td><?php if (isset($cliente->id)) echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->nome)) echo htmlspecialchars($cliente->nome, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->email)) echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->data_nasc)) echo htmlspecialchars($cliente->data_nasc, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->cpf)) echo htmlspecialchars($cliente->cpf, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'clientes/delete/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>">Excluir</a></td>
                    <td><a href="<?php echo URL . 'clientes/edit/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>">Editar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
