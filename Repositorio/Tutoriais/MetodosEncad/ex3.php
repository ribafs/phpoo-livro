<?php

class Maker 
{
    private static $result      = null;
    private static $delimiter   = '.';
    private static $data        = [];

    public static function words($words)
    {
        if( !empty($words) && count($words) )
        {
            foreach ($words as $w)
            {
                self::$data[] = $w;
            }
        }        
        return new static;
    }

    public static function concate($delimiter)
    {
        self::$delimiter = $delimiter;
        foreach (self::$data as $d)
        {
            self::$result .= $d.$delimiter;
        }
        return new static;
    }

    public static function get()
    {
        return rtrim(self::$result, self::$delimiter);
    }    
}

echo Maker::words(['foo', 'bob', 'bar'])->concate('>')->get();

