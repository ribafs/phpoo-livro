<div class="container">
    <h2 class="text-center">Produto</h2>
	<a class="btn btn-primary btn-sm" href="<?=URL . 'products/add'; ?>">Add Produto</a>

    <div>
        <br>        
        <b>Lista de produtos (dados vindos do model)</b><div class="text-right"><b>Soma de produtos: <?php echo $soma; ?></b></div>
        <table class="table table-hover table-stripped">
            <thead>
            <tr class="bg-gray">
                <td><b>ID</b></td>
                <td><b>Nome</b></td>
                <td><b>Preço</b></td>
                <td colspan="2" align="center">AÇÕES</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($todos as $product) { ?>
                <tr>
                    <td><?php if (isset($product->id)) echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->name)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->price)) echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'products/delete/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'products/edit/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
