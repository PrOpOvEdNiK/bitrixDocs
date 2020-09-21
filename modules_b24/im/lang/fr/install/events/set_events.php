<?
$MESS["IM_NEW_MESSAGE_DESC"] = "#USER_ID# - ID utilisateur
#USER_LOGIN# - identifiant de l'utilisateur
#USER_NAME# - prénom de l'utilisateur
#USER_LAST_NAME# - nom de l'utilisateur
#FROM_USER# - prénom de l'expéditeur
#MESSAGES# - bloc de messages
#EMAIL_TO# - adresse email du destinataire";
$MESS["IM_NEW_MESSAGE_GROUP_DESC"] = "#USER_ID# - ID utilisateur
#USER_LOGIN# - identifiant de l'utilisateur
#USER_NAME# - prénom de l'utilisateur
#USER_LAST_NAME# - nom de l'utilisateur
#FROM_USERS# - prénoms des expéditeurs
#MESSAGES# - bloc des messages
#EMAIL_TO# - adresse email du destinataire";
$MESS["IM_NEW_MESSAGE_GROUP_MESSAGE"] = "Bonjour, #USER_NAME#!

Vous-avez des nouveaux messages instantanés des utilisateurs #FROM_USERS#.

#MESSAGES#

Aller aux dialogues : http://#SERVER_NAME#/?IM_DIALOG=Y
Vous pouvez modifier les paramètres de notification : http://#SERVER_NAME#/?IM_SETTINGS=NOTIFY

Ce message est généré automatiquement.";
$MESS["IM_NEW_MESSAGE_GROUP_NAME"] = "Nouveau message (groupe)";
$MESS["IM_NEW_MESSAGE_GROUP_SUBJECT"] = "#SITE_NAME# : Messages instantanés de #FROM_USERS#";
$MESS["IM_NEW_MESSAGE_MESSAGE"] = "Bonjour, #USER_NAME#!

Vous avez de nouveaux messages venu de l'utilisateur #FROM_USER#.

------------------------------------------
#MESSAGES#
------------------------------------------

Retour au dialogue avec l'utilisateur : http://#SERVER_NAME#/?IM_DIALOG=#USER_ID#
Vous pouvez modifier les paramètres de notifications : http://#SERVER_NAME#/?IM_SETTINGS=NOTIFY

Ce message est généré automatiquement.";
$MESS["IM_NEW_MESSAGE_NAME"] = "Nouveau message";
$MESS["IM_NEW_MESSAGE_SUBJECT"] = "#SITE_NAME# : Messages instantanés de #FROM_USER#";
$MESS["IM_NEW_NOTIFY_DESC"] = "#MESSAGE_ID# - ID message
#USER_ID# - ID utilisateur
#USER_LOGIN# - identifiant de l'utilisateur
#USER_NAME# - prénom de l'utilisateur
#USER_LAST_NAME# - nom de l'utilisateur
#FROM_USER_ID# - ID expéditeur du message
#FROM_USER# - prénom de l'expéditeur du message
#DATE_CREATE# - date de création du message
#TITLE# - titre du message
#MESSAGE# - message
#MESSAGE_50# - message, les 50 premiers symboles
#EMAIL_TO# - adresse email du destinataire de la lettre";
$MESS["IM_NEW_NOTIFY_GROUP_DESC"] = "#MESSAGE_ID# - ID message
#USER_ID# - ID utilisateur
#USER_LOGIN# - identifiant de l'utilisateur
#USER_NAME# -  prénom de l'utilisateur
#USER_LAST_NAME# - nom de l'utilisateur
#FROM_USERS# - noms des expéditeurs de message
#DATE_CREATE# - date de création du message
#TITLE# - en-tête du message
#MESSAGE# - texte de la notification
#MESSAGE_50# -texte de la notification, les 50 premiers caractères
#EMAIL_TO# - adresse email du destinataire de la lettre";
$MESS["IM_NEW_NOTIFY_GROUP_MESSAGE"] = "Bonjour, #USER_NAME#!

Vous avez une nouvelle notification de la part de l'utilisateur : #FROM_USERS#

------------------------------------------

#MESSAGE#

------------------------------------------

Aller aux notifications : http://#SERVER_NAME#/?IM_NOTIFY=Y
Vous pouvez modifier les paramètres des notifications :  http://#SERVER_NAME#/?IM_SETTINGS=NOTIFY

Cette lettre a été générée automatiquement.";
$MESS["IM_NEW_NOTIFY_GROUP_NAME"] = "Une nouvelle notification (de groupe)";
$MESS["IM_NEW_NOTIFY_GROUP_SUBJECT"] = "#SITE_NAME# : Avis \"#MESSAGE_50#\"";
$MESS["IM_NEW_NOTIFY_MESSAGE"] = "Bonjour, #USER_NAME#!

Vous avez une nouvelle notification de l'utilisateur #FROM_USER#

------------------------------------------

#MESSAGE#

------------------------------------------

Voir la notification : http://#SERVER_NAME#/?IM_NOTIFY=Y
Vous pouvez changer les paramètres de notification : http://#SERVER_NAME#/?IM_SETTINGS=NOTIFY

Ce message a été généré automatiquement.";
$MESS["IM_NEW_NOTIFY_NAME"] = "Nouvelle notification";
$MESS["IM_NEW_NOTIFY_SUBJECT"] = "#SITE_NAME# : Avis \"#MESSAGE_50#\"";
?>