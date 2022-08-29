<?php

class Request
{
    protected $request;

    public function __construct()
    {
        $this->request = $_REQUEST;
    }

    public function __get($nome)
    {
        if (isset($this->request[$nome])) {
            return $this->request[$nome];
        }
        return false;
    }
}