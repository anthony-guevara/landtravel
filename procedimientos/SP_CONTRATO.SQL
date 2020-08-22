CREATE  PROCEDURE SP_CONTRATO(
                    IN pid INT(11),
                    IN pusuarioId INT(11),
                    IN pdireccion VARCHAR(45),
                    IN ptelefono VARCHAR(45),
                    IN paccion VARCHAR(15),
                    OUT mensaje VARCHAR(100),
                    OUT codigo INT) 
SP:BEGIN

    DECLARE did INT;

    DECLARE tempMensaje VARCHAR(100);

    SET autocommit=0;  

    SET tempMensaje='';

    START TRANSACTION;  


    IF pid=0 THEN
        SET tempMensaje='pid ,';
    END IF;
    IF pusuarioId=0 THEN
        SET tempMensaje='pusuarioId ,';
    END IF;
    IF pdireccion="" THEN
        SET tempMensaje='direccion ,';
    END IF;
    IF ptelefono=''  THEN
        SET tempMensaje='ptelefono ,';
    END IF;
    IF paccion='' THEN
        SET tempMensaje='paccion ,';
    END IF;
    
    
    IF tempMensaje<>'' THEN
        SET mensaje=CONCAT('Campos requeridos ',tempMensaje);
        SET codigo = 0;
        LEAVE SP;
    END IF;


    
    IF paccion="editar" THEN
        UPDATE persona SET telefono=ptelefono, direccion=pdireccion  WHERE usuario_id=pid;

        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(),pusuarioId , CONCAT('Actualizó datos usuario: ', pid, '. '));

        SET mensaje='Se editó correctamente';
        SET codigo=1;
        COMMIT;
    
    ELSEIF paccion="eliminar" THEN
        UPDATE usuario SET habilitado=0 WHERE id=pid;

        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Eliminó usuario: ', pid));

        SET mensaje='Se eliminó correctamente';
        SET codigo=1;
        COMMIT;

    ELSE 
        SET mensaje='Ocurrió un error';
        SET codigo=0;
        LEAVE SP;
    END IF;
    

END$$