<?
$MESS["SUBSCRIBE_CONFIRM_DESC"] = "#ID# - ID signature
#EMAIL# - adresse de l'abonnement
#CONFIRM_CODE# - code de confirmation
#SUBSCR_SECTION# - la section où se trouve la page de rédaction de l'abonnement (données définies déterminées dans les paramètres)
#USER_NAME# -  nom de l'abonné (facultatif)
#DATE_SUBSCR# - date de l'ajout/changements d'adresse";
$MESS["SUBSCRIBE_CONFIRM_MESSAGE"] = "Message venu du site #SITE_NAME#
------------------------------------------

Bonjour,

Vous avez reçu ce message parce que votre adresse email figure sur la liste de diffusion à partir du serveur #SERVER_NAME#.

Renseignements supplémentaires sur l'abonnement:

Adresse email (email)............ #EMAIL#
Date de création/modification.... #DATE_SUBSCR#

Votre code de cofirmation d'abonnement : #CONFIRM_CODE#

Pour confirmer votre abonnement, cliquez sur le lien suivant:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#

Vous pouvez également entrer le code de confirmation d'abonnement sur la page:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#

Attention ! Vous ne commencerez à recevoir les messages qu'après la confirmation de
votre abonnement.

---------------------------------------------------------------------
Veuillez garder cet Adresse emailcar il contient les renseignements relaitfs à votre autorisation.
En utilisant le code de confirmation de votre abonnement, vous pourrez modifier les paramètres
d'abonnement ou se désabonner.

Modifier les paramètres:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#

Se désabonner:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#&action=unsubscribe
---------------------------------------------------------------------

Ce message a été généré automatiquement.";
$MESS["SUBSCRIBE_CONFIRM_NAME"] = "Confirmation de l'abonnement";
$MESS["SUBSCRIBE_CONFIRM_SUBJECT"] = "#SITE_NAME# : Confirmation de l'abonnement";
?>