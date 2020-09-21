<?
$MESS["WD_CONNECT"] = "Connecter";
$MESS["WD_CONNECTION_MANUAL"] = "<a href='#LINK#'>Consigne de la connexion</a>.";
$MESS["WD_CONNECTION_TITLE"] = "Connexion d'un bibliothèque de documents comme un player réseau";
$MESS["WD_CONNECTOR_HELP_MAPDRIVE"] = "<h3>Adjonction du disque réseau</h3>
<p>Pour ajouter la bibliothèque en tant que disque réseau au moyen <b>de l'explorateur</b> :
<ul>
<li>Lancez <b>Explorateur.</b></li>
<li>Sélectionner dans le menu le point <i>Service> Ajouter le disque réseau</i>.On verra s'ouvrir le dialogue du disque réseau :
<br><a href='javascript:ShowImg('#TEMPLATEFOLDER#/images/network_storage.png',628,465,'Ajout du disque réseau');'>
<img width='250' height='185' border='0' src='#TEMPLATEFOLDER#/images/network_storage_sm.png' style='cursor: pointer;' alt='Cliquez sur l'image pour agrandir' /></a></li>
<li>Dans le champ <b>Disque</b> désisgnez la lettre pour le dossier à ajouter.</li>
<li>Dans le champ</b> introduisez le chemin vers la bibliothèque: <i>http://&lt;votre serveur&gt;/docs/shared/</i>. S'il est nécessaire que le dossier soit ajouté pour affichage à chaque lancement du système, marquez le du drapeau <b>Restaurer à l'entrée dans le système</b>.</li>
<li>Appuyez sur <b>C'est fait</b>. Si le dialogue du système d'exploitation s'ouvre pour autorisation, introduisez les données pour autorisation sur le serveur.</li>
</ul>
</p>
<p>Les ouvertures suivantes du dossier pourront être réalisées soit par <b>Explorateur Windows</b>, où le dossier est représenté sous forme d'un disque à part, soit par tout gestionnaire de fichiers.</p>";
$MESS["WD_CONNECTOR_HELP_OSX"] = "<h3>Connexion à la bibliothèque sous Mac OS, Mac OS X</h3>

<ul>
<li>Ouvrez <i>Finder Go->Connect to Server command</i>;</li>
<li>Saisissez une adresse à la bibliothèque dans un champ <b>Server Address</b> : </p>
<p><a href='javascript:ShowImg('#TEMPLATEFOLDER#/images/macos.png',465,550,'Mac OS X');'>
<img width='235' height='278' border='0' src='#TEMPLATEFOLDER#/images/macos_sm.png' style='cursor: pointer;' alt='Cliquez sur le dessin pour l'agrandir' /></a></li>
</ul>";
$MESS["WD_CONNECTOR_HELP_WEBFOLDERS"] = "<h3> Connexion via le composant Dossiers Web (web-folders) </h3>
<p>Avant de connecter une bibliothèque de documents, assurez-vous que <a href='#URL_HELP##oswindowsreg'> toutes les modifications de registre ont été faites et</a> <a href='#URL_HELP##oswindowswebclient'> le service Web client est en cours d'exécution (WebClient)</a>.</p>
<p>Pour se connecter à une bibliothèque de documents de cette manière il vous faut un composant de dossiers Web. Il est conseillé d'installer la dernière version du logiciel pour les dossiers Web (<a href='http://www.microsoft.com/downloads/details.aspx?displaylang=fr&FamilyID=17c36612-632e-4c04-9382-987622ed1d64' target = '_blank'> consultez le site Microsoft</a>) sur l'ordinateur du client. </p>
<ul>
<li> Démarrer <b>l'explorateur</b> </li>
<li> Choisissez l'option de menu <b>Service& gt; Activer le lecteur réseau</b> </li>
<li> En utilisant le lien <b>Inscrivez-vous pour le stockage en ligne ou connectez-vous à un serveur de réseau</b> démarrer <b></b> : </p>
<p><a href='javascript:ShowImg('#TEMPLATEFOLDER#/images/network_add_1.png',447,322,'Activation de disque réseau');'>
<img width = '250' height = '180' border = '0' src = '#TEMPLATEFOLDER#/images/network_add_1_sm.png' style = 'cursor: pointer;' alt = 'Cliquez sur l'image pour l'agrandir' /></a> </li>
<li> Cliquez sur le bouton <b>Suivant</b>, qui va ouvrir une deuxième fenêtre <b>Assistant</b> </li>
<li> Dans cette fenêtre, activez la position <b>Choisissez un autre emplacement réseau</b>, puis cliquez sur <b>Suivant</b>. Ouvrez l'étape suivante <b>Assistant</b> :
<p><a href='javascript:ShowImg('#TEMPLATEFOLDER#/images/network_add_4.png',563,459,'Assistant d'ajout réseau : étape 3');'>
<img width = '250' height = '204' border = '0' src = '#TEMPLATEFOLDER#/images/network_add_4_sm.png' style = 'cursor: pointer;' alt = 'Cliquez sur l'image pour l'agrandir' /></a> </li>
<li> Dans le champ <b>adresse réseau ou sur l'Internet</b>, entrez l'URL du dossier à activer du forme: <i>http:. //your_server/docs/shared/</i> </li>
<li> Cliquez sur <b>Suivant</b>. Si vous êtes invité à vous identifier, saisissez les données d'autorisation sur le serveur. </li>
</ul>

<p>Pour ouvrir un dossier, exécutez la commande suivante:. <b>Démarrer> Favoris réseau> Nom du dossier</b>.</P>";
$MESS["WD_EMPTY_PATH"] = "Le chemin pour la connexion n'est pas indiqué.";
$MESS["WD_MACOS_TITLE"] = "Connexion en Mac OS X";
$MESS["WD_NOTINSTALLED"] = "Par défaut, le composant n'a pas été installé dans votre système d'exploitation. Vous pouvez le télécharger du <a href='#LINK#'>site officiel</a>.";
$MESS["WD_REGISTERPATCH"] = "Pour la connexion du disque de réseau avec des réglages courants de la sécurité du site il faut <a href='#LINK#'>faire des modifications dans le registre</a>.";
$MESS["WD_SHAREDDRIVE_TITLE"] = "Comment brancher la bibliothèque comme un disque du réseau";
$MESS["WD_TIP_FOR_2008"] = "Si vous avez Microsoft Windows Server 2008, veuillez consulter <a href='#LINK#'> la référence</a>.";
$MESS["WD_USEADDRESS"] = "Utilisez l'adresse suivante pour vous connecter : ";
$MESS["WD_USECOMMANDLINE"] = "Pour connecter la bibliothèque en tant que disque réseau par le protocole de sécurité HTTPS/SSL: exécuter l'ordre <b>Démarrage > Exécuter > cmd</b>. Dans la ligne de commande saisissez : ";
$MESS["WD_WEBFOLDER_TITLE"] = "Connectez nuage PBX hébergé";
$MESS["WD_WIN7HTTPSCMD"] = "Pour la connexion à la bibliothèque comme au disque de réseau par un protocole protégé HTTPS/SSL: exécutez la commande <b>Menu Démarrer> Exécuter > cmd</b>.";
?>