<?
$MESS["BP_DBLA_APP"] = "Approuvé";
$MESS["BP_DBLA_APPROVE"] = "Votez pour le document, s'il vous plaît !";
$MESS["BP_DBLA_APPROVE2"] = "Votez pour le document, s'il vous plaît !";
$MESS["BP_DBLA_APPROVE2_TEXT"] = "Vous devez voter pour le document' '{=Document:NAME}'.

Auteur: {=Document:CREATED_BY_PRINTABLE}'";
$MESS["BP_DBLA_APPROVE2_TITLE"] = "Approbation du document: 2-ème étape";
$MESS["BP_DBLA_APPROVE_TEXT"] = "Il vous faut voter pour le document '{=Document:NAME}'.

?uteur: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_APPROVE_TITLR"] = "Validation du document: 1ère étape";
$MESS["BP_DBLA_APP_S"] = "Statut: Validé";
$MESS["BP_DBLA_DESC"] = "C'est recommandé pour les situations de validation du document avec un jugement prévisionnel. En cadre du processus, à la première étape le document est validé par un expert. Si le document n'est pas validé par lui, il est rendu pour la mise au point. Si il est validé, le document est transféré pour la prise de décision dans un groupe d'employés par une simple majorité des voix. Si le document n'est pas accepté à la deuxième étape, du vote, il est rendu à son auteur pour la mise au point et le processus de validation recommence.";
$MESS["BP_DBLA_M"] = "Message e-mail";
$MESS["BP_DBLA_MAIL2_SUBJ"] = "Il faut voter pour '{=Document:NAME}'";
$MESS["BP_DBLA_MAIL2_TEXT"] = "Vous devez approuver ou rejeter le document '{=Document:NAME}'.

Pour l'approbation du document cliquez http://#HTTP_HOST##TASK_URL#

Auteur: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_MAIL3_SUBJ"] = "Vote par '{=Document:NAME}: Le document est accepté.";
$MESS["BP_DBLA_MAIL3_TEXT"] = "La vote sur le document '{=Document:NAME}' est terminée.

Le document est approuvé {=ApproveActivity2:ApprovedPercent}% de votes.

Pour le document: {=ApproveActivity2:ApprovedCount}
Contre le document: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_MAIL4_SUBJ"] = "Validation {=Document:NAME}: Le document est rejeté.";
$MESS["BP_DBLA_MAIL4_TEXT"] = "La première étape de la validation du document '{=Document:NAME}' est terminée.

Document est rejeté.

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_MAIL_SUBJ"] = "Le document est accepté à la 1-ère étape";
$MESS["BP_DBLA_MAIL_TEXT"] = "Première étape de confirmation du document '{=Document:NAME}' est terminée.

Document reçu.

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_NAME"] = "Approbation à deux étapes";
$MESS["BP_DBLA_NAPP"] = "Vote pour '{= Document: NAME}: Document refusé.";
$MESS["BP_DBLA_NAPP_DRAFT"] = "Envoyé pour la mise à jour";
$MESS["BP_DBLA_NAPP_DRAFT_S"] = "Statut: renvoyé pour la mise au point";
$MESS["BP_DBLA_NAPP_TEXT"] = "La vote pour le document '{=Document:NAME}' est terminée.

Document refusé.

Pour le document: {=ApproveActivity2:ApprovedCount}
Contre le document: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_PARAM1"] = "Approuvant à la 1-ère étape";
$MESS["BP_DBLA_PARAM2"] = "Ceux qui confirment à la 2e étape";
$MESS["BP_DBLA_PUB_TITLE"] = "Publication du document";
$MESS["BP_DBLA_S"] = "Ordre de succession d'actions";
$MESS["BP_DBLA_T"] = "Processus d'affaires consécutif";
$MESS["BP_DBLA_TASK"] = "Approuver le document: '{= Document: NAME}'";
$MESS["BP_DBLA_TASK_DESC"] = "Vous devez approuver ou rejeter le document '{=Document:NAME}'.

Pour l'approbation du document cliquez http://#HTTP_HOST##TASK_URL#

Auteur: {=Document:CREATED_BY_PRINTABLE}";
?>