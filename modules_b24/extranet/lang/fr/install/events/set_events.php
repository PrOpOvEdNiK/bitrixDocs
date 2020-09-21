<?
$MESS["EXTRANET_INVITATION_DESC"] = "#CHECKWORD# - Ligne de commande
#USER_ID# - ID utilisateur
#EMAIL# - Adresse email de l'utilisateur
#SITE_NAME# - Nom du site
#SERVER_NAME# - URL du site (sans http://)";
$MESS["EXTRANET_INVITATION_MESSAGE"] = "Message venu du #SITE_NAME#
------------------------------------------

Vous êtes invités au site. Pour confirmer votre inscription et créer un mot de passe veuillez suivre ce lien:
http://#SERVER_NAME#/extranet/confirm/?checkword=#CHECKWORD#&user_id=#USER_ID#

Ce message a été généré automatiquement.";
$MESS["EXTRANET_INVITATION_NAME"] = "Invitation du nouveau utilisateur au site";
$MESS["EXTRANET_INVITATION_SUBJECT"] = "#SITE_NAME# : Vous êtes invité au site";
$MESS["EXTRANET_WG_FROM_ARCHIVE_DESC"] = "#WG_ID# - ID du groupe de travail
#WG_NAME# - Nom du groupe de travail
#MEMBER_EMAIL# - Adresses email des membres du groupe de travail
#SITE_NAME# - Nom du site";
$MESS["EXTRANET_WG_FROM_ARCHIVE_MESSAGE"] = "Message d'information du site #SITE_NAME#
------------------------------------------

Bonjour, #MEMBER_NAME#

Le groupe de travail '#WG_NAME#' [#WG_ID#] est retiré de l'archive sur le site #SITE_NAME#.
---------------------------------------------------------------------------

Les données de ce groupe de travail sont maintenant de nouveau disponibles pour les modifications.

Pour aller au groupe de travail cliquez sur le lien:
http://#SERVER_NAME#/extranet/workgroups/group/#WG_ID#/

Message généré automatiquement.";
$MESS["EXTRANET_WG_FROM_ARCHIVE_NAME"] = "Le groupe de travail est sorti des archives.";
$MESS["EXTRANET_WG_FROM_ARCHIVE_SUBJECT"] = "#SITE_NAME# : Le groupe de travail '#WG_NAME#' a été retiré des archives.";
$MESS["EXTRANET_WG_TO_ARCHIVE_DESC"] = "#WG_ID# - ID du groupe de travail
#WG_NAME# - Nom du groupe de travail
#MEMBER_EMAIL# - Adresses email des membres du groupe de travail
#SITE_NAME# - Nom du site";
$MESS["EXTRANET_WG_TO_ARCHIVE_MESSAGE"] = "Message d'information du site #SITE_NAME#
------------------------------------------

Bonjour, #MEMBER_NAME#!

Le groupe de travail '#WG_NAME#' [#WG_ID#] est déplacé aux archives sur le site #SITE_NAME#.
---------------------------------------------------------------------------

Dès lors, les données de ce groupe de travail ne sont accessibles que pour la consultation.

Pour consulter le groupe de travail, suivez le lien:
http://#SERVER_NAME#/extranet/workgroups/group/#WG_ID#/

Cette lettre a été générée automatiquement.";
$MESS["EXTRANET_WG_TO_ARCHIVE_NAME"] = "Le groupe de travail est déplacé à l'archive.";
$MESS["EXTRANET_WG_TO_ARCHIVE_SUBJECT"] = "#SITE_NAME# : Le groupe de travail '#WG_NAME#' a été déplacé aux archives.";
?>