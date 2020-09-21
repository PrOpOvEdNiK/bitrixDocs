<?
$MESS["CLU_MAIN_LOAD"] = "Charge minimale";
$MESS["CLU_SLAVE_BACKUP"] = "Sauvegarde";
$MESS["CLU_SLAVE_LIST_ADD"] = "Ajouter la base de données de slave";
$MESS["CLU_SLAVE_LIST_ADD_TITLE"] = "Lancer l'assistant d'ajout d'une nouvelle base de données slave";
$MESS["CLU_SLAVE_LIST_BEHIND"] = "Retard (s)";
$MESS["CLU_SLAVE_LIST_DB_HOST"] = "Adresse du serveur";
$MESS["CLU_SLAVE_LIST_DB_LOGIN"] = "Utilisateur";
$MESS["CLU_SLAVE_LIST_DB_NAME"] = "Base de données";
$MESS["CLU_SLAVE_LIST_DELETE"] = "Supprimer";
$MESS["CLU_SLAVE_LIST_DELETE_CONF"] = "Supprimer la connexion ?";
$MESS["CLU_SLAVE_LIST_DESCRIPTION"] = "Description";
$MESS["CLU_SLAVE_LIST_EDIT"] = "Éditer";
$MESS["CLU_SLAVE_LIST_FLAG"] = "District";
$MESS["CLU_SLAVE_LIST_ID"] = "ID";
$MESS["CLU_SLAVE_LIST_MASTER_ADD"] = "Ajouter la base de données de master/slave";
$MESS["CLU_SLAVE_LIST_MASTER_ADD_TITLE"] = "Lancer l'assistant pour ajouter de nouvelles bases de données master-slave";
$MESS["CLU_SLAVE_LIST_NAME"] = "Dénomination";
$MESS["CLU_SLAVE_LIST_NOTE"] = "<p>Réplication de la base de données - est un processus de la création de sa copie ainsi que sa maintenance en état actuel.</p>
<p>Les tâches qu'il accomplit : <br>
1) possibilité du transfert d'une partie de la charge de la base de données générale (master) à une copie (ou quelques copies) de cette base (slave).<br>
2) utilisation des copies en tant qu'une réserve critique.<br>
</p>
<p>C'est important !<br>
- Utiliser des serveurs différents pour la réplication avec une connection rapide entre eux.<br>
- Le lancement de la réplication commence par la reproduction du contenu de la base des données. Pendant ce processus la partie publique du site sera fermée, la partie administrative - non. Toutes les modifications de données qui n'étaient pas prises en compte pendant la reproduction peuvent ensuite perturber le bon fonctionnement du site.<br>
</p>
<p>Consigne pour le réglage<br>
Etape 1: Démarrez l'assistant, en appuyant sur 'Ajouter slave base de données'. Cette étape sert à vérifier les réglages du serveur et ajouter une connection à la liste des bases de données slave.<br>
Etape 2: Dans la liste des bases de données slave dans un menu d'actions exécutez la commande 'Commencer à utiliser'.<br>
Etape 3: Suivez les recommendations de l'assistant.<br></p>";
$MESS["CLU_SLAVE_LIST_PAUSE"] = "arrêter";
$MESS["CLU_SLAVE_LIST_REFRESH"] = "Recalculer";
$MESS["CLU_SLAVE_LIST_RESUME"] = "Curriculum vitae";
$MESS["CLU_SLAVE_LIST_SKIP_SQL_ERROR"] = "Conversion illégale";
$MESS["CLU_SLAVE_LIST_SKIP_SQL_ERROR_ALT"] = "Ignorer une erreur SQL et continuer la réplication";
$MESS["CLU_SLAVE_LIST_START_USING_DB"] = "Commencer d'utiliser";
$MESS["CLU_SLAVE_LIST_STATUS"] = "Statut";
$MESS["CLU_SLAVE_LIST_STOP"] = "Arrêter d'utiliser";
$MESS["CLU_SLAVE_LIST_TITLE"] = "Base de données esclave";
$MESS["CLU_SLAVE_LIST_WEIGHT"] = "Utiliser (%)";
$MESS["CLU_SLAVE_NOCONNECTION"] = "déconnecté";
$MESS["CLU_SLAVE_UPTIME"] = "Temps de travail";
?>