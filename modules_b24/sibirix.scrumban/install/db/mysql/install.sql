DROP TABLE IF EXISTS `sib_kanban_board`;
CREATE TABLE IF NOT EXISTS `sib_kanban_board` (
  `KANBAN_BOARD_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GROUP_ID` int(10) unsigned DEFAULT NULL,
  `SPRINT_ID` int(10) unsigned DEFAULT NULL,
  `TITLE` varchar(250) NOT NULL,
  `IS_TEMPLATE` char(1) NOT NULL DEFAULT 'N',
  `LAST_SYNC` datetime DEFAULT NULL,
  `RESPONSIBLE` int(10) DEFAULT NULL,
  `RESPONSIBLE_CHANGE` char(1) NOT NULL DEFAULT 'Y',
  `NOTIFY` char(1) NOT NULL DEFAULT 'N',
  `TASK_TYPES` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`KANBAN_BOARD_ID`),
  KEY `GROUP_ID` (`GROUP_ID`),
  KEY `SPRINT_ID` (`SPRINT_ID`),
  KEY `IS_TEMPLATE` (`IS_TEMPLATE`)
) AUTO_INCREMENT=3;

DROP TABLE IF EXISTS `sib_kanban_checklist_items`;
CREATE TABLE IF NOT EXISTS `sib_kanban_checklist_items` (
  `CHECKLIST_ITEM_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `TASK_ID` int(11) unsigned NOT NULL DEFAULT '0',
  `STATUS` char(1) NOT NULL DEFAULT '0',
  `SORT` smallint(5) unsigned NOT NULL DEFAULT '0',
  `DESCRIPTION` varchar(255) NOT NULL,
  PRIMARY KEY (`CHECKLIST_ITEM_ID`)
);

DROP TABLE IF EXISTS `sib_kanban_column`;
CREATE TABLE IF NOT EXISTS `sib_kanban_column` (
  `KANBAN_BOARD_COLUMN_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `KANBAN_BOARD_ID` int(10) unsigned NOT NULL,
  `SORT` int(10) unsigned NOT NULL,
  `TASKS_MIN` int(10) unsigned DEFAULT NULL,
  `TASKS_MAX` int(10) unsigned DEFAULT NULL,
  `TASK_STATUS` int(10) unsigned DEFAULT NULL,
  `TITLE` varchar(250) DEFAULT NULL,
  `FORCE_TIME` char(1) NOT NULL DEFAULT 'N',
  `SHOW_BUDGET_STATS` char(1) NOT NULL DEFAULT 'N',
  `CUSTOMER_CAN_DROP` char(1) NOT NULL DEFAULT 'Y',
  `OTHER_CAN_DROP` char(1) NOT NULL DEFAULT 'Y',
  `CUSTOMER_FINAL` char(1) NOT NULL DEFAULT 'N',
  `STAGE_ID` INT NULL,
  `STAGE_COLOR` CHAR(6) NULL,
  PRIMARY KEY (`KANBAN_BOARD_COLUMN_ID`),
  KEY `KANBANBOARD_ID` (`KANBAN_BOARD_ID`),
  KEY `SORT` (`SORT`)
) AUTO_INCREMENT=21;

DROP TABLE IF EXISTS `sib_kanban_column_dods`;
CREATE TABLE IF NOT EXISTS `sib_kanban_column_dods` (
  `DOD_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `KANBAN_BOARD_COLUMN_ID` int(11) unsigned NOT NULL,
  `SORT` smallint(5) unsigned NOT NULL DEFAULT '0',
  `DESCRIPTION` varchar(255) NOT NULL,
  PRIMARY KEY (`DOD_ID`)
);

DROP TABLE IF EXISTS `sib_kanban_dod2task`;
CREATE TABLE IF NOT EXISTS `sib_kanban_dod2task` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `TASK_ID` int(11) unsigned NOT NULL,
  `DOD_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `TASK_ID` (`TASK_ID`),
  KEY `DOD_ID` (`DOD_ID`)
);

DROP TABLE IF EXISTS `sib_kanban_label2task`;
CREATE TABLE IF NOT EXISTS `sib_kanban_label2task` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `TASK_ID` int(11) unsigned NOT NULL,
  `LABEL_ID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
);

DROP TABLE IF EXISTS `sib_kanban_labels`;
CREATE TABLE IF NOT EXISTS `sib_kanban_labels` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `TITLE` char(255) DEFAULT NULL,
  `CSS_CLASS` char(100) DEFAULT NULL,
  `KANBAN_BOARD_ID` int(11) unsigned DEFAULT NULL,
  `SORT` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `KANBAN_BOARD_ID` (`KANBAN_BOARD_ID`)
) AUTO_INCREMENT=33;

DROP TABLE IF EXISTS `sib_kanban_project`;
CREATE TABLE IF NOT EXISTS `sib_kanban_project` (
  `GROUP_ID` int(10) unsigned NOT NULL,
  `STATUS` int(10) unsigned DEFAULT NULL,
  `VISIBLE` tinyint(3) unsigned DEFAULT NULL,
  `SCRUMBAN_ENABLED` int(10) DEFAULT '0',
  `PRICE_RATE` int(10) unsigned DEFAULT NULL,
  `PRICE_HIGH_RATE` int(10) unsigned DEFAULT NULL,
  `BUDGET` int(10) DEFAULT NULL,
  `SUPPORT_ENABLED` tinyint(3) unsigned DEFAULT NULL,
  `NOTIFY_IMPORTANT_TASK` tinyint(3) unsigned DEFAULT '0',
  `ARCHIVE_SPRINT_HIDE` tinyint(3) unsigned DEFAULT '0',
  `KANBAN_SYNC_TYPE` ENUM('0','1') NULL DEFAULT NULL,
  `KANBAN_SYNC_CONFLICT` ENUM('stage','status') NULL DEFAULT 'stage',
  `ACT_BASE` varchar(255) DEFAULT '',
  `REPORT_EMAIL` varchar(255) DEFAULT '',
  `GA_AUTH_TOKEN` varchar(255) DEFAULT '',
  `GA_REFRESH_TOKEN` varchar(255) DEFAULT '',
  `GA_AUTH_EXPIRE` datetime DEFAULT NULL,
  `YM_AUTH_TOKEN` varchar(255) DEFAULT '',
  `REPORT_WEEK_DAY` tinyint(3) unsigned DEFAULT NULL,
  `REPORT_HOUR` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`GROUP_ID`)
);

DROP TABLE IF EXISTS `sib_kanban_project_status`;
CREATE TABLE IF NOT EXISTS sib_kanban_project_status (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `STATUS` enum('ACTIVE','ARCHIVE') NOT NULL DEFAULT 'ACTIVE',
  `NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
);

DROP TABLE IF EXISTS `sib_kanban_sprints`;
CREATE TABLE IF NOT EXISTS `sib_kanban_sprints` (
  `SPRINT_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `GROUP_ID` int(11) unsigned NOT NULL,
  `TITLE` char(255) DEFAULT NULL,
  `STANDUP_TIME` time DEFAULT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `DEADLINE_DATE` date DEFAULT NULL,
  `ARCHIVED` char(1) DEFAULT 'N',
  PRIMARY KEY (`SPRINT_ID`)
);

DROP TABLE IF EXISTS `sib_kanban_task`;
CREATE TABLE IF NOT EXISTS `sib_kanban_task` (
  `KANBAN_BOARD_TASK_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `KANBAN_BOARD_COLUMN_ID` int(10) unsigned NOT NULL,
  `BLOCK_COMMENT_ID` int(10) unsigned DEFAULT NULL,
  `RANK` int(10) unsigned DEFAULT NULL,
  `IMPORTANCE` int(10) DEFAULT NULL,
  `IMPORTANCE_RANK` int(10) unsigned NOT NULL DEFAULT '0',
  `TASK_ID` int(10) unsigned DEFAULT NULL,
  `TIME_ADDING` datetime NOT NULL COMMENT 'время добавления в колонку',
  `ESTIMATE_CUSTOM_FROM` int(10) unsigned DEFAULT NULL,
  `ESTIMATE_CUSTOM_TO` int(10) unsigned DEFAULT NULL,
  `ELAPSED_CUSTOM` int(10) unsigned DEFAULT NULL,
  `PRICE_RATE` int(10) unsigned DEFAULT NULL,
  `PRICE_HIGH_RATE` int(10) unsigned DEFAULT NULL,
  `GA_AUTH_TOKEN` varchar(255) DEFAULT '',
  `GA_REFRESH_TOKEN` varchar(255) DEFAULT '',
  `GA_AUTH_EXPIRE` datetime DEFAULT NULL,
  `YM_AUTH_TOKEN` varchar(255) DEFAULT '',
  `AN_FROM` datetime DEFAULT NULL,
  `AN_TO` datetime DEFAULT NULL,
  `COUNTER` varchar(255) DEFAULT '',
  `ACCOUNT` varchar(255) DEFAULT '',
  `PROFILE` varchar(255) DEFAULT '',
  `GOAL` varchar(255) DEFAULT '',
  `MEASURE_TYPE` tinyint(4) DEFAULT NULL,
  `MEASURE_VALUE` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`KANBAN_BOARD_TASK_ID`),
  KEY `KANBAN_BOARD_COLUMN_ID` (`KANBAN_BOARD_COLUMN_ID`),
  KEY `TASK_ID` (`TASK_ID`)
);

DROP TABLE IF EXISTS `sib_sync_log`;
CREATE TABLE IF NOT EXISTS `sib_sync_log` (
  `EVENT_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `BACKEND_TASK_ID` int(11) unsigned NOT NULL DEFAULT '0',
  `EVENT` char(1) NOT NULL,
  `GROUP_ID` int(11) DEFAULT '0',
  PRIMARY KEY (`EVENT_ID`)
);

DROP TABLE IF EXISTS `sib_task`;
CREATE TABLE IF NOT EXISTS `sib_task` (
  `TASK_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SPRINT_ID` int(10) unsigned NOT NULL,
  `SPRINT_RANK` int(10) unsigned NOT NULL,
  `TASK_TYPE_ID` int(10) unsigned NOT NULL,
  `BACKEND_TASK_ID` int(10) unsigned NOT NULL,
  `DURATION_PLAN_MINUTS` int(11) unsigned DEFAULT NULL,
  `ARCHIVED` datetime DEFAULT NULL,
  `RESPONSIBLE_ID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`TASK_ID`),
  KEY `SPRINT_ID` (`SPRINT_ID`),
  KEY `TASK_TYPE_ID` (`TASK_TYPE_ID`),
  KEY `BACKEND_TASK_ID` (`BACKEND_TASK_ID`)
);

DROP TABLE IF EXISTS `sib_task_type`;
CREATE TABLE IF NOT EXISTS `sib_task_type` (
  `TASK_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(100) NOT NULL DEFAULT '',
  `CSS_CLASS` varchar(100) NOT NULL DEFAULT '',
  `SORT` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`TASK_TYPE_ID`),
  KEY `CSS_CLASS` (`CSS_CLASS`)
) AUTO_INCREMENT=8;

DROP TABLE IF EXISTS `sib_user2task`;
CREATE TABLE IF NOT EXISTS `sib_user2task` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) unsigned NOT NULL,
  `TASK_ID` int(10) unsigned NOT NULL,
  `LAST_VIEWED` datetime NOT NULL,
  PRIMARY KEY (`ID`)
);

DROP TABLE IF EXISTS `sib_user2project_visit`;
CREATE TABLE IF NOT EXISTS `sib_user2project_visit` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) unsigned NOT NULL,
  `PROJECT_ID` int(10) unsigned DEFAULT NULL,
  `SITE_ID` varchar(50) DEFAULT NULL,
  `LAST_VIEWED` datetime NOT NULL,
  PRIMARY KEY (`ID`)
);
