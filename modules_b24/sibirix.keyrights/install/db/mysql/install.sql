DROP TABLE IF EXISTS `sib_kr_item`;
CREATE TABLE IF NOT EXISTS `sib_kr_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `section_id` int(10) unsigned DEFAULT NULL,
  `owner` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `section_id` (`section_id`)
) AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `sib_kr_right`;
CREATE TABLE IF NOT EXISTS `sib_kr_right` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `edit` int(1) unsigned NOT NULL,
  `blocked` int(1) unsigned NOT NULL,
  `timed` DATETIME DEFAULT NULL,
  `user` int(10) unsigned DEFAULT NULL,
  `group` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) AUTO_INCREMENT=1;
