<?php

class Connection extends Config {
    private $link;
    private $consulta;
    function Connection() {
        
    }

    public function connect() {
        $this->link = mysql_connect(parent::getServer(), parent::getUser(), parent::getPass());
        if (!$this->link) {
            die('No pudo conectarse: ' . mysql_error());
        }
        if (!mysql_select_db(parent::getDataBase(), $this->link)) {
            die('No pudo seleccionar la base de datos: ' . mysql_error());
        }
    }

    public function getNombreBDD() {
        return parent::getDataBase();
    }

    public function setConsulta($consulta) {
        // echo $consulta;
        $this->consulta = $consulta;
    }

    public function close() {
        mysql_close($this->link);
    }

    public function getResultConsulta() {

        $result = mysql_query($this->consulta);
        
    }

    public function getRegistros($result) {
        return mysql_fetch_assoc($result);
    }

    public function getRegistros_array($result) {
        return mysql_fetch_array($result);
    }

    public function getCantidadRegistros($result) {
        return mysql_num_rows($result);
    }

    public function getParametroSP($parametros) {
       $rs_sp=  mysql_query("select ".$parametros.";");
       $row= mysql_fetch_assoc($rs_sp);
       return $row;
    }

    public function lastInsertId() {
        $sql = "SELECT last_insert_id()";
        $this->setConsulta($sql);
        $qry = $this->getResultConsulta();
        $ultimoCodigo = mysql_fetch_row($qry);
        return $ultimoCodigo[0];
    }

}

?>