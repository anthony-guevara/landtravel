CREATE  PROCEDURE SP_LUGAR(
                    IN pIdCiudad INT,
                    IN pIdLugar INT,
                    IN pNombre VARCHAR(45),
                    IN pDescripcion VARCHAR(45),
                    IN pusuarioId INT(11),
                    IN paccion VARCHAR(15),
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
    IF pIdLugar=0 THEN
        SET tempMensaje='pIdLugar ,';
    END IF;
    IF pusuarioId=0 THEN
        SET tempMensaje='pusuarioId ,';
    END IF;
    IF pNombre=''  THEN
        SET tempMensaje='nombre ,';
    END IF;
    IF pDescripcion='' THEN
        SET tempMensaje='descripcion ,';
    END IF;
    IF paccion=''  THEN
        SET tempMensaje='paccion ,';
    END IF;
    
    
    IF tempMensaje<>'' THEN
        SET mensaje=CONCAT('Campos requeridos ',tempMensaje);
        SET codigo = 0;
        LEAVE SP;
    END IF;


    IF paccion='agregar' THEN
    
    
        SELECT MAX(id) INTO did FROM lugar;

        SET did=did+1; 

        INSERT INTO `lugar`(`id`, `nombre`, `descripcion`, `destino_id`, `estado`) VALUES(did, pNombre, pDescripcion, pIdCiudad, 1);
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(),  pusuarioId, CONCAT('Agregó nuevo lugar, id: ', did));

        SET mensaje='Registro exitoso';
        SET codigo=1;
        COMMIT;

    ELSEIF paccion='editar' THEN  
        UPDATE landtravel.lugar SET  nombre=pNombre,  descripcion=pDescripcion WHERE id=pIdLugar;
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(),  pusuarioId, CONCAT('Editó lugar, id: ', pIdLugar));

        SET mensaje='Edición exitosa';
        SET codigo=1;
        COMMIT;

    ELSEIF paccion='eliminar' THEN  
        UPDATE lugar  SET estado=0 WHERE id=pIdLugar;
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(),  pusuarioId, CONCAT('Eliminó lugar, id: ', pIdLugar));

        SET mensaje='Eliminación exitosa';
        SET codigo=1;
        COMMIT;

    ELSE 
        SET mensaje='Ocurrió un error';
        SET codigo=0;

        LEAVE SP;        


    END IF;
END$$