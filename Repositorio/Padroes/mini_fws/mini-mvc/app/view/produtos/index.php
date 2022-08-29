<div class="container">
    <h1>Produto</h1>
    <h2>Você está na View: app/view/produtos/index.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- form add produto -->
    <div class="box">
        <h3>Adicionar um produto</h3>
        <form action="<?php echo URL; ?>produtos/add" method="POST">
            <label>Descrição</label>
            <input type="text" name="descricao" value="" required />
            <label>Unidade</label>
            <input type="text" name="unidade" value="" required />
            <input type="submit" name="submit_add_produto" value="Enviar" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>Total de produtos: <?php echo $amount_of_produtos; ?></h3>
        <h3>Total de produtos (via AJAX)</h3>
        <div id="javascript-ajax-result-box"></div>
        <div>
            <button id="javascript-ajax-button">Clique aqui para obter a quantidade de produtos via Ajax (será exibido em # javascript-ajax-result-box acima)</button>
        </div>
        <h3>Lista de produtos (dados do model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Descrição</td>
                <td>Unidade</td>
                <td>Excluir</td>
                <td>Atualizar</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($produtos as $produto) { ?>
                <tr>
                    <td><?php if (isset($produto->id)) echo htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($produto->descricao)) echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($produto->unidade)) echo htmlspecialchars($produto->unidade, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'produtos/delete/' . htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>">Excluir</a></td>
                    <td><a href="<?php echo URL . 'produtos/edit/' . htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>">Editar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
