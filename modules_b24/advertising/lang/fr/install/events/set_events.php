<?
$MESS["ADV_BANNER_STATUS_CHANGE_DESC"] = "#EMAIL_TO# - Adresse email du destinataire du message #OWNER_EMAIL#
#ADMIN_EMAIL# - Adresse email des utilisateurs ayant le rôle de 'gestionnaire des bannières' et 'administrateurs'
#ADD_EMAIL# - Adresse email des utilisateurs ayant accès à la gestion des bannières du contrat
#STAT_EMAIL# - Adresse email des utilisateurs ayant accès à l'examen des bannières du contrat
#EDIT_EMAIL# - Adresse email des utilisateurs ayant accès à la modification de certains champs du contrat
#OWNER_EMAIL# - Adresse email des utilisateurs ayant accès à certains droits du contrat
#BCC# - copie cachée (#ADMIN_EMAIL#)
#ID# - ID de la bannière
#CONTRACT_ID# - ID du contrat
#CONTRACT_NAME# - titre du contrat
#TYPE_SID# - ID du type
#TYPE_NAME# - titre du type
#STATUS# - statut
#STATUS_COMMENTS# - commentaire pour le statut
#NAME# - titre de la bannnière
#GROUP_SID# - groupe de bannière
#INDICATOR# - est-ce que la bannière est affichée sur le site ?
#ACTIVE# - drapeau d'activité de la bannière [Y | N]
#MAX_SHOW_COUNT# - nombre maximal d'affichages de la bannière
#SHOW_COUNT# - combien de fois la bannière a été affichée sur le site
#MAX_CLICK_COUNT# - nombre maximal de clics sur la bannière
#CLICK_COUNT# - nombre de clics sur la bannière
#DATE_LAST_SHOW# - date du dernier affichage de la bannière
#DATE_LAST_CLICK# - date du dernier clic sur la bannière
#DATE_SHOW_FROM# - date de début d'affichage de la bannière
#DATE_SHOW_TO# - date de fin d'affichage de la bannière
#IMAGE_LINK# - lien sur l'image de la bannière
#IMAGE_ALT# - texte de l'info-bulle sur l'image
#URL# - URL sur l'image
#URL_TARGET# - où dérouler l'URL de l'image
#CODE# - code de la bannière
#CODE_TYPE# - type de code de la bannière (text | html)
#COMMENTS# - commentaire pour la bannière
#DATE_CREATE# - date de création de la bannière
#CREATED_BY# - qui a créé la bannière
#DATE_MODIFY# - date de modification de la bannière
#MODIFIED_BY# - qui a modifié la bannière
#STAT_EMAIL# - EMail des utilisateurs ayant le droit d'examen des bannières du contrat
#EDIT_EMAIL# - EMail des utilisateurs ayant le droit de modification de certains champs du contrat
#OWNER_EMAIL# - EMail des utilisateurs avec de certains droits du contrat
#BCC# - copie cachée (#ADMIN_EMAIL#)
#ID# - ID de la bannière
#CONTRACT_ID# - ID du contrat
#CONTRACT_NAME# - titre du contrat
#TYPE_SID# - ID du type
#TYPE_NAME# - titre du type
#STATUS# - statut
#STATUS_COMMENTS# - commentaire pour le statut
#NAME# - titre de la bannnière
#GROUP_SID# - groupe du bannière
#INDICATOR# - est-ce que la bannière est affichée sur le site ?
#ACTIVE# - drapeau d'activité de la bannière [Y | N]
#MAX_SHOW_COUNT# - nombre maximal d'affichages de la bannière
#SHOW_COUNT# - combien de fois la bannière a été affichée sur le site
#MAX_CLICK_COUNT# - nombre maximal de clics sur la bannière
#CLICK_COUNT# - combien de fois on a cliqué sur la bannière
#DATE_LAST_SHOW# - date du dernier affichage de la bannière
#DATE_LAST_CLICK# - date du dernier clic sur la bannière
#DATE_SHOW_FROM# - date de début d'affichage de la bannière
#DATE_SHOW_TO# - date d'achèvement de l'affichage de la bannière
#IMAGE_LINK# - lien à l'image de la bannière
#IMAGE_ALT# - texte de l'info-bulle sur l'image
#URL# - URL sur l'image
#URL_TARGET# - où dérouler URL de l'image
#CODE# - code de la bannière
#CODE_TYPE# - type du code de la bannière (text | html)
#COMMENTS# - commentaire pour la bannière
#DATE_CREATE# - date de création de la bannière
#CREATED_BY# - qui a créé la bannière
#DATE_MODIFY# - date de modification de la bannière
#MODIFIED_BY# - qui a modifié la bannière";
$MESS["ADV_BANNER_STATUS_CHANGE_MESSAGE"] = "Le statut de la bannière # #ID# est remplacé par [#STATUS#].

>=================== Paramètres de la bannière ===============================

Bannière - [#ID#] #NAME#
Contrat - [#CONTRACT_ID#] #CONTRACT_NAME#
Type- [#TYPE_SID#] #TYPE_NAME#
Groupe - #GROUP_SID#

----------------------------------------------------------------------

Activité: #INDICATOR#

Période - [#DATE_SHOW_FROM# - #DATE_SHOW_TO#]
Indiqué - #SHOW_COUNT# / #MAX_SHOW_COUNT# [#DATE_LAST_SHOW#]
Cliqué - #CLICK_COUNT# / #MAX_CLICK_COUNT# [#DATE_LAST_CLICK#]
Coché - [#ACTIVE#]
Statut - [#STATUS#]
Commentaire:
#STATUS_COMMENTS#
----------------------------------------------------------------------

Image - [#IMAGE_ALT#] #IMAGE_LINK#
URL - [#URL_TARGET#] #URL#

Code: [#CODE_TYPE#]
#CODE#

>=====================================================================

Créé - #CREATED_BY# [#DATE_CREATE#]
Modifié - #MODIFIED_BY# [#DATE_MODIFY#]

Pour consulter les paramètres de la bannière cliquez sur le lien:
http://#SERVER_NAME#/bitrix/admin/adv_banner_edit.php?ID=#ID#&CONTRACT_ID=#CONTRACT_ID#&lang=#LANGUAGE_ID#

La lettre est générée automatiquement.";
$MESS["ADV_BANNER_STATUS_CHANGE_NAME"] = "Le statut de la bannière a été changé";
$MESS["ADV_BANNER_STATUS_CHANGE_SUBJECT"] = "[BID##ID#] #SITE_NAME# : Bannière statut a été changé - [#STATUS#]";
$MESS["ADV_CONTRACT_INFO_DESC"] = "#ID# - ID contrat
#MESSAGE# - message
#EMAIL_TO# - Adresse email de récepteur de messages
#ADMIN_EMAIL# - envoyer par email des utilisateurs avec 'gestionnaire de bannières' et rôles 'administrateur'
#ADD_EMAIL# - Email de gestionnaires de bannières
#STAT_EMAIL# - Adresse email de gestionnaires de bannières
#EDIT_EMAIL# - envoyer par email des utilisateurs qui ont des autorisations pour afficher les statistiques de bannières
#OWNER_EMAIL# - envoyer par email des utilisateurs qui ont des autorisations sur contrat
#BCC# - copie
#INDICATOR# - est bannières contractuels indiqués sur le site ?
#ACTIVE# - contrat activité drapeau [Y | N]
#NAME# - intitulé du marché
#DESCRIPTION# - description du marché
#MAX_SHOW_COUNT# - nombre maximum de toutes les bannières du contrat spectacles
#SHOW_COUNT# - nombre de toutes les bannières du contrat spectacles
#MAX_CLICK_COUNT# - nombre maximum de toutes les bannières du contrat clics
#CLICK_COUNT# - nombre de toutes les bannières du contrat clics
#BANNERS# - nombre de bannières de contrat
#DATE_SHOW_FROM# - date de bannière montrant période démarre
#DATE_SHOW_TO# - date de bannière montrant en fin de période
#DATE_CREATE# - contrat date de création
#CREATED_BY# - contrat créateur
#DATE_MODIFY# - contrat date de modification
#MODIFIED_BY# - qui a modifié le contrat";
$MESS["ADV_CONTRACT_INFO_MESSAGE"] = "#MESSAGE#
Contrat: [#ID#] #NAME#
#DESCRIPTION#
>================== Paramètres du contrat ==============================

Activité: #INDICATOR#

Période - [#DATE_SHOW_FROM# - #DATE_SHOW_TO#]
Affiché - #SHOW_COUNT# / #MAX_SHOW_COUNT#
Clics - #CLICK_COUNT# / #MAX_CLICK_COUNT#
Indicateur d'activité - [#ACTIVE#]

Bannières - #BANNERS#
>=====================================================================

Créé(e)s - #CREATED_BY# [#DATE_CREATE#]
Modifié par - #MODIFIED_BY# [#DATE_MODIFY#]

Pour voir les paramètres du contrat cliquez sur ce lien:
http://#SERVER_NAME#/bitrix/admin/adv_contract_edit.php?ID=#ID#&lang=#LANGUAGE_ID#

Ce message a été généré automatiquement.";
$MESS["ADV_CONTRACT_INFO_NAME"] = "Paramètres de contrat de publicité";
$MESS["ADV_CONTRACT_INFO_SUBJECT"] = "[CID##ID#] #SITE_NAME# : Publicité paramètres contractuels";
?>