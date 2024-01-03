<?php

class Database{

    private $host = 'localhost';
    private $user = 'root' ;
    private $password = '';
    private $db = 'framework';
    private $porta = '3306' ;
    private $dbh ;    

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this -> host . ';port=' . $this -> porta . ';dbname=' . $this -> db;
        $opcoes = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this -> dbh = new PDO($dsn, $this-> user, $this-> password, $opcoes);
        } catch (PDOException $e) {
            print "Error!: " . $e -> getMessage() . "<br/>";
            die();
        }
    }

}
