<?
$MESS["LDAP_BITRIXVM_BLOCK"] = "Changement de l'adresse Ntlm d'autorisation sur les portes 8890 et 8891";
$MESS["LDAP_BITRIXVM_HINT"] = "Indiquez ici un sous-réseau, dont l'authentification NTLM d'utilisateurs il faut rediriger.<br> Par exemple: <b>192.168.1.0/24</b> ou <b>192.168.1.0/255.255.255.0</b>.<br>On peut indiquer plusieurs plages séparées par un point-virgule (;). <br> Si vous laissez le champ vide, la redirection fonctionne alors pour tous les utilisateurs.";
$MESS["LDAP_BITRIXVM_NET"] = "Restreindre le transfert NTLM par le sous-réseau suivant : ";
$MESS["LDAP_BITRIXVM_SUPPORT"] = "Activer le réadressage NTLM de l'autorisation : ";
$MESS["LDAP_CURRENT_USER"] = "ID actuel d'utilisateur pour autorisation NTLM (domaine\\ login) : ";
$MESS["LDAP_CURRENT_USER_ABS"] = "Indéfini";
$MESS["LDAP_DEFAULT_NTLM_SERVER"] = "Serveur du domaine par défaut : ";
$MESS["LDAP_DUPLICATE_LOGIN_USER"] = "Créer un utilisateur même si l'identifiant est déjà utilisé : ";
$MESS["LDAP_NOT_USE_DEFAULT_NTLM_SERVER"] = "Ne pas utiliser";
$MESS["LDAP_OPTIONS_DEFAULT_EMAIL"] = "Adresse email pour les utilisateurs n'ayant pas indiqué le leur adresse : ";
$MESS["LDAP_OPTIONS_GROUP_LIMIT"] = "Nombre maximal des entrées LDAP choisies pour une requête : ";
$MESS["LDAP_OPTIONS_NEW_USERS"] = "Créer de nouveaux utilisateurs lors de la première autorisation réussie : ";
$MESS["LDAP_OPTIONS_NTLM_VARNAME"] = "Le nom d'une variable PHP qui garde l'identifiant d'utilisateur NTLM (généralement REMOTE_USER) : ";
$MESS["LDAP_OPTIONS_RESET"] = "Annuler";
$MESS["LDAP_OPTIONS_SAVE"] = "Enregistrer";
$MESS["LDAP_OPTIONS_USE_NTLM"] = "Utiliser l'autorisation NTLM<sup><span class='required'>1</span></sup>";
$MESS["LDAP_OPTIONS_USE_NTLM_MSG"] = "<span class='required'>1</span></sup> - Pour l'authentification NTLM il est nécessaire de configurer les modules correspondants du serveur Web et de préciser les domaines de l'authentification NTLM aux paramètres du serveur AD sur le portail.";
$MESS["LDAP_WITHOUT_PREFIX"] = "Vérifier l'autorisation sur tous les serveurs Idap accessibles, si le nom d'utilisateur ne contient pas le préfixe";
$MESS["LDAP_WRONG_NET_MASK"] = "L'adresse et la masque du sous-réseau pour l'authentification NTLM sont indiqués de manière incorrecte.<br> Variantes acceptables : <br> réseau/masque <br> xxx.xxx.xxx.xxx/xxx.xxx.xxx.xxx <br> xxx.xxx.xxx.xxx/xx<br>Vous pouvez spécifier plusieurs plages séparées par un point-virgule (;).";
?>