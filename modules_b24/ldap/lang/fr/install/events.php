<?
$MESS["LDAP_USER_CONFIRM_EVENT_DESC"] = "Message d'information du site #SITE_NAME#
------------------------------------------
Bonjour !

Vous avez reçu ce message parce que votre adresse avait été utilisée lors de l'inscription du nouvel utilisateur au serveur #SERVER_NAME#.

Pour valider l'inscription, il faut s'autoriser (entrer le nom d'utilisateur et le mot de passe utilisés dans le réseau local) sur la page suivante:
http://#SERVER_NAME#/bitrix/admin/ldap_user_auth.php?ldap_user_id=#XML_ID#&back_url=#BACK_URL#

Ce message a été généré automatiquement.";
$MESS["LDAP_USER_CONFIRM_EVENT_NAME"] = "#SITE_NAME# : Confirmation de l'enregistrement";
$MESS["LDAP_USER_CONFIRM_TYPE_DESC"] = "#USER_ID# - ID utilisateur
#EMAIL# - Adresse email
#LOGIN# - Identifiant
#XML_ID# -Identificateur externe
#BACK_URL# - Lien du contact";
$MESS["LDAP_USER_CONFIRM_TYPE_NAME"] = "Confirmation de l'inscription";
?>