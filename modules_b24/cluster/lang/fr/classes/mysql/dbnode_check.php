<?
$MESS["CLU_AFTER_CONNECT_MSG"] = "La base principale de données et l'environnement du produit doivent être ajustés à la manière que le fichier php_interface/after_connect.php soit absent.";
$MESS["CLU_AFTER_CONNECT_WIZREC"] = "Effectuez les réglages nécessaires. Assurez-vous du fonctionnement correct du produit. Eliminer le fichier ou relancer l'assistant.";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_ERR_MSG"] = "Le serveur avec pour ID égal à #node_id# a une valeur incorrecte pour le paramètre auto_increment_increment. Elle doit être égale à #value# (valeur actuelle du paramètre auto_increment_increment: #current#).";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_NODE_ERR_MSG"] = "La valeur du paramètre auto_increment_increment du serveur ajouté est incorrecte. Elle doit être égale à #value# (valeur actuelle auto_increment_increment: #current#).";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_OK_MSG"] = "La valeur du paramètre auto_increment_increment des serveurs de l'amas doit être égale à #value#.";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_WIZREC"] = "Dans le fichier my.cnf, définissez la valeur du paramètre auto_increment_increment égale à #value#. Redémarrer MySQL et cliquez sur 'Suivant'.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_ERR_MSG"] = "Le serveur avec l'ID égal à #node_id# a la valeur du paramètre auto_increment_offset incorrecte. La valeur ne doit pas être égale à #current#.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_NODE_ERR_MSG"] = "La valeur du paramètre auto_increment_offset du serveur à ajouter est erronée. Elle ne doit pas être égale à #current#.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_OK_MSG"] = "Sur les serveurs du groupe la valeur du paramètre auto_increment_offset ne doit pas provoquer les collisions.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_WIZREC"] = "Dans le fichier my.cnf sélectionnez la valeur du paramètre auto_increment_offset différente d'autres serveurs. Relancez MySQL et cliquez 'Suivant'.";
$MESS["CLU_CHARSET_MSG"] = "L'encodage pour le serveur, la base de données, la connexion et le client doivent coïncider.";
$MESS["CLU_CHARSET_WIZREC"] = "Configurez les paramètres de MySQL : <br />
&nbsp;character_set_server (valeur actuelle: #character_set_server#),<br />
&nbsp;character_set_database (valeur actuelle: #character_set_database#),<br />
&nbsp;character_set_connection (valeur actuelle: #character_set_connection#),<br />
&nbsp;character_set_client (valeur actuelle: #character_set_client#).<br />
Veuillez-vous rassurer du bon fonctionnement du produit et relancez l'assistant.";
$MESS["CLU_COLLATION_MSG"] = "Les règles de tri pour le serveur, la base de données et pour la connexion doivent être identiques.";
$MESS["CLU_COLLATION_WIZREC"] = "Configurez MySQL : <br />
&nbsp;collation_server (valeur actuelle: #collation_server#),<br />
&nbsp;collation_database (valeur actuelle: #collation_database#),<br />
&nbsp;collation_connection (valeur actuelle: #collation_connection#).<br />
Vérifier un bon fonctionnement du produit et démarrer l'assistant à nouveau.";
$MESS["CLU_FLUSH_ON_COMMIT_MSG"] = "Si vous utilisez InnoDB pour augmenter la fiabilité de réplication, il est souhaitable d'installer le paramètre innodb_flush_log_at_trx_commit = 1 (valeur actuelle: #innodb_flush_log_at_trx_commit#).";
$MESS["CLU_LOG_BIN_MSG"] = "L'exploitation du serveur principal doit être activé (valeur actuelle log-bin: #log-bin#).";
$MESS["CLU_LOG_BIN_NODE_MSG"] = "Le serveur à ajouter doit avoir la mise en journal activée (log-bin: #log-bin#).";
$MESS["CLU_LOG_BIN_WIZREC"] = "Ajouter le paramètre log-bin=mysql-bin au my.cnf. Redémarrer MySQL et cliquez sur 'Suivant'.";
$MESS["CLU_LOG_SLAVE_UPDATES_MSG"] = "Pour le serveur avec ID égale à #node_id# la mise en registre des demandes reçues de la base de données master n'est pas activée. Cette activation sera indispensable si des bases de données slave y sont connectés. Valeur courante log-slave-updates: #log-slave-updates#.";
$MESS["CLU_LOG_SLAVE_UPDATES_OK_MSG"] = "Le master des serveurs du cluster doit avoir la journalisation activée des demandes arrivant d'une autre base de données master.";
$MESS["CLU_LOG_SLAVE_UPDATES_WIZREC"] = "Dans un fichier my.cnf entrez la valeur du paramètre log-slave-updates égale #value#. Redémarrez MySQL et appuyez sur le bouton 'Suivant'.";
$MESS["CLU_MASTER_CHARSET_MSG"] = "L'encodage et la règle de tri du serveur principal et de la nouvelle connexion doivent coïncider.";
$MESS["CLU_MASTER_CHARSET_WIZREC"] = "Configurez les paramètres MySQL : <br />
&nbsp;character_set_server (valeur actuelle: #character_set_server#),<br />
&nbsp;collation_server (valeur actuelle: #collation_server#).<br />
Assurez-vous du bon fonctionnement du produit et relancez l'assistant.";
$MESS["CLU_MASTER_CONNECT_ERROR"] = "Erreur de connexion à la base de données principale : ";
$MESS["CLU_MASTER_STATUS_MSG"] = "Il ne suffit pas de privilèges pour vérifier le statut de la réplication.";
$MESS["CLU_MASTER_STATUS_WIZREC"] = "Exécutez la requête: #sql#.";
$MESS["CLU_MAX_ALLOWED_PACKET_MSG"] = "La valeur du paramètre max_allowed_packet y slave de la base de données ne doit pas être moindre que celle de la base de données principale.";
$MESS["CLU_MAX_ALLOWED_PACKET_WIZREC"] = "Dans le fichier my.cnf, définissez la valeur max_allowed_packet et redémarrer MySQL.";
$MESS["CLU_NOT_MASTER"] = "Désigné comme principale, cette base de données ne l'est pas.";
$MESS["CLU_RELAY_LOG_ERR_MSG"] = "Au serveur avec ID de #node_id# la lecture du journal n'est pas activée (valeur courante relay-log: #relay-log#).";
$MESS["CLU_RELAY_LOG_OK_MSG"] = "La lecture du journal (paramètre relay-log) pour les serveurs du cluster doit être activée.";
$MESS["CLU_RELAY_LOG_WIZREC"] = "Dans le fichier my.cnf, donnez la valeur du paramètre relay-log (par exemple: mysqld-relay-bin) et redémarrez MySQL.";
$MESS["CLU_RUNNING_SLAVE"] = "Un processus de la réplication à été lancé dans cette base de données. La connexion est impossible.";
$MESS["CLU_SAME_DATABASE"] = "Cette base de données est la même que la principale. Connexion impossible.";
$MESS["CLU_SERVER_ID_MSG"] = "Chaque nud du cluster doit avoir un identifiant unique (valeur actuelle de server-id: #server-id#).";
$MESS["CLU_SERVER_ID_WIZREC"] = "Dans le fichier my.cnf indiquez la valeur du paramètre server-id. Redémarrez MySQL et cliquez sur 'Suivant'.";
$MESS["CLU_SERVER_ID_WIZREC1"] = "Le paramètre server-id n'est pas donné.";
$MESS["CLU_SERVER_ID_WIZREC2"] = "Le serveur de la base de données du même server-id est existe déjà dans le module.";
$MESS["CLU_SKIP_NETWORKING_MSG"] = "Il faut autoriser la connexion au serveur maître par le réseau (valeur courante skip-networking: #skip-networking#).";
$MESS["CLU_SKIP_NETWORKING_NODE_MSG"] = "Il est nécessaire d'autoriser la connexion au serveur étant ajouté par le réseau (la valeur actuelle de skip-réseau: #skip-networking#).";
$MESS["CLU_SKIP_NETWORKING_WIZREC"] = "Dans le fichier my.cnf supprimez ou commentez le paramètre skip-networking. Redémarrez MySQL et cliquez sur 'Suivant'.";
$MESS["CLU_SLAVE_RELAY_LOG_MSG"] = "Valeur du paramètre relay-log non renseignée. En cas de modification de l'identifiant de l'hébergeur du serveur la réplication sera dérangée.";
$MESS["CLU_SLAVE_VERSION_MSG"] = "La version de base de données MySQL slave (#slave-version#) doit être au moins #required-version#.";
$MESS["CLU_SQL_MSG"] = "L'utilisateur doit avoir le droit de créer et de supprimer des tableaux, ainsi que d'insérer, d'extraire, de modifier et de supprimer des données.";
$MESS["CLU_SQL_WIZREC"] = "Les droits sont insuffisants. On n'a pas réussi à satisfaire les demandes SQL suivantes: #sql_erorrs_list#";
$MESS["CLU_SYNC_BINLOGDODB_MSG"] = "La réplication seulement d'une base de données doit être prévue.";
$MESS["CLU_SYNC_BINLOGDODB_WIZREC"] = "Ajouter le paramètre binlog-do-db=#database# au my.cnf. Redémarrer MySQL et cliquez sur 'Suivant'.";
$MESS["CLU_SYNC_BINLOG_MSG"] = "Si vous utilisez InnoDB pour augmenter la fiabilité de la réplication, il est souhaitable d'installer un paramètre sync_binlog = 1 (valeur actuelle: #sync_binlog#).";
$MESS["CLU_VERSION_MSG"] = "La version MySQL de la base de données esclave (#slave-version#) ne doit pas être inférieure à celle du maître (#master-version#).";
$MESS["CLU_VERSION_WIZREC"] = "Mettez à jour MySQL et lancez l'assistant encore une fois.";
?>