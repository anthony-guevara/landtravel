CREATE DEFINER=`root`@`localhost` PROCEDURE `landtravel`.`SP_Tours`(IN `pcnombre` VARCHAR(45), IN `pcfechainicio` VARCHAR(10), IN `pccupos` INT(11), IN `pctipos` VARCHAR(45), IN `pcaccion` VARCHAR(45), OUT `pcmensaje` VARCHAR(2000), OUT `pccodigo` INT, OUT `pcid` INT)
SP:BEGIN
DECLARE vnconteo,vnmaximo,vnmaximo1,vnid int;
declare temMensaje varchar(100);
set pcmensaje='';
    SET autocommit=0;  
	START TRANSACTION;   
   if pcaccion='agregar' then 
   

   if pcnombre ='' or pcnombre is null then 
	SET temMensaje=CONCAT(temMensaje,'Nombre Tour');
	END if ;
   
    if pcfechainicio='' or pcfechainicio is null then 
  	SET temMensaje=CONCAT(temMensaje,'Fecha Inicio');
    END if ;
   
          
           if pccupos ='' or pccupos  is null then 
   	SET temMensaje=CONCAT(temMensaje,'Cupos');
   END if ;
          
                 
	if pctipos ='' or pctipos  is null then 
   	SET temMensaje=CONCAT(temMensaje,'Tipo de Tour');
          END if ;
         
        IF temMensaje<>'' THEN
			SET pcMensaje=CONCAT('Campos requeridos para poder crear el TOur:',temMensaje);
			set pccodigo=0;
			LEAVE SP;
		END IF;
 
         select max(id)+1 into vnmaximo from tour ;
        
        INSERT INTO tour(`id`,`nombre`,`fecha_inicio`,`habilitado`,`TipoTour`,`Cupos`)
		VALUES	(vnmaximo,pcnombre,pcfechainicio,1,pctipos,pccupos);
                 
         set pcmensaje="Agregado Satisfactoriamente";
         set pccodigo=1;
         set  pcid=vnmaximo;
         
    --     else if pcaccion='Editar' then 
			
		-- else if pcaccion='Eliminar' then 
        
  --        end  if;
          
     --     END IF;
          
          END IF;
         
          commit;
end