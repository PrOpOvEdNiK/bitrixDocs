INSERT INTO `sib_kanban_board` (`KANBAN_BOARD_ID`, `GROUP_ID`, `SPRINT_ID`, `TITLE`, `IS_TEMPLATE`, `LAST_SYNC`) VALUES
    (1, NULL, NULL, 'Доска-шаблон',       'Y', NULL),
    (2, NULL, NULL, 'Задачи без проекта', 'N', NULL),
    (3, NULL, NULL, 'Доска-шаблон ТП',    'S', NULL);

INSERT INTO `sib_kanban_column` (`KANBAN_BOARD_COLUMN_ID`, `KANBAN_BOARD_ID`, `SORT`, `TASKS_MIN`, `TASKS_MAX`, `TASK_STATUS`, `TITLE`, `FORCE_TIME`, `SHOW_BUDGET_STATS`, `CUSTOMER_CAN_DROP`, `OTHER_CAN_DROP`, `CUSTOMER_FINAL`) VALUES
    (1,  1, 1,  NULL, NULL, 1, 'Новые задачи',                'N', 'N', 'Y', 'Y', 'N'),
    (2,  1, 2,  NULL, NULL, 2, 'Приняты в работу',            'N', 'N', 'Y', 'Y', 'N'),
    (3,  1, 3,  NULL, NULL, 3, 'Выполняются',                 'N', 'N', 'Y', 'Y', 'N'),
    (4,  1, 4,  NULL, NULL, 4, 'Ждут контроля',               'Y', 'N', 'Y', 'Y', 'N'),
    (5,  1, 5,  NULL, NULL, 5, 'Завершены',                   'Y', 'N', 'Y', 'Y', 'N'),
    (6,  2, 1,  NULL, NULL, 1, 'Новые задачи',                'N', 'N', 'Y', 'Y', 'N'),
    (7,  2, 2,  NULL, NULL, 2, 'Приняты в работу',            'N', 'N', 'Y', 'Y', 'N'),
    (8,  2, 3,  NULL, NULL, 3, 'Выполняются',                 'N', 'N', 'Y', 'Y', 'N'),
    (9,  2, 4,  NULL, NULL, 4, 'Ждут контроля',               'Y', 'N', 'Y', 'Y', 'N'),
    (10, 2, 5,  NULL, NULL, 5, 'Завершены',                   'Y', 'N', 'Y', 'Y', 'N'),
    (11, 3, 1,  NULL, NULL, 1, 'Новые задачи',                'N', 'N', 'Y', 'Y', 'N'),
    (12, 3, 2,  NULL, NULL, NULL, 'Формулировка согласована', 'N', 'N', 'N', 'N', 'N'),
    (13, 3, 3,  NULL, NULL, NULL, 'Оценка согласована',       'N', 'N', 'Y', 'Y', 'N'),
    (14, 3, 4,  NULL, NULL, 2, 'Приняты в работу',            'N', 'N', 'N', 'Y', 'N'),
    (15, 3, 5,  NULL, NULL, 3, 'Выполняются',                 'N', 'N', 'N', 'Y', 'N'),
    (16, 3, 6,  NULL, NULL, 4, 'Ждут контроля',               'Y', 'N', 'N', 'Y', 'N'),
    (17, 3, 7,  NULL, NULL, 5, 'Завершены',                   'Y', 'N', 'N', 'Y', 'N'),
    (18, 3, 8,  NULL, NULL, NULL, 'Принята заказчиком',       'N', 'N', 'Y', 'N', 'Y'),
    (19, 3, 9,  NULL, NULL, NULL, 'Счет и акт',               'N', 'Y', 'N', 'N', 'N');

INSERT INTO `sib_kanban_labels` (`ID`, `TITLE`, `CSS_CLASS`, `KANBAN_BOARD_ID`, `SORT`) VALUES
    (1,  'Зеленый',    'label-1', NULL, 0),
    (2,  'Хаки',       'label-2', NULL, 1),
    (3,  'Тыквенный',  'label-3', NULL, 2),
    (4,  'Вишневый',   'label-4', NULL, 3),
    (5,  'Фиолетовый', 'label-5', NULL, 4),
    (6,  'Синий',      'label-6', NULL, 5),
    (7,  'Салатовый',  'label-7', NULL, 6),
    (8,  'Оранжевый',  'label-8', NULL, 7),

    (9,  'Зеленый',    'label-1', 1,    0),
    (10, 'Хаки',       'label-2', 1,    1),
    (11, 'Тыквенный',  'label-3', 1,    2),
    (12, 'Вишневый',   'label-4', 1,    3),
    (13, 'Фиолетовый', 'label-5', 1,    4),
    (14, 'Синий',      'label-6', 1,    5),
    (15, 'Салатовый',  'label-7', 1,    6),
    (16, 'Оранжевый',  'label-8', 1,    7),

    (17, 'Зеленый',    'label-1', 2,    0),
    (18, 'Хаки',       'label-2', 2,    1),
    (19, 'Тыквенный',  'label-3', 2,    2),
    (20, 'Вишневый',   'label-4', 2,    3),
    (21, 'Фиолетовый', 'label-5', 2,    4),
    (22, 'Синий',      'label-6', 2,    5),
    (23, 'Салатовый',  'label-7', 2,    6),
    (24, 'Оранжевый',  'label-8', 2,    7),

    (25, 'Зеленый',    'label-1', 3,    0),
    (26, 'Хаки',       'label-2', 3,    1),
    (27, 'Тыквенный',  'label-3', 3,    2),
    (28, 'Вишневый',   'label-4', 3,    3),
    (29, 'Фиолетовый', 'label-5', 3,    4),
    (30, 'Синий',      'label-6', 3,    5),
    (31, 'Салатовый',  'label-7', 3,    6),
    (32, 'Оранжевый',  'label-8', 3,    7);

INSERT INTO `sib_task_type` (`TASK_TYPE_ID`, `TITLE`, `CSS_CLASS`, `SORT`) VALUES
    (1,  'Задача',    'type-task',      1),
    (2,  'Фича',      'type-feature',   3),
    (3,  'Баг',       'type-bug',       2),
    (4,  'Уточнение', 'type-info',      4),
    (5,  'Лид',       'type-lead',      9),
    (6,  'Сделка',    'type-contract',  10),
    (7,  'Подпроект', 'type-project',   6),
    (8,  'Эпос',      'type-epic',      7),
    (9,  'Запрос',    'type-request',   5),
    (10, 'История',   'type-userstory', 8);

INSERT INTO `sib_kanban_project_status` (`ID`, `STATUS`, `NAME`) VALUES
	(1, 'ACTIVE', 'Активные'),
	(2, 'ARCHIVE', 'Завершенные');

INSERT INTO `sib_kanban_project` (`GROUP_ID`, `STATUS`, `SCRUMBAN_ENABLED`) VALUES (0, 1, 0);
