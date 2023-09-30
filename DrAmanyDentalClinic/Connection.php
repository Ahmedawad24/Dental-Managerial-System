<?php
    class Database{
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $name = "dramanydentalclinic";
        private $DbConnection;
        private static $instance;
        private static $Counter;

        public function __construct(){
            $this->DbConnection = mysqli_connect($this->host, $this->username, $this->password, $this->name);
            self::$Counter++;
            //echo self::$Counter;
        }
        public static function getInstance(){
            if(self::$instance == null){
                //echo "Return new instance";
                self::$instance = new Database();
            }
            else
            {
                //echo "Object is their";
            }
            return self::$instance;
        }
        public static function GetConnection()
        {
            $Temp = mysqli_connect("localhost", "root", "", "dramanydentalclinic");
            return $Temp;
        }
    }
    
    $con = mysqli_connect("localhost", "root", "");
    if(!$con)
    {
        die('Could not connect: '.mysqli_error($con));
    }
    mysqli_select_db($con, "dramanydentalclinic");
?>