<?
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ALLOW_DELIVERY_TITLE"] = "Autoriser la livraison";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_EMAIL_TITLE"] = "Envoyer un message";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_FOOTER"] = "Cordialement,<br> #A1#La boutique en ligne#A2#";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_1_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Cher/chère {=Document:CONTACT.NAME} {=Document:CONTACT.SECOND_NAME} {=Document:CONTACT.LAST_NAME},
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Votre commande #{=Document:ACCOUNT_NUMBER} du {=Document:DATE_INSERT} a été confirmée.<br>
<br>
Total de la commande : {=Document:PRICE_FORMATTED}.<br>
<br>
Vous pouvez suivre son évolution depuis votre compte sur {=Document:SHOP_TITLE}.<br>
<br>
Veuillez noter que vous aurez besoin de l'identifiant et du mot de passe utilisés pour vous inscrire sur {=Document:SHOP_TITLE}.<br>
<br>
Si vous souhaitez annuler votre commande, vous pouvez le faire depuis votre compte.<br>
<br>
Pensez bien à préciser votre numéro de commande (#{=Document:ACCOUNT_NUMBER}) quand vous contactez l'administration de {=Document:SHOP_TITLE}.<br>
<br>
Merci pour votre commande !<br>
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_1_TITLE"] = "Vous avez passé une commande avec {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_2_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
Cher/chère {=Document:CONTACT.NAME} {=Document:CONTACT.SECOND_NAME} {=Document:CONTACT.LAST_NAME},
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Vous avez effectué une commande (numéro : #{=Document:ACCOUNT_NUMBER}) de {=Document:PRICE_FORMATTED} le {=Document:DATE_INSERT}.<br>
<br>
Vous ne l'avez malheureusement pas encore payée.<br>
<br>
Vous pouvez suivre son évolution depuis votre compte sur {=Document:SHOP_TITLE}.<br>
<br>
Veuillez noter que vous aurez besoin de l'identifiant et du mot de passe utilisés pour vous inscrire sur {=Document:SHOP_TITLE}.<br>
<br>
Si vous souhaitez annuler votre commande, vous pouvez le faire depuis votre compte.<br>
<br>
Pensez bien à préciser votre numéro de commande (#{=Document:ACCOUNT_NUMBER}) quand vous contactez l'administration de {=Document:SHOP_TITLE}.<br>
<br>
Merci pour votre commande !<br>
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_2_TITLE"] = "N'oubliez pas de payer la commande passée sur {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_3_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
La commande #{=Document:ACCOUNT_NUMBER} du {=Document:DATE_INSERT} a été payée.
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
Utilisez ce lien pour obtenir plus d'informations : {=Document:SHOP_PUBLIC_URL}
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_3_TITLE"] = "Votre paiement pour votre commande chez {=Document:SHOP_TITLE}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_4_BODY"] = "<p style=\"margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;\">
La commande #{=Document:ACCOUNT_NUMBER} du {=Document:DATE_INSERT} a été annulée.
</p>
<p style=\"margin-top: 0; margin-bottom: 20px; line-height: 20px;\">
{=Document:REASON_CANCELED}<br>
<br>
Utilisez ce lien pour obtenir plus d'informations : {=Document:SHOP_PUBLIC_URL}
</p>";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_MAIL_4_TITLE"] = "{=Document:SHOP_TITLE} : Annulation de la commande #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_NEW_ORDER_PAYMENT_TITLE"] = "{=Document:SHOP_TITLE} : Rappel du paiement de la commande #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_NEW_ORDER_TITLE"] = "{=Document:SHOP_TITLE} : Nouvelle commande #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ORDER_CANCELED_TITLE"] = "{=Document:SHOP_TITLE} : Annulation de la commande #{=Document:ACCOUNT_NUMBER}";
$MESS["CRM_AUTOMATION_DEMO_ORDER_1_ORDER_PAYED_TITLE"] = "{=Document:SHOP_TITLE} : La commande #{=Document:ACCOUNT_NUMBER} a été payée.";
?>