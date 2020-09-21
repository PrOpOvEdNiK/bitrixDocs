<?
$MESS["SERVICES_INFO"] = "<div> Contenus :
  <ul>
    <li><a href='&#35;introduction' title='Description générale'>Flux de travail et processus d'entreprise</a></li>

    <li><a href='&#35;workflow' title=\"Qu'est-ce que 'Flux de travail' signifie ?\">Flux de travail</a></li>

    <li><a href='&#35;bizproc' title='Qu'est-ce qu'un processus d'entreprise ?'>Processus d'entreprise</a></li>

    <li><a href='&#35;tipical' title='Quels processus d'entreprise typiques sont inclus ?'>Processus d'entreprise typiques</a></li>

    <li><a href='&#35;work' title='Comment créer un processus d'entreprise'>Créer un processus d'entreprise</a></li>

    <li><a href='&#35;perfomance' title='Comment accomplir un processus d'entreprise ?'>Mener un processus d'entreprise</a></li>
   </ul>

  <br />

  <h1><a name='introduction'></a>Flux de travail et processus d'entreprise</h1>

  <p><b>Bitrix Intranet</b> contient les deux modules suivants qui facilitent
  le travail d'équipe dans le contexte du portail intranet.</p>

  <ul>
    <li> Le module <b>Flux de travail</b> apporte un traitement
    étape par étape des pages et informations statiques et dynamiques. Ce module est
      inclus dans toutes les éditions du produit.</li>

    <li>Le module <b>Processus d'entreprise</b> prend en charge le traitement simple et étape par étape
      de l'élément bloc d'information (un processus séparé, linéaire et limité dans le temps
      ainsi que des processus variables et axés sur les statuts. Ce
      module est inclus comme module <b>Processus typiques</b> dans les éditions
      junior. La version complète, qui apporte des outils pour créer de nouveaux processus, est incluse dans <b>Bitrix Intranet :
      Édition entreprise</b>.</li>
   </ul>

  <p>Comment implémenter de manière optimal ce flux de travail à ces outils de gestion de processus dans ces genre
  de documents qui circulent dans la société, et devrait être déterminés par le responsable
  pour l'intégration de processus d'entreprise. L'implémentation peut être effectuée par un administrateur du portail.</p>

  <h1><a name='flux de travail'></a>Flux de travail</h1>

  <p>Le module <b>Flux de travail</b> facilite le traitement des documents linéaires. Ce module est approprié quand un document a simplement besoin de suivre une série d'étapes consécutives avant d'atteindre son statut final (par exemple : publication).</p>

  <p>Par défaut, le module <b>Flux de travail</b> apporte trois statuts suffisants pour le schéma de flux de travail le plus simple. Cependant, les vrais projets dans le vrai monde vont généralement
  nécessiter l'ajout de statuts personnalisés. Les statuts personnalisés peuvent être créés par
  un administrateur du portail ou par des personnes possédant les permissions de créeer des statuts.</p>
 <img border='1' title='Documents et statuts' alt='Documents and statuses' src='#SITE#images/en/bp/1.png' />
  <p>Le module <b>Flux de travail</b> prend en charge l'assignation des responsables pour
  le déplacement d'un document d'un statut à un autre, mais vous permet de lister les personnes autorisées à éditer
  un document une fois un certain statut reçu. Le module peut garder des versions des copies d'un document
  avant que les modifications soient enregistrées, en fonction des paramètres. Seul un administrateur
  du portail peut modifier les paramètres du module.</p>

  <h1><a name='bizproc'></a>Processus d'entreprise</h1>

  <p>Le module <b>Processus d'entreprise</b> est un instrument étendu pour créer,
  exécuter et gérer les flux d'informations. Ce module apporte bien plus
  de capacités de gestion d'informations que le <b>Flux de travail</b>.</p>

  <p><i>Un <b>Processus d'entreprise</b> est le flux d'informations (ou de documents) passant par une route ou un schéma défini. Le schéma d'un processus d'entreprise peut spécifier : </i></p>

  <ul>
    <li><i>une ou plusieurs entrées ou points de sortie ; </i></li>
    <li><i>une séquence d'actions (étapes, paliers, fonctions), à remplir dans un ordre établi ou sous certaines conditions.</i></li>
   </ul>

  <p>Le vrai monde demandera différents flux d'informations, du plus simple au plus compliqué.
  Le processus simple de publication d'un document peut contenir une
  variété d'actions possibles et de fourches conditionnelles, et pourrait demander diverses données
  saisies et notifications d'utilisateur.</p>

  <p>Le module <b>Processus d'entreprise</b> apporte à l'utilisateur une interface pour créer et
  éditer les processus d'entreprise. Cet éditeur est très simple à utiliser, mais pas trop simple, ce qui veut dire qu'un utilisateur professionnel ordinaire sera en mesure d'accès à un grand choix de fonctionnalités. Cependant la notion même de processus
  d'entreprise implique qu'un haut niveau de capacités analytiques et une profonde connaissance de ce qui se passe vraiment à l'intérieur de la société doivent être combinés pour tirer le meilleur bénéfice de cette fonctionnalité. </p>

  <p>Le concepteur de processus d'entreprise
  est en substance un simple créateur de blocs <b>glisser-poser</b>  visuels. Les modèles
  de processus d'entreprise sont créés dans une version spécialisée de l'éditeur visuel. Un
  auteur de processus d'entreprise peut préciser des étapes dans le processus et la séquence, mais également mettre en valeur les détails spécifiques au processus grâce à
  de simples plans visuels.</p>

  <p>Le flux d'informations spécifique est défini par le modèle de processus d'entreprise,
  qui est constitué d'un jeu d'actions. Un action peut être n'importe quel évènement
  de votre choix : créer une création ; envoyer un e-mail ; créer un enregistrement de base de donnée
  etc.</p>

  <p>Le pack de distribution de produits contient des dizaines d'actions intégrées et
  certains processus d'entreprise typiques qui peuvent être utilisés pour modéliser les activités
  les plus communes.</p>

  <p>Deux types de processus d'entreprise généraux existent, et le module <b>Processus d'entreprise
</b> les prend tous les deux en charge : </p>

  <ul>
    <li><b>processus d'entreprise séquentiel</b> - pour effectuer une série d'actions consécutives sur un document,
      d'un point de départ prédéfini à un point d'arrivée prédéfini ; </li>

    <li><b>le processus d'entreprise axé sur les statuts</b> n'a ni point de départ ni point d'arrivée ;
      le flux de travail change le statut du processus. De tels processus d'entreprise
      peut, théoriquement, s'arrêter à n'importe quelle étape.</li>
   </ul>

  <h2><b>Processus d'entreprise séquentiel</b></h2>

  <p>Le mode séquentiel est généralement utilisé pour les processus au cycle de vie limité et
  prédéfini. Un exemple typique est la création et l'approbation d'un document
  texte. Tout processus séquentiel comprend en général plusieurs actions entre les points
  de départ et d'arrivée.</p>

  <p><img border='1' alt='Exemple : un processus linéaire simple' title='Exemple : un processus linéaire simple' src='#SITE#images/en/bp/2.png' /></p>

  <h2>Processus d'entreprise axé sur les statuts</h2>

  <p>Une approche axée sur les statuts est utilisée quand un processus ne dispose pas d'une plage temporelle
  définie et peut répéter ou retourner à un statut donné de fait de la nature
  du processus (par exemple : la mise à jour continue de la documentation
  du produit). Ici un statut n'est pas seulement un marqueur indiquant
  le degré de préparation d'un document, mais plutôt un indicateur d'un cycle de processus
  du monde réel.</p>

  <p>Créer un modèle de processus axé sur les statuts n'est pas aussi simple
  que pour un processus séquentiel, mais il ouvre plus de possibilités pour automatiser
  le traitement des informations. Un plan typique de tels processus consiste en plusieurs statuts
  qui a leur tour comprennent des actions et des conditions de changement de statut.</p>
 <img border='1' alt='Exemple : processus avec statuts' title='Exemple : processus avec statuts' src='#SITE#images/en/bp/3.png' />
  <p>Chaque action d'un statut est généralement un processus séquentiel fini.</p>

  <h1><a name='typique'></a>Processus d'entreprise typiques</h1>

  <p>Les processus d'entreprise les plus communs sont inclus dans les éditions junior (<b>Bitrix Intranet : Édition de bureau</b> et <b>Bitrix Intranet : Édition extranet</b>) comme constructions en lecture-seule. Vous pouvez
  les configurer pour gérer les documents requis, mais vous ne pouvez pas en changer la logique.
  La <b>Bitrix Intranet :
      Édition entreprise</b> comprend un éditeur visuel dans lequel vous
  pouvez éditer les modèles standard et créer vos propres processus d'entreprise.</p>

  <h2>'Approbation/vote simple' du processus séquentiel</h2>

  <p>Recommandé quand une décision doit être prise avec une majorité simple de votes.</p>

  <h2>'Première approbation' du processus séquentiel</h2>

  <p>Recommandé quand une simple approbation ou réponse ('J'ai besoin d'un volontaire...') est suffisant.</p>

  <h2>&quot;Approbation d'un document avec statuts&quot; du processus axé sur les statuts</h2>

  <p>Recommandé quand un accord mutuel est nécessaire pour approuver un document.</p>

  <h2>&quot;Approbation en deux étapes&quot; du processus séquentiel</h2>

  <p>Recommandé quand un document nécessite l'évaluation préalable d'un expert avant de pouvoir être approuvé.</p>

  <h2>&quot;Opinion experte&quot; du processus séquentiel</h2>

  <p>Recommandé pour les situations où une personne qui doit approuver ou rejeter un document a besoin de commentaires experts sur le sujet.</p>

  <h2>&quot;Lecture de document&quot; du processus séquentiel</h2>

  <p>Recommandé quand des employés doivent se familiariser avec un document.</p>
  Vous pouvez visionner les processus d'entreprise (standards ou définis par un utilisateur) liés à un
  certain type de document en cliquant sur le <img src='#SITE#images/en/bp/4.png' alt='bouton Processus d'entreprise' title='bouton Processus d'entreprise' />, ce qui ouvrira la page des <b>modèles de processus d'entreprise</b> où vous pouvez éditer
  les processus existant ou en créer de nouveaux.
  <p><img border='1' src='#SITE#images/en/bp/11.png' alt='Page des processus d'entreprise' title='Page des processus d'entreprise' />
  <h1><a name='travail'></a>Créer un processus d'entreprise</h1>

  <p>Pour créer et éditer un processus d'entreprise, vous aurez besoin d'un éditeur visuel
  spécial inclus uniquement dans <b>Bitrix Intranet :
      Édition entreprise</b>.</p>

  <p>Avant de créer un processus d'entreprise, vous devez sélectionner le type de processus :
  séquentiel ou axé sur les statuts, ce qui définira l'organisation de l'éditeur
  visuel. Le type peut être sélectionné via les contrôles de la barre d'outil contextuelle du formulaire
  <b>Modèles de processus d'entreprise</b>.</p>

  <p>La première étape de création d'un processus d'entreprise est de définir les paramètres. Les
  paramètres du processus sont des données qui peuvent être accédées dans n'importe quelle commande, action
  ou condition. Une fois les paramètres définis, vous pouvez poursuivre et créer le
  processus.</p>
 <img border='1' title='Définir les paramètres du processus' alt='Définir les paramètres du processus' src='#SITE#images/en/bp/6.png' />

  <h2>Créer un processus axé sur les statuts</h2>

  <p>Tout d'abord, créez et configurez les statuts nécessaires via le bouton Ajouter statut. Créez alors
  des commandes pour chaque statut. Chaque commande représente un processus séquentiel
  séparé.</p>
   <img border='1' src='#SITE#images/en/bp/7.png' alt='Assigner des actions dans les statuts' title='Assigner des actions dans les statuts' />

  <h2>Créer un processus séquentiel</h2>

  <p>Quand vous créez un processus séquentiel, l'éditeur visuel affiche un
  jeu personnalisable d'actions.</p>

  <p>L'éditeur visuel utilise la technique populaire de glisser-poser pour ajouter
  des actions. Une fois la commande ajoutée, configurez ses paramètres. Chaque commande a une
  boîte de dialogue de paramètres unique.</p>
 <img border='1' title='Ajouter des actions dans l'éditeur visuel' alt='Ajouter des actions dans l'éditeur visuel' src='#SITE#images/en/bp/8.png' />
  <h1><a name='performance'></a>Exécuter un processus d'entreprise</h1>

  <p>Un processus d'entreprise créé (ou existant) peut être exécuté manuellement ou
  automatiquement en fonction de ses paramètres. Ce choix
  n'affecte pas l'exécution. Un processus peut avoir plusieurs instances, chacune
  exécutée indépendamment.</p>

  <p>Pour exécuter un processus d'entreprise sur un document spécifique, sélectionnez la commande 
  <b>Nouveau processus d'entreprise</b> dans le menu action du document et choisissez le
  processus d'entreprise requis dans la liste.</p>
 <img border='1' src='#SITE#images/en/bp/5.png' alt='Lancer un processus d'entreprise pour un document' title='Lancer un processus d'entreprise pour un document' />
  <p>Quand la fenêtre des paramètres d'un processus d'entreprise s'ouvre, spécifiez les paramètres et 
  cliquez sur <b>Démarrer</b>.</p>
 <img border='1' title='Configurer un processus d'entreprise' alt='Configurer un processus d'entreprise' src='#SITE#images/en/bp/9.png' />
  <p>Si un processus d'entreprise propose des options de notifications, une notification sera envoyée à un employé quand le processus arrivera à un point qui nécessitera une action de la part de l'employé.   Pour voir et effectuer les tâches assignées, la personne peut
  ouvrir l'onglet <b>Processus d'entreprise</b> de leur page personnelle.</p>
</div>
";
$MESS["SERVICES_TITLE"] = "Procédures d'entreprise";
?>