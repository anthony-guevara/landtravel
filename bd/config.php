<?php
abstract class Config
{

    // base en amazon
    // protected $server = 'landtravel.cnvuznrls2s2.us-east-1.rds.amazonaws.com:3306';
    // protected $dataBase = 'landtravel';
    // protected $user = 'admin';
    // protected $pass = 'landtravel_unah_2020';

    protected $server = 'localhost:3306';
    protected $dataBase = 'landtravel';
    protected $user = 'root';
    protected $pass = '';
    
    protected function getServer()
    {
        return $this->server;
    }
    protected function getDataBase()
    {
        return $this->dataBase;
    }
    protected function getUser()
    {
        return $this->user;
    }
    protected function getPass()
    {
        return $this->pass;
    }
}
