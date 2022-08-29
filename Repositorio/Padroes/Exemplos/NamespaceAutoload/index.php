<?php

require_once 'vendor/autoload.php';

$produto = new \App\Model\Produto();
$produto->setId(2);
$produto->setNome('Segundo Micro HP');
$produto->setDescricao('i7, 8GB');

$produtoDao = new \App\Model\ProdutoDao();
//$produtoDao->delete(3);
$produtoDao->create($produto);
//$produtoDao->update($produto);

$produtos = $produtoDao->read();

foreach($produtos as $produto){
    print $produto['nome'].'-'.$produto['descricao'].'<hr>';
}
