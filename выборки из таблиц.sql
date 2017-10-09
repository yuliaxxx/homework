SELECT 
`b`.`name_book`,
`prov`.`name`,
`d`.`date`
FROM `deliveries` `d` 
JOIN `books` `b` ON `d`.`id_book`=`b`.`id` 
JOIN `providers` `prov` ON `d`.`id_prov`=`prov`.`id`
ORDER BY `b`.`name_book` ASC;

SELECT 
`s`.`date`,
SUM(`s`.`count_book`*`p`.`price`) `receipts`
FROM `sales` `s` 
JOIN `prices` `p` ON `s`.`id_price`=`p`.`id` 
WHERE `s`.`date` = "2017-06-04";

SELECT 
`prov`.`name`,
SUM(`d`.`count_book`) `count`
FROM `deliveries` `d`
JOIN `providers` `prov` ON `d`.`id_prov`=`prov`.`id`
GROUP BY `prov`.`name`;

SELECT 
`s`.`date`,
MAX(`s`.`count_book`*`p`.`price`) `receipts`
FROM `sales` `s` 
JOIN `prices` `p` ON `s`.`id_price`=`p`.`id` 
ORDER BY `s`.`date`;

SELECT * FROM `info`;

SELECT * FROM `book_info`;