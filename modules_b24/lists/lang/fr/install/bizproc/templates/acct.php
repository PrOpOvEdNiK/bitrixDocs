<?
$MESS["LIBTA_AAQD1"] = "Vous devez approuver ou de rejeter la charge

Nom : {=Document:NAME}
Date de création : {=Document:DATE_CREATE}
Auteur : {=Document:CREATED_BY_PRINTABLE}
Type : {=Document:PROPERTY_TYPE}
Numéro et date de la facture : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Ligne budgétaire : {=Document:PROPERTY_BDT}
Fichier : {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_AAQD2"] = "Vous devez approuver ou refuser le règlement de la facture

Approuvée : {=Variable:Approver_printable}
Edité par : {=Document:CREATED_BY_PRINTABLE}
Date d'édition : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date de la facture : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Article du budget : {=Document:PROPERTY_BDT}
Fichier : {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_AAQN1"] = "Vaidation du compte '{=Document:NAME}'";
$MESS["LIBTA_AAQN2"] = "Confirmer le règlement de la facture '{=Document:NAME}'";
$MESS["LIBTA_APPROVED"] = "Approuvé";
$MESS["LIBTA_APPROVED_N"] = "Caché";
$MESS["LIBTA_APPROVED_R"] = "Refusé";
$MESS["LIBTA_APPROVED_Y"] = "Approuvé";
$MESS["LIBTA_BDT"] = "L'article du budget";
$MESS["LIBTA_BP_TITLE"] = "Comptes";
$MESS["LIBTA_CREATED_BY"] = "Créé par";
$MESS["LIBTA_DATE_CREATE"] = "Créé le";
$MESS["LIBTA_DATE_PAY"] = "Date de paiement (à remplir par le comptable)";
$MESS["LIBTA_DOCS"] = "Copies des documents";
$MESS["LIBTA_DOCS_NO"] = "Non";
$MESS["LIBTA_DOCS_YES"] = "Oui";
$MESS["LIBTA_FILE"] = "Fichier (copie du compte)";
$MESS["LIBTA_NAME"] = "Dénomination";
$MESS["LIBTA_NUM_DATE"] = "Numéro et la date de compte";
$MESS["LIBTA_NUM_PP"] = "Numéro de référence (à remplir par le comptable)";
$MESS["LIBTA_PAID"] = "La facture est réglée";
$MESS["LIBTA_PAID_NO"] = "Non";
$MESS["LIBTA_PAID_YES"] = "Oui";
$MESS["LIBTA_RIA10_DESCR"] = "Payer la facture

Le paiement est confirmé : {=Variable:PaymentApprover_printable}
Compte approuvé : {=Variable:Approver_printable}
Créé par : {=Document:CREATED_BY_PRINTABLE}
Date de création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et la date de la facture : {=Document:PROPERTY_NUM_DATE}
Somme : {=Document:PROPERTY_SUM}
Ligne budgétaire : {=Document:PROPERTY_BDT}
Fichier : {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_RIA10_NAME"] = "Payer le compte '{=Document:NAME}'";
$MESS["LIBTA_RIA10_R1"] = "date de paiement";
$MESS["LIBTA_RIA10_R2"] = "Numéro d'ordre";
$MESS["LIBTA_RRA15_DESCR"] = "Recueillir les documents relatifs à la facture

Paiement est confirmé : {=Variable:PaymentApprover_printable}
Facture validée : {=Variable:Approver_printable}
Créé par qui : {=Document:CREATED_BY_PRINTABLE}
Date de la création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et Date de la facture : {=Document:PROPERTY_NUM_DATE}
Somme : {=Document:PROPERTY_SUM}
Article du budget : {=Document:PROPERTY_BDT}
Fichier : {=Variable:Domain} {=Document:PROPERTY_FILE}

{=Variable:Link} {=Document:ID} /";
$MESS["LIBTA_RRA15_NAME"] = "Recueillir les documents relatifs à la facture/au compte '{=Document:NAME}'";
$MESS["LIBTA_RRA15_SM"] = "Collection de documents";
$MESS["LIBTA_RRA15_TASKBUTTON"] = "Les documents recueillis";
$MESS["LIBTA_RRA17_BUTTON"] = "Documents reçus";
$MESS["LIBTA_RRA17_DESCR"] = "Je confirme la réception de documents pour le paiement.

Date de paiement : {=Document:PROPERTY_DATE_PAY}
Numéro d'ordre de paiement : {=Document:PROPERTY_NUM_PAY}
Paiement confirmé : {=Variable:PaymentApprover_printable}
Facture approuvée : {=Variable:Approver_printable}
Créé par : {=Document:CREATED_BY_PRINTABLE}
Date de création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date de facture : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Article du budget : {=Document:PROPERTY_BDT}
Fichier : {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_RRA17_NAME"] = "Confirmer la réception des documents d'après la facture '{=Document:NAME}'";
$MESS["LIBTA_SMA_MESSAGE_1"] = "Demande de validation d'une facture
Créée par : {=Document:CREATED_BY_PRINTABLE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Montant : {=Document:PROPERTY_SUM}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_SMA_MESSAGE_10"] = "Compte n'est pas approuvé

Date de création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_SMA_MESSAGE_2"] = "Facture validée

Date d'édition : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_SMA_MESSAGE_3"] = "Je vous demande de confirmer le paiement de la facture

Approuvée : {=Variable:Approver_printable}
Créé par : {=Document:CREATED_BY_PRINTABLE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date de facture : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}

{=Variable:Link}{=Document:ID}/

Liste de tâches:
{=Variable:TasksLink}";
$MESS["LIBTA_SMA_MESSAGE_4"] = "Le paiement de la facture est confirmé

Date de création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_SMA_MESSAGE_5"] = "Je vous demande de payer la facture

Paiement confirmé : {=Variable:PaymentApprover_printable}
Facture approuvée : {=Variable:Approver_printable}
Créé par : {=Document:CREATED_BY_PRINTABLE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Article du budget : {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/

Liste de tâches:
{=Variable:TasksLink}";
$MESS["LIBTA_SMA_MESSAGE_6"] = "La facture est payée. Les documents nécessaires sur la facture.

Date de création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
";
$MESS["LIBTA_SMA_MESSAGE_7"] = "Documents du compte collectés

Date de paiement : {=Document:PROPERTY_DATE_PAY}
Numéro du paiement : {=Document:PROPERTY_NUM_PAY}
Qui a créé : {=Document:CREATED_BY_PRINTABLE}
Date de création : {=Document:DATE_CREATE}
Dénomination : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date de la facture : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}

{=Variable:Link}{=Document:ID}/

Liste de tâches:
{=Variable:TasksLink}";
$MESS["LIBTA_SMA_MESSAGE_8"] = "Documents reçus. Le plan business d'après la facture est clos.

Date de la création : {=Document:DATE_CREATE}
Nom : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_SMA_MESSAGE_9"] = "Le paiement du compte n'est pas confirmé

Date de création : {=Document:DATE_CREATE}
Dénomination : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_STATE1"] = "En approbation";
$MESS["LIBTA_STATE2"] = "Approuvé(e) ({=Variable:Approver_printable})";
$MESS["LIBTA_STATE3"] = "N'est pas validé ({=Variable:Approver_printable})";
$MESS["LIBTA_STATE4"] = "Paiement en cours de confirmation";
$MESS["LIBTA_STATE5"] = "Paiement est validé";
$MESS["LIBTA_STATE6"] = "En attente de paiement";
$MESS["LIBTA_STATE7"] = "La facture est réglée";
$MESS["LIBTA_STATE8"] = "Accompli";
$MESS["LIBTA_STATE9"] = "Paiement rejeté";
$MESS["LIBTA_SUM"] = "Dans le montant de";
$MESS["LIBTA_TYPE"] = "Entité";
$MESS["LIBTA_TYPE_ADV"] = "Publicité";
$MESS["LIBTA_TYPE_C"] = "Remboursables";
$MESS["LIBTA_TYPE_D"] = "Autre";
$MESS["LIBTA_TYPE_EX"] = "De représentation";
$MESS["LIBTA_T_AAQN1"] = "Validation";
$MESS["LIBTA_T_AAQN2"] = "Confirmation du paiement de la facture";
$MESS["LIBTA_T_ASFA1"] = "Installation du champ 'Validé' du document";
$MESS["LIBTA_T_ASFA2"] = "Installation du champ 'Validé' du document";
$MESS["LIBTA_T_ASFA3"] = "Installation du champ 'Validé' du document";
$MESS["LIBTA_T_ASFA4"] = "Modification du document";
$MESS["LIBTA_T_ASFA5"] = "Modification du document";
$MESS["LIBTA_T_GUAX1"] = "Choix du responsable";
$MESS["LIBTA_T_IFELSEA1"] = "Reçu pas la direction";
$MESS["LIBTA_T_IFELSEA2"] = "Facture est validée";
$MESS["LIBTA_T_IFELSEBA1"] = "Oui";
$MESS["LIBTA_T_IFELSEBA2"] = "Non";
$MESS["LIBTA_T_IFELSEBA3"] = "Oui";
$MESS["LIBTA_T_IFELSEBA4"] = "Non";
$MESS["LIBTA_T_PBP"] = "Créer un processus d'affaires consécutif";
$MESS["LIBTA_T_PDA1"] = "Publication du document";
$MESS["LIBTA_T_RIA10"] = "Règlement de la facture";
$MESS["LIBTA_T_RRA15"] = "Documents du compte";
$MESS["LIBTA_T_RRA17_NAME"] = "Documents reçus";
$MESS["LIBTA_T_SA0"] = "Ordre de succession d'actions";
$MESS["LIBTA_T_SMA_MESSAGE_1"] = "Message : la demande de validation de la facture";
$MESS["LIBTA_T_SMA_MESSAGE_10"] = "Message : compte non approuvé";
$MESS["LIBTA_T_SMA_MESSAGE_2"] = "Message : compte approuvé";
$MESS["LIBTA_T_SMA_MESSAGE_3"] = "Message : confirmation de paiement";
$MESS["LIBTA_T_SMA_MESSAGE_4"] = "Message : le paiement est confirmé";
$MESS["LIBTA_T_SMA_MESSAGE_5"] = "Message : facture à payer";
$MESS["LIBTA_T_SMA_MESSAGE_6"] = "Message : facture liquidée";
$MESS["LIBTA_T_SMA_MESSAGE_7"] = "Message : les documents sont rassemblés";
$MESS["LIBTA_T_SMA_MESSAGE_8"] = "Message : documents reçus";
$MESS["LIBTA_T_SMA_MESSAGE_9"] = "Message : le paiement n'est pas confirmé";
$MESS["LIBTA_T_SPA1"] = "Personnes responsables fixés";
$MESS["LIBTA_T_SPAX1"] = "Définition des droits : pour celui qui valide la lecture";
$MESS["LIBTA_T_SPAX2"] = "Définir des autorisations pour : gestionnaire approuvant";
$MESS["LIBTA_T_SPAX3"] = "Définition des droits : pour le payeur";
$MESS["LIBTA_T_SPAX4"] = "Définition des droits : au générateur de documentations";
$MESS["LIBTA_T_SPAX5"] = "Définition des droits d'accès : finale";
$MESS["LIBTA_T_SSTA1"] = "Statut : en attente de confirmation";
$MESS["LIBTA_T_SSTA2"] = "Statut : validé";
$MESS["LIBTA_T_SSTA3"] = "Statut : non confirmé";
$MESS["LIBTA_T_SSTA4"] = "Statut : sur la confirmation de paiement";
$MESS["LIBTA_T_SSTA5"] = "Statut : paiement est confirmé";
$MESS["LIBTA_T_SSTA6"] = "Statut : attente de paiement";
$MESS["LIBTA_T_SSTA7"] = "Statut : facture payée";
$MESS["LIBTA_T_SSTA8"] = "Statut : la facture est acquittée";
$MESS["LIBTA_T_SSTA9"] = "Statut : Paiement refusé";
$MESS["LIBTA_T_SVWA1"] = "Assignement du validateur";
$MESS["LIBTA_T_SVWA2"] = "Assignement du validateur";
$MESS["LIBTA_T_SVWA3"] = "Changement de variables";
$MESS["LIBTA_T_WHILEA1"] = "Le cycle de coordination";
$MESS["LIBTA_T_XMA_MESSAGES_1"] = "Message : validation du compte";
$MESS["LIBTA_T_XMA_MESSAGES_2"] = "Message : confirmation de paiement";
$MESS["LIBTA_T_XMA_MESSAGES_3"] = "Message : facture à payer";
$MESS["LIBTA_V_APPR"] = "Paiement confirmé";
$MESS["LIBTA_V_APPRU"] = "Approbateur";
$MESS["LIBTA_V_BK"] = "Service de comptabilité (validation du paiement)";
$MESS["LIBTA_V_BKD"] = "Service de comptabilité (collecte de documents)";
$MESS["LIBTA_V_BKP"] = "Service de comptabilité (paiement de la facture)";
$MESS["LIBTA_V_DOMAIN"] = "Domaine";
$MESS["LIBTA_V_LINK"] = "Lien au commentaire";
$MESS["LIBTA_V_MAPPR"] = "Manuel (validation des factures)";
$MESS["LIBTA_V_MNG"] = "Conseil d'administration";
$MESS["LIBTA_V_PDATE"] = "date de paiement";
$MESS["LIBTA_V_PNUM"] = "Numéro d'ordre";
$MESS["LIBTA_V_TLINK"] = "Lien vers la liste de tâches";
$MESS["LIBTA_XMA_MESSAGES_1"] = "BIP : Facture pour approbation";
$MESS["LIBTA_XMA_MESSAGES_2"] = "BIP : Confirmation du paiement de facture";
$MESS["LIBTA_XMA_MESSAGES_3"] = "BIP : Facture de paiement";
$MESS["LIBTA_XMA_MESSAGET_1"] = "Demande d'approuver le compte

Qui a créé : {=Document:CREATED_BY_PRINTABLE}
Date de création : {=Document:DATE_CREATE}
Dénomination : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date du compte : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Poste budgétaire : {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/


Liste de tâches par les processus d'affaires:
{=Variable:TasksLink}";
$MESS["LIBTA_XMA_MESSAGET_2"] = "Demande de confirmer le paiement du compte

Approuvé : {=Variable:Approver_printable}
Créé par : {=Document:CREATED_BY_PRINTABLE}
Date de création : {=Document:DATE_CREATE}
Dénomination : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date du compte : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Poste budgétaire : {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/

Liste de tâches:
{=Variable:TasksLink}";
$MESS["LIBTA_XMA_MESSAGET_3"] = "Payez la facture, s'il vous plaît

Le paiement est confirmé : {=Variable:PaymentApprover_printable}
La facture est approuvée : {=Variable:Approver_printable}
Créé par : {=Document:CREATED_BY_PRINTABLE}
Date de la création : {=Document:DATE_CREATE}
Titre : {=Document:NAME}
Type : {=Document:PROPERTY_TYPE}
Numéro et date de la facture : {=Document:PROPERTY_NUM_DATE}
Montant : {=Document:PROPERTY_SUM}
Poste budgétaire : {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/

Liste de tâches:
{=Variable:TasksLink}";
?>