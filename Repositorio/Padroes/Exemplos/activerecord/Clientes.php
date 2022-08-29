<?php

class Clientes extends ActiveRecord
{
    public static function numTotal()
    {
        return self::count();
    }
}
