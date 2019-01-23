<?php
/**
 * Created by PhpStorm.
 * User: Mateo
 * Date: 14.1.2019.
 * Time: 16:37
 */

namespace App\Connection;
use mysqli;

include_once ('config.php');

class DBConnection
{
    private $conn = null;
    private static $instance;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function dbConnect(){
        $this->conn = new mysqli(host,username,password, db, port);
        if($this->conn->connect_errno){
            die("Cant connect to database");
        }
        return $this->conn;
    }

    function selectDB($query) {
        $queryResult = $this->conn->query($query);
        if ($this->conn->connect_errno) {
            die("Error in given query: {$query} ") ;
        }
        if (!$queryResult) {
            $queryResult = null;
        }
        return $queryResult;
    }

    public function dbClose(){
        $this->conn->close();
    }


}