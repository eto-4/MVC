<?php

class Database 
{
    private PDO $pdo;
    private string $host;
    private string  $dbName;
    private string $user;
    private string $pass;

    public function __construct($host, $dbName, $user, $pass) 
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->pass = $pass;
        
        // Verificacions
        $this->connect();
        $this->checkDatabase();
        $this->checkTables();
    }

    // Connexió a la bd
    private function connect():void 
    {
        $this->pdo = new PDO("mysql:host={$this->host}", $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>