<?php 


class ConnexionMysqli extends Config {

    function ConnexionMysqli() {
        
    }


    function connect() {
        return new mysqli(
            parent::getServer(), parent::getUser(), parent::getPass(), parent::getDataBase()
        );
    }
}


?>