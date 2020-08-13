CREATE  PROCEDURE SP_PAIS(
                    IN pNombre INT(11),
                    IN pGentilicio VARCHAR(45),
                    IN pCodigo VARCHAR(45),
                    OUT mensaje VARCHAR(100),
                    OUT codigo INT) 
SP:BEGIN

    DECLARE did INT;

    DECLARE tempMensaje VARCHAR(100);

    SET autocommit=0;  

    SET tempMensaje='';

    START TRANSACTION;  


    IF pGentilicio="" THEN
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
    
    
    
    SELECT max(id) INTO did FROM pais;

    SET did=did+1; 

    INSERT INTO pais (id, nombre, gentilicio, codigo, estado) VALUES(did, pNombre, pGentilicio, pCodigo, 1);


    SET mensaje='Registro exitoso';
    SET codigo=1;
    

    COMMIT;
END$$