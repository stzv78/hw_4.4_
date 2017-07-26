<?php
class DataBase
{
	private static $db = NULL;
	private $connection;
    public $dbname; 
    
	
	public static function getDb()
	{
		if (self :: $db == NULL)
		{
			self :: $db = new DataBase();
		}
		return self :: $db;
	}

	public function __construct()
	{
		try {
			    $config = require_once 'config.php';
                $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbName'].';charset='.$config['charset'];
           	    $this->connection = new PDO($dsn, $config['userName'], $config['userPassword']);
                $this->dbname = $config['dbName'];
		} catch (PDOException $e) {
	        //нет соединения c БД
	        echo "Database connection failed!";
            exit;
	    }
    }

   //ищет id пользователя по логину-паролю в БД
    public function selectUser($login, $password)
    { 
        $sql = "SELECT login, password, id FROM `user` WHERE login LIKE :login";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":login", $login, PDO::PARAM_INT);
        $st->execute();             
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function insertUser($log, $pass)
    {   
        $sql = "INSERT INTO `user` (`login`,`password`) VALUES (:login, :password)";
        $st = $this->connection->prepare($sql);
        $st->bindValue( ":login", $log, PDO::PARAM_INT);
        $st->bindValue( ":password", $pass, PDO::PARAM_INT);
        $st->execute();
    }

    public function createTable($name)
    {   
        $sql = "CREATE TABLE IF NOT EXISTS " . $name . " (
                            `id` int(9) NOT NULL AUTO_INCREMENT,
                            `column1` text NOT NULL,
                            `column2` text NOT NULL,
                            `column3` text NOT NULL,
                            PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $st = $this->connection->prepare($sql);
        $st->execute();
    }

    public function deleteTable($name)
    {   
        $sql = "DROP TABLE" . $name; 
        $st = $this->connection->prepare($sql);
        $st->execute();
    }
    

    public function infoTable($name)
    {
        if (!empty($name)) {
            $sql = "DESCRIBE " . $name;
            $st = $this->connection->prepare($sql);
            $st->execute();
            return $st->fetchALL(PDO::FETCH_ASSOC);
        } 
    }

    public function showTables()
    {   
        $result = array();
        $sql = "SHOW TABLES FROM `" . $this->dbname . "`";
        $st = $this->connection->query($sql);
        $key = "Tables_in_" . $this->dbname;
        while ($r = $st->fetch(PDO::FETCH_ASSOC)) {
            $result[] =  $r[$key];
        }
        return $result;
    }

    public function dropColumn($name, $field)
    {   
        $sql = "ALTER TABLE " . $name . " DROP COLUMN " . $field;
        $st = $this->connection->query($sql);
    }

    public function editColumnType($name, $field, $type)
    {   
        $sql = "ALTER TABLE " . $name . " MODIFY " . $field . " " . $type;
        $st = $this->connection->query($sql);
    }

    public function renameColumn($name, $field, $newField, $type)
    {   
        $sql = "ALTER TABLE " . $name . " CHANGE " . $field . " " . $newField . " " . $type;
        $st = $this->connection->query($sql);
    }

}
