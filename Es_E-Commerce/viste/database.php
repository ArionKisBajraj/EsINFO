<?php

class Database
{

    private $host, $port, $username, $password;

    public function __construct($host, $port, $username, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect($dbname)
    {

        $dsn = "mysql:host=$this->host;dbname=$dbname;";

        return new PDO($dsn, $this->username, $this->password);

    }
}
