<?php

namespace Mini\Libs;

class Helper
{
    /**
     * debugPDO
     *
     * Mostra a consulta SQL emulada em uma instrução PDO. O que isso faz é extremamente simples, mas poderoso:
     * Combina a consulta bruta e os espaços reservados. Com certeza não é realmente perfeito (como PDO é mais complexo do que apenas
     * Combinando consulta e argumentos brutos), mas faz o trabalho.
     *
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // checar se os parâmetros nomeados (':param') ou anonymous parameters ('?') são usados
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // traga o parâmetro para o formato legível por humanos
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        echo "<br> [DEBUG] Keys:<pre>";
        print_r($keys);

        echo "\n[DEBUG] Values: ";
        print_r($values);
        echo "</pre>";
        */

        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

}
