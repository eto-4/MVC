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
    private function connect(): void 
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host}", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            throw new RuntimeException(
                'No t\'he pogut connectar a la base de dades, poder el següent missatge té alguna cosa interesant per poder-ho resoldre: ',
                0,
                $e
            );
        }
    }

    // Comprovació i creació de DB
    private function checkDatabase(): void
    {
        try 
        {
            $dataBaseSQL = file_get_contents(__DIR__ . '/dbBasicFiles/create_database.sql');
            $this->pdo->exec($dataBaseSQL);
            $this->pdo->exec("USE `{$this->dbName}`");
        } 
        catch (PDOException $e) 
        {
            throw new RuntimeException(
                'No s\'ha pogut crear la base de dades correctament... Dona-li un cop d\'ull a aquest error que m\'han passat poder en treus alguna cosa: ',
                0,
                $e
            );
        }
    }

    // Comprovació i creació de taules
    private function checkTables(): void
    {
        try {
            $tableSQL = file_get_contents(__DIR__ . '/dbBasicFiles/create_tables.sql');
            $this->pdo->exec($tableSQL);
        }
        catch (PDOException $e) 
        {
            throw new RuntimeException(
                'No s\'ha pogut crear la taula correctament... Poder en podem extreure alguna cosa del missatge que acabo de rebre: ',
                0,
                $e
            );
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
?>