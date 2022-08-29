<div class="container">
    <h2>Você está na View: app/view/funcionarios/edit.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add song form -->
    <div>
        <h3>Editar um funcionario</h3>
        <form action="<?php echo URL; ?>funcionarios/update" method="POST">
            <label>Nome</label>
            <input autofocus type="text" name="nome" value="<?php echo htmlspecialchars($funcionario->nome, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>CPF</label>
            <input type="text" name="cpf" value="<?php echo htmlspecialchars($funcionario->cpf, ENT_QUOTES, 'UTF-8'); ?>" />
            <label>Observação</label>
            <input type="text" name="obs" value="<?php echo htmlspecialchars($funcionario->obs, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="hidden" name="funcionario_id" value="<?php echo htmlspecialchars($funcionario->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_funcionario" value="Atualizar" />
        </form>
    </div>
</div>

