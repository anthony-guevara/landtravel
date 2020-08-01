CREATE  PROCEDURE SP_LUGAR(
                    IN pIdCiudad INT,
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


    IF pIdCiudad=0 THEN
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
    
    
    SELECT MAX(id) INTO did FROM lugar;

    SET did=did+1; 

    INSERT INTO `lugar`(`id`, `nombre`, `descripcion`, `destino_id`, `estado`) VALUES(did, pNombre, pDescripcion, pIdCiudad, 1);

    SET mensaje='Registro exitoso';
    SET codigo=1;
    

    COMMIT;
END$$