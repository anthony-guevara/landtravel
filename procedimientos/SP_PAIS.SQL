CREATE  PROCEDURE SP_PAIS(
                    IN pNombre VARCHAR(11),
                    IN pGentilicio VARCHAR(45),
                    IN pIdPais INT(11),
                    IN pusuarioId INT(11),
                    IN paccion VARCHAR(15),
                    IN pCodigo VARCHAR(45),
                    OUT mensaje VARCHAR(100),
                    OUT codigo INT) 
SP:BEGIN

    DECLARE did INT;

    DECLARE tempMensaje VARCHAR(100);

    SET autocommit=0;  

    SET tempMensaje='';

    START TRANSACTION;  


    IF pGentilicio='' THEN
        SET tempMensaje='pGentilicio ,';
    END IF;
    IF pNombre=''  THEN
        SET tempMensaje='nombre ,';
    END IF;
    IF pCodigo='' THEN
        SET tempMensaje='pCodigo ,';
    END IF;
    
    
    IF tempMensaje<>'' THEN
        SET mensaje=CONCAT('Campos requeridos ',tempMensaje);
        SET codigo = 0;
        LEAVE SP;
    END IF;
    
    
    IF paccion="agregar" then
        SELECT max(id) INTO did FROM pais;

        SET did=did+1; 

        INSERT INTO pais (id, nombre, gentilicio, codigo, estado) VALUES(did, pNombre, pGentilicio, pCodigo, 1);
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Insertó nuevo pais, id; ',did ));


        SET mensaje='Registro exitoso';
        SET codigo=1;
    

        COMMIT;
    
    ELSEIF paccion='editar' THEN
        
        UPDATE pais SET nombre=pNombre, gentilicio=pGentilicio, codigo=pCodigo WHERE id= pIdPais;    
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Editó Pais  id; ',pIdPais ));

        SET mensaje='Edición exitosa';
        SET codigo=1;
        COMMIT;
        
    ELSEIF paccion='eliminar' THEN

        UPDATE pais  SET estado=0 WHERE id = pIdPais;
        INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), pusuarioId, CONCAT('Eliminó pais  id; ', pIdPais ));

        SET mensaje='Eliminación exitosa';
        SET codigo=1;
        COMMIT;
        
    ELSE 
        SET mensaje='Ocurrió un error';
        SET codigo=0;
        LEAVE SP;

    END IF;
        
END$$