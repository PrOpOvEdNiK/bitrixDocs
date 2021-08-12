# Список изменений
Все значимые изменения по проекту должны быть зафиксированы исполнителем в этом файле. [Правила ведения списка изменений](https://docs.google.com/document/d/1ZWyQEYpXc6gjhK8magK4VH8TXdcTofvu4skbDkf-OFg/edit?usp=sharing).

## dev-master

## v1.3.7 - 04.02.2021
- Фикс проверки наличия функционала пинг-сообщений задач в ядре(для старых версий портала) #70936

## v1.3.6 - 03.02.2021
- Добавлена опция откл.(по умолчанию)/вкл. попадание пинг-сообщений задач в модуль "Реагировать на пинг-сообщения" #70312

## v1.3.5 - 20.07.2020
- Улучшено логирование ошибок получения описания для оповещений #64703
- Добавлено полное очищение фильтра при удалении последнего параметра для исключения редких визуальных ошибок фильтра #63274

## v1.3.3, v1.3.4 - 03.06.2020
- Добавлены стили для корректного отображения попапа раздела Управление после обновления корпортала до версии 20.0.1175 #63818

## v1.3.2 - 01.06.2020
- Добавлены стили для корректного отображения попапа после обновления корпортала до версии 20.0.1175 #63712
- Добавлена проверка на bitrix/local размещение кастомных asset js/css файлов модуля #57781

## v1.3.1 - 11.05.2020
- Добавлены счетчики уведомлений "Ожидаю реакции"/"с реакцией", "без реакции" после удаления записей в гриде #62329

## v1.3.0 - 23.12.2019
- При ожидании реакции от нескольких пользователей теперь создаётся отдельное уведомление на каждого из них #57144
- Добавлена настройка "Разрешить администраторам удалять уведомления во вкладке "требует реакции"" #57174
- Добавлена возможность удалить сразу все уведомления в блоке "Нужно среагировать", если у пользователя есть на это права #57174

## v1.2.0 - 09.12.2019
- При удалении задачи удаляются все уведомления связанные с необходимостью проконтролировать задачу #53085
- Уведомление о отчете теперь отправляется выбранному руководителю #49290
- Нулевые каунтеры в разделе "Управление" теперь подсвечиваются серым #55560
- Во вкладке "Ожидаю реакции" добавлены каунтеры "С реакцией" и "Без реакции" #55211
- Добавлен тип реакции "Ознакомление с задачей" #55211
- Исправлено исчезание панели групповых действий после первого действия #56017
- Добавлена возможность среагировать на новую задачу комментарием #56048
- Добавлена возможность среагировать на новую задачу стартом работы над ней #56451

## v1.1.1 - 30.08.2019
- Добавлено подключение стилей и скриптов необходимых для корректной работы грида и фильтра #51386

## [v1.1.0](https://gitlab.magnifico.pro/bitrix24/bizprofi.reaction/compare/v1.0.3...v1.1.0) - 19.06.2019
### Добавлено
- Фильтр по отделам во вкладке управление #43030
- Регирование на упоминание в записи живой ленты комментарием #41427
- Перенос уведомлений связанных с отчетом на нового руководителя, при переводе сотрудника в другой отдел #43856
- Сортировка сотрудников по количеству уведомлений требующих реакции во вкладке управление #48135

### Исправлено
- Не корректное переключение между окном чата и вкладкой управление [#43023](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/43023/)
- Не корректное взаимодействие с задачами связанными с CRM #40482
- Иконка чата #44680
- Дублирование уведомлений при закрытии слайдера #43766
- Отображение количества уведомлений #44680
- Постраничная навигация по уведомлениям [#46203](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/46203/?MID=61106#com61106)
- Исключение при сортировке и в случае отсутствия связей уведомлений #46511
- Удаление агента CRM уведомлений #46212
- Запрет закрытия рабочего дня в случае когда включены ежедневные отчеты #48581
- Реагирование на комментарии в задачах лайком #48414
- Открытие ссылки на отчет #48952

### Переработано
- Логика работы с комментариями CRM #41429
- Модуль реагирования теперь работает в слайдере #45111

## [v1.0.3](https://gitlab.magnifico.pro/bitrix24/bizprofi.reaction/compare/v1.0.2...v1.0.3) - 25.04.2019
### Добавлено
- Вкладка "Управление" [#41575](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/41575/)

### Исправлено
- Немецкая локализация [#42955](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/42955/)

## [v1.0.2](https://gitlab.magnifico.pro/bitrix24/bizprofi.reaction/compare/v1.0.1...v1.0.2) - 23.04.2019
### Добавлено
- Поддержка английского и немецкого языков [#41807](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/41807/)

## [v1.0.1](https://gitlab.magnifico.pro/bitrix24/bizprofi.reaction/compare/v1.0.0...v1.0.1) - 01.04.2019
### Добавлено
- Кнопка удаления уведомлений ожидающих реакции с реакцией [#40234](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/40234/)

### Исправлено
- Исключение при добавлении комментария к отчету [#40377](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/40377/)
- Обрезка фото для превью [#40484](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/40484/)
- Реагирование на комментарий к отчету лайком [#40680](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/40680/)
- Дублирование уведослений о комментарии в отчете [#40494](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/40494/)
- Отображение окна реагирования после открытия ссылки в слайдере [#41344](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/41344/)

### Измененно
- Логика уведомлений о комментариях в отчетах [#40553](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/40553/)

## [v1.0.0](https://gitlab.magnifico.pro/bitrix24/bizprofi.reaction/tree/v1.0.0) - 11.03.2019
### Добавлено
- Создан модуль "Реагирование" [#31474](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/31474/)
- Таблицы для хранения и биндинга уведомлений, обработчики событий добавления-удаления комментариев и задач [#31476](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/31476/)
- Базовый функционал модуля [#31480](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/31480/)
- Ajax функционал [#31481](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/31481/)
- Push&Pull [#31482](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/31482/)
- Запрет завершения рабочего дня при наличии уведомлений [#33102](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/33102/)
- Переодические уведомление о наличии уведомлений [#33101](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/33101/)
- Обработка отчётов [#33983](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/33983/)
- Вывод имени задачи в уведомлениях, Нужно среагировать / Ожидаю реакции кликабельны, опция настройки блокировки окончания дня  [#35339](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/35339/)
- Миграция, добавляющая уведомления за последние 30 дней [#33984](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/33984/)
- При отправки задачу на проверку добавляется уведомление для ответственного в колонку "ожидаю реакции", отображение названия задачи отправленной на контроль  [#35822](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/35822/)
- При комментировании задачи создаётся уведомление о ожидании реакции [#36216](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36216/)
- Возможность реагировать через кнопку "лайк" в задачах и отчётах [#36431](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36431/)
- Отображение количества уведомлений по направлениям в кругляшиках [#36439](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36439/)
- Отображение и фильтрация уведомлений по сущностям [#36457](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36457/)
- у уведомлений "ожидаю реакции", на которые среагировали появляется зелёный кругляшик [#36460](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36460/)
- Обработка сущностей сонета [#36875](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36875/)
- Обработка сущностей crm [#37663](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/37663/)
- Документация [#37376](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/37376/)
- Обработка задач бизнес-процессов [#37326](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/37326/)
- Комментарии к блогам [#38163](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38163/)
- Удаление всех нотификаций при удалении бизнес процесса [#38478](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38478/)
- Добавлена поддержка публикации в marketplace [#38860](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38860/)
- Удаление уведомлений при удалении поста из живой ленты [#39230](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/39230/)

### Изменено
- Уведомления для ответившего в комментариях к задаче пользователя теперь удаляются [#35339](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/35339/)
- getCountByUserIds теперь возвращает количество по всем направлениям сразу [#36439](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36439/)
- текст уведомения теперь генерируется динамически [#36435](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36435/)
- время запуска агента crm уменьшено до 1 минуты [#38011](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38011/)
- Описание уведомления о бизнес процессе теперь парсится в html [#38478](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38478/)
- Создание старых уведомлений вынесено в настройки модуля [#39347](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/39347/)

### Исправлено
- Поведение кнопки подгрузки при отсутствии уведомлений [#35339](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/35339/)
- Иногда удалялись оповещение о контролле задачи при добавлении комментария [#35822](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/35822/)
- Ложное появление надписи отсутствия уведомлений [#36335](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36335/)
- Теперь учитываются любые типы лайков [#36953](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36953/)
- Уведомления ожидающие реакции больше не удаляются автоматически при реакции на них [#36448](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/36448/)
- Теперь корректно обрабатывается контроль отчётов в новом генераторе [#37656](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/37656/)
- Больше не создаются уведомления если пользователь был упомянут в цитате [#38544](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38544/)
- Ссылка на просмотр ожидающего реакции бизнес процесса [#38478](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38478/)
- Дублирование уведомлений об отчете при его редактировании [#38716](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/38716/)
- Определение общего количества уведомлений [#39100](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/39100/)
- Дублирование уведомлений [#39212](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/39212/)
- Формирование ссылки на запись блога [#39254](https://in.bizprofi.ru/company/personal/user/0/tasks/task/view/39254/)
