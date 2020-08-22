CREATE DEFINER=`root`@`localhost` PROCEDURE `landtravel`.`SP_Persona`(IN `IN_pnombre` VARCHAR(25), IN `IN_papellido` VARCHAR(25), 
IN `IN_correo` VARCHAR(45), IN `IN_contrasenia` VARCHAR(45), IN `IN_pais` INT, IN `IN_direccion` VARCHAR(45),
 IN `IN_telefono` VARCHAR(45), IN `IN_fecha_nacimiento` DATE, IN `IN_pasaporte` VARCHAR(45), IN `IN_expiracion` DATE, 
 IN `IN_tipo_usuario` VARCHAR(45), IN `IN_identidad` BIGINT(13), IN `IN_genero` TINYINT, OUT `OUT_codigo` INT, 
 OUT `OUT_mensaje` VARCHAR(32))

SP:BEGIN
DECLARE ultimo_usuario int default 0;
DECLARE ultima_persona int default 0;
DECLARE ultimo_pago int default 0;
DECLARE vercorreo int;
DECLARE Ngentilicio varchar(45);
SET OUT_codigo = 1;
SET AUTOCOMMIT = 0;

START TRANSACTION;
SELECT MAX(id)+1 INTO ultimo_usuario FROM usuario;
SELECT MAX(id)+1 INTO ultima_persona FROM persona;
SELECT MAX(id)+1 INTO ultimo_pago FROM pago;
select gentilicio into Ngentilicio from pais where id=IN_pais;


select count(*) into vercorreo from usuario
where email=IN_correo;

if vercorreo>=1 then
    set OUT_codigo=-1;
    set OUT_mensaje="Correo Repetido";

    leave sp;
end if;
  
INSERT INTO usuario
(`id`,
`email`,
`contrasenia`,
`tipo_usuario`,
`habilitado`,
`codigo_confirmacion`)
VALUES
(ultimo_usuario,
IN_correo,
IN_contrasenia,
IN_tipo_usuario,
1,
"1");


INSERT INTO log (fecha, usuario_id, descripcion) VALUES(NOW(), ultimo_usuario, "Usuario registrado.");


INSERT INTO persona
(`id`,
`pais_id`,
`usuario_id`,
`pnombre`,
`papellido`,
`fecha_nacimiento`,
`telefono`,
`direccion`,
`pasaporte`,
`genero`,
`identidad`,
nacionalidad)
VALUES
(ultima_persona,
IN_pais,
ultimo_usuario,
IN_pnombre,
IN_papellido,
IN_fecha_nacimiento,
IN_telefono,
IN_direccion,
IN_pasaporte,
IN_genero,
IN_identidad,
Ngentilicio);

set OUT_codigo=1;
set OUT_mensaje="Creado Correctamente";


IF IN_tipo_usuario = 'Guia' THEN
    
    IF ultimo_usuario is null THEN
		SET ultimo_usuario = 0;
	END IF;
    
	INSERT INTO guia
	(`id`,
	`persona_id`,
    `contrato_id`)
	VALUES
	(
		ultimo_usuario,
		ultima_persona,
        1
    );
    
	IF ultimo_pago is null THEN
		SET ultimo_pago = 0;
	END IF;
    Insert into pago
    (id,
	guia_id,
    horas,
    horas_extra,
    mensual,
    extra,
    deducido,
    fecha_pago)
    values
    (ultimo_pago,ultimo_usuario,16,0,64,8,8.64,'2020-04-14');
    
    
    
    set OUT_codigo=1;
    set OUT_mensaje="Creado Correctamente";
END IF;

COMMIT;
END