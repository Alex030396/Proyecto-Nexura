CREATE SCHEMA `nexura` ;
USE `nexura`;
CREATE TABLE  `nexura`.`areas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));
  
CREATE TABLE `nexura`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `nexura`.`empleados` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `sexo` CHAR(1) NOT NULL,
  `area_id` INT NOT NULL,
  `boletin` INT NOT NULL,
  `descripcion` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fg_key_area_idx` (`area_id` ASC) VISIBLE,
  CONSTRAINT `fg_key_area`
    FOREIGN KEY (`area_id`)
    REFERENCES `nexura`.`areas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `nexura`.`empleado_rol` (
  `id` INT AUTO_INCREMENT NOT NULL ,
  `empleado_id` INT NOT NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fg_key_empleado_idx` (`empleado_id` ASC) VISIBLE,
  INDEX `fg_key_rol_idx` (`rol_id` ASC) VISIBLE,
  CONSTRAINT `fg_key_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `nexura`.`empleados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fg_key_rol`
    FOREIGN KEY (`rol_id`)
    REFERENCES `nexura`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


    
INSERT INTO `nexura`.`roles` (`id`, `nombre`) VALUES ('1', 'Profesional de proyectos - Desarrollador');
INSERT INTO `nexura`.`roles` (`id`, `nombre`) VALUES ('2', 'Gerente estratégico');
INSERT INTO `nexura`.`roles` (`id`, `nombre`) VALUES ('3', 'Auxiliar administrativo');

INSERT INTO `nexura`.`areas` (`id`, `nombre`) VALUES ('1', 'Ventas');
INSERT INTO `nexura`.`areas` (`id`, `nombre`) VALUES ('2', 'Calidad');
INSERT INTO `nexura`.`areas` (`id`, `nombre`) VALUES ('3', 'Producción');
INSERT INTO `nexura`.`areas` (`id`, `nombre`) VALUES ('4', 'Administración');

INSERT INTO `nexura`.`empleados` (`id`, `nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES ('1', 'Gladys Fernández', 'gfernandez@example.com', 'F', '1', '1', 'EStadsa');
INSERT INTO `nexura`.`empleados` (`id`, `nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES ('2', 'Felipe Gómez', 'fgomez@example.com', 'M', '2', '0', 'adasdadf');
INSERT INTO `nexura`.`empleados` (`id`, `nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES ('3', 'Adriana Loaiza', 'aloaiza@example.com', 'F', '3', '1', 'asdaasdf');