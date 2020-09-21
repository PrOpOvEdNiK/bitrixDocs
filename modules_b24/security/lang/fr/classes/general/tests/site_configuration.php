<?
$MESS["SECURITY_SITE_CHECKER_ADMIN_SECURITY_LEVEL"] = "Le niveau de sécurité du groupe d'administration n'est pas augmenté.";
$MESS["SECURITY_SITE_CHECKER_ADMIN_SECURITY_LEVEL_DETAIL"] = "Une baisse niveau de sécurité du groupe d'administration peut beaucoup aider un malfaiteur.";
$MESS["SECURITY_SITE_CHECKER_ADMIN_SECURITY_LEVEL_RECOMMENDATION"] = "Augmenter le niveau de sécurité du groupe d'administration";
$MESS["SECURITY_SITE_CHECKER_DANGER_EXTENSIONS"] = "La liste des extensions des fichiers potentiellement dangereuses est limitée";
$MESS["SECURITY_SITE_CHECKER_DANGER_EXTENSIONS_ADDITIONAL"] = "Actuels: #ACTUAL#<br>
Recommandés (sans prendre en compte les paramètres de votre serveur) : #EXPECTED#<br>
Manquants: #MISSING#";
$MESS["SECURITY_SITE_CHECKER_DANGER_EXTENSIONS_DETAIL"] = "La liste courante des extensions des fichiers qui sont considérées comme potentiellement dangereuses, ne contient pas toutes les valeurs recommandées. La liste des extensions des fichiers exécutables doit toujours être mise à jour";
$MESS["SECURITY_SITE_CHECKER_DANGER_EXTENSIONS_RECOMMENDATION"] = "Vous pouvez toujours modifier la liste des extensions de fichiers exécutables dans les paramètres du site: <a href='/bitrix/admin/settings.php?mid=fileman' target='_blank'>Gestion de la structure</a>";
$MESS["SECURITY_SITE_CHECKER_DB_DEBUG"] = "Le débogage des demandes SQL est activé (\$DBDebug dans le sens de true)";
$MESS["SECURITY_SITE_CHECKER_DB_DEBUG_DETAIL"] = "Le réglage de demandes SQL peut révéler une information importante sur la ressource";
$MESS["SECURITY_SITE_CHECKER_DB_DEBUG_RECOMMENDATION"] = "Désactiver ayant fixé la valeur de la variable \$DBDebug dans false";
$MESS["SECURITY_SITE_CHECKER_DB_EMPTY_PASS"] = "Le mot de passe pour la base de données est vide";
$MESS["SECURITY_SITE_CHECKER_DB_EMPTY_PASS_DETAIL"] = "Une base de données sans mot de passe augmente le risque de piratage de comptes dans la base de données.";
$MESS["SECURITY_SITE_CHECKER_DB_EMPTY_PASS_RECOMMENDATION"] = "Etablir un mot de passe";
$MESS["SECURITY_SITE_CHECKER_DB_MIN_LEN_PASS"] = "La longueur du mot de passe pour la base de données est inférieure à 8 caractères.";
$MESS["SECURITY_SITE_CHECKER_DB_MIN_LEN_PASS_DETAIL"] = "Le mot de passe est trop simple, cela augmente la risque du piratage du compte personnel dans la base de données.";
$MESS["SECURITY_SITE_CHECKER_DB_MIN_LEN_PASS_RECOMMENDATION"] = "Augmenter la longueur du mot de passe";
$MESS["SECURITY_SITE_CHECKER_DB_NO_DIT_PASS"] = "Le mot de passe pour la base de données ne contient pas de chiffres";
$MESS["SECURITY_SITE_CHECKER_DB_NO_DIT_PASS_DETAIL"] = "Le mot de passe est trop simple, cela augmente la risque du piratage du compte personnel dans la base de données.";
$MESS["SECURITY_SITE_CHECKER_DB_NO_DIT_PASS_RECOMMENDATION"] = "Ajouter des chiffres dans un mot de passe.";
$MESS["SECURITY_SITE_CHECKER_DB_NO_SIGN_PASS"] = "Mot de passe pour la base de données ne contient pas de symboles spéciaux(signes de ponctuation).";
$MESS["SECURITY_SITE_CHECKER_DB_NO_SIGN_PASS_DETAIL"] = "Le mot de passe est trop simple, cela augmente la risque du piratage du compte personnel dans la base de données.";
$MESS["SECURITY_SITE_CHECKER_DB_NO_SIGN_PASS_RECOMMENDATION"] = "Ajouter les signes de ponctuations dans le mot de passe";
$MESS["SECURITY_SITE_CHECKER_DB_SAME_REGISTER_PASS"] = "Symboles du mot de passe pour la base de données dans l'un registre.";
$MESS["SECURITY_SITE_CHECKER_DB_SAME_REGISTER_PASS_DETAIL"] = "Le mot de passe est trop simple, cela augmente la risque du piratage du compte personnel dans la base de données.";
$MESS["SECURITY_SITE_CHECKER_DB_SAME_REGISTER_PASS_RECOMMENDATION"] = "Utiliser des caractères différents dans un mot de passe.";
$MESS["SECURITY_SITE_CHECKER_ERROR_REPORTING"] = "Le niveau de sortie d'erreurs doit être 'Erreurs uniquement' ou 'ne pas afficher'";
$MESS["SECURITY_SITE_CHECKER_ERROR_REPORTING_DETAIL"] = "Affichage des notifications php peut permettre d'apprendre le chemin physique complet vers votre projet.";
$MESS["SECURITY_SITE_CHECKER_ERROR_REPORTING_RECOMMENDATION"] = "Modifiez le niveau d'erreur de sortie sur le 'ne pas imprimer': <a href='/bitrix/admin/settings.php?mid=main' target='_blank'>Paramètres du module principal</a>";
$MESS["SECURITY_SITE_CHECKER_EXCEPTION_DEBUG"] = "L'affichage détaillé des erreurs est activé";
$MESS["SECURITY_SITE_CHECKER_EXCEPTION_DEBUG_DETAIL"] = "L'affichage avancé des erreurs peut dévoiler des informations importantes sur la ressource.";
$MESS["SECURITY_SITE_CHECKER_EXCEPTION_DEBUG_RECOMMENDATION"] = "Désactiver dans le fichier des propriétés.settigs.php";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION"] = "Des modules de la plateforme utilisés sont obsolètes";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION_ARRITIONAL"] = "Les modules auxquels les mises à jours sont accessibles: <br>#MODULES#";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION_DETAIL"] = "Des nouvelles versions des modules sont disponibles";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION_ERROR"] = "Impossible de vérifier les mises à jour sont disponibles pour la plate-forme";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION_ERROR_DETAIL"] = "La mise à jour du système SiteUpdate peut être disponible ou la période de réception des mises à jour de votre copie du produit est arrivée à l'expiration.";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION_ERROR_RECOMMENDATION"] = "Plus en détails sur la page: <a href='/bitrix/admin/update_system.php' target='_blank'>mise à jour de plate-forme</a>.";
$MESS["SECURITY_SITE_CHECKER_MODULES_VERSION_RECOMMENDATION"] = "Il est recommandé de rafraîchir à temps les modules de la plateforme, d'installer les mises à jour recommandées: <a href='/bitrix/admin/update_system.php' target='_blank'>Mise à jour de la plateforme</a>";
$MESS["SECURITY_SITE_CHECKER_REDIRECT_OFF"] = "Protection de redirections désactivée";
$MESS["SECURITY_SITE_CHECKER_REDIRECT_OFF_DETAIL"] = "Le reroutage vers une ressource tierce arbitraire peut contribuer ux plusieures attaques, la protection des reroutages exclut cette possibilité (en cas d'utilisation d'API standard).";
$MESS["SECURITY_SITE_CHECKER_REDIRECT_OFF_RECOMMENDATION"] = "Activer la protection de redirections <a href='/bitrix/admin/security_redirect.php' protection target='_blank'>protection de redirections</a>";
$MESS["SECURITY_SITE_CHECKER_SiteConfigurationTest_NAME"] = "Vérification des réglages du site";
$MESS["SECURITY_SITE_CHECKER_WAF_OFF"] = "Il est recommandé d'activer une protection proactive.";
$MESS["SECURITY_SITE_CHECKER_WAF_OFF_DETAIL"] = "Filtre Proactive désactivé ne capture pas les tentative d'attaque sur une ressource";
$MESS["SECURITY_SITE_CHECKER_WAF_OFF_RECOMMENDATION"] = "Activez le filtre proactive: <a href='/bitrix/admin/security_filter.php' target='_blank'> filtre proactive</a>";
?>