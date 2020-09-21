<?
$MESS["WF_IBLOCK_STATUS_CHANGE_DESC"] = "#ID# - ID
#IBLOCK_ID# - ID blocs d'info
#IBLOCK_TYPE# - type de blocs d'info
#SECTION_ID# - ID section
#ADMIN_EMAIL# - Adresse email des administrateurs d'un flux documentaire
#BCC# - copie cachée (tous ceux qui ont modifié, ou peut modifier le document dans son statut actuel)
#PREV_STATUS_ID# - ID statut précédent du document
#PREV_STATUS_TITLE# - nom de l'état précédent de l'élément
#STATUS_ID# - ID de l'état actuel
#STATUS_TITLE# - le nom de l'état actuel
#DATE_CREATE# - date de création d'un élément
#CREATED_BY_ID# - ID utilisateur ayant créé l'élément
#CREATED_BY_NAME# - nom de l'utilisateur ayantcréé l'élément
#CREATED_BY_EMAIL# - Adresse email de l'utilisateur qui a créé l'élément
#DATE_MODIFY# - date de modification d'un élément
#MODIFIED_BY_ID# - ID utilisateur qui a modifié un élément
#MODIFIED_BY_NAME# nom de l'utilisateur qui a modifié l'élément
#NAME# - nom de l'élément
#PREVIEW_HTML# - annonce au format HTML
#PREVIEW_TEXT# - annonce au format TEXT
#PREVIEW# - annonce stockée dans la base
#PREVIEW_TYPE# - type d'annonce (text | html)
#DETAIL_HTML# - description détaillée d'un élément au format HTML
#DETAIL_TEXT# - description détaillée d'un élément au format TEXT
#DÉTAIL# - description détaillée d'un élément stockée dans la base
#DETAIL_TYPE# - type de description détaillée (text | html)
#COMMENTS# commentaire
";
$MESS["WF_IBLOCK_STATUS_CHANGE_MESSAGE"] = "#SITE_NAME# : Le statut d'élément # #ID# un bloc d'information # #IBLOCK_ID# (type - #IBLOCK_TYPE#) est modifié
---------------------------------------------------------------------------

Maintenant, les champ d'élément ont les significations suivantes :

Intitulé - #NAME#
Statut - [#STATUS_ID#] #STATUS_TITLE#;
précédent - [#PREV_STATUS_ID#] #PREV_STATUS_TITLE#
Créé - #DATE_CREATE#; [#CREATED_BY_ID#] #CREATED_BY_NAME#
Modifié  - #DATE_MODIFY#; [#MODIFIED_BY_ID#] #MODIFIED_BY_NAME#

Brêve description (type - #PREVIEW_TYPE#) :
---------------------------------------------------------------------------
#PREVIEW_TEXT#
---------------------------------------------------------------------------

Description détaillée (type - #DETAIL_TYPE#) :
---------------------------------------------------------------------------
#DETAIL_TEXT#
---------------------------------------------------------------------------

Commentaire :
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Pour accéder et modifier un élément, utilisez le lien :
http://#SERVER_NAME#/bitrix/admin/iblock_element_edit.php?lang=fr&WF=Y&PID=#ID#&type=#IBLOCK_TYPE#&IBLOCK_ID=#IBLOCK_ID#&filter_section=#SECTION_ID#

Lettre généré automatiquement.
";
$MESS["WF_IBLOCK_STATUS_CHANGE_NAME"] = "Infoblock statut de l'élément a changé";
$MESS["WF_IBLOCK_STATUS_CHANGE_SUBJECT"] = "#SITE_NAME# : Le statut d'élément # #ID# un bloc d'information # #IBLOCK_ID# (type - #IBLOCK_TYPE#) est modifié ";
$MESS["WF_NEW_DOCUMENT_DESC"] = "#ID# - ID
#ADMIN_EMAIL# - Adresse emailaddresses des administrateurs d'un flux documentaire (séparées par des virgules)
#BCC# - copie cachée (tous ceux qui ont modifié, ou peut modifier le document dans son statut actuel)
#STATUS_ID# - ID statut
#STATUS_TITLE# - nom d'état
#DATE_ENTER# - date de création du document
#ENTERED_BY_ID# - ID utilisateur ayant créé le document 
#ENTERED_BY_NAME# - nom de l'utilisateur ayant créé le document
#ENTERED_BY_EMAIL# - Adresse emailde l'utilisateur ayant créé le document 
#FILENAME# -  nom complet de fichier
#TITLE# - titre de fichier
#BODY_HTML# - le contenu du document au format HTML
#BODY_TEXT# - le contenu du document au format TEXT
#BODY# - le contenu du document stocké dans la base
#BODY_TYPE# - type de contenu du document
#COMMENTS# - commentaire";
$MESS["WF_NEW_DOCUMENT_MESSAGE"] = "Nouveau document a été créé à  #SITE_NAME#.
-------------------------------------------------- -------------------------

Maintenant les champs dans le document sont les valeurs suivantes :

ID            - #ID#
Fichier - #FILENAME#
Titre - #TITLE#
Statut - [#STATUS_ID#] #STATUS_TITLE#
Créé - #DATE_ENTER#; [#ENTERED_BY_ID#] #ENTERED_BY_NAME#

Sommaire (type - #BODY_TYPE#) :
-------------------------------------------------- -------------------------
#BODY_TEXT#
-------------------------------------------------- -------------------------

Commentaires :
-------------------------------------------------- -------------------------
#COMMENTAIRES#
-------------------------------------------------- -------------------------

Pour afficher et modifier le lien document de visite :
http://#SERVER_NAME#/bitrix/admin/workflow_edit.php?lang=fr&ID=#ID#

Généré automatiquement message.
";
$MESS["WF_NEW_DOCUMENT_NAME"] = "Nouveau document a été créé";
$MESS["WF_NEW_DOCUMENT_SUBJECT"] = "#SITE_NAME# : Un nouveau document a été créé";
$MESS["WF_NEW_IBLOCK_ELEMENT_DESC"] = "#ID# - ID
#IBLOCK_ID# - ID blocs d'info
#IBLOCK_TYPE# - type de blocs d'info
#SECTION_ID# - ID section
#ADMIN_EMAIL# - Adresse email des administrateurs d'un flux documentaire
#BCC# - copie cachée (tous ceux qui ont modifié, ou peut modifier le document dans son statut actuel)
#STATUS_ID# - ID statut 
#STATUS_TITLE# - le nom de l'état actuel
#DATE_CREATE# - date de création d'un élément
#CREATED_BY_ID# - ID utilisateur ayant créé l'élément
#CREATED_BY_NAME# - nom de l'utilisateur ayant créé l'élément
#CREATED_BY_EMAIL# - Adresse email de l'utilisateur ayant créé l'élément
#NAME# - nom de l'élément
#PREVIEW_HTML# - annonce au format HTML
#PREVIEW_TEXT# - annonce au format TEXT
#PREVIEW# - annonce stockée dans la base
#PREVIEW_TYPE# - type d'annonce (text | html)
#DETAIL_HTML# - description détaillée d'un élément au format HTML
#DETAIL_TEXT# - description détaillée d'un élément au format TEXT
#DÉTAIL# - description détaillée d'un élément stockée dans la base
#DETAIL_TYPE# - type de description détaillée
#COMMENTS# commentaire";
$MESS["WF_NEW_IBLOCK_ELEMENT_MESSAGE"] = "#SITE_NAME# : Un nouvel élément un bloc d'information a été créé # #IBLOCK_ID# (type - #IBLOCK_TYPE#)
-------------------------------------------------- -------------------------

Maintenant, les champ d'élément ont les significations suivantes :

Intitulé - #NAME#
Statut - [#STATUS_ID#] #STATUS_TITLE#
Créé - #DATE_CREATE#; [#CREATED_BY_ID#] #CREATED_BY_NAME#

Brêve description (type - #PREVIEW_TYPE#) :
-------------------------------------------------- -------------------------
#PREVIEW_TEXT#
-------------------------------------------------- -------------------------

Description détaillée (type - #DETAIL_TYPE#) :
-------------------------------------------------- -------------------------
#DETAIL_TEXT#
-------------------------------------------------- -------------------------

Commentaire :
-------------------------------------------------- -------------------------
#COMMENTS#
-------------------------------------------------- -------------------------

Pour accéder et modifier un élément, utilisez le lien :
http://#SERVER_NAME#/bitrix/admin/iblock_element_edit.php?lang=fr&WF=Y&PID=#ID#&type=#IBLOCK_TYPE#&IBLOCK_ID=#IBLOCK_ID#&filter_section=#SECTION_ID#

Lettre généré automatiquement.";
$MESS["WF_NEW_IBLOCK_ELEMENT_NAME"] = "Nouvel élément de bloc d'information a été créée";
$MESS["WF_NEW_IBLOCK_ELEMENT_SUBJECT"] = "#SITE_NAME# : Un nouvel élément un bloc d'information a été créé # #IBLOCK_ID# (type - #IBLOCK_TYPE#)";
$MESS["WF_STATUS_CHANGE_DESC"] = "#ID# - ID
#ADMIN_EMAIL# - Adresse emailaddresses des administrateurs d'un flux documentaire (séparées par des virgules)
#BCC# - copie cachée (tous ceux qui ont modifié, ou peut modifier le document dans son statut actuel)
#PREV_STATUS_ID# - ID statut précédent du document
#PREV_STATUS_TITLE# - nom de l'état précédent du document
#STATUS_ID# - ID statut
#STATUS_TITLE# - nom d'état
#DATE_ENTER#  - date de création du document
#ENTERED_BY_ID# - ID utilisateur ayant créé le document 
#ENTERED_BY_NAME# - nom de l'utilisateur ayant créé le document
#ENTERED_BY_EMAIL# - Adresse emailde l'utilisateur qui a créé le document 
#DATE_MODIFY# - date de modification du document
#MODIFIED_BY_ID# - ID utilisateur ayant modidfié le document
 #MODIFIED_BY_NAME# - nom de l'utilisateur ayant modidfié le document
#FILENAME# -  nom complet de fichier
#TITLE# - titre de fichier
#BODY_HTML# - le contenu du document au format HTML
#BODY_TEXT# - le contenu du document au format TEXT
#BODY# - le contenu du document stocké dans la base
#BODY_TYPE# - type de contenu du document
#COMMENTS# - commentaire
";
$MESS["WF_STATUS_CHANGE_MESSAGE"] = "Statut du document # #ID# a été modifié à #SITE_NAME#.
-------------------------------------------------- -------------------------

Maintenant les champs dans le document sont les valeurs suivantes :

Fichier - #FILENAME#
Titre - #TITLE# 
Statut - [#STATUS_ID#] #STATUS_TITLE#; précédente - [#PREV_STATUS_ID#] #PREV_STATUS_TITLE#
Créé - #DATE_ENTER#; [#ENTERED_BY_ID#] #ENTERED_BY_NAME#
Modifié - #DATE_MODIFY#; [#MODIFIED_BY_ID#] #MODIFIED_BY_NAME#

Sommaire (type - #BODY_TYPE#) :
-------------------------------------------------- -------------------------
#BODY_TEXT#
-------------------------------------------------- -------------------------

Commentaires :
-------------------------------------------------- -------------------------
#COMMENTS#
-------------------------------------------------- -------------------------

Pour afficher et modifier le document, cliquez sur le lien :
http://#SERVER_NAME#/bitrix/admin/workflow_edit.php?lang=fr&ID=#ID#

Généré automatiquement message.
";
$MESS["WF_STATUS_CHANGE_NAME"] = "Statut du document a été modifié";
$MESS["WF_STATUS_CHANGE_SUBJECT"] = "#SITE_NAME# : Le statut du document est modidfié # #ID#";
?>