<?php
class DataBase extends PDO {
    private string $_DB_HOST = 'localhost';
    private string $_DB_USER = 'root';
    private string $_DB_PASS = 'root';
    private string $_DB_NAME = 'todo';

    public function __construct(){
        try {
            parent::__construct("mysql:host=" . $this->_DB_HOST . ";dbname=" . $this->_DB_NAME, $this->_DB_USER, $this->_DB_PASS);
        } catch (PDOException $e) {
            echo "Erreur de connection : ".$e->getMessage();
        }
    }
}