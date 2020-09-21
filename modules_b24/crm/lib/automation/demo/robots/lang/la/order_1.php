<?
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ALLOW_DELIVERY_TITLE"] = "Permitir la entrega";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_EMAIL_TITLE"] = "Enviar mensaje";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_FOOTER"] = "Saludos cordiales,<br> #A1#Online store#A2#";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_1_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Estimado (-a) {=Document:CONTACT.NAME} {=Document:CONTACT.SECOND_NAME} {=Document:CONTACT.LAST_NAME},
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Su pedido #{=Document:ACCOUNT_NUMBER} desde {=Document:DATE_INSERT} ha sido confirmado.<br>
<br>
Total del pedido: {=Document:PRICE_FORMATTED}.<br>
<br>
Puede hacerle seguimiento al pedido en su cuenta en {=Document:SHOP_TITLE}.<br>
<br>
Tenga en cuenta que necesitará su nombre de usuario y contraseña que usó para registrarse {=Document:SHOP_TITLE}.<br>
<br>
Si desea cancelar su pedido, puede hacerlo en su cuenta personal.<br>
<br>
Por favor, asegúrese de mencionar su pedido #{=Document:ACCOUNT_NUMBER}siempre que contacte {=Document:SHOP_TITLE} administración.<br>
<br>
¡Gracias por su pedido!<br></p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_1_TITLE"] = "Ha realizado un pedido con {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_2_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Estimado {=Document:CONTACT.NAME} {=Document:CONTACT.SECOND_NAME} {=Document:CONTACT.LAST_NAME},
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Usted ha colocado el pedido #{=Document:ACCOUNT_NUMBER} desde {=Document:DATE_INSERT} para {=Document:PRICE_FORMATTED}.<br>
<br>
Lamentablemente todavía no lo ha pagado.<br>
<br>
Puede hacerle seguimiento a su pedido en su cuenta en {=Document:SHOP_TITLE}.<br>
<br>
Tenga en cuenta que necesitará su nombre de usuario y contraseña que usó para registrarse {=Document:SHOP_TITLE}.<br>
<br>
Si desea cancelar su pedido, puede hacerlo en su cuenta personal.<br>
<br>
Por favor, asegúrese de mencionar su pedido  #{=Document:ACCOUNT_NUMBER} siempre que contacte {=Document:SHOP_TITLE} administración.<br>
<br>
¡Gracias por su pedido!<br></p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_2_TITLE"] = "No olvide pagar su pedido con {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_3_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Pedido #{=Document:ACCOUNT_NUMBER} de {=Document:DATE_INSERT} ha sido pagado.
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Usa este enlace para más información: {=Document:SHOP_PUBLIC_URL}</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_3_TITLE"] = "Su pago por el pedido con {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_4_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Pedido #{=Document:ACCOUNT_NUMBER} de {=Document:DATE_INSERT} ha sido cancelado.
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
{=Document:REASON_CANCELED}<br>
<br>
Usa este enlace para más información: {=Document:SHOP_PUBLIC_URL}</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_4_TITLE"] = "{=Document:SHOP_TITLE}: Cancelar pedido #{=Document:ACCOUNT_NUMBER";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_NEW_ORDER_PAYMENT_TITLE"] = "{=Document:SHOP_TITLE}: Recordatorio de pago del pedido #{=Document:ACCOUNT_NUMBER";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_NEW_ORDER_TITLE"] = "{=Document:SHOP_TITLE}: Nuevo pedido #{=Document:ACCOUNT_NUMBER";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ORDER_CANCELED_TITLE"] = "{=Document:SHOP_TITLE}: Cancelar pedido #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ORDER_PAYED_TITLE"] = "{=Document:SHOP_TITLE}: Pedido #{=Document:ACCOUNT_NUMBER} ha sido pagado.";
?>