<?
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ALLOW_DELIVERY_TITLE"] = "Permitir entrega";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_EMAIL_TITLE"] = "Enviar mensagem";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_FOOTER"] = "Atenciosamente,<br> #A1#Loja online#A2#";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_1_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Prezado {=Document:CONTACT.NAME} {=Document:CONTACT.SECOND_NAME} {=Document:CONTACT.LAST_NAME},
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Seu pedido #{=Document:ACCOUNT_NUMBER} de {=Document:DATE_INSERT} foi confirmado.<br>
<br>
Total do pedido: {=Document:PRICE_FORMATTED}.<br>
<br>
Você pode acompanhar o andamento do pedido na sua conta em {=Document:SHOP_TITLE}.<br>
<br>
Observe que você precisará do seu login e senha usados para registrar-se em {=Document:SHOP_TITLE}.<br>
<br>
Se deseja cancelar seu pedido, você pode fazer isso na sua conta pessoal.<br>
<br>
Por favor, certifique-se de mencionar seu pedido #{=Document:ACCOUNT_NUMBER} sempre que entrar em contato com a administração de {=Document:SHOP_TITLE}.<br>
<br>
Obrigado pelo seu pedido!<br>
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_1_TITLE"] = "Você fez um pedido com {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_2_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Prezado {=Document:CONTACT.NAME} {=Document:CONTACT.SECOND_NAME} {=Document:CONTACT.LAST_NAME},
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Você fez o pedido #{=Document:ACCOUNT_NUMBER} em {=Document:DATE_INSERT} de {=Document:PRICE_FORMATTED}.<br>
<br>
Infelizmente, você ainda não pagou.<br>
<br>
Você pode acompanhar o andamento do pedido na sua conta em {=Document:SHOP_TITLE}.<br>
<br>
Observe que você precisará do seu login e senha usados para registrar-se em {=Document:SHOP_TITLE}.<br>
<br>
Se deseja cancelar seu pedido, você pode fazer isso na sua conta pessoal.<br>
<br>
Por favor, certifique-se de mencionar seu pedido #{=Document:ACCOUNT_NUMBER} sempre que entrar em contato com a administração de {=Document:SHOP_TITLE}.<br>
<br>
Obrigado pelo seu pedido!<br>
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_2_TITLE"] = "Não se esqueça de pagar seu pedido com {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_3_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Pedido #{=Document:ACCOUNT_NUMBER} de {=Document:DATE_INSERT} foi pago.
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Use este link para obter mais informações: {=Document:SHOP_PUBLIC_URL}
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_3_TITLE"] = "Seu pagamento do pedido com {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_4_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Pedido #{=Document:ACCOUNT_NUMBER} de {=Document:DATE_INSERT} foi cancelado.
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
{=Document:REASON_CANCELED}<br>
<br>
Use este link para obter mais informações: {=Document:SHOP_PUBLIC_URL}
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_4_TITLE"] = "{=Document:SHOP_TITLE}: Cancelar pedido #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_NEW_ORDER_PAYMENT_TITLE"] = "{=Document:SHOP_TITLE}: Lembrete de pagamento do pedido #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_NEW_ORDER_TITLE"] = "{=Document:SHOP_TITLE}: Novo pedido #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ORDER_CANCELED_TITLE"] = "{=Document:SHOP_TITLE}: Cancelar pedido #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ORDER_PAYED_TITLE"] = "{=Document:SHOP_TITLE}: O pedido #{=Document:ACCOUNT_NUMBER} foi pago.";
?>