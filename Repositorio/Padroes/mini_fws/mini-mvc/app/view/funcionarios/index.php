<div class="container">
    <h1>Funcionários</h1>
    <h2>Você está na View: application/view/funcionarios/index.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- Form para adicionar funcionario -->
    <div class="box">
        <h3>Adicionar um funcionário</h3>
        <form action="<?php echo URL; ?>funcionarios/add" method="POST">
            <label>Nome</label>
            <input type="text" name="nome" value="" required />
            <label>CPF</label>
            <input type="text" name="cpf" value="" />
            <input type="submit" name="submit_add_funcionario" value="Enviar" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>Total de funcionarios: <?php echo $amount_of_funcionarios; ?></h3>
        <h3>Total de funcionários (via AJAX)</h3>
        <div id="javascript-ajax-result-box"></div>
        <div>
            <button id="javascript-ajax-button">Clique aqui para obter a quantidade de funcionarios via Ajax (será exibido em # javascript-ajax-result-box acima)</button>
        </div>
        <h3>Lista de funcionarios (dados do model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($funcionarios as $funcionario) { ?>
                <tr>
                    <td><?php if (isset($funcionario->id)) echo htmlspecialchars($funcionario->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($funcionario->nome)) echo htmlspecialchars($funcionario->nome, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($funcionario->obs)) echo htmlspecialchars($funcionario->obs, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($funcionario->cpf)) echo htmlspecialchars($funcionario->cpf, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'funcionarios/delete/' . htmlspecialchars($funcionario->id, ENT_QUOTES, 'UTF-8'); ?>">Excluir</a></td>
                    <td><a href="<?php echo URL . 'funcionarios/edit/' . htmlspecialchars($funcionario->id, ENT_QUOTES, 'UTF-8'); ?>">Editar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
