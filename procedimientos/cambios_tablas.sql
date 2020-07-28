
--tabla pais
alter table pais add column estado int;
update  pais set estado=1;

--tabla destino
alter table destino add column estado int;
update  destino set estado=1;