CREATE  PROCEDURE SP_CIUDAD(
                    IN pIdPais INT(11),
                    IN pIdCiudad INT(11),
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

    --TODO: agregar VALIDACION

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

    IF paccion='agregar' THEN
    
    
        SELECT MAX(id) INTO did FROM destino;

        SET did=did+1; 

        INSERT INTO  `destino` (`id`, `pais_id`, `nombre`, `descripcion`, `estado`) VALUES(did, pIdPais, pNombre, pDescripcion, 1);
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Insertó nuevo destino, id; ',did ));


        SET mensaje='Registro exitoso';
        SET codigo=1;
        COMMIT;

    ELSEIF paccion='editar' THEN

        UPDATE destino SET  nombre=pNombre,  descripcion=pDescripcion WHERE id=pIdCiudad;    
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Editó destino  id; ', pIdCiudad ));

        SET mensaje='Edición exitosa';
        SET codigo=1;
        COMMIT;

    ELSEIF paccion='eliminar' THEN
        UPDATE DESTINO  SET estado=0 WHERE id=pIdCiudad;
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Eliminó destino  id; ', pIdCiudad ));

        SET mensaje='Eliminación exitosa';
        SET codigo=1;
        COMMIT;

    ELSE 
        SET mensaje='Ocurrió un error';
        SET codigo=0;
        LEAVE SP;

    END IF;
    

    
END$$