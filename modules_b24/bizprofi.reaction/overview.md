��� ��������. <br>
=========
����������� ������� ����� ������� ����������, �������� � �������������� ������������ � ��������� � ��������� ��������� (������, ������).
 ����� ��������� ������� ������ ������������ � ��������������� �������. � ������� ������� OnBeforeEndBufferContent �� ������ ��������� ������������ � ���������������� ��������������� ������� js ������, ������� �������� �� ����������� ��������� � �������������� � �������������.
 ��������� ���������� ������������� � ����������� IM � ��������� �������� ������� �����������. ���������� ����������� ������� �� ������������ (������� �������, ����� ������������) � �� ��������� (������ �� ���������, ������, �����������). �� ������������ � ��������� �������� ����������.
 ��� ��������� ���������� ����������� ������ �������� pull-������ � ������� � ��������� ������ �� ����������. ���������� ���������/������������ ��������� - 20 ����, ���� ����������� ������, ��������� ������ ��������� �����������. �������� ����������� � �������� ������������ ajax-��������.<br>
 � ������ ������������� ����������� ����������� ����������� ������� ����, ���� � ������������ ���� �������������� �����������, ������������� � ���������� ������. <br>
 � ������ ������������ ����� ������������� ����������� �����-����� � ���������� ��������� ������� �����������. <br>

<a name="composition"></a>�� ���� �������. <br>
=========
�������: <br>
-------
### NotificationTable <br>
�������� �������, � ������� �������� ����������� <br>
####  ����: <br>
ID <br>
int FROM_USER - �� ���� ����������� <br>
int TO_USER - ���� ����������� <br>
string NOTIFICATION - ������ � �� ����������� ������� �����������, ������ ���� �������, ��������� ������������ ����������� <br>
Datetime   DATE   - ���� �������� ����������� <br>
int DIRECTION - ����������� ������, �������� ����������� <br>
```php
const NEED_REACTION = 2;
const WAIT_REACTION = 1;
```

#### � ������������� ���� ������� ����� ����� ������� ��� ��������� ����������� � �������:<br>
```php
public static function isExistNoty(int $userId, $entityType, $entityId)// ��������� ��������� ���������� �� ����������� �� id ������������, ���� �������� � id ��������. �������� ������� � ������� ���������.
public static function getAllCounters(array $users) : array //��������� �������� �������� ���� ��������� ��������� ��� ������� �������������
public static function getCountByUserIds(array $ids, bool $sendPull = true): array  //��������� �������� ��� �������� �� ������������ � ���������, � ��� �� ��������� �� ����-�������� �������������, $deleteKeys ��������� ������ ����� ����������� ���� ������� � ������������, ����� ��� ��������� � ���� �� ���� ������������ �������������
 public static function clearEntityById(int $id, int $entityType, int $direction = 0) //������� ����������� �� id,type �������� � �����������
 public static function clearEntityByUser(array $ids, int $entityType, int $etityId, int $direction = 0) //������� ����������� ��� ������ ������������� ��� ���������� ��������
 public static function deleteAllWaitReaction(int $user) //������� ��� ����������� ��������� ������� � ������������ (��� ������ ������� ���)
```

NotificationBindingTable
---------
������� ��������� �����������
������ � ���� ������������ ����� ������������� � ����������. ��� �������� ����������� ������ � ���� ������� ��������� ��������.
### ����:
```php
int NOTIFICATION_ID //����� � ID � �������� �������
int ENTITY_ID //id ��������
int ENTITY_TYPE  //��� ��������, ������� �����������:
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
const DONT_USE_IT_RESERVED_FOR_ENTITY_FILTER = 12; // ��� 12 �������������� � ������������ ��� ������� �� ���� ������������
```
������ ���.

NotificationResponsibleTable
-------
������ �������������, ������� ������� ������� ��������. ���� � �������� ��������� ������� ��� ������� � ���� ������� - ��� ��������� �� ��������� ������� � � �� ���������� ������ ���������. <br>
���������� ������������� ��� �������� (�����������) ���������� ��� ��������� � notifygenerator � ����������� � js, ���� >0, ���������� ���, ����� ����.
������������� ����������� ��� �������� �����������, ������� �� ���������� �������������, ��� �������� �����/������� ������ ���, ���� �������� �����������. <br>
### ����:
int NOTIFICATION_ID - ����� � ID � �������� ������� <br>
int USER_ID - �������� ������������<br>
int ENTITY_TYPE - ��� ��������<br>
int ENTITY_ID - id ��������<br>

### ������:
```php
public static function clearResponsible(int $entityId, int $entityType, int $userId)
//������� ������������ �� ��������� ������� � ����������� ��������

public static function clearResponsibleByEntity(int $entityId, int $entityType)
//��������� ������� ������������� � ����������� ��������. ������������ � �������� ����� � �������, �� ��� ���� �������������.
```

����������� �������: <br>
--------
### MainEventHandler <br>
������� ����������, ��������� ������, ���������� ��� ������� �� ��������. <br>
��������� �� ������� OnBeforeEndBufferContent <br>

NotifyEventsHandler <br>
---------
������ ���  ������ ��������� � ���������. <br>

### �����
```php
public function OnAddRatingVote($id, $data) //���������� ��� ������� ������ "��� ��������", �������/�������� ����������� � �������������.
```
### ������
```php
public function onTaskUpdate($taskId, $arData) //����� ����������� ������ ������
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
)//��������� � �� ����� ����������� � ������ � ��� ���� � ��������� ���������� �����������
```
### ������
```php
public function onAfterReportAdd($fields) //������ �����������, ����� ��������� �����
public function onAfterMessageDelete(int $id) //������ ������� ����������� ��� �������� ����������� � ������ (������)
public function onReportCommentUpdate($id, $fields)
public function onReportComment($id, $fields)
public function OnAfterFullReportUpdate($reportId, $fields) //����� �������������� �����, ������� ���������� ��� ����� ������������
protected static function sendReportNotify(
    int $reportId,
    int $to,
    int $from,
    string $nofity,
    string $date,
    int $direction
) //�������� ��� �������
protected static function sendCommentReportNotify(
    int $messageId,
    int $logId,
    int $to,
    int $from,
    string $nofity,
    $date,
    int $direction
) //�������� ��� ������������ �������

public function onDelete(int $taskId) //��� �������� ������ ������� � �����������
public function OnCommentDelete($taskId, array $arData) //��� �������� ����������� � ������
```
### �����
```php
 public function onSocLogComment($id, $fields)
 //��� ���������� ����������� � ����� �����, ��������� ������� ���� 'report_comment','tasks_comment') ��� ��� ��� ��� ���� ������ �����������
 public function onSocNetCommentUpdate($id, $fields) //��� �������������� ����������� � ������
 public function onSocNetCommentDelete($id) //��������
 sendSocCommentNotify(...)// ��������� � �� ����� ����������� � ������ � ��� ���� � ��������� ���������� �����������
 ```
 ### Crm
  � ��������� CRM ��� �� ��� ����������. ��� ����������� ������ �������, � ������� ���������� �� ���� ����������.
 ���� ����������� �������� � ������� TimelineTable, � ������� � ��������� � TimelineTableBinding. � ������ ���������� ����������� �������� � ������� ��� ���, ��� ��� ��� ������� ����������, �� �� ����� ������ � ���� ��������� ����������� � ���� ������.
 ������� ������� ��������� ���� ����������, ����������� ��������� ���� ������ ������ �������� � ������� Upsert ����� ������������� � �� ���������� �������.
 ��� ������������ ���������� ������������ ��� ������ ����� CrmCatchAgent, ������� ��� � ��������� ����� ���� ����� ����������� � ������ ��� ��� �����������. ������� update � delete �������� ���������.
 ��� ��� ����������� ������ �������, ������������ ������ �� ��� ������������ - �������� �� ����. ��������� ��� ���������� ������� ���������� ������� �����������.
 ���� �������� ����������� � ��� �� ��� ���������������, ��������� ������� update � ����������� ������������� ������ ������.
 ```php

 public function onTimeLineCommentAdd($fields)
 //��������� ����������� � ����������� � ���. ������� ������������ � ������ � � ������� update
 public function onAfterCrmUpdate(Entity\Event $event)
 //���������� ��� ���������� ����������� � crm
 public function onAfterCrmDelete(Entity\Event $event)
 //��������
  sendCrmCommentNotify()
 //��� �������� ��������������� �����������
  ```

  ### ��
   ������ �������������� ������ ������� ��.
  ```php
  public function OnBpTaskAdd($id, $fields)
  //����������� ��� ������� ������������� ������ ��������, ������������ � ������������� �� ������� ����� ������������� ����������� ��� ����� �������
  //������ ��� � ����� �������� �� ����� � ������� WorkflowStateTable, ��� �������� �� ���� WORKFLOW_ID
  public function OnBpTaskMarkCompleted($id, $userId, $status)
  //���������� ����� ������������� �� ������� ����������� (����� ������ ��������, ������, �����������, etc). �������� ��� � ��� ��������� � ������ �������� �������. ���� ������� ����� �������� �� ������ �� ��, ������ �� ��������. (���� ��� � ��� �����������)
  public function OnBpTaskDelegate($taskId, $fromUserId, $toUserId)
  //������� ����� ������������ �� ������� ������������ (�����������), ������ ����� ������� ��� � �� ���� ����������
  public function OnBpTaskUpdate($id, $fields)
  //����������� ����� � ������� �������� ������. ��� ������������� ������� ����� ����������� ��� ���-�� �������.
  sendBpEntityNoty() //��� �������� ��������������� �����������
```
### ���������������
```php
protected static function getUsersFromMessage($message) : array //��������� ���������� ������������� �� ������ ���������
```
bizprofi-notify.js
-------
�������� � ������������ js ���� � ������� ���������� ��� ���������� ����������� � ������.


<br>
<br>
 [� ����������](./index.md "����������")
