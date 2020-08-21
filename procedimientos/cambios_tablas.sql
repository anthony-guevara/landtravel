
--tabla pais
alter table pais add column estado int;
update  pais set estado=1;

--tabla destino
alter table destino add column estado int;
update  destino set estado=1;



--tabla lugar
alter table lugar add column estado int;
update  lugar set estado=1;

--tabla de logs
--id, fecha datetime, usuario_id int, transaccion varchar, valor_antiguo varchar, valor_nuevo varchar   

CREATE TABLE log(
    id INT NOT NULL AUTO_INCREMENT,
    fecha DATETIME NOT NULL,
    usuario_id INT( 11 ) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    PRIMARY KEY ( id ),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) 
)