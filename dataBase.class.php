<?php
class DataBase extends PDO {
    private string $_DB_HOST = 'localhost';
    private string $_DB_USER = 'root';
    private string $_DB_PASS = 'root';
    private string $_DB_NAME = 'todo';

    public function __construct(){
        if (empty($_ENV["DB_HOST"])) {
            try {
                parent::__construct("mysql:host=" . $this->_DB_HOST . ";dbname=" . $this->_DB_NAME, $this->_DB_USER, $this->_DB_PASS);
            } catch (PDOException $e) {
                echo "Erreur de connection : " . $e->getMessage();
            }
        }
        if (!empty($_ENV["DB_HOST"])) {
            try {
                parent::__construct("mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASS"]);
            } catch (PDOException $e) {
                echo "Erreur de connection : " . $e->getMessage();
            }
        }
    }
}