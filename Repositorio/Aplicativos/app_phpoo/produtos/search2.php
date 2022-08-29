<?php 
require_once('../classes/produto.php');
$produto = new Produto($pdo);

// Busca
if(isset($_GET['keyword'])){
    $keyword=$_GET['keyword'];

    $sql = "select * from produtos WHERE descricao LIKE :keyword order by id";
    $sth = $produto->pdo->prepare($sql);
    $sth->bindValue(":keyword", $keyword."%");
    $sth->execute();
	//$nr = $sth->rowCount();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
}
require_once('./header.php');
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$conn->appName;?></b></h3></div>
<?php
print '<div class="text-center"><h4><b>Registro(s) encontrado(s)</b>: '.count($rows).' com '.$keyword.'</h4></div>';

if(count($rows) > 0){
?>

    <table class="table table-hover">
        <thead>  
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Unidade</th>
                <th>Cadastro</th>
            </tr>
        </thead>

<?php
    // Loop através dos registros recebidos
    foreach ($rows as $row){
        echo "<tr>" . 
            "<td>" . $row['id'] . "</td>" . 
            "<td>" . $row['descricao'] . "</td>" . 
            "<td>" . $row['unidade'] . "</td>" . 
            "<td>" . $row['data_cadastro'] . "</td>" . 
        "</tr>";
    } 
    echo "</table>";

}else{
    print '<h3>Nenhum Registro encontrado!</h3>
</div>';
}
?>

<div class="text-center"><input name="send" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></div>
</div>
<br>
<?php require_once('../footer.php'); ?>
