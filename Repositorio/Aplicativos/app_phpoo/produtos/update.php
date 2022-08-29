<?php
require_once('../classes/produto.php');
$produto = new Produto($pdo);

$id=$_GET['id'];

$sth = $produto->pdo->prepare("SELECT id,descricao,unidade,data_cadastro from produtos WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_OBJ);
$descricao = $reg->descricao;
$unidade = $reg->unidade;
$data_cadastro = $reg->data_cadastro;

require_once('./header.php');
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$conn->appName?> <br>Atualizar</h3></b></div>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="">
                <table class="table table-bordered table-responsive table-hover">
                <tr><td><b>Descrição</td><td><input type="text" name="descricao" value="<?=$descricao?>"></td></tr>
                <tr><td><b>Unidade</td><td><input type="text" name="unidade" value="<?=$unidade?>"></td></tr>
                <tr><td><b>Cadastro</td><td><input type="text" name="data_cadastro" value="<?=$data_cadastro?>"></td></tr>
                <input name="id" type="hidden" value="<?=$id?>">
                <tr><td></td><td><input name="enviar" class="btn btn-primary" type="submit" value="Editar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
                </table>
            </form>
            <?php require_once('../footer.php'); ?>
        </div>
    <div>
</div>

<?php

if(isset($_POST['enviar'])){
require_once('../classes/produto.php');
$produto = new Produto($pdo);

   if($produto->update()){
        print "<script>alert('Registro alterado com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao alterar o registro!<br><br>";
        exit();
    }
}
?>

