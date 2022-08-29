<?php
namespace Conta;

class Conta 
{
    protected $saldo;
    
    /**
     * Inicializa a conta com um saldo
     */
    public function __construct($valor)
    {
        $this->saldo = $valor;
    }

    /**
     * Deposita um valor na conta
     */
    public function depositar($valor)
    {
        $this->saldo += $valor;
    }

    
}

class ContaCorrente extends Conta
{
    /**
     * Saca um valor da conta
     */
    public function sacar($valor)
    {
        // Verifica se existe saldo para realizar o saque
        if($valor < $saldo) {
            $this->saldo -= $valor;
        }
    }
}


class ContaPoupanca extends Conta
{
    private $limiteSaque;

    public function __construct($saldo, $limiteSaque)
    {
        parent::__construct($saldo);
        $this->limiteSaque = $limiteSaque;
    }

    /**
     * Saca um valor da conta
     */
    public function sacar($valor)
    {
        // Verifica se existe saldo para realizar o saque
        if($valor < $saldo && $valor < $limiteSaque) {
            $this->saldo -= $valor;
        }
    }
}
//https://blog.eximiaweb.com.br/4-conceitos-orientacao-a-objetos/

// Sugestão: https://blog.eximiaweb.com.br/tutorial-php-classes/

