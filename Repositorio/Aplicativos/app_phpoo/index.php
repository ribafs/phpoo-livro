<?php
require_once('./header.php');
require_once('./classes/connection.php');
$conn = new Connection();
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$conn->appNameMenu?></b></h3>
        <div class="row">
<pre>






</pre>
        <a href="clientes">Clientes</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="produtos">Produtos</a>

<pre>






</pre>
</div>
</div>

<?php require_once('./footer.php');?>
