CREATE TABLE ft_table (
`id` INT AUTO_INCREMENT NOT NULL,
`login` VARCHAR(8) NOT NULL DEFAULT 'toto',
`group` ENUM('staf','student','other') NOT NULL,
`creation_data` DATE NOT NULL,
PRIMARY KEY (id));
