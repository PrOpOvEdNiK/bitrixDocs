<?

$MESS["SCRUMBAN_INSTALL_PROCESS_TITLE"] = "Поздравляем!";

$MESS["SCRUMBAN_INSTALL_PROCESS_DESCRIPTION"] = "Вы в одном шаге от завершения установки &laquo;Доски задач&raquo;";



$MESS["SCRUMBAN_MODULE_NAME"] = "Доска задач";

$MESS["SCRUMBAN_MODULE_DESC"] = "SCRUMBAN";

$MESS["SCRUMBAN_MENU_LINK"] = "Доска задач";



$MESS["SCRUMBAN_BETA_VERSION"] = "<b>Это бета-версия модуля</b>. Мы очень старались сделать ее максимально стабильной, но, возможно, вы найдете то, что мы пропустили. Мы будем очень рады, если вы напишете нам об этом на <a href=\"http://scrumban.helpdesk.sibirix.ru/\">http://scrumban.helpdesk.sibirix.ru/</a>.";



$MESS['SCRUMBAN_INSTALL'] = "Установка модуля Доски задач (Канбана)";



$MESS["SCRUMBAN_INSTALL_WELCOME"] = "Добро подаловать в установку модуля Доски задач";

$MESS["SCRUMBAN_INSTALL_REQUIREMENTS_HEADER"] = "Для корректной работы модуля необходимо, чтобы следующие требования были соблюдены. Проверьте, пожалуйста:";

$MESS["SCRUMBAN_INSTALL_REQUIREMENTS"] =

    "<li><b>битрикс версии 17.0</b> и выше;</li>" .

    "<li>установлен модуль <b>\"Задачи\"</b> версии <b>17.5</b> и выше;</li>" .

    "<li>установлен модуль <b>\"Социальная сеть\"</b>;</li>" .

    "<li>установлен модуль <b>\"Форум\"</b>;</li>" .

    "<li>установлен модуль <b>\"Учет рабочего времени\"</b>.</li>";



$MESS["SCRUMBAN_INSTALL_REQUIREMENTS_ERROR"] = "Не удовлетворены минимальные системные требования";

$MESS["SCRUMBAN_INSTALL_REQUIREMENTS_REPAIR"] = "Пожалуйста, устраните перечисленные замечания, и попробуйте повторить установку";



//$MESS["SCRUMBAN_INSTALL_REQERROR_CHAR"] = "Неправильная кодировка";

$MESS["SCRUMBAN_INSTALL_REQERROR_BX"] = "Требуется Битрикс, версии 17.0 и выше";

$MESS["SCRUMBAN_INSTALL_REQERROR_TASKS"] = "Не установлен модуль Задач";

$MESS["SCRUMBAN_INSTALL_REQERROR_TASKS_VERSION"] = "Требуется модуль Задачи версии 17.5 и выше";

$MESS["SCRUMBAN_INSTALL_REQERROR_SOCIAL"] = "Не установлен модуль Социальной сети";

$MESS["SCRUMBAN_INSTALL_REQERROR_FORUM"] = "Не установлен модуль Форума";

$MESS["SCRUMBAN_INSTALL_REQERROR_TIMEMAN"] = "Не установлен модуль Учета рабочего времени";



$MESS["SCRUMBAN_INSTALL_BUTTON_INSTALL"] = "Установить";



$MESS["SCRUMBAN_HEADER_STEP1"] = "Параметры установки";



$MESS["SCRUMBAN_LICENSE_STEP1"] = "Я прочитал <a href='http://scrumban.ru/eula.pdf' target='_blank'>лицензионное соглашение</a> и согласен с ним";



$MESS["SCRUMBAN_INSTALL_COMPLETE_HEADER"] = "Установка завершена";

$MESS["SCRUMBAN_INSTALL_COMPLETE"] = 'Введенные вами параметры при установке вы в любой момент можете изменить в <a href="/bitrix/admin/settings.php?mid=sibirix.scrumban&mid_menu=1">панели управления модулем</a>.';

$MESS["SCRUMBAN_INSTALL_COMPLETE_COMPONENT"] = "Настройте компонент";

$MESS["SCRUMBAN_INSTALL_COMPLETE_WARNING"] = 'Не забудьте <a href="/bitrix/admin/settings.php?mid=sibirix.scrumban&mid_menu=1">настроить параметры</a>!';



$MESS["SCRUMBAN_INSTALL_ALL_REQUIRED"] = "Все поля являются обязательными";



$MESS['SCRUMBAN_UNINSTALL'] = "Удаление модуля Доски задач";

$MESS["SCRUMBAN_UNINSTALL_SAVE_TABLES"] = "Сохранить таблицы";

$MESS["SCRUMBAN_UNINSTALL_SAVE_FILES"]  = "Сохранить файлы клиентской части модуля";



$MESS["SCRUMBAN_INSTALL_PROJECT_RIGHTS"] = "Включить расширенное управление правами доступа к проектам";

$MESS["SCRUMBAN_INSTALL_PROJECT_RIGHTS_TIP"] = "<p>Опция управления доступом позволит включать и отключать отображение Доски задач и Доски планирования индивидуально для каждого проекта, а также для \"задач без проекта\".</p>" .

    "<p>Если вы включите опцию управления доступом, то сможете включать и отключать использование Scrumban для конкретного проекта. Для \"задач без проекта\" доступны трехуровневые настройки доступа.</p>" .

    "<p>Управлять доступом участников к конкретному проекту может администратор Корпоративного портала и Владелец проекта. Доступом к \"задачам без проекта\" &mdash; только администратор.</p>" .

    "<p>Вы можете включить опцию управления доступом на странице настроек в любой момент после установки модуля.</p>";



$MESS['SCRUMBAN_INSTALL_MAIL_TEMPLATE_EMAIL_SUBJECT'] = '#SUBJECT#';

$MESS['SCRUMBAN_INSTALL_MAIL_TEMPLATE_EMAIL_MESSAGE'] = '#MESSAGE#';

$MESS['SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_WEEKLY_SUBJECT'] = 'Еженедельное уведомление о задачах технической поддержки';

$MESS['SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_WEEKLY_MESSAGE'] = 'В проекте #PROJECT_NAME# следующие задачи требуют ответа:<br>

#TASK_LIST#';

$MESS['SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_DAILY_SUBJECT'] = 'Ежедневное уведомление о задачах технической поддержки';

$MESS['SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_DAILY_MESSAGE'] = 'В проекте #PROJECT_NAME# произошли следующие изменения:<br>

#TASKS_HI#

#TASKS_LOW#

#COMMENTS#';
