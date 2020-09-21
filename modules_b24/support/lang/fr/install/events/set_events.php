<?
$MESS["SUP_SE_TICKET_CHANGE_BY_AUTHOR_FOR_AUTHOR_TEXT"] = "#ID# - ID d'appel
#LANGUAGE_ID# - identificateur de langue du site auquel l'appel est attribué
#WHAT_CHANGE# - liste de changements sur l'appel
#DATE_CREATE# - date de création
#TIMESTAMP# - date de modification
#DATE_CLOSE# - date de fermeture
#TITLE# - titre d'appel
#STATUS# - statut d'appel
#CATEGORY# - catégorie d'appel
#CRITICALITY# - niveau de criticité de l'appel
#RATE# - estimation des réponses
#SLA# - niveau de support technique
#SOURCE# - source initiale de l'appel (web, email, téléphone etc.)
#SPAM_MARK# - marque spam
#MESSAGES_AMOUNT# - nombre de messages dans l'appel
#ADMIN_EDIT_URL# - lien pour la modification de l'appel (dans la partie administrative)
#PUBLIC_EDIT_URL# - lien pour la modification de l'appel (dans la partie publique)

#OWNER_EMAIL# - #OWNER_USER_EMAIL# et/ou #OWNER_SID#
#OWNER_USER_ID# - ID d'auteur du message
#OWNER_USER_NAME# - nom de l'auteur du message
#OWNER_USER_LOGIN# - identifiant de l'auteur du message
#OWNER_USER_EMAIL# - email de l'auteur du message
#OWNER_TEXT# - [#OWNER_USER_ID#] (#OWNER_USER_LOGIN#) #OWNER_USER_NAME#
#OWNER_SID# - identificateur arbitraire de l'auteur du message (email, téléphone etc.)

#SUPPORT_EMAIL# - #RESPONSIBLE_USER_EMAIL# ou #SUPPORT_ADMIN_EMAIL#
#RESPONSIBLE_USER_ID# - ID du responsable d'appel
#RESPONSIBLE_USER_NAME# - nom du responsable d'appel
#RESPONSIBLE_USER_LOGIN# - login du responsable d'appel
#RESPONSIBLE_USER_EMAIL# - adresse email du responsable d'appel
#RESPONSIBLE_TEXT# - [#RESPONSIBLE_USER_ID#] (#RESPONSIBLE_USER_LOGIN#) #RESPONSIBLE_USER_NAME#
#SUPPORT_ADMIN_EMAIL# - adresses email des administrateurs de support technique

#CREATED_USER_ID# - ID du créateur d'appel
#CREATED_USER_LOGIN# - login du créateur d'appel
#CREATED_USER_EMAIL# - adresse email du créateur d'appel
#CREATED_USER_NAME# - nom du créateur d'appel
#CREATED_MODULE_NAME# - identificateur du module utilisé pour la création d'appel
#CREATED_TEXT# - [#CREATED_USER_ID#] (#CREATED_USER_LOGIN#) #CREATED_USER_NAME#

#MODIFIED_USER_ID# - ID du modificateur d'appel
#MODIFIED_USER_LOGIN# - login du modificateur d'appel
#MODIFIED_USER_EMAIL# - adresse email du modificateur d'appel
#MODIFIED_USER_NAME# - nom du modificateur d'appel
#MODIFIED_MODULE_NAME# - identificateur du module utilisé pour la création d'appel
#MODIFIED_TEXT# - [#MODIFIED_USER_ID#] (#MODIFIED_USER_LOGIN#) #MODIFIED_USER_NAME#

#MESSAGE_AUTHOR_USER_ID# - ID d'auteur du message
#MESSAGE_AUTHOR_USER_NAME# - nom d'auteur du message
#MESSAGE_AUTHOR_USER_LOGIN# - login d'auteur du message
#MESSAGE_AUTHOR_USER_EMAIL# - email d'auteur du message
#MESSAGE_AUTHOR_TEXT# - [#MESSAGE_AUTHOR_USER_ID#] (#MESSAGE_AUTHOR_USER_LOGIN#) #MESSAGE_AUTHOR_USER_NAME#
#MESSAGE_AUTHOR_SID# - identificateur arbitraire d'auteur du message (email, téléphone etc.)
#MESSAGE_SOURCE# - source du message
#MESSAGE_HEADER# - '******* MESSAGE *******', ou '******* MESSAGE DISSIMULÉ *******'
#MESSAGE_BODY# - texte du message
#MESSAGE_FOOTER# - '*********************** '
#FILES_LINKS# - liens vers les fichiers attachés

#SUPPORT_COMMENTS# - commentaire administratif";
$MESS["SUP_SE_TICKET_CHANGE_BY_AUTHOR_FOR_AUTHOR_TITLE"] = "Billet a été modifié par l'auteur (pour l'auteur)";
$MESS["SUP_SE_TICKET_CHANGE_BY_SUPPORT_FOR_AUTHOR_MESSAGE"] = "Changements dans votre demande # #ID# à #SERVER_NAME#.

#WHAT_CHANGE#
Objet : #TITLE# 

De : #MESSAGE_SOURCE##MESSAGE_AUTHOR_SID##MESSAGE_AUTHOR_TEXT#

>======================== MESSAGE ====================================#FILES_LINKS##MESSAGE_BODY#
>=====================================================================

Auteur - #SOURCE##OWNER_SID##OWNER_TEXT#
Créé - #CREATED_TEXT##CREATED_MODULE_NAME# [#DATE_CREATE#]
Changé - #MODIFIED_TEXT##MODIFIED_MODULE_NAME# [#TIMESTAMP#]

Responsable - #RESPONSIBLE_TEXT#
Catégorie - #CATEGORY#
Priorité - #CRITICALITY#
Statut - #STATUS#
Taux - #RATE#
Niveau de soutien - #SLA#

Pour afficher et modifier le lien demande de visite:
http://#SERVER_NAME##PUBLIC_EDIT_URL#?ID=#ID#

Nous vous demandons de ne pas oublier de noter les réponses de techsupport après la fermeture de la demande:
http://#SERVER_NAME##PUBLIC_EDIT_URL#?ID=#ID#
Généré automatiquement message.
";
$MESS["SUP_SE_TICKET_CHANGE_BY_SUPPORT_FOR_AUTHOR_SUBJECT"] = "[TID##ID#] #SERVER_NAME# : Modification de votre demande";
$MESS["SUP_SE_TICKET_CHANGE_BY_SUPPORT_FOR_AUTHOR_TEXT"] = "#ID# - ID d'appel
#LANGUAGE_ID# - identificateur de langue du site auquel l'appel est attribué
#WHAT_CHANGE# - liste de changements sur l'appel
#DATE_CREATE# - date de création
#TIMESTAMP# - date de modification
#DATE_CLOSE# - date de fermeture
#TITLE# - titre d'appel
#STATUS# - statut d'appel
#CATEGORY# - catégorie d'appel
#CRITICALITY# - niveau de criticité de l'appel
#RATE# - estimation des réponses
#SLA# - niveau de support technique
#SOURCE# - source initiale de l'appel (web, email, téléphone etc.)
#SPAM_MARK# - marque spam
#MESSAGES_AMOUNT# - nombre de messages dans l'appel
#ADMIN_EDIT_URL# - lien pour la modification de l'appel (dans la partie administrative)
#PUBLIC_EDIT_URL# - lien pour la modification de l'appel (dans la partie publique)

#OWNER_EMAIL# - #OWNER_USER_EMAIL# et/ou #OWNER_SID#
#OWNER_USER_ID# - ID d'auteur du message
#OWNER_USER_NAME# - nom de l'auteur du message
#OWNER_USER_LOGIN# - identifiant de l'auteur du message
#OWNER_USER_EMAIL# - email de l'auteur du message
#OWNER_TEXT# - [#OWNER_USER_ID#] (#OWNER_USER_LOGIN#) #OWNER_USER_NAME#
#OWNER_SID# - identificateur arbitraire de l'auteur du message (email, téléphone etc.)

#SUPPORT_EMAIL# - #RESPONSIBLE_USER_EMAIL# ou #SUPPORT_ADMIN_EMAIL#
#RESPONSIBLE_USER_ID# - ID du responsable d'appel
#RESPONSIBLE_USER_NAME# - nom du responsable d'appel
#RESPONSIBLE_USER_LOGIN# - login du responsable d'appel
#RESPONSIBLE_USER_EMAIL# - adresse email du responsable d'appel
#RESPONSIBLE_TEXT# - [#RESPONSIBLE_USER_ID#] (#RESPONSIBLE_USER_LOGIN#) #RESPONSIBLE_USER_NAME#
#SUPPORT_ADMIN_EMAIL# - adresses email des administrateurs de support technique

#CREATED_USER_ID# - ID du créateur d'appel
#CREATED_USER_LOGIN# - login du créateur d'appel
#CREATED_USER_EMAIL# - adresse email du créateur d'appel
#CREATED_USER_NAME# - nom du créateur d'appel
#CREATED_MODULE_NAME# - identificateur du module utilisé pour la création d'appel
#CREATED_TEXT# - [#CREATED_USER_ID#] (#CREATED_USER_LOGIN#) #CREATED_USER_NAME#

#MODIFIED_USER_ID# - ID du modificateur d'appel
#MODIFIED_USER_LOGIN# - login du modificateur d'appel
#MODIFIED_USER_EMAIL# - adresse email du modificateur d'appel
#MODIFIED_USER_NAME# - nom du modificateur d'appel
#MODIFIED_MODULE_NAME# - identificateur du module utilisé pour la création d'appel
#MODIFIED_TEXT# - [#MODIFIED_USER_ID#] (#MODIFIED_USER_LOGIN#) #MODIFIED_USER_NAME#

#MESSAGE_AUTHOR_USER_ID# - ID d'auteur du message
#MESSAGE_AUTHOR_USER_NAME# - nom d'auteur du message
#MESSAGE_AUTHOR_USER_LOGIN# - login d'auteur du message
#MESSAGE_AUTHOR_USER_EMAIL# - email d'auteur du message
#MESSAGE_AUTHOR_TEXT# - [#MESSAGE_AUTHOR_USER_ID#] (#MESSAGE_AUTHOR_USER_LOGIN#) #MESSAGE_AUTHOR_USER_NAME#
#MESSAGE_AUTHOR_SID# - identificateur arbitraire d'auteur du message (email, téléphone etc.)
#MESSAGE_SOURCE# - source du message
#MESSAGE_HEADER# - '******* MESSAGE *******', ou '******* MESSAGE DISSIMULÉ *******'
#MESSAGE_BODY# - texte du message
#MESSAGE_FOOTER# - '*********************** '
#FILES_LINKS# - liens vers les fichiers attachés

#SUPPORT_COMMENTS# - commentaire administratif";
$MESS["SUP_SE_TICKET_CHANGE_BY_SUPPORT_FOR_AUTHOR_TITLE"] = "Billet a été changé par un membre de techsupport (pour l'auteur)";
$MESS["SUP_SE_TICKET_CHANGE_FOR_TECHSUPPORT_MESSAGE"] = "Les changements dans la demande # #ID# à #SERVER_NAME#.
#SPAM_MARK#
#WHAT_CHANGE#
Objet : #TITLE# 

De : #MESSAGE_SOURCE##MESSAGE_AUTHOR_SID##MESSAGE_AUTHOR_TEXT#

>#MESSAGE_HEADER##FILES_LINKS##MESSAGE_BODY#
>#MESSAGE_FOOTER#

Auteur - #SOURCE##OWNER_SID##OWNER_TEXT#
Créé - #CREATED_TEXT##CREATED_MODULE_NAME# [#DATE_CREATE#
Changé - #MODIFIED_TEXT##MODIFIED_MODULE_NAME# [#TIMESTAMP#]

Responsable - #RESPONSIBLE_TEXT#
Catégorie - #CATEGORY#
Priorité - #CRITICALITY#
Statut - #STATUS#
Taux - #RATE#
Niveau de soutien - #SLA#

> ======================= COMMENTAIRES ========================= ==========#SUPPORT_COMMENTS#
> ================================================= ===================

Pour afficher et modifier le lien demande de visite:
http://#SERVER_NAME##ADMIN_EDIT_URL#?ID=#ID#&lang=#LANGUAGE_ID#


Généré automatiquement message.
";
$MESS["SUP_SE_TICKET_CHANGE_FOR_TECHSUPPORT_SUBJECT"] = "[TID##ID#] #SERVER_NAME# : Modification de la demande";
$MESS["SUP_SE_TICKET_CHANGE_FOR_TECHSUPPORT_TEXT"] = "#ID# - ID d'appel
#LANGUAGE_ID# - identificateur de langue du site auquel l'appel est attribué
#WHAT_CHANGE# - liste de changements sur l'appel
#DATE_CREATE# - date de création
#TIMESTAMP# - date de modification
#DATE_CLOSE# - date de fermeture
#TITLE# - titre d'appel
#STATUS# - statut d'appel
#CATEGORY# - catégorie d'appel
#CRITICALITY# - niveau de critique d'appel
#RATE# - estimation de réponses
#SLA# - niveau de support technique
#SOURCE# - source initiale d'appel (web, email, téléphone etc.)
#SPAM_MARK# - marque spam
#MESSAGES_AMOUNT# - nombre de messages dans l'appel
#ADMIN_EDIT_URL# - lien pour la modification d'appel (dans la partie administrative)
#PUBLIC_EDIT_URL# - lien pour la modification d'appel (dans la partie publique)

#OWNER_EMAIL# - #OWNER_USER_EMAIL# et/ou #OWNER_SID#
#OWNER_USER_ID# - ID d'auteur du message
#OWNER_USER_NAME# - nom d'auteur du message
#OWNER_USER_LOGIN# - login d'auteur du message
#OWNER_USER_EMAIL# - email d'auteur du message
#OWNER_TEXT# - [#OWNER_USER_ID#] (#OWNER_USER_LOGIN#) #OWNER_USER_NAME#
#OWNER_SID# - identificateur arbitraire d'auteur du message (email, téléphone etc.)

#SUPPORT_EMAIL# - #RESPONSIBLE_USER_EMAIL# ou #SUPPORT_ADMIN_EMAIL#
#RESPONSIBLE_USER_ID# - ID du responsable d'appel
#RESPONSIBLE_USER_NAME# - nom du responsable d'appel
#RESPONSIBLE_USER_LOGIN# - login du responsable d'appel
#RESPONSIBLE_USER_EMAIL# - email du responsable d'appel
#RESPONSIBLE_TEXT# - [#RESPONSIBLE_USER_ID#] (#RESPONSIBLE_USER_LOGIN#) #RESPONSIBLE_USER_NAME#
#SUPPORT_ADMIN_EMAIL# - EMail des administrateurs de support technique

#CREATED_USER_ID# - ID du créateur d'appel
#CREATED_USER_LOGIN# - login du créateur d'appel
#CREATED_USER_EMAIL# - email du créateur d'appel
#CREATED_USER_NAME# - nom du créateur d'appel
#CREATED_MODULE_NAME# - identificateur du module utilisé pour la création d'appel
#CREATED_TEXT# - [#CREATED_USER_ID#] (#CREATED_USER_LOGIN#) #CREATED_USER_NAME#

#MODIFIED_USER_ID# - ID du modificateur d'appel
#MODIFIED_USER_LOGIN# - login du modificateur d'appel
#MODIFIED_USER_EMAIL# - EMail du modificateur d'appel
#MODIFIED_USER_NAME# - nom du modificateur d'appel
#MODIFIED_MODULE_NAME# - identificateur du module utilisé pour la création d'appel
#MODIFIED_TEXT# - [#MODIFIED_USER_ID#] (#MODIFIED_USER_LOGIN#) #MODIFIED_USER_NAME#

#MESSAGE_AUTHOR_USER_ID# - ID d'auteur du message
#MESSAGE_AUTHOR_USER_NAME# - nom d'auteur du message
#MESSAGE_AUTHOR_USER_LOGIN# - login d'auteur du message
#MESSAGE_AUTHOR_USER_EMAIL# - email d'auteur du message
#MESSAGE_AUTHOR_TEXT# - [#MESSAGE_AUTHOR_USER_ID#] (#MESSAGE_AUTHOR_USER_LOGIN#) #MESSAGE_AUTHOR_USER_NAME#
#MESSAGE_AUTHOR_SID# - identificateur arbitraire d'auteur du message (email, téléphone etc.)
#MESSAGE_SOURCE# - source du message
#MESSAGE_HEADER# - '******* MESSAGE *******', ou '******* MESSAGE DISSIMULÉ *******'
#MESSAGE_BODY# - texte du message
#MESSAGE_FOOTER# - '*********************** '
#FILES_LINKS# - liens vers les fichiers attachés

#SUPPORT_COMMENTS# - commentaire administratif";
$MESS["SUP_SE_TICKET_CHANGE_FOR_TECHSUPPORT_TITLE"] = "Changements dans billet (pour techsupport)";
$MESS["SUP_SE_TICKET_GENERATE_SUPERCOUPON_TEXT"] = "#COUPON# - Coupon
#COUPON_ID# - ID du coupon
#DATE# - Date d'utilisation
#USER_ID# - ID utilisateur
#SESSION_ID# - ID de la session
#GUEST_ID# - ID du visiteur";
$MESS["SUP_SE_TICKET_GENERATE_SUPERCOUPON_TITLE"] = "Un coupon a été utilisé";
$MESS["SUP_SE_TICKET_NEW_FOR_AUTHOR_MESSAGE"] = "Nous avous reçu votre message, le numéro attribué #ID#.

Vous ne devez pas répondre à cet email. Ce n'est que la confirmation
que le service du support technique a reçu votre message et est en train de le traiter.

Information sur votre message:

Sujet - #TITLE#
Expéditeur - #SOURCE##OWNER_SID##OWNER_TEXT#
Catégorie - #CATEGORY#
Criticité - #CRITICALITY#

Créé par - #CREATED_TEXT##CREATED_MODULE_NAME# [#DATE_CREATE#]
Responsable - #RESPONSIBLE_TEXT#
Niveau du support - #SLA#

>======================= MESSAGE ===================================

#FILES_LINKS##MESSAGE_BODY#

>=====================================================================

Pour consulter et modifier le message, utilisez le lien :
http://#SERVER_NAME##PUBLIC_EDIT_URL#?ID=#ID#

Ce message a été généré automatiquement.";
$MESS["SUP_SE_TICKET_NEW_FOR_AUTHOR_SUBJECT"] = "[TID##ID#] #SERVER_NAME# : Votre demande est acceptée";
$MESS["SUP_SE_TICKET_NEW_FOR_AUTHOR_TEXT"] = "#ID# - ID de la requête
#LANGUAGE_ID# - identificateur de la langue du site auquel est rattaché la requête
#DATE_CREATE# - date de création
#TIMESTAMP# - date de modification
#DATE_CLOSE# - date de fermeture
#TITLE# - entête de la requête
#CATEGORY# - catégorie de la requête
#STATUS# - statut de la requête
#CRITICALITY# - criticalité de la requête
#SLA# - niveau du soutien technique
#SOURCE# - source de la requête (web, email, téléphone etc.)
#SPAM_MARK# - marqué comme spa,
#MESSAGE_BODY# - texte du message
#FILES_LINKS# - liens vers les fichiers joints
#ADMIN_EDIT_URL# - lien pour modifier la requête (dans la partie administrative)
#PUBLIC_EDIT_URL# - lien pour modifier la requête (dans la partie publique)

#OWNER_EMAIL# - #OWNER_USER_EMAIL# et/ou #OWNER_SID#
#OWNER_USER_ID# - ID de l'auteur de la requête
#OWNER_USER_NAME# - prénom de l'auteur de la requête
#OWNER_USER_LOGIN# - identifiant de l'auteur de la requête
#OWNER_USER_EMAIL# - email de l'auteur de la requête
#OWNER_TEXT# - [#OWNER_USER_ID#] (#OWNER_USER_LOGIN#) #OWNER_USER_NAME#
#OWNER_SID# - identificateur arbitraire de l'auteur de la requête (email, téléphone etc.)

#SUPPORT_EMAIL# - #RESPONSIBLE_USER_EMAIL# ou #SUPPORT_ADMIN_EMAIL#
#RESPONSIBLE_USER_ID# - ID du responsable de la requête
#RESPONSIBLE_USER_NAME# - Prénom du responsable de la requête
#RESPONSIBLE_USER_LOGIN# - identifiant du responsable de la requête
#RESPONSIBLE_USER_EMAIL# - email du responsable de la requête
#RESPONSIBLE_TEXT# - [#RESPONSIBLE_USER_ID#] (#RESPONSIBLE_USER_LOGIN#) #RESPONSIBLE_USER_NAME#
#SUPPORT_ADMIN_EMAIL# - EMail de tous les administrateurs du soutien technique

#CREATED_USER_ID# - ID du créateur de la requête
#CREATED_USER_LOGIN# - identifiant du créateur de la requête
#CREATED_USER_EMAIL# - email du créateur de la requête
#CREATED_USER_NAME# - prénom du créateur de la requête
#CREATED_MODULE_NAME# - identificateur du module par l'intermédiaire duquel la requête a été créée
#CREATED_TEXT# - [#CREATED_USER_ID#] (#CREATED_USER_LOGIN#) #CREATED_USER_NAME#

#SUPPORT_COMMENTS# - commentaire administratif";
$MESS["SUP_SE_TICKET_NEW_FOR_AUTHOR_TITLE"] = "Nouveau billet (pour l'auteur)";
$MESS["SUP_SE_TICKET_NEW_FOR_TECHSUPPORT_MESSAGE"] = "Nouveaux demande # #ID# à #SERVER_NAME#.
#SPAM_MARK#
De : #SOURCE##OWNER_SID##OWNER_TEXT#

Objet : #TITLE#

> ======================== MESSAGE ======================== ============


#FILES_LINKS##MESSAGE_BODY#

> ================================================= ====================

Responsable - #RESPONSIBLE_TEXT#
Catégorie - #CATEGORY#
Priorité - #CRITICALITY#
Niveau de soutien - #SLA#
Créé - #CREATED_TEXT##CREATED_MODULE_NAME# [#DATE_CREATE#]

Pour afficher et modifier le lien demande de visite:
http://#SERVER_NAME##ADMIN_EDIT_URL#?ID=#ID#&lang=#LANGUAGE_ID#

Généré automatiquement message.
";
$MESS["SUP_SE_TICKET_NEW_FOR_TECHSUPPORT_SUBJECT"] = "[TID##ID#] #SERVER_NAME# : Nouvelle demande";
$MESS["SUP_SE_TICKET_NEW_FOR_TECHSUPPORT_TEXT"] = "#ID# - ID de la requête
#LANGUAGE_ID# - identificateur de la langue du site auquel est lié la requête
#DATE_CREATE# - date de création
#TIMESTAMP# - date de modification
#DATE_CLOSE# - date de fermeture
#TITLE# - en-tête de la requête
#CATEGORY# - catégorie de la requête
#STATUS# - statut de la requête
#CRITICALITY# - criticité de la requête
#SLA# - niveau d'assistance technique
#SOURCE# - source de la requête (web, email, téléphone etc.)
#SPAM_MARK# - marque pour les spams
#MESSAGE_BODY# - texte de la requête
#FILES_LINKS# - liens aux fichiers joints
#ADMIN_EDIT_URL# - lien pour modifier la requête (dans la partie administration)
#PUBLIC_EDIT_URL# - lien pour modifier la requête (dans la partie publique)

#OWNER_EMAIL# - #OWNER_USER_EMAIL# et/ou #OWNER_SID#
#OWNER_USER_ID# - ID de l'auteur de la requête
#OWNER_USER_NAME# - nom de l'auteur de la requête
#OWNER_USER_LOGIN# - login de l'auteur de la requête
#OWNER_USER_EMAIL# - email de l'auteur de la requête
#OWNER_TEXT# - [#OWNER_USER_ID#] (#OWNER_USER_LOGIN#) #OWNER_USER_NAME#
#OWNER_SID# -  identificateur arbitraire de l'auteur de la requête (email, téléphone, etc.)

#SUPPORT_EMAIL# - #RESPONSIBLE_USER_EMAIL# ou #SUPPORT_ADMIN_EMAIL#
#RESPONSIBLE_USER_ID# - ID du responsable de la requête
#RESPONSIBLE_USER_NAME# - Prénom du responsable de la requête
#RESPONSIBLE_USER_LOGIN# - login du responsable de la requête
#RESPONSIBLE_USER_EMAIL# - adresse email du responsable de la requête
#RESPONSIBLE_TEXT# - [#RESPONSIBLE_USER_ID#] (#RESPONSIBLE_USER_LOGIN#) #RESPONSIBLE_USER_NAME#
#SUPPORT_ADMIN_EMAIL# - Email de tous les administrateurs du support technique

#CREATED_USER_ID# - ID créateur de la requête
#CREATED_USER_LOGIN# - login du créateur de la requête
#CREATED_USER_EMAIL# - email du créateur de la requête
#CREATED_USER_NAME# - nom du créateur de la requête
#CREATED_MODULE_NAME# - Identificateur du module par l'intermédiaire duquel la requête a été créée
#CREATED_TEXT# - [#CREATED_USER_ID#] (#CREATED_USER_LOGIN#) #CREATED_USER_NAME#

#SUPPORT_COMMENTS# - Commentaire administratif

#COUPON# - Coupon";
$MESS["SUP_SE_TICKET_NEW_FOR_TECHSUPPORT_TITLE"] = "Nouveau billet (pour techsupport)";
$MESS["SUP_SE_TICKET_OVERDUE_REMINDER_MESSAGE"] = "Rappel sur la nécessité de répondre à une requête # #ID# faite au centre d'assistance du site #SERVER_NAME#.

Date d'expiration - #EXPIRATION_DATE# (temps restant : #REMAINED_TIME#)

>================= INFORMATION SUR LA REQUÊTE ===========================

Thème - #TITLE#

Auteur - #SOURCE##OWNER_SID##OWNER_TEXT#
Fait le - #CREATED_TEXT# #CREATED_MODULE_NAME# [#DATE_CREATE#]

Niveau d'assistance - #SLA#

Responsable - #RESPONSIBLE_TEXT#
Catégorie - #CATEGORY#
Criticité - #CRITICALITY#
Statut - #STATUS#
Appréciation des réponses - #RATE#

>================ MESSAGE NÉCESSITANT UNE RÉPONSE =========================
#MESSAGE_BODY#
>=====================================================================

Pour voir et modifier la requête utilisez le lien :
http://#SERVER_NAME##ADMIN_EDIT_URL#?ID=#ID#&lang=#LANGUAGE_ID#

Ce message a été généré automatiquement.";
$MESS["SUP_SE_TICKET_OVERDUE_REMINDER_SUBJECT"] = "[TID##ID#] #SERVER_NAME# : Rappel de nécessité de la réponse";
$MESS["SUP_SE_TICKET_OVERDUE_REMINDER_TEXT"] = "#ID# - ID de demande
#LANGUAGE_ID# - identificateur de langue du site auquel la demande est liée
#DATE_CREATE# - date de création
#TITLE# - titre de demande
#STATUS# - statut de demande
#CATEGORY# - catégorie de demande
#CRITICALITY# - criticité de demande
#RATE# - évaluation de réponses
#SLA# - niveau du support
#SOURCE# - source d'origine de demande (web, email, téléphone, etc)
#ADMIN_EDIT_URL# - lien pour modifier la demande (dans la section administrative)

#EXPIRATION_DATE# - date d'expiration du temps de réaction
#REMAINED_TIME# - combien de temps reste-t-il jusqu'à la date d'expiration du temps de réaction

#OWNER_EMAIL# - #OWNER_USER_EMAIL# et / ou #OWNER_SID# 
#OWNER_USER_ID# - ID d'auteur de demande
#OWNER_USER_NAME# - nom d'auteur de demande
#OWNER_USER_LOGIN# - identifant d'auteur de demande
#OWNER_USER_EMAIL# - email d'auteur de demande
#OWNER_TEXT# - [#OWNER_USER_ID#] (#OWNER_USER_LOGIN#) #OWNER_USER_NAME#
#OWNER_SID# - identifiant arbitraire d'auteur de demande (e-mail, téléphone, etc)

#SUPPORT_EMAIL# - #RESPONSIBLE_USER_EMAIL# ou #SUPPORT_ADMIN_EMAIL#
#RESPONSIBLE_USER_ID# - ID du responsable de demande
#RESPONSIBLE_USER_NAME# - nom du responsable de demande
#RESPONSIBLE_USER_LOGIN# - identifant du responsable de demande
#RESPONSIBLE_USER_EMAIL# - email du responsable de demande
#RESPONSIBLE_TEXT# - [#RESPONSIBLE_USER_ID#] (#RESPONSIBLE_USER_LOGIN#) #RESPONSIBLE_USER_NAME#
#SUPPORT_ADMIN_EMAIL# - adresse emaild'administrateurs du support technique

#CREATED_USER_ID# - ID du créateur de demande
#CREATED_USER_LOGIN# - identifiant du créateur de demande
#CREATED_USER_EMAIL# - adresse email du créateur de demande
#CREATED_USER_NAME# - nom du créateur de demande
#CREATED_MODULE_NAME# - identifiant du module à l'aide duquel la demande a été créée
#CREATED_TEXT# - [#CREATED_USER_ID#] (#CREATED_USER_LOGIN#) #CREATED_USER_NAME#

#MESSAGE_BODY# - texte de message du client exigeant une réponse";
$MESS["SUP_SE_TICKET_OVERDUE_REMINDER_TITLE"] = "Rappel sur la nécessité de répondre (pour le support technique)";
?>