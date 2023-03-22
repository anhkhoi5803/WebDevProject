<?php


define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','kidsGames');
//define('DBNAME','kidsGames2'); // testing creating another database name

//require_once "functions.php";

class ManipulateDB
{
   
    //Declare the properties
    public $firstname, $lastname, $username, $registrationOrder,$newPassword, $password, $login_err;
    private $connection; 
    private $sqlExec, $lastErrMsg;

    //Declare the method constructor
    public function __construct(){

    }

    public function getSqlExec() {
        return $this->sqlExec;
    }

    //Declare the method to save the messages
    protected function messages(){
        //Error messages 
        $m['dbms'] = "<p>Connection to MySQL failed!<br/>$this->lastErrMsg</p>";
        $m['db'] = "<p>Connection to the DB failed!<br/>$this->lastErrMsg</p>";
        $m['creatDb'] = "<p>Creation of the DB failed!<br/>$this->lastErrMsg</p>";
        $m['creatTab'] = "<p>Creation of the Table failed!<br/>$this->lastErrMsg</p>";
        $m['insertTab'] = "<p>Data insertion to the Table failed!<br/>$this->lastErrMsg</p>";
        $m['selectTab'] = "<p>Data selection from the Table failed!<br/>$this->lastErrMsg</p>";
        $m['desTab'] = "<p>Table structure description failed!<br/>$this->lastErrMsg</p>";
        //Try again messages
        $b['tryAgain'] = "<a href=\"index.php\"><input type=\"submit\" value=\"Try again!\"></a>";
        //Group messages by category 
        $msg['error'] = $m;
        $msg['link'] = $b;
        return $msg;
    }

    //Declare the method to save the SQL Code to be executed
    //protected function sqlCode(){
    protected function sqlCode(){

        $sqlCode['checkPlayerExist'] = "SELECT id, userName, passCode FROM player JOIN authenticator ON player.registrationOrder = authenticator.registrationOrder WHERE username = '$this->username';"; 
        //$sqlCode['checkPlayerExist'] = "SELECT id, userName, passCode FROM player JOIN authenticator ON player.registrationOrder = authenticator.registrationOrder WHERE username = 'tss12345';"; 

        $sqlCode['register']="INSERT INTO player(fName, lName, userName, registrationTime) 
        VALUES($this->firstname, $this->lastname, $this->username, date());";

        $sqlCode['insertPassword']="INSERT INTO authenticator(passCode,registrationOrder)
        VALUES($this->newPassword, $this->registrationOrder);";

        $sqlCode['changePassword']="UPDATE authenticator SET passCode = $this->newPassword where registrationOrder= $this->registrationOrder";
            
        $sqlCode['checkPasswordExists']="SELECT passCode FROM authenticator where registrationOrder= $this->registrationOrder";
        
        //Return an array of queries
        return $sqlCode;

    }

    //Declare the method to connect to the DBMS
    protected function connectToDBMS()
    {
        //Attempt to connect to MySQL using MySQLi
        $con = new mysqli(HOST, USER, PASS);
        //If connection to the MySQL failed save the system error message 
        if ($con->connect_error) {
            $this->lastErrMsg = mysqli_connect_error();
            return FALSE;
        } else {
            $this->connection = $con;
            return TRUE;
        }
    }

    //Declare the method to connect to the DB
    protected function connectToDB()
    {
        //If connection to the Database failed save the system error message 
        if (mysqli_select_db($this->connection, DBNAME) === FALSE) {
            $this->lastErrMsg = $this->connection->error;
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Declare the method to execute the SQL Code 
    //protected function executeSql($code)
    protected function executeSql($code)
    {
        //Execute the query
        $invokeQuery = $this->connection->query($code);
        //If data insertion to the table failed save the system error message  
        if ($invokeQuery === FALSE) {
            $this->lastErrMsg = $this->connection->error;
            return FALSE;
        } else
            $this->sqlExec = $invokeQuery;
        return TRUE;
    }
    
    protected function executeSqlMultiQuery($code)
    {
        //Execute the query
        $invokeQuery = $this->connection->multi_query($code);
        //If data insertion to the table failed save the system error message  
        if ($invokeQuery === FALSE) {
            $this->lastErrMsg = $this->connection->error;
            return FALSE;
        } else
            $this->sqlExec = $invokeQuery;
        return TRUE;
    }


    //Declare the method to disconnect from the DBMS
    public function __destruct()
    {
        //Close automatically the connection from MySQL when it is opened at the end          
        if ($this->connection == TRUE) {
            $this->connection->close();
        }
    }

    

   

}