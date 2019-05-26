<?php
    /*PDO DB class
    * connect to Database
     * create prepared statements
     * bind values
     * return rows and results
     */
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            //set dsn
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //create PDO instance
            try {

            } catch(PDOException $e) {
                $this->error =$e->getMessage();
                echo $this->error;

            }
        }
    }