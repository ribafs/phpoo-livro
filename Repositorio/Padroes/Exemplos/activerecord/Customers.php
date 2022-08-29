<?php

class Customers extends ActiveRecord
{

    public static function numTotal()
    {
        return self::count();
    }
}
