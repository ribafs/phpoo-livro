<div class="container">
    <h2>Você está na View: application/view/clientes/edit.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add song form -->
    <div>
        <h3>Editar um cliente</h3>
        <form action="<?php echo URL; ?>clientes/update" method="POST">
            <label>Nome</label>
            <input autofocus type="text" name="nome" value="<?php echo htmlspecialchars($cliente->nome, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>E-mail</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Nascimento</label>
            <input type="text" name="data_nasc" value="<?php echo htmlspecialchars($cliente->data_nasc, ENT_QUOTES, 'UTF-8'); ?>" />
            <label>CPF</label>
            <input type="text" name="cpf" value="<?php echo htmlspecialchars($cliente->cpf, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="hidden" name="cliente_id" value="<?php echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_cliente" value="Editar" />
        </form>
    </div>
</div>

