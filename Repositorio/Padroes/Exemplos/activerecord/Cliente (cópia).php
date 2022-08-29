<?php

class Cliente extends ActiveRecord
{
    public static function numTotal()
    {
        return self::count();
    }
}
