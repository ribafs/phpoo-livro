<?php
include_once("../classes/cliente.php");
$cliente = new Cliente($pdo);
// $conn para referir a classe Connection()

$stmt = $cliente->pdo->prepare("SELECT COUNT(*) FROM clientes");
$stmt->execute();
$rows = $stmt->fetch();

// get total no. of pages
$totalPages = ceil($rows[0]/$conn->regsPerPage);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <title><?=$conn->appNameMenu?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    .panel-footer {
        padding: 0;
        background: none;
    }
    </style>
</head>
