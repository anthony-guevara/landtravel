
--tabla pais
alter table pais add column estado int;
update  pais set estado=1;

--tabla destino
alter table destino add column estado int;
update  destino set estado=1;



--tabla lugar
alter table lugar add column estado int;
update  lugar set estado=1;