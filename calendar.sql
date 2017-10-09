CREATE TABLE IF NOT EXISTS `calendar` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`type` int(10) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,  
  `case` int(10) NOT NULL,
  `comm` varchar(255) NOT NULL,
  `done` tinyint unsigned NOT NULL default '0',
  PRIMARY KEY(`id`),
  INDEX `type` (`type`),
  INDEX `case` (`case`)  
); 

CREATE TABLE IF NOT EXISTS  `types` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
);

INSERT INTO `types` (`type`) VALUES
('Встреча'), 
('Звонок'), 
('Совещание'),
('Дело');

CREATE TABLE IF NOT EXISTS `cases` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `case` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
);

INSERT INTO `cases` (`case`) VALUES
('30 минут'),
('1 час'),
('2 часа'),
('3 часа'),
('4 часа');