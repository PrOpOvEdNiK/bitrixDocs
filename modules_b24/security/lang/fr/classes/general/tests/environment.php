<?
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR"] = "Les fichiers temporaires sont conservés dans le répertoire racine du projet";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR_ADDITIONAL"] = "Répertoire actuel : #DIR#";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR_DETAIL"] = "Enregistrer les fichiers temporaires créés par CTempFile dans le répertoire racine n'est pas recommandé.";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR_RECOMMENDATION"] = "Définissez une constante \"BX_TEMPORARY_FILES_DIRECTORY\" dans \"bitrix/php_interface/dbconn.php\" et indiquez un chemin d'accès requis.<br>
Suivez ces étapes : <br>
1. Choisissez un nom pour votre répertoire remporaire et créez-le. Par exemple, \"/home/bitrix/tmp/www\":
<pre>
mkdir -p -m 700 /home/bitrix/tmp/www
</pre>
2. Définissez la constante pour permettre au système de savoir que vous voulez enregistrer les fichiers temporaires dans ce répertoire :
<pre>
define(\"BX_TEMPORARY_FILES_DIRECTORY\", \"/home/bitrix/tmp/www\");
</pre>";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION"] = "Il est possible que des sessions d'autres projets se trouvent dans le répertoire de stockage des sessions.";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_ADDITIONAL_OWNER"] = "La raison: l'utilisateur actuel n'est pas le propriétaire du fichier<br>
Fichier: #FILE#<br>
UID du propriétaire du fichier: #FILE_ONWER# 
UID de l'utilisateur actuel: #CURRENT_OWNER#<br>";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_ADDITIONAL_SIGN"] = "Cause: le fichier de session ne contient pas la signature du site actuel<br>
Fichier: #FILE#<br>
Signature du site actuel: #SIGN#<br>
Contenu du fichier: <pre>#FILE_CONTENT#</pre>";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_DETAIL"] = "Cela peut permettre de lire/modifier les données de session en utilisant les scripts des autres serveurs virtuels.";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_RECOMMENDATION"] = "Changer le dossier du stockage ou activer le stockage des sessions dans la base des données: <a href='/bitrix/admin/security_session.php'>Protection de la session</a>";
$MESS["SECURITY_SITE_CHECKER_EnvironmentTest_NAME"] = "Vérification des réglages de l'environnement";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER"] = "PHP est exécuté comme utilisateur privilégié";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER_ADDITIONAL"] = "#UID#/#GID#";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER_DETAIL"] = "Exécuter PHP comme utilisateur privilégié (ex : racine) peut compromettre la sécurité de votre projet";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER_RECOMMENDATION"] = "Configurez votre serveur de manière à ce que PHP soit exécuté comme un utilisateur non privilégié";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR"] = "Le répertoire de stockage des fichiers des sessions courantes est accessible à tous les utilisateurs du système";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR_ADDITIONAL"] = "Le répertoire de stockage des sessions: #DIR#<br>
Les droits: #PERMS#";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR_DETAIL"] = "Cela peut permettre de lire/modifier les données de session en utilisant les scripts des autres serveurs virtuels.";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR_RECOMMENDATION"] = "Configurer correctement les droits sur les fichiers ou modifier le dossier de stockage ou activer le stockage des sessions dans la base de données: <a href='/bitrix/admin/security_session.php'>Protection des sessions</a>";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP"] = "Les scripts PHP sont exécutés dans le répertoire de stockage des fichiers téléchargés.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DETAIL"] = "Les architectes oublient parfois le filtrage correct des noms de fichiers, si cela arrive, l'attaquant peutrecevoir le contrôle total de votre projet.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DOUBLE"] = "Scripts PHP à la double extension (eg php.lala) sont exécutés dans un répertoire du stockage des fichiers chargés.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DOUBLE_DETAIL"] = "Les architectes oublient parfois le filtrage correct des noms de fichiers, si cela arrive, l'attaquant peutrecevoir le contrôle total de votre projet.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DOUBLE_RECOMMENDATION"] = "Configurer votre serveur web correctement.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_RECOMMENDATION"] = "Configurer votre serveur web correctement.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PY"] = "Les scripts RU sont exécutées dans la direction de stockage de fichiers à télécharger.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PY_DETAIL"] = "Les architectes oublient parfois le filtrage correct des noms de fichiers, si cela arrive, l'attaquant peutrecevoir le contrôle total de votre projet.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PY_RECOMMENDATION"] = "Configurer votre serveur web correctement.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_HTACCESS"] = "Les fichiers.htaccess ne devraient pas être traitées dans le répertoire de stockage des fichiers téléchargés Apache";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_HTACCESS_DETAIL"] = "Les architectes oublient parfois le filtrage correct des noms de fichiers, si cela arrive, l'attaquant peutrecevoir le contrôle total de votre projet.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_HTACCESS_RECOMMENDATION"] = "Configurer votre serveur web correctement.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_NEGOTIATION"] = "Apache Content Negotiation est autorisé dans le répertoire de stockage des fichiers téléchargés.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_NEGOTIATION_DETAIL"] = "Apache Content Negotiation n'est pas conseillé pour l'utilisation parce qu'il peut servir de source d'attaque XSS.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_NEGOTIATION_RECOMMENDATION"] = "Configurer votre serveur web correctement.";
?>