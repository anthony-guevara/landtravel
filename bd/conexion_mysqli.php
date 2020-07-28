<?php


class ConnexionMysqli extends Config
{
    public function __construct()
    {
    }

    public function connect()
    {
        return new mysqli(
            parent::getServer(),
            parent::getUser(),
            parent::getPass(),
            parent::getDataBase()
        );
    }
}
