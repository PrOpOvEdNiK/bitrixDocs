<?
$MESS["DAV_HELP_NAME"] = "Module DAV";
$MESS["DAV_HELP_TEXT"] = "Le module DAV fournit pour la synchronisation des calendriers et des contacts entre le portail et tous les logiciels et le matériel qui supporte les protocoles CalDAV et / ou CardDAV, par exemple iPhone et iPad. Le support logiciel est fourni par Mozilla Sunbird, eM Client et d'autres applications logicielles. <br>
<ul>
<li><b><a href='#caldav'>Connecter en utilisant CalDav</a></b>
<ul>
<li><a href='#caldavipad'>Connectez l'iPhone</a></li>
<li><a href='#carddavsunbird'>Connect Mozilla Sunbird</a></li>
</ul>
</li>
<li><b><a href='#carddav'>Connecter en utilisant CardDAV</a></b></li>
</ul>

<br><br>

<h3><a name='caldav'></a>Connecter en utilisant CalDav</h3>

<h4><a name='caldavipad'></a>Connectez l'iPhone</h4>

Pour configurer votre appareil Apple pour soutenir CalDAV :
<ol>
<li>Cliquez sur <b>Paramètres</b> et sélectionnez <b>Comptes et mots de passe</b>.</li>
<li>Cliquez sur <b>Ajouter un compte</b>.</li>
<li>Sélectionnez <b>Autres</b> &gt; <b>Ajouter un compte CalDAV</b>.</li>
<li>Indiquez l'adresse d'un site Web en tant que serveur (#SERVER#). Utilisez votre login et votre mot de passe.</li>
<li>Autorisation d'utilisation de base.</li>
<li>Pour spécifier le numéro de port, enregistrer le compte et l'ouvrir à nouveau pour l'édition.</li>
</ol>

Vos calendriers apparaîtront dans le Calendrier application.<br>
Pour vous connecter, utilisez les liens calendriers d'autres utilisateurs : <br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/</i><br>
and<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/</i><br>

<br><br>

<h4><a name='carddavsunbird'></a>Connecter Mozilla Sunbird</h4>

Pour configurer Mozilla Sunbird pour une utilisation avec CalDAV :
<ol>
<li>Exécuter Sunbird et sélectionnez <b>Fichier &gt; Nouveau Calendrier</b>.</li>
<li>Sélectionnez <b>Sur le Network</b> et cliquez sur <b>Suivant</b>.</li>
<li>Sélectionnez <b>CalDAV</b> format.</li>
<li> Dans le <b>Location</b> field, entrez : <br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/calendar_ID/</i><br>
or<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/calendar_ID/</i><br>
et cliquez sur <b>Suivant</b>.</li>
<li>Donnez votre calendrier un nom et sélectionner une couleur pour elle.</li>
<li>Entrez votre nom d'utilisateur et mot de passe.</li>
</ol>

<br><br>

<h3><a name='carddav'></a>Connecter en utilisant CardDAV</h3>

Pour configurer votre appareil Apple pour soutenir CardDAV :
<ol>
<li>Cliquez sur <b>Paramètres</b> et sélectionnez <b>Mail, Contacts, Calendrier> Comptes</b>.</li>
<li>Cliquez sur <b>Ajouter un compte</b>.</li>
<li>Sélectionnez <b>Autre</b> &gt; <b>Ajouter un Compte CardDAV</b>.</li>
<li>Indiquez l'adresse d'un site Web en tant que serveur (#SERVER#). Utilisez votre login et votre mot de passe.</li>
<li>Autorisation d'utilisation de base.</li>
<li>Pour spécifier le numéro de port, enregistrer le compte et l'ouvrir à nouveau pour l'édition.</li>
</ol>

Vos calendriers apparaîtront dans l'application Contacts.<br>
";
?>