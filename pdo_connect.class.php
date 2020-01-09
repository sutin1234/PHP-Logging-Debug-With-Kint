<?php
ini_set('display_errors', FALSE);
require_once 'Logger.class.php';

class PDO_CONNECTION {

    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $db_name = 'users';

    public $conn;
    public $statement;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->user, $this->pwd);
        }catch(Throwable $e){
            Logging::Log($e->getMessage(), false);
        }
        
    }

    public  function getConnection()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function executeQuery(string $sql)
    {
        try{
            $this->statement = $this->conn->prepare($sql);
            $this->statement->execute();
        }catch (Exception $exception){
            Logging::Log($exception);
        }

    }

    public function fetchResults()
    {
        $results = [];
        while ($row = $this->statement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }

    public function fetchResult()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }
}
