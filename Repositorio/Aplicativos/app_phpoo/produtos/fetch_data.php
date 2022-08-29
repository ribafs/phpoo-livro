<?php
include_once("../classes/produto.php");
$produto = new Produto($pdo);

if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $conn->regsPerPage);

if($conn->sgbd == 'mysql'){
    $results = $produto->pdo->prepare("SELECT * FROM produtos ORDER BY id LIMIT $start, $conn->regsPerPage");
}else if($conn->sgbd == 'pgsql'){
    $results = $produto->pdo->prepare("SELECT * FROM produtos ORDER BY id LIMIT $conn->regsPerPage OFFSET $start");
}
$results->execute();

while($row = $results->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>" . 
    "<td>" . $row['id'] . "</td>" . 
    "<td>" . $row['descricao'] . "</td>" . 
    "<td>" . $row['unidade'] . "</td>" . 
    "<td>" . $row['data_cadastro'] . "</td>";
		?>
	    <td><a href="update.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-edit" title="Editar"></a></td>
	    <td><a href="delete.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-remove-circle" title="Excluir"></a></td>
        <!-- onclick="return confirm('Tem certeza de que deseja excluir este registro ?')" -->
<?php
print "
    </tr>";
}


