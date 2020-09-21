<?
$MESS["SEC_SESSION_ADMIN_DB_BUTTON_OFF"] = "Désactiver le stockage des données de sessions dans une base de données du module";
$MESS["SEC_SESSION_ADMIN_DB_BUTTON_ON"] = "Activer le stockage des données des sessions dans la base de données du module";
$MESS["SEC_SESSION_ADMIN_DB_NOTE"] = "<p>La majorité des attaques sur les applications web ont pour l'objectif d'obtenir des données sur la session autorisée de l'utilisateur. L'activation de la <b>protection des sessions</b> rend le vol de la session autorisée inefficaceinefficace l'enlèvement de la session autorisée.</p>
<p>En supplément aux instruments standards de protection des sessions qui sont installés dans les configurations du groupe, <b>le mécanisme de protection des sessions</b> inclut:
<ul style='font-size:100%'>
<li>le changement d'identificateur de la session et la fréquence peut être modifiée;</li>
<li>le stockage des données des sessions dans une tableau du module.</li>
</ul>
 <p>Le stockage des données des sessions dans un tableau du module permet d'éviter la lecture de ces données par les scripts d'autres serveurs virtuels et éviter faire les erreurs de la configuration d'un hébergeur virtuel, les erreurs de droits d'accès aux catalogues temporaires ainsi qu'une série d'autres problèmes liés à la configuration d'environnement d'opérations. En plus, cela sert à décharger le système de fichier et transfére la charge au serveur de la base de données.</p>
<p><i>Il est recommandé d'activer pour le niveau élevé.</i></p>";
$MESS["SEC_SESSION_ADMIN_DB_OFF"] = "Les données de sessions ne sont pas sauvegardées dans la base de données du module de la sécurité.";
$MESS["SEC_SESSION_ADMIN_DB_ON"] = "Les données de sessions sont stockées dans la base de données du module de sécurité.";
$MESS["SEC_SESSION_ADMIN_DB_WARNING"] = "Attention ! Après le changement du régime de stockage des sessions tous les utilisateurs vont perdre l'autorisation (les données de sessions seront éliminées).";
$MESS["SEC_SESSION_ADMIN_SAVEDB_TAB"] = "Stockage dans la base de données";
$MESS["SEC_SESSION_ADMIN_SAVEDB_TAB_TITLE"] = "Activation du mécanisme de sauvegarde de ces sessions des utilisateurs dans la base de données";
$MESS["SEC_SESSION_ADMIN_SESSID_BUTTON_OFF"] = "Désactiver la substitution de l'identifiant";
$MESS["SEC_SESSION_ADMIN_SESSID_BUTTON_ON"] = "Activer le changement d'identificateur";
$MESS["SEC_SESSION_ADMIN_SESSID_NOTE"] = "<p>Si la fonction est activée, l'identificateur de la session de l'utilisateur changera après un laps de temps défini. Cela crée une charge supplémentaire sur le serveur, mais permet de rende le vol de la session autorisée inefficace.</p>
<p><i>Il est recommandé de l'activé pour un haut niveau.</i></p>";
$MESS["SEC_SESSION_ADMIN_SESSID_OFF"] = "Le changement de l'identificateur des sessions est désactivé.";
$MESS["SEC_SESSION_ADMIN_SESSID_ON"] = "La modification de l'ID de session est activée.";
$MESS["SEC_SESSION_ADMIN_SESSID_TAB"] = "Changement d'ID";
$MESS["SEC_SESSION_ADMIN_SESSID_TAB_TITLE"] = "Réglages des paramètres de changement de l'identificateur des sessions";
$MESS["SEC_SESSION_ADMIN_SESSID_TTL"] = "Durée de vie de l'identificateur, sec.";
$MESS["SEC_SESSION_ADMIN_SESSID_WARNING"] = "L'identifiant de session n'est pas compatible avec le module de sécurité. La longueur de l'identificateur retourné par la fonction session_id() ne doit pas être plus de 32 caractères et il doit conteniruniquement les lettres de l'alphabet latin et les chiffres.";
$MESS["SEC_SESSION_ADMIN_TITLE"] = "Protection des sessions";
?>