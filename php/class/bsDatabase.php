<?php

include("config/dbconfig.php");

class bsDatabase {

    public $connection;
    private $dbHost, $dbUser, $dbPass, $dbName;

    public function __construct()
    {
        $getConfig = new dbconfig();

        $this->dbHost = $getConfig->databaseHost;
        $this->dbUser = $getConfig->databaseUsername;
        $this->dbPass = $getConfig->databasePassword;
        $this->dbName = $getConfig->databaseDatabase;

        try
        {
            $this->connection = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            $this->errors = "Cannot connect: " . $e->getMessage();
            return false;
        }
        return true;
    }

    function getUserIdFromToken($token)
    {
        $prepare = ["token" => $token];
        $query = "
        SELECT userid
        FROM `token`
        WHERE token = :token
        LIMIT 1";

        $execute = $this->doQuery($query, $prepare);

        $result = $execute->fetch(PDO::FETCH_OBJ);

        return $result->userid;
    }

    function doQuery($query, $prepare)
    {
        $prepareQuery = $this->connection->prepare($query);

        try
        {
            $prepareQuery->execute($prepare);
        }
        catch (PDOException $e)
        {
            $this->errors = $e;
            return false;
        }

        return $prepareQuery;
    }

    public function generateToken($username, $password)
    {
        $hash = hash("sha256", $password);

        $prepare = ["username" => $username, "hash" => $hash];
        $query = "
        SELECT username, hash
        FROM `users`
        WHERE username = :username
        AND hash = :hash";
    }
} 