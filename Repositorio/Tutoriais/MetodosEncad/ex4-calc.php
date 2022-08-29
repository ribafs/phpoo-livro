<?php

class Calculator
{
  protected $result = 0;

  public function sum($num)
  {
    $this->result += $num;
    return $this;
  }

  public function sub($num)
  {
    $this->result -= $num;
    return $this;
  }

  public function result()
  {
    return $this->result;
  }
}

$calculator = new Calculator;
echo '10 -5 +3 = '.$calculator->sum(10)->sub(5)->sum(3)->result(); // 8
