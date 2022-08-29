<?php
/**
 * Created on 05/10/2009
 * @author Rogério Oliveira     -   rogeriobav@gmail.com.
 * @todo classe desenvolvida para a
 * instrução de muitos no uso de OO com PHP.
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 */
 
class form{
 
    function form()
    {
 
    }
 
/**
 * @author Rogério Oliveira     -   rogeriobav@gmail.com.
 * @param: $nome                -   nome do campo.
 * @param: $valores     string  -   valor digitado ou valor encontrado através da busca.
 */
 
    function inputText($nome, $valor)
    {
        return "<input type='text' id='$nome' name='$nome' value='$valor' />";
    }
 
/**
 * @author Rogério Oliveira     -   rogeriobav@gmail.com.
 * @param: $nome                -   nome do campo.
 * @param: $valores             -   array de valores; esse por sua vez deve ser unidimensional.
 * @param: $selecionado         -   opção que retorna o valor atual gravado no banco.
 */
 
    function inputSelect($nome, $valores, $selecionado = null)
    {
 
        foreach ($valores as $key => $valor) {
            if ($key == $selecionado) {
                $select .="<option value='$key' selected='selected' >".$valor."</option>";
            } else {
                $select .="<option value='$key' >".$valor."</option>";
            }
        }
 
        $select = " <select id='$nome' name='$nome'>$select</select>";
 
        return  $select;
 
    }
 
/**
 * @author Rogério Oliveira     -   rogeriobav@gmail.com.
 * @param: $name                -   nome do campo.
 * @param: $values              -   array de valores; esse por sua vez deve ser unidimensional.
 * @param: $check               -   opção que retorna o valor atual gravado no banco.
 * @param: $separation          -   Aqui podemos utlizar o '<br />' caso necessite de quebra de linha.
 */
    function inputRadio($name, $values, $check, $separation = null)
    {
 
        foreach ($values as $key => $valor) {
            if ($key == $check) {
                $radio .="<label><input type='radio' name='$name' value='$key' checked />$valor</label>$separation";
            } else {
                $radio .="<label><input type='radio' name='$name' value='$key' />$valor</label>$separation";
            }
        }
 
        return $radio;
    }
 
}
?>
