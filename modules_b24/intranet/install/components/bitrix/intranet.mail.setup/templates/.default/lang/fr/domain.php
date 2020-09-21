<?
$MESS["INTR_MAIL_AJAX_ERROR"] = "Erreur lors de l'exécution de la demande";
$MESS["INTR_MAIL_CHECK_JUST_NOW"] = "Code secret (secret App) : ";
$MESS["INTR_MAIL_CHECK_TEXT"] = "Dernière vérification #DATE#";
$MESS["INTR_MAIL_CHECK_TEXT_NA"] = "Aucune donnée sur l'état du domaine";
$MESS["INTR_MAIL_CHECK_TEXT_NEXT"] = "Vérification suivante dans #DATE#";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM"] = "Déconnecter le domaine ? Toutes les boîtes aux lettres connectées au portail seront également déconnectées !";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM_TEXT"] = "Voulez-vous de détacher le domaine ?<br>Tous les boîtes aux lettres attachées sur le portail seront détachés ainsi !";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME"] = "nom invalide";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME_HINT"] = "Le nom de domaine peut inclure des caractères latins, des chiffres et des traits d'union; ne peut pas commencer ou finir par un trait d'union, ou répéter le trait d'union aux positions 3 et 4. Terminez le nom avec le <b>.com</b>.";
$MESS["INTR_MAIL_DOMAIN_CHECK"] = "Vérifier";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_HINT"] = "Choisir un nom de domaine .com";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_TITLE"] = "Choisissez Domain";
$MESS["INTR_MAIL_DOMAIN_EMPTY_NAME"] = "entrez le nom";
$MESS["INTR_MAIL_DOMAIN_EULA_CONFIRM"] = "Je accepte les termes de la <a href='http://www.bitrix24.ru/about/domain.php' target='_blank'>Contrat de licence</a>";
$MESS["INTR_MAIL_DOMAIN_HELP"] = "Si votre domaine n'est pas encore réglé pour le travail dans Yandex.Mail pour le domaine, exécutez les actions suivantes:
<br/><br/>
- <a href='https://passport.yandex.com/registration/' target='_blank'>Ouvrez le compte</a> dans Yandex.Mail ou utilisez le compte déjà existant<br/>
- <a href='https://pdd.yandex.ru/domains_add/' target='_blank'>Connectez le domaine</a> à Yandex.Mail pour le domaine<sup> (<a href='http://help.yandex.ru/pdd/add-domain/add-exist.xml' target='_blank' title='Comment ca fonctionne ?'>?</a>)</sup><br/>
- Confirmer la propriété du domaine <sup>(<a href='http://help.yandex.ru/pdd/confirm-domain.xml' target='_blank' title='Comment ca fonctionne ?'>?</a>)</sup><br/>
- Réglez les enregistrements MX <sup>(<a href='http://help.yandex.ru/pdd/records.xml#mx' target='_blank' title='Comment régler les enregistrements MX ?'>?</a>)</sup> ou déléguez votre domaine à Yandex <sup>(<a href='http://help.yandex.ru/pdd/hosting.xml#delegate' target='_blank' title='Comment déléguer le domaine à Yandex ?'>?</a>)</sup>
<br/><br/>
Quand tous les réglages pour le domaine sont exécutés sur Yandex.Mail, connectez le domaine à votre portail :
<br/><br/>
- <a href='https://pddimp.yandex.ru/api2/admin/get_token' target='_blank' onclick='window.open(this.href, '_blank', 'height=480,width=720,top='+parseInt(screen.height/2-240)+',left='+parseInt(screen.width/2-360)); return false; '>Recevez le token</a> (dans la fenêtre apparue remplissez le formulaire et cliquez sur 'Get token', dupliquez le token reçu)<br/>
- Indiquez le domaine et le token sous forme";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1"] = "Étape&nbsp;1.&nbsp;&nbsp;Confirmer le droit de posséder le domaine";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_A"] = "Chargez dans le répertoire racine de votre site le fichier nommé <b>#SECRET_N#.html</b> et contenant le texte <b>#SECRET_C#</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B"] = "Pour configurer les entrées CNAME vous devez avoir accès aux modifications des entrées DNS de votre domaine auprès de votre registraire ou de votre fournisseur d'hébergement. Généralement, ce type d'accès est disponible via une interface web.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAME"] = "Nom de note : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAMEV"] = "<b>yamail-#SECRET_N#</b> (ou <b>yamail-#SECRET_N#.#DOMAIN#.</b> avec un point à la fin, en fonction de l'interface)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_PROMPT"] = "Il faut indiquer les réglages ci-dessous : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_TYPE"] = "Type de l'inscription : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUE"] = "Valeur : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUEV"] = "<b>mail.yandex.ru.</b> (le point à la fin de l'adresse est important)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C"] = "Indiquez l'adresse <b>#DOMAIN#+#SECRET_N#@yandex.ru</b> en tant qu'adresse postale de contact dans les données d'enregistrement de votre domaine. Cette opération se fait à l'aide des outils de votre enregistreur des domaines.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C_HINT"] = "Changez cette adresse e-mail pour votre adresse e-mail réelle dès que le domaine est confirmé.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_HINT"] = "Si vous avez des questions ou des problèmes liés à la confirmation du domaine, <a href='http://bitrixsoft.com/support/' target='_blank'>contactez le service client</a>.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_OR"] = "ou";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_PROMPT"] = "Vous devez cliquer sur le bouton \"réponse\" à commencer à répondre.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2"] = "Étape&nbsp;2.&nbsp;&nbsp; Régler les enregistrements MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_HINT"] = "Supprimer toutes les anciennes MX-inscriptions et TXT-inscriptions qui n'amènent pas aux serveurs du Yandex. Le processus de la diffusion d'information sur la modification de MX-inscriptions peut prendre de quelques heures jusqu'à deux ou trois jours.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_MXPROMPT"] = "Créez un nouvel enregistrement MX aux paramètres suivants : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAME"] = "Nom de note : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAMEV"] = "<b>@</b> (ou <b>#DOMAIN#.</b> avec un point à la fin en fonction de l'interface)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PRIORITY"] = "Priorité : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PROMPT"] = "Ayant confirmé la possession du domaine vous devrez modifier les enregistrements MX qui lui correspondent. Cette opération s'effectue à l'aide des outils de l'hébergeur qui gère votre domaine.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TITLE"] = "Réglage d'un enregistrement MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TYPE"] = "Type de l'inscription : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUE"] = "Valeur : ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUEV"] = "<b>mx.yandex.net.</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_TITLE"] = "Pour connecter votre domaine à Bitrix24 vous devez suivre quelques étapes.";
$MESS["INTR_MAIL_DOMAIN_LONG_NAME"] = "max. 63 caractères avant .com";
$MESS["INTR_MAIL_DOMAIN_NAME_FREE"] = "ce nom est libre";
$MESS["INTR_MAIL_DOMAIN_NAME_OCCUPIED"] = "ce nom n'est pas disponible";
$MESS["INTR_MAIL_DOMAIN_NOCONFIRM"] = "Le domaine n'est pas validé";
$MESS["INTR_MAIL_DOMAIN_NOMX"] = "Les enregistrements MX ne sont pas configurés";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TEXT"] = "Une fois connecté, vous ne serez pas en mesure de changer le nom de domaine<br>ou en obtenir un autre, parce que vous pouvez vous inscrireun seul domaine pour votre Bitrix24.<br><br>Si vous trouvez le nom <b>#DOMAIN#</b> est correct, confirmez votre nouveau domaine.";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TITLE"] = "S'il vous plaît vérifier que vous avez entré le nom de domaine correctement.";
$MESS["INTR_MAIL_DOMAIN_REMOVE"] = "Désactiver";
$MESS["INTR_MAIL_DOMAIN_SAVE"] = "Enregistrer";
$MESS["INTR_MAIL_DOMAIN_SAVE2"] = "Connecter";
$MESS["INTR_MAIL_DOMAIN_SETUP_HINT"] = "Le nom de domaine peut prendre de 1 heure à plusieurs jours pour confirmer.";
$MESS["INTR_MAIL_DOMAIN_SHORT_NAME"] = "au moins deux caractères avant .com";
$MESS["INTR_MAIL_DOMAIN_STATUS_CONFIRM"] = "Confirmé";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOCONFIRM"] = "Non confirmé";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOMX"] = "Les enregistrements MX ne sont pas configurés";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE"] = "Statut de la connexion au domaine";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE2"] = "Domaine est confirmé";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_MORE"] = "Afficher d'autres options";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_TITLE"] = "S'il vous plaît venir avec un autre nom ou choisir un";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_WAIT"] = "Recherche de noms possibles ...";
$MESS["INTR_MAIL_DOMAIN_TITLE"] = "Si votre domaine est réglé pour fonctionner à Yandex.Potchta pour le domaine indiquer tout simplement le nom du domaine et le token dans la forme en bas";
$MESS["INTR_MAIL_DOMAIN_TITLE2"] = "Le domaine est connecté à votre portail";
$MESS["INTR_MAIL_DOMAIN_TITLE3"] = "Domaine pour votre correspondance";
$MESS["INTR_MAIL_DOMAIN_WAITCONFIRM"] = "Attend la confirmation";
$MESS["INTR_MAIL_DOMAIN_WAITMX"] = "Les enregistrements MX ne sont pas configurés";
$MESS["INTR_MAIL_DOMAIN_WHOIS"] = "Exécuter";
$MESS["INTR_MAIL_GET_TOKEN"] = "obtenir";
$MESS["INTR_MAIL_INP_CANCEL"] = "Annuler";
$MESS["INTR_MAIL_INP_DOMAIN"] = "Nom de domaine";
$MESS["INTR_MAIL_INP_PUBLIC_DOMAIN"] = "Autoriser les collaborateurs à enregistrer les boîtes dans le nouveau domaine";
$MESS["INTR_MAIL_INP_TOKEN"] = "Jeton";
$MESS["INTR_MAIL_MANAGE"] = "Ajuster les messageries pour des utilisateurs";
?>