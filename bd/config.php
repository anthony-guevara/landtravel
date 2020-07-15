<?php
abstract class Config {
    protected $server = 'localhost:3306';
    protected $dataBase = 'landtravel';
    protected $user = 'root';
    protected $pass = '';
    
    protected function getServer() {
        return $this->server;
    }
    protected function getDataBase() {
        return $this->dataBase;
    }
    protected function getUser() {
        return $this->user;
    }
    protected function getPass() {
        return $this->pass;
    }
}
?>