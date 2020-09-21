<?
$MESS["INTR_MAIL_AJAX_ERROR"] = "Erreur lors de l'exécution de la demande";
$MESS["INTR_MAIL_CHECK_JUST_NOW"] = "secondes passées";
$MESS["INTR_MAIL_CHECK_TEXT"] = "Dernière vérification le #DATE#";
$MESS["INTR_MAIL_CHECK_TEXT_NA"] = "Aucune donnée sur l'état du domaine";
$MESS["INTR_MAIL_CHECK_TEXT_NEXT"] = "Prochaine vérification dans #DATE#";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM"] = "Voulez-vous déconnecter le domaine ?";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM_TEXT"] = "Voulez-vous détacher le domaine ?<br>Tous les boîtes aux lettres attachées au portail seront également détachées !";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME"] = "nom invalide";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME_HINT"] = "Le nom de domaine peut inclure des caractères latins, des chiffres et des traits d'union; ne peut pas commencer ou finir par un trait d'union, ou répéter le trait d'union aux positions 3 et 4. Terminez le nom par <b>.com</b>.";
$MESS["INTR_MAIL_DOMAIN_CHECK"] = "Vérifier";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_HINT"] = "Choisir un nom de domaine .com";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_TITLE"] = "Choisir un domaine";
$MESS["INTR_MAIL_DOMAIN_EMPTY_NAME"] = "entrer un nom";
$MESS["INTR_MAIL_DOMAIN_EULA_CONFIRM"] = "J'accepte les termes du <a href=\"http://www.bitrix24.ru/about/domain.php\" target=\"_blank\">Contrat de licence</a>";
$MESS["INTR_MAIL_DOMAIN_HELP"] = "Si votre domaine n'est pas encore configuré pour travailler avec la messagerie hébergée sur Yandex, procédez comme suit:
<br/><br/>
- <a href=\"https://passport.yandex.com/registration/\" target=\"_blank\">Créez un compte de messagerie sur Yandex</a> ou utilisez votre compte déjà créé.
- <a href=\"https://pdd.yandex.ru/domains_add/\" target=\"_blank\">Attachez votre domaine</a> à la messagerie hébergée sur Yandex<sup> (<a href=\"http://help.yandex.ru/pdd/add-domain/add-exist.xml\" target=\"_blank\" title=\"How do I do it ?\">?</a>)</sup><br/>
- Vérifiez l'appartenance de votre domaine<sup>(<a href=\"http://help.yandex.ru/pdd/confirm-domain.xml\" target=\"_blank\" title=\"How do I do it ?\">?</a>)</sup><br/>
- Configurez les enregistrements MX<sup>(<a href=\"http://help.yandex.ru/pdd/records.xml#mx\" target=\"_blank\" title=\"How do I do it ?\">?</a>)</sup>
ou déléguez votre domaine à Yandex<sup>(<a href=\"http://help.yandex.ru/pdd/hosting.xml#delegate\" target=\"_blank\" title=\"How do I do it ?\">?</a>)</sup>
<br/><br/>
Lorsque votre compte de messagerie hébergée sur Yandex a été configuré, attachez le domaine à votre Bitrix24 :
<br/><br/> - <a href=\"https://pddimp.yandex.ru/api2/admin/get_token\" target=\"_blank\" onclick=\"window.open(this.href, '_blank', 'height=480,width=720,top='+parseInt(screen.height/2-240)+',left='+parseInt(screen.width/2-360)); return false; \">Obtenez un jeton d'accès</a> (remplissez le formulaire et cliquez sur 'Obtenir le jeton d'accès'&quot;. Copiez le jeton d'accès obtenu )<br/>
- Ajoutez le domaine et le jeton d'accès aux paramètres.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1"] = "Étape&nbsp;1.&nbsp;&nbsp;Confirmer la propriété du domaine";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_A"] = "Chargez un fichier appelé <b>#SECRET_N#.html</b> dans le répertoire racine de votre site. Le fichier doit contenir le texte : <b>#SECRET_C#</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B"] = "Pour configurer l'enregistrement CNAME, vous devez avoir accès aux enregistrements DNS de votre domaine auprès de l'enregistreur ou du fournisseur d'hébergement avec lequel vous avez enregistré votre domaine. Vous trouverez ces paramètres dans votre compte ou dans le panneau de configuration.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAME"] = "Nom de l'enregistrement : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAMEV"] = "<b>yamail-#SECRET_N#</b> (ou <b>yamail-#SECRET_N#.#DOMAIN#.</b> avec un point à la fin, en fonction de l'interface)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_PROMPT"] = "Spécifiez ces valeurs :";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_TYPE"] = "Type d'enregistrement : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUE"] = "Valeur : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUEV"] = "<b>mail.yandex.ru.</b> (avec un point à la fin)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C"] = "Configurez l'adresse e-mail de contact dans les informations d'enregistrement de votre domaine comme <b>#SECRET_N#@yandex.ru</b>. Utilisez le panneau de configuration de votre enregistreur de domaines afin de configurer l'adresse e-mail.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C_HINT"] = "Changez cette adresse e-mail pour votre adresse e-mail réelle dès que le domaine est confirmé.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_HINT"] = "Si vous avez des questions ou des problèmes liés à la propriété de votre domaine, contactez l'assistance technique via <a href=\"https://helpdesk.bitrix24.com/\" target=\"_blank\">helpdesk.bitrix24.com</a>.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_OR"] = "ou";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_PROMPT"] = "Vous devez confirmer que vous êtes le propriétaire du nom de domaine spécifié en utilisant l'une des méthodes suivantes :";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2"] = "Étape&nbsp;2.&nbsp;&nbsp; Configurer les enregistrements MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_HINT"] = "Supprimez tous les autres enregistrements MX et TXT qui se sont pas liés à Yandex. Les modifications apportées aux enregistrements MX peuvent prendre de quelques heures à trois jours pour être actualisées sur Internet.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_MXPROMPT"] = "Créez un nouvel enregistrement MX avec les paramètres suivants : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAME"] = "Nom de l'enregistrement :";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAMEV"] = "<b>@</b> (ou <b>#DOMAIN#.</b> - si nécessaire. Avec un point à la fin)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PRIORITY"] = "Priorité: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PROMPT"] = "Lorsque vous avez confirmé la propriété de votre domaine, vous devrez modifier les enregistrements MX correspondants sur votre hébergement web.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TITLE"] = "Configurer les enregistrements MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TYPE"] = "Type d'enregistrement :";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUE"] = "Valeur : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUEV"] = "<b>mx.yandex.net.</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_TITLE"] = "Pour connecter votre domaine à Bitrix24, vous devez suivre quelques étapes.";
$MESS["INTR_MAIL_DOMAIN_LONG_NAME"] = "max. 63 caractères avant .com";
$MESS["INTR_MAIL_DOMAIN_NAME_FREE"] = "ce nom est disponible";
$MESS["INTR_MAIL_DOMAIN_NAME_OCCUPIED"] = "ce nom n'est pas disponible";
$MESS["INTR_MAIL_DOMAIN_NOCONFIRM"] = "Domaine non confirmé";
$MESS["INTR_MAIL_DOMAIN_NOMX"] = "Les enregistrements MX ne sont pas configurés";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TEXT"] = "Une fois connecté, vous ne pourrez plus changer le nom de domaine<br>ou en obtenir un autre, car vous ne pouvez enregistrer<br>qu'un seul domaine pour votre Bitrix24.<br><br>Si vous trouvez que le nom <b>#DOMAIN#</b> est correct, confirmez votre nouveau domaine.";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TITLE"] = "Veuillez vous assurer d'avoir entré le nom de domaine correctement.";
$MESS["INTR_MAIL_DOMAIN_REMOVE"] = "Détacher";
$MESS["INTR_MAIL_DOMAIN_SAVE"] = "Enregistrer";
$MESS["INTR_MAIL_DOMAIN_SAVE2"] = "Connecter";
$MESS["INTR_MAIL_DOMAIN_SETUP_HINT"] = "Le nom de domaine peut prendre de 1 heure à plusieurs jours pour être confirmé.";
$MESS["INTR_MAIL_DOMAIN_SHORT_NAME"] = "au moins deux caractères avant .com";
$MESS["INTR_MAIL_DOMAIN_STATUS_CONFIRM"] = "Confirmé";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOCONFIRM"] = "Non confirmé";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOMX"] = "Les enregistrements MX ne sont pas configurés";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE"] = "Statut de liaison du domaine";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE2"] = "Domaine confirmé";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_MORE"] = "Afficher d'autres options";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_TITLE"] = "Veuillez indiquer un autre nom ou en choisir un";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_WAIT"] = "Recherche des noms possibles...";
$MESS["INTR_MAIL_DOMAIN_TITLE"] = "Si votre domaine est configuré pour fonctionner sur Yandex.Mail pour les domaines, entrez simplement le nom du domaine et le jeton d'accès dans le formulaire ci-dessous";
$MESS["INTR_MAIL_DOMAIN_TITLE2"] = "Le domaine est maintenant lié à votre portail";
$MESS["INTR_MAIL_DOMAIN_TITLE3"] = "Domaine pour votre adresse e-mail";
$MESS["INTR_MAIL_DOMAIN_WAITCONFIRM"] = "En attente de confirmation";
$MESS["INTR_MAIL_DOMAIN_WAITMX"] = "Les enregistrements MX ne sont pas configurés";
$MESS["INTR_MAIL_DOMAIN_WHOIS"] = "Vérifier";
$MESS["INTR_MAIL_GET_TOKEN"] = "obtenir";
$MESS["INTR_MAIL_INP_CANCEL"] = "Annuler";
$MESS["INTR_MAIL_INP_DOMAIN"] = "Nom du domaine";
$MESS["INTR_MAIL_INP_PUBLIC_DOMAIN"] = "Les utilisateurs peuvent créer des boîtes de réception sur ce domaine";
$MESS["INTR_MAIL_INP_TOKEN"] = "Jeton d'accès";
$MESS["INTR_MAIL_MANAGE"] = "Configurer les boîtes de réception d'utilisateur";
?>