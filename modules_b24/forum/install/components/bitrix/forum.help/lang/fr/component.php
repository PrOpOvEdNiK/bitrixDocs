<?
$MESS["F_CONTENT"] = "<ul class='forum-help-list'>
 <li id='new_topic'><b>Comment puis-je créer un sujet sur le forum ?</b><br />
Cliquez sur un bouton ou sur un lien approprié dans une fenêtre de la liste des sujets du forum ou bien d'un sujet concret.
Il est possible que vous deviez vous vous connecter avant d'envoyer un message.</li>
 <li id='html'><b>Puis-je utiliser HTML ?</b><br />
Cela dépend de l'autorisation d'administrateur. C'est fait comme cela pour les mesures de sécurité, afin d'interdire l'activation des tags qui peuvent provoquer des problèmes.</li>
 <li id='bbcode'><b>Comment faire la édition du texte du message si HTML est interdit ?</b><br />
 L'administrateur peut autoriser l'utilisation des tags suivants : <br />
 <table cellpadding='0' cellspacing='0' class='forum-table'>
<tr><th>Tag</th><th>Description</th><th>Synonymes</th><th>Remarque</th></tr>
 <tr><td>&lt;a href='Lien'&gt;</td>
  <td>lien</td><td>[URL]lien[/URL]<br />[URL=lien]</td>
  <td> </td></tr><tr><td>&lt;b&gt;, &lt;u&gt;, &lt;i&gt;</td>
  <td>texte en gras, texte souligné ou en italique</td>
  <td>[b], [u], [i]</td><td>La balise fermante est obligatoire &lt;/b&gt;, &lt;/u&gt;, &lt;/i&gt;</td></tr>
 <tr><td>&lt;img src='adresse'&gt;</td><td>dessin</td>
  <td>[img]adresse[/img]</td>
  <td>adresse c'est une voie complète à l'image sur n'importe quel site public</td></tr>
 <tr>
  <td>&lt;ul&gt;, &lt;li&gt;</td><td>Des listes sans numération</td>
  <td>[ul], [li]</td><td> </td></tr><tr><td>&lt;quote&gt;</td>
  <td>Le tag spécial pour sélectionner la citation</td><td>[quote]</td>
  <td>La balise fermante est obligatoire &lt;/quote&gt;</td></tr>
 <tr><td>&lt;code&gt;</td>
  <td>Le tag spécial pour selectioner le code</td>
  <td>[code]</td>
  <td>La balise fermante est obligatoire &lt;/code&gt;</td></tr>
 <tr><td>&lt;font color=&gt;, &lt;font size=&gt;</td><td>Modification de la couleur et de la taille de police</td>
  <td>[color=couleur], [size=taille]</td><td>La balise fermante est obligatoire &lt;/font&gt;</td></tr>
 </table>
 </li>
 <li id='images'><b>Puis-je insérer des images ?</b><br />
 Vous pouvez coller des images dans vos messages si ces actions sont autorisées par l'administrateur.
 Vous devez indiquer le lien vers cette image qui se trouve au serveur public,
Modèle : [img]http://www.bitrix.ru/images/logo_bitrix.gif[/img] ou &lt;img src='http://www.bitrix.ru/images/logo_bitrix.gif'&gt;.</li>
 <li id='smiles'><b>Qu'est-ce que les smileys ?</b><br />
 Smileys ou émoticônes ce sont de petites images qui peuvent dnoc être utilisées pour l'expression de vos santiments, par exemple:) pour la joie, :( pour la tristesse.
 Vous pouvez voir a une liste complète des smileys dans le formulaire de création des messages. Utilisez-les avec modération : sinon votre message deviendra illisible et le modérateur pourra modifier votre message ou bien le supprimer.</li>
 <li id='registration'><b>Pourquoi dois-je me connecter ?</b><br />
Vous pouvez ne pas le faire. Cela dépend des paramètres définis par l'administrateur : vous devez vous connecter pour écrire des messages ou non.</li>
 <li id='profile'><b>Comment puis-je modifier mes paramètres ?</b><br />
 Tous vos paramètres sont sauvegardés dans la base de données (si vous êtes connecté). Pour les modifier accèdez à votre Profil (le lien se trouve sur le panneau en haut).
Vous pouvez modifier là-bas tous vos paramètres. L'accès au Profil devient possible après la connexion.<br />
 La page de modification du Profil d'utilisateur se cpmpose de trois parties : modification de l'information de connexion, modification des données personnelles et modification du Profil sur le forum.
 La section de modification de l'information de connexion sert à modifier votre nom, prénom, identifint et mot de passe. La section de modification des données personnelles sert à indiquer votre profession, date de naissance, adresse domicile et charger des photos. La section de modification du Profil sur le forum sert à changer
 des paramètres sur le forum:
  <ul><li><i>Afficher le nom.</i> On utilise le nom et le prénom d'auteur en tant que nom d'auteur du message, si ces champs ne sont pas vides.
  Sinon on utilise l'identifiant d'auteur. Ce drapeau interdit l'utilisation du nom et prénom indépendamment de remplissage de ces champs;</li>
  <li><i>Texte de l'aide</i> est un texte de l'auteur qui sera affiché au-dessous du nom de l'auteur du message. A titre d'explication il est interdit d'utiliser tous les groupes de mots et expressions, contenant 'admin', 'modérateur', 'support' etc. Ceux qui ne respectent pas cette règle seront supprimés du forum sans avertissement;</li>
  <li><i>Signature</i> est un texte personnalisé (tel que vos coordonnées ou votre citation préférée) qui est inséré automatiquement au bas de chaque message que vous envoyez. Il est possible d'utiliser pour la signature tous les tags
   permis sur ce forum;</li>
  <li><i>Avatar</i> est une image affichée au-dessous du nom d'auteur du message.</li>
  </ul>
 </li>
 <li id='subscribe'><b>Je souhaite recevoir de nouveaux messages par courrier électronique !</b><br />Vous pouvez souscrire à la réception de nouveaux messages publiés sur le forum ou bien de messages publiés dans le sujet. Il faut être enregistré sur le forum. Il est possible de sousEcrire à la réception de tous les messages du forum ou
 des messages sur un sujet concret au cours de la création d'un nouveau message (sujet) ou bien vous pouvez utiliser les liens dans une liste des sujets du forum ou dans un sujet. Pour la gestion de votre souscription cliquez sur le lien 'Souscription', qui se trouve dans votre Profil.
 </li>
</ul>
";
$MESS["F_NO_MODULE"] = "Le module du forum n'a pas été installé.";
$MESS["F_TITLE"] = "Aide";
$MESS["F_TITLE_NAV"] = "Aide";
?>