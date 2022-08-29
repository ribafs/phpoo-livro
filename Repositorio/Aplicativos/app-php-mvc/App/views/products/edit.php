<div class="container">
    <h2 class="text-center">Produto</h2>
    <div>
		<br><br>
        <form action="<?php echo URL; ?>products/update" method="POST">   
        <table class="table table-hover table-stripped">
            <tr><td><label>Nome</label></td>
            <td><input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($um->name, ENT_QUOTES, 'UTF-8'); ?>" required autofocus/></td></tr>
            <td><label>Preço</label></td>
            <td><input class="form-control" type="text" name="price" value="<?php echo htmlspecialchars($um->price, ENT_QUOTES, 'UTF-8'); ?>" required /></td></tr>
            <input type="hidden" name="field_id" value="<?php echo htmlspecialchars($um->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <tr><td></td><td><input type="submit" name="submit_update_product" value="Update Produto" class="btn btn-primary btn-sm"/></td></tr>
		</table>
        </form>
    </div>
</div>
<br><br><br>
