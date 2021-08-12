Как работает. <br>
=========
Обработчики событий ловят события добавления, удаления и редактирования комментариев к сущностям и некоторых сущностей (задачи, отчёты).
 После обработки событий данные записываются в соответствующие таблицы. С помощью события OnBeforeEndBufferContent на нужных страницах подключается и инициализируется первоначальными данными js скрипт, который отвечает за графический интерфейс и взаимодействие с пользователем.
 Интерфейс польностью интегрируется в стандартный IM и визуально копирует вкладку уведомлений. Приходящие уведомления разбиты по направлениям (ожидает реакции, нужно среагировать) и по сущностям (задачи на контролле, отчёты, комментарии). По направлениям и сущностям доступна фильтрация.
 При изменении количества уведомлений клиент получает pull-запрос с сервера и обновляет данные на актуальные. Количество выводимых/подгружаемых сообщений - 20 штук, если уведомлений больше, выводится кнопка подгрузки уведомлений. Загрузка уведомлений и удаление производится ajax-запросом.<br>
 В модуле предусмотрена возможность опционально блокировать рабочий день, если у пользователя есть необработанные уведомления, настраивается в настройках модуля. <br>
 В модуле предусмотрен вывод периодических напоминаний попап-окном о количестве требующих реакции уведомлений. <br>

<a name="composition"></a>Из чего состоит. <br>
=========
Таблицы: <br>
-------
### NotificationTable <br>
Основная таблица, в которой хранятся уведомления <br>
####  Поля: <br>
ID <br>
int FROM_USER - от кого уведомление <br>
int TO_USER - кому уведомление <br>
string NOTIFICATION - раньше в нём содержалась верстка уведомления, сейчас поле удалено, сообщение генерируется динамически <br>
Datetime   DATE   - дата создания уведомления <br>
int DIRECTION - неправление сделки, задается константами <br>
```php
const NEED_REACTION = 2;
const WAIT_REACTION = 1;
```

#### В датаменеджере этой таблицы задан набор функций для упрощения манимуляций с данными:<br>
```php
public static function isExistNoty(int $userId, $entityType, $entityId)// позволяет проверить существует ли уведомление по id пользователя, типу сущности и id сущности. Сущности берутся с таблицы биндингов.
public static function getAllCounters(array $users) : array //позволяет получить значения всех счетчиков сущностей для массива пользователей
public static function getCountByUserIds(array $ids, bool $sendPull = true): array  //позволяет получить все счетчики по направлениям и сущностям, а так же отправить их пулл-запросом пользователям, $deleteKeys позволяет задать какие уведомления были удалены у пользователя, чтобы они удалились у него из окна реагирования джаваскриптом
 public static function clearEntityById(int $id, int $entityType, int $direction = 0) //очищает уведомления по id,type сущности и направлению
 public static function clearEntityByUser(array $ids, int $entityType, int $etityId, int $direction = 0) //очищает уведомления для списка пользователей для конкретной сущности
 public static function deleteAllWaitReaction(int $user) //удаляет все уведомления ожидающие реакции у пользователя (для кнопки удалить все)
```

NotificationBindingTable
---------
Таблица биндингов уведомлений
Хранит в себе соответствия между уведомлениями и сущностями. При удаление уведомления записи с этой таблицы удаляются каскадом.
### Поля:
```php
int NOTIFICATION_ID //связь с ID в основной таблице
int ENTITY_ID //id сущности
int ENTITY_TYPE  //тип сущности, задаётся константами:
const BP_TASK = 11;
const CRM_ENTITY_COMMENT = 10;
const CRM_ENTITY = 9;
const SOC_LOG = 8;
const SOC_LOG_COMMENT = 7;
const COMMENT_REPORT_ENTITY = 6;
const SOC_LOG_REPORT_ENTITY = 5;
const REPORT_ENTITY = 4;
const MESSAGE_ENTITY = 3;
const TASK_ENTITY = 2;
const TASK_CONSTROL_ENTITY = 1;
const DONT_USE_IT_RESERVED_FOR_ENTITY_FILTER = 12; // тип 12 зарезервирован и используется для фильтра по всем комментариям
```
Функий нет.

NotificationResponsibleTable
-------
Хранит пользователей, реакции которых ожидает сущность. Если у сущности ожидающей реакции нет записей в этой таблице - она считается не требующей реакции и у неё появляется зелёный кругляшик. <br>
Количество ответственных для сущности (уведомления) выбирается при генерации в notifygenerator и проверяется в js, если >0, кругляшика нет, иначе есть.
Ответственные добавляются при создании уведомления, берутся из упомянутых пользователей, для контроля задач/отчётов берётся тот, кому создаётся уведомление. <br>
### Поля:
int NOTIFICATION_ID - связь с ID в основной таблице <br>
int USER_ID - привязка пользователя<br>
int ENTITY_TYPE - тип сущности<br>
int ENTITY_ID - id сущности<br>

### Методы:
```php
public static function clearResponsible(int $entityId, int $entityType, int $userId)
//Убирает пользователя из требующих реакции у определённой сущности

public static function clearResponsibleByEntity(int $entityId, int $entityType)
//Полностью очищает пользователей у определённой сущности. Используется в контроле задач и отчетов, тк там один ответственный.
```

Обработчики событий: <br>
--------
### MainEventHandler <br>
Главный обработчик, запускает модуль, подключает его скрипты на страницу. <br>
Реагирует на событие OnBeforeEndBufferContent <br>

NotifyEventsHandler <br>
---------
Служит для  отлова сообщений в сущностях. <br>

### Лайки
```php
public function OnAddRatingVote($id, $data) //срабатывет при нажатии кнопки "мне нравится", удаляет/помечает уведомления у пользователей.
```
### Задачи
```php
public function onTaskUpdate($taskId, $arData) //когда обновляется статус задачи
public function OnCommentAdd(int $taskId, array $arData)
public function OnCommentUpdate($taskId, array $arData)
protected static function sendTaskCommentNotify(
   int $messageId,
   int $taskId,
   int $to,
   int $from,
   string $nofity,
   $date,
   int $direction
)//добавляет в бд новый комментарий к задаче и шлёт пулл о изменении количества уведомлений
```
### Отчеты
```php
public function onAfterReportAdd($fields) //создаёт уведомление, когда отправлен отчёт
public function onAfterMessageDelete(int $id) //сейчас удаляет уведомления при удалении комментария в отчёте (сонете)
public function onReportCommentUpdate($id, $fields)
public function onReportComment($id, $fields)
public function OnAfterFullReportUpdate($reportId, $fields) //когда подтверждается отчёт, удаляет уведоление что нужно среагировать
protected static function sendReportNotify(
    int $reportId,
    int $to,
    int $from,
    string $nofity,
    string $date,
    int $direction
) //аналогия для отчётов
protected static function sendCommentReportNotify(
    int $messageId,
    int $logId,
    int $to,
    int $from,
    string $nofity,
    $date,
    int $direction
) //аналогия для комментариев отчётов

public function onDelete(int $taskId) //при удалении задачи удаляет её уведомления
public function OnCommentDelete($taskId, array $arData) //при удалении комментария в задаче
```
### Сонет
```php
 public function onSocLogComment($id, $fields)
 //при добавлении комментария в живой ленте, отсеивает события типа 'report_comment','tasks_comment') так как для них есть другие обработчики
 public function onSocNetCommentUpdate($id, $fields) //при редактировании комментария в сонете
 public function onSocNetCommentDelete($id) //удаление
 sendSocCommentNotify(...)// добавляет в бд новый комментарий к сонету и шлёт пулл о изменении количества уведомлений
 ```
 ### Crm
  С событиями CRM все не так однозначно. Эти комментарии нельзя лайкать, а событие добавления по сути бесполезно.
 Сами комментарии хранятся в таблице TimelineTable, а биндинг к сущностям в TimelineTableBinding. В момент добавления комментария биндинга в таблице ещё нет, так что это событие бесполезно, мы не можем узнать к чему относится комментарий в этот момент.
 События таблицы биндингов тоже бесполезны, битриксоиды вставляют туда данные примым запросом в функции Upsert этого датаменеджера и не генерируют события.
 Для отслеживания добавления комментариев был создан агент CrmCatchAgent, который раз в некоторое время ищет новые комментарии и создаёт для них уведомления. События update и delete работают нормально.
 Так как комментарии нельзя лайкать, единственный способ на них среагировать - ответить на него. Сообщение без упоминания другого сотрудника очистит уведомления.
 Если оставить комментарий и тут же его отредактировать, сработает событие update и уведомления сгенерируются раньше агента.
 ```php

 public function onTimeLineCommentAdd($fields)
 //Добавляет уведомление о комментарии в срм. Функция используется в агенте и в функции update
 public function onAfterCrmUpdate(Entity\Event $event)
 //Вызывается при обновлении комментария в crm
 public function onAfterCrmDelete(Entity\Event $event)
 //удаление
  sendCrmCommentNotify()
 //для создания соответствующих уведомлений
  ```

  ### БП
   Сейчас обрабатываются только задания бп.
  ```php
  public function OnBpTaskAdd($id, $fields)
  //Срабатывает при запуске пользователем бизнес процесса, пользователю и ответственным на текущем этапе сгенерируются уведомления для этого задания
  //Узнать кто и когда запустил бп можно в таблице WorkflowStateTable, она биндится по полю WORKFLOW_ID
  public function OnBpTaskMarkCompleted($id, $userId, $status)
  //срабатывет когда ответственный за задание среагировал (нажал кнопку одобрить, выдать, согласовать, etc). Приходит кто и где отметился и статус текущего задания. Если решение этого человека не влияет на бп, статус не меняется. (есть ещё с кем согласовать)
  public function OnBpTaskDelegate($taskId, $fromUserId, $toUserId)
  //задание можно делегировать на другого пользователя (подчинённого), прийдёт какое задание кто и на кого перебросил
  public function OnBpTaskUpdate($id, $fields)
  //Срабатывает когда у задания меняется статус. Все ответственные данного этапа согласовали или кто-то отменил.
  sendBpEntityNoty() //для создания соответствующих уведомлений
```
### Вспомогательные
```php
protected static function getUsersFromMessage($message) : array //выдёргивет упомянутых пользователей из текста сообщения
```
bizprofi-notify.js
-------
Основной и единственный js файл в котором происходят все визуальные манипуляции в модуле.


<br>
<br>
 [В содержание](./index.md "содержание")
