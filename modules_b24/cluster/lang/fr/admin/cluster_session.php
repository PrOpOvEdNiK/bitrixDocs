<?
$MESS["CLU_SESSION_DB_BUTTON_OFF"] = "Désactiver le stockage des données de sessions dans une base de données du module";
$MESS["CLU_SESSION_DB_BUTTON_ON"] = "Activer le stockage des données des sessions dans la base de données du module";
$MESS["CLU_SESSION_DB_OFF"] = "Les données de sessions ne sont pas sauvegardées dans la base de données du module de la sécurité.";
$MESS["CLU_SESSION_DB_ON"] = "Les données de sessions sont stockées dans la base de données du module de sécurité.";
$MESS["CLU_SESSION_DB_WARNING"] = "Attention ! Après le changement du régime de stockage des sessions tous les utilisateurs vont perdre l'autorisation (les données de sessions seront éliminées).";
$MESS["CLU_SESSION_NOTE"] = "<p>Si plusieurs serveurs web sont utilisés, il faut régler le soutien de la session.</p>
<p>Les variantes le plus souvent utilisées de répartition de charge sur l'équilibreur : </p>
<p>1) la session de l'utilisateur est rattachée au serveur web et c'est seulement par lui qu'elle sera maintenue en ultérieur.</p>
<p>2) les divers 'hits' d'une même session sont maintenus par divers serveurs web.<br>
La nécessité d'inclure le stockage des données de ces sessions dans la base de données du module de sécurité est une condition obligatoire de l'aptitude à fonctionner de ce scénario.</p>";
$MESS["CLU_SESSION_NO_SECURITY"] = "Le module installé de la défense proactive est exigé.";
$MESS["CLU_SESSION_SAVEDB_TAB"] = "Stockage dans la base de données";
$MESS["CLU_SESSION_SAVEDB_TAB_TITLE"] = "Activation du mécanisme de sauvegarde de ces sessions des utilisateurs dans la base de données";
$MESS["CLU_SESSION_SESSID_WARNING"] = "L'identifiant de session n'est pas compatible avec le module de sécurité. La longueur de l'identificateur retourné par la fonction session_id() ne doit pas être plus de 32 caractères et il doit conteniruniquement les lettres de l'alphabet latin et les chiffres.";
$MESS["CLU_SESSION_TITLE"] = "Stocker les sessions dans une base de données";
?>