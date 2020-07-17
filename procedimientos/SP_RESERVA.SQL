CREATE DEFINER=`root`@`localhost` PROCEDURE `landtravel`.`SP_Reserva`(IN `nusuario` INT(11), IN `ntarjeta` BIGINT(16), IN `ncvv` VARCHAR(45), IN `nfechaexp` VARCHAR(10), IN `nidtour` INT(11), IN `nreserva` FLOAT, OUT `pmensaje` VARCHAR(45), OUT `pcodigo` INT)
SP:BEGIN
DECLARE ultima_factura INT DEFAULT 0;
DECLARE ultima_detalle INT DEFAULT 0;
DECLARE monto float;
     SET autocommit=0; 
     START TRANSACTION;

    
        
     
        	IF nusuario = "" or nusuario is null THEN
				SET pMensaje = "El usuario no existe";
                set pcodigo=0;
                	leave sp;
			END IF;
                    	IF ntarjeta = "" or ntarjeta is null THEN
				SET pMensaje = "La tarjeta no existe";
                     set pcodigo=0;
                	leave sp;
			END IF;
                    	IF ncvv = "" or ncvv is null THEN
				SET pMensaje = "El cvv no existe";
                     set pcodigo=0;
                	leave sp;
			END IF;
                    	IF nfechaexp = "" or nfechaexp is null THEN
				SET pMensaje = "La fecha de expiracion no existe";
                     set pcodigo=0;
                	leave sp;
			END IF;
					IF nidtour = "" or nidtour is null THEN
				SET pMensaje = "El paquete no existe";
                     set pcodigo=0;
                	leave sp;
			END IF;
            

		

 
 	/*Haces un insert a la tabla rutas*/
	       select max(idfactura)+1 into ultima_factura from factura;
			select max(idfactura)+1 into ultima_detalle from factura;
           if(ultima_factura is null || ultima_detalle is null)then
				set ultima_factura=1;
                set ultima_detalle=1;
			end if;
            
            select costo into monto from tour where id=nidtour;
			
            INSERT INTO factura(idfactura,tipo_pago,usuario_id,tipotarjeta,NumeroTarjeta,CVV,fechaexp) VALUES (ultima_factura,0,nusuario,"Variable",ntarjeta,ncvv,nfechaexp);
            INSERT INTO detalle_factura(iddetalle_factura,cantidad,monto,factura_idfactura,tour_id,prima) VALUES (ultima_detalle,1,monto,ultima_factura,nidtour,nreserva);
	

    set pMensaje="Si crea factura";
    set pcodigo=1;
commit;
END