��������� ������������� ���������� � initialize_reaction(), ���������� ���������� ������ �� ������ � ������������� ������ ReactionNotify.

ReactionNotify
======
�������� js ����� ������. <br>
�������� �������:
* [init](#init "init")
* [setCommonCount](#setCommonCount "setCommonCount")
* [initBlockTimeMan](#initBlockTimeMan "initBlockTimeMan")
* [showPopup](#showPopup "showPopup")
* [showAlertPopup](#showAlertPopup "showAlertPopup")
* [pluralize](#pluralize "pluralize")
* [setCount](#setCount "setCount")

�������� �������
=========

### <a name="init"></a> init()
�������������� ���������, ��������� ����� ��� ������������ � IM, ������������� �� ������� `onPullEvent-reaction` ��� ��������� ��������� ����������� pull ���������, ������������� �� ������� onImDrawTab ��� ���������� ��������� ���� ������������.
### <a name="setCommonCount"></a>setCommonCount = function (count) [setCommonCount] ##
������������ ��� ��������� ������ �������� ����������� "���������� �������" �� �������
### <a name="initBlockTimeMan"></a>initBlockTimeMan
�������������� ���������� �������� ��� ���� ���� �������������� ����������� � ����� �������� � ���������� ������
### <a name="showPopup"></a>showPopup = function (count)
���������� ����� ���������� �������� ���
### <a name="showAlertPopup"></a>showAlertPopup = function (count)
 ���������� ����� �������������� ����������� � ������� �����������
### <a name="pluralize"></a>pluralize = function ($n, $forms)
������������ ��� ����������� ��������� ����� (�����������, �����������, �����������)
### <a name="setCount"></a>setCount = function (count, allCounters)
����� ������� ��� ��������� ���� ����� ���������

������
=====
 �� ������� ������ ������ ������ ����������� ������ ����� jquery, ��� ������� ����������� ������� � �������������.<br>
 ���������� ����������� ������� ���������� ��� ������������� (� maineventshandler) � ����� �������� pull ��������� ��� ��������� ����������.
 ���� �������� ����� ������������� �����������, ��� � ����������� ���������� ����� ������������ ����� �������������� �����������. <br>
 ���� �������� ����� ������� �������� ���, �� ��� ������� ����������� ����� ������������ ����� ���������� �������� ���, ������ ���������� ��� ����� �������������� ���� �� ����� ����������� ��� �����������.<br>
<br>
<br>
 [� ����������](./index.md "����������")
