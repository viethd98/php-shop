<?php


class DatabaseClass
{
   
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    public $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // Start Connection
        $connection = mysqli_connect($host, $username, $password, $database);
        if ( ! $connection ) {
            die ("Connection Failed. ". mysqli_connect_error());
        }

        $this->connection = $connection;
    }

    
    public function query($string, $returnMysqlObject = false)
    {
        $result = false;
        $query = $this->connection->query($string);

        if (strpos(strtoupper($string), 'SELECT') !== false) {

            $result = [];

            if ($query == true && $query->num_rows > 0) {
                $rows = [];
                while ($row = $query->fetch_assoc()) {
                    $rows[] = $row;
                }
                $result = $rows;
            }

        } else {

            if ($this->connection->error) {
                $result = $this->connection->error;
            } else if($returnMysqlObject) {
                $result = $this->connection;
            } else {
                $result = $query;
            }

        }

        return $result;
    }

}

?>