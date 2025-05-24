<?php

class model
{
    public $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try
        {
            $this->connection = new mysqli('localhost', 'root', '', 'mvc');
        }
        catch (Exception $e)
        {
            echo ($e->getMessage());
        }
    }
}
