CREATE DEFINER=`root`@`localhost` PROCEDURE `landtravel`.`SP_rutas`(IN `nidguia` INT(11), IN `nidviaje` INT(11), 
IN `nidmetodo` INT(11), IN `nidpaquete` INT(11), IN `nidtour` INT(11), IN `nidinicio` INT(11), IN `niddestino` INT(11), 
IN `nfechallegada` VARCHAR(11), IN `nfechasalida` VARCHAR(11), IN `nidlugar` INT(11), IN `ncosto` FLOAT, OUT `pMensaje` VARCHAR(45), 
OUT `montoPagar` FLOAT, OUT `fechaultima` VARCHAR(11), OUT `ultimoid` INT)
SP:BEGIN
	DECLARE nidruta,existepaquete, costotours,existelugarturistico,costotrasnporte,costohotel,existeguia ,subtotal INT;
    
    DECLARE error VARCHAR(45);
     SET autocommit=0; 
	SET existepaquete = 0;
	SET existelugarturistico = 0;
	SET existeguia = 0;
	SET costotrasnporte= 0;
    SET costohotel=0;
      SET costotours=0;
      set subtotal=0;
    SET error='Error';
     START TRANSACTION;

    
		SELECT COUNT(*) INTO existepaquete FROM paquete WHERE id = nidpaquete;
		
		SELECT COUNT(*) INTO existelugarturistico FROM lugar WHERE id = nidlugar;
           select count(*) into existeguia from persona per   
           inner join usuario usu on usu.id=per.usuario_id
           inner join guia gui on gui.persona_id=per.id
           where tipo_usuario='Guia' and  gui.id=nidguia;
        
        
     
        	IF existepaquete = 0 THEN
				SET pMensaje = CONCAT(error, ' ', 'El paquete no existe');
                	leave sp;
			END IF;
            IF existelugarturistico = 0 THEN
				SET pMensaje = CONCAT(error, ' ', 'El lugar turistico no existe');
                	leave sp;
			END IF;
            IF existeguia = 0 THEN
				SET pMensaje = CONCAT(error, ' ', 'El guia no existe');
                	leave sp;
			END IF;
            

		

 
 	/*Haces un insert a la tabla rutas*/
	       select max(id)+1 into nidruta from ruta;
           if(nidruta is null)then
				set nidruta=1;
				select fecha_inicio into nfechallegada from tour
                where id=nidtour;
			else
				select rut.fecha_salida into nfechallegada from tour tou 
				inner join ruta rut on rut.tour_id=tou.id
                where rut.id=(select max(id) from ruta);
                                
				select max(id)+1 into nidruta  from ruta ;
                
		   end if;
            INSERT INTO ruta(id,viaje_id,metodo_id,paquete_id,tour_id,inicio,destino,fecha_llegada,fecha_salida,idlugar,idguia,costo) VALUES (nidruta,nidviaje,nidmetodo,nidpaquete,nidtour,nidinicio,niddestino,nfechallegada,nfechasalida,nidlugar,nidguia,ncosto);
	


	/*ahora sacar el monto total*/
if (select costo from tour where id=nidtour) is null then
UPDATE tour
SET costo=ncosto
WHERE id=nidtour;
Else
UPDATE tour
SET costo=(select costo from (select * from tour) tab where id=nidtour)+ncosto
WHERE id=nidtour;
end if;

	SELECT costo INTO costotours FROM tour WHERE id = nidtour;
    
SELECT costo INTO costotrasnporte FROM metodo WHERE id = nidmetodo;

SELECT costo INTO costohotel FROM viaje WHERE id = nidviaje;
    
   set subtotal=(costohotel+costotrasnporte+costotours);
   set  montoPagar=(subtotal*1.5);
   
   set montoPagar=(select costo from tour where id=nidtour);
   
   Update tour
   set fecha_salida=nfechasalida
	WHERE id=nidtour;
    
	set fechaultima=nfechasalida;
    set pMensaje="Si";
     set ultimoid=nidruta;
commit;
END