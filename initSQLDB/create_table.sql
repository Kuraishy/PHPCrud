-- CREATE TABLE php_database.posts (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY , title VARCHAR(255) NOT NULL , body VARCHAR(255) NULL , created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);

-- INSERT INTO php_database.posts (title,body) VALUES ("titulo default","body default");


-- creando la tabla de lisitngs
CREATE TABLE `php_database`.`listings` (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `title` VARCHAR(255) NOT NULL , `description` LONGTEXT NULL , `salary` VARCHAR(45) NULL , `tags` VARCHAR(255) NULL , `company` VARCHAR(45) NULL , `address` VARCHAR(255) NULL , `city` VARCHAR(45) NULL , `state` VARCHAR(45) NULL , `phone` VARCHAR(45) NULL , `requirements` LONGTEXT NULL , `benefits` LONGTEXT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)); 

-- creacion de la tabla de usuarios
CREATE TABLE `php_database`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(25) NOT NULL , `email` VARCHAR(25) NOT NULL , `password` VARCHAR(255) NOT NULL , `city` VARCHAR(45) NULL , `state` VARCHAR(45) NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`));

-- creando la relacion entre las dos tablas usando el user_id de lsiting con el id de users
-- si se borra o se modifica una, la accion se refleja en la otra tabal
ALTER TABLE `listings` ADD CONSTRAINT `fk_listings_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; 

-- insertando un usuario de pruebla
INSERT INTO `users`(`name`,`email`,`password`,`city`,`state`) VALUES ('John Doe','john@email.com','passwordjohn','Boston','MA');