<?php

class fakeString
{
// O retorno do $this é o responsável pelo encadeamento dos métodos
    private $str;
    function __construct()
    {
        $this->str = "";
    }
    
    function addA()
    {
        $this->str .= "a";
        return $this;
    }
    
    function addB()
    {
        $this->str .= "b";
        return $this;
    }
    
    function getStr()
    {
        return $this->str;
    }
}

$a = new fakeString();
echo $a->addA()->addB()->getStr();
