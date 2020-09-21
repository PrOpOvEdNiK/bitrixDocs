<?
$MESS["SUBSCRIBE_CONFIRM_DESC"] = "#ID# - ID de la suscripción
#EMAIL# - email de suscripción
#CONFIRM_CODE# - código de confirmación
#SUBSCR_SECTION# - sección con suscripción de la página(especificar las configuraciones)
#USER_NAME# - nombre del suscriptor (puede estar ausente)
#DATE_SUBSCR# - fecha de adición/cambio de dirección";
$MESS["SUBSCRIBE_CONFIRM_MESSAGE"] = "Mensaje interno de #SITE_NAME#
---------------------------------------

Hola,

Usted ha recibido este mensaje por que su dirección está suscrita para noticias desde #SERVER_NAME#.

Aquí está la información al detalle sobre sus suscripción:

email de suscripción .............. #EMAIL#
Fecha del mail adición/edición .... #DATE_SUBSCR#

Su código de confirmación: #CONFIRM_CODE#

Por favor visite el link de este mensaje para confirmar su suscripción
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#

O vaya a esta página e ingrese su código de confirmación manualmente:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#

Usted no podrá recibir ningún mensaje hasta que nos envíe su confirmación.

---------------------------------------------------------------------
Por favor guarde este mensaje puesto que contiene información sobre la autorización
Usando su código de confirmación usted podrá cambiar los parámetros de la suscripción.
Editar parámetros:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#

No suscribir:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#&action=unsubscribe
---------------------------------------------------------------------

Este mensaje fue generado automáticamente.";
$MESS["SUBSCRIBE_CONFIRM_NAME"] = "Confirmación de suscripción";
$MESS["SUBSCRIBE_CONFIRM_SUBJECT"] = "#SITE_NAME#: Confirmación de suscripción";
?>