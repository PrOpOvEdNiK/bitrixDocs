Первичная инициализация происходит в initialize_reaction(), происходит добавление иконки на панель и инициализация класса ReactionNotify.

ReactionNotify
======
Основной js класс модуля. <br>
Содержит функции:
* [init](#init "init")
* [setCommonCount](#setCommonCount "setCommonCount")
* [initBlockTimeMan](#initBlockTimeMan "initBlockTimeMan")
* [showPopup](#showPopup "showPopup")
* [showAlertPopup](#showAlertPopup "showAlertPopup")
* [pluralize](#pluralize "pluralize")
* [setCount](#setCount "setCount")

Описание методов
=========

### <a name="init"></a> init()
Инициализирует параметры, добавляет новый таб реагирования в IM, подписывается на событие `onPullEvent-reaction` для изменения счетчиков уведомлений pull событиями, подписывается на событие onImDrawTab для корректной отрисовки окна реагирования.
### <a name="setCommonCount"></a>setCommonCount = function (count) [setCommonCount] ##
используется для установки общего счетчика уведомлений "необходима реакция" на вкладке
### <a name="initBlockTimeMan"></a>initBlockTimeMan
инициализирует блокировку рабочего дня если есть необработанные уведомления и опция включена в настройках модуля
### <a name="showPopup"></a>showPopup = function (count)
показывает попап блокировки рабочего дня
### <a name="showAlertPopup"></a>showAlertPopup = function (count)
 показывает попап периодического уведомления о наличии уведомлений
### <a name="pluralize"></a>pluralize = function ($n, $forms)
используется для определения окончания слова (уведомление, уведомлений, уведомления)
### <a name="setCount"></a>setCount = function (count, allCounters)
общая функция для установки всех типов счетчиков

Работа
=====
 На вкладку справа кнопка робота добавляется просто через jquery, при нажатии открывается слайдер с уведомлениями.<br>
 Количество уведомлений задаётся изначально при инициализации (в maineventshandler) и далее меняется pull запросами при изменении количества.
 Если включена опция периодических уведомлений, раз в определённый промежуток будет показываться попап периодического уведомления. <br>
 Если включена опция запрета рабочего дня, то при наличии уведомлений будет показываться попап блокировки рабочего дня, кнопка завершения дня будет заблокированна пока не будут обработанны все уведомления.<br>
<br>
<br>
 [В содержание](./index.md "содержание")
