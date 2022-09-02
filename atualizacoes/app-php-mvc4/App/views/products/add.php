<div class="container">
    <h2 class="text-center">Produtos</h2>
    <div>
        <br>
        <form action="<?php echo URL; ?>products/add" method="POST">   
        <table class="table table-hover table-stripped">
            <tr><td><label>Nome</label></td>
            <td><input class="form-control" type="text" name="name" value="" required /></td></tr>
            <td><label>Preço</label></td>
            <td><input class="form-control" type="text" name="price" value="" required /></td></tr>
            <tr><td></td><td><input type="submit" name="submit_add_product" value="Add Produto" class="btn btn-primary btn-sm"/></td></tr>
		</table>
        </form>
    </div>
</div>
