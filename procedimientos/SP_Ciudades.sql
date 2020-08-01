CREATE  PROCEDURE SP_CIUDAD(
                    IN pIdPais INT(11),
                    IN pNombre VARCHAR(45),
                    IN pDescripcion VARCHAR(45),
                    OUT mensaje VARCHAR(100),
                    OUT codigo INT) 
SP:BEGIN

    DECLARE did INT;

    DECLARE tempMensaje VARCHAR(100);

    SET autocommit=0;  

    SET tempMensaje='';

    START TRANSACTION;  


    IF pIdPais=0 THEN
        SET tempMensaje='ID ,';
    END IF;
    IF pNombre=''  THEN
        SET tempMensaje='nombre ,';
    END IF;
    IF pDescripcion='' THEN
        SET tempMensaje='descripcion ,';
    END IF;
    
    
    IF tempMensaje<>'' THEN
        SET mensaje=CONCAT('Campos requeridos ',tempMensaje);
        SET codigo = 0;
        LEAVE SP;
    END IF;
    
    
    SELECT MAX(id) INTO did FROM destino;

    SET did=did+1; 

    INSERT INTO  `destino` (`id`, `pais_id`, `nombre`, `descripcion`, `estado`) VALUES(did, pIdPais, pNombre, pDescripcion, 1);


    SET mensaje='Registro exitoso';
    SET codigo=1;
    

    COMMIT;
END$$