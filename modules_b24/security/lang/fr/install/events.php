<?
$MESS["VIRUS_DETECTED_DESC"] = "#EMAIL# - Adresse email de l'administrateur du site (à partir des paramètres du module principal)";
$MESS["VIRUS_DETECTED_MESSAGE"] = "Message venu du site #SITE_NAME#
------------------------------------------

Bonjour !

Vous avez reçu ce message parce que le module de sécurité proactive du serveur #SERVER_NAME# a trouvé un code similaire à un virus.

1 le code suspect a été découpé de html.
2 Vérifiez le journal d'invasions et assurez-vous que le code est vraiment nuisible, et n'est pas une source d'un compteur ou d'un cadre.
 (Lien : http://#SERVER_NAME#/bitrix/admin/event_log.php?lang=fr&set_filter=Y&find_type=audit_type_id&find_audit_type[]=SECURITY_VIRUS )
3 Si le code n'est pas dangereux, ajoutez-le aux exceptions à la page des paramètres anti-virus.
 (Lien : http://#SERVER_NAME#/bitrix/admin/security_antivirus.php?lang=fr&tabControl_active_tab=exceptio)
4 Si le code est un virus, alors vous devez effectuer les étapes suivantes :

 a) Modifiez le mot de passe pour accéder aux administrateurs du site et des collaborateurs responsables.
 b) Modifiez les mots de passe via ssh et ftp.
 c) Vérifier et soignez les ordinateurs d'administrateurs qui ont eu l'accès au site via ssh ou ftp.
 d) Dans les programmes d'accès au site via ssh et ftp désactiver le mot de passe.
 e) Supprimez le code nuisible de fichiers infectés. Par exemple, restaurer les fichiers endommagés à partir de la dernière sauvegarde.

-------------------------------------------------- -------------------
Le message est généré automatiquement.";
$MESS["VIRUS_DETECTED_NAME"] = "Virus détecté";
$MESS["VIRUS_DETECTED_SUBJECT"] = "#SITE_NAME# : Un virus a été détecté";
?>