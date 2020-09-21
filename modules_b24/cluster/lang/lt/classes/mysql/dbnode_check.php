<?
$MESS["CLU_AFTER_CONNECT_MSG"] = "Pagrindinė duomenų bazė ir sistemos aplinka turi būti sukonfigūruoti taip, kad neliktų bylos php_interface/after_connect.php.";
$MESS["CLU_AFTER_CONNECT_WIZREC"] = "Atlikite būtinus nustatymus. Įsitikinkite, kad produktas veikia tinkamai. Ištrinkite bylą ir paleiskite vedlį dar kartą.";
$MESS["CLU_CHARSET_MSG"] = "Serverio, duomenų bazės, ryšio ir kliento koduotės turi sutapti.";
$MESS["CLU_CHARSET_WIZREC"] = "Nustatykite MySQL parametrus:<br />
&nbsp;character_set_server (dabartinė reikšmė: #character_set_server#),<br />
&nbsp;character_set_database (dabartinė reikšmė: #character_set_database#),<br />
&nbsp;character_set_connection (dabartinė reikšmė: #character_set_connection#),<br />
&nbsp;character_set_client (dabartinė reikšmė: #character_set_client#).<br />
Įsitikinkite, kad produktas veikia tvarkingai, ir vėl paleiskite vedlį.";
$MESS["CLU_COLLATION_MSG"] = "Serveris, duomenų bazės ir jungtys turi naudoti tas pačias rūšiavimo taisykles.";
$MESS["CLU_COLLATION_WIZREC"] = "Nustatykite MySQL parametrus:<br />
&nbsp;collation_server (dabartinė reikšmė: #collation_server#),<br />
&nbsp;collation_database (dabartinė reikšmė: #collation_database#),<br />
&nbsp;collation_connection (dabartinė reikšmė: #collation_connection#).<br />
Įsitikinkite, kad produktas veikia tvarkingai, ir vėl paleiskite vedlį.";
$MESS["CLU_SERVER_ID_MSG"] = "Kiekvienas klasterio mazgas turi turėti unikalų ID (dabartinis serverio ID: #server-id#).";
$MESS["CLU_LOG_BIN_MSG"] = "Pagrindinio serverio žurnaliavimas turi būti įjungtas (dabartinė vertė log-bin: #log-bin#).";
$MESS["CLU_LOG_BIN_NODE_MSG"] = "Naujo serverio žurnaliavimas turi būti įjungtas (dabartinė vertė log-bin: #log-bin#).";
$MESS["CLU_LOG_BIN_WIZREC"] = "Pridėkite parametrą log-bin=mysql-bin į my.cnf. Tada perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_SKIP_NETWORKING_MSG"] = "Pirminis serveris turi būti pasiekiamas iš tinklo (dabartinė reikšmė skip-networking: #skip-networking#).";
$MESS["CLU_SKIP_NETWORKING_NODE_MSG"] = "Tinklas turi būti prieinamas naujam sukurtam serveriui (dabartinė reikšmė skip-networking: #skip-networking#).";
$MESS["CLU_SKIP_NETWORKING_WIZREC"] = "Byloje my.cnf ištrinkite arba užkomentuokite parametrą skip-networking. Tada perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_FLUSH_ON_COMMIT_MSG"] = "Naudojant InnoDB, replikacijos patikimumui, nustatykite parametrą innodb_flush_log_at_trx_commit = 1 (dabartinė reikšmė: #innodb_flush_log_at_trx_commit#).";
$MESS["CLU_SYNC_BINLOG_MSG"] = "Naudojant InnoDB, replikacijos patikimumui, nustatykite parametrą sync_binlog = 1 (dabartinė reikšmė: #sync_binlog#).";
$MESS["CLU_SYNC_BINLOGDODB_MSG"] = "Gali būti nustatyta replikacija tik vienos duomenų bazės.";
$MESS["CLU_SYNC_BINLOGDODB_WIZREC"] = "Pridėkite parametrą binlog-do-db=#database# į my.cnf. Tada perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_MASTER_CHARSET_MSG"] = "Kodavimas ir rūšiavimo taisyklės pirminio serverio ir naujo ryšio turi būti analogiški.";
$MESS["CLU_MASTER_CHARSET_WIZREC"] = "Nustatykite MySQL parametrus:<br />
&nbsp;character_set_server (dabartinė reikšmė: #character_set_server#),<br />
&nbsp;collation_server (dabartinė reikšmė: #collation_server#).<br />
Įsitikinkite, kad produktas veikia tvarkingai, ir vėl paleiskite vedlį.";
$MESS["CLU_SERVER_ID_WIZREC1"] = "Nenurodytas parametras server-id";
$MESS["CLU_SERVER_ID_WIZREC2"] = "Duomenų bazė su tokiu server-id modulyje jau yra.";
$MESS["CLU_SERVER_ID_WIZREC"] = "Pridėkite ir nustatykite parametrą server-id byloje my.cnf. Tada perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_SQL_MSG"] = "Naudotojas privalo turėti teises kurti ir trinti lenteles, taip pat įterpti, pasirinkti, redaguoti ir trinti duomenys.";
$MESS["CLU_SQL_WIZREC"] = "Nepakanka teisių. Sekančios SQL užklausos nebuvo įvykdytos: #sql_erorrs_list#";
$MESS["CLU_RUNNING_SLAVE"] = "Šioje duomenų bazėje jau pradėtas replikacijos procesas. Prijungimas neįmanomas.";
$MESS["CLU_SAME_DATABASE"] = "Ši duomenų bazė yra tokia pati kaip pirminė. Prijungimas neįmanomas.";
$MESS["CLU_MASTER_CONNECT_ERROR"] = "Pirminės duomenų bazės ryšio klaida.";
$MESS["CLU_NOT_MASTER"] = "Nurodyta duomenų bazė nėra pirminė.";
$MESS["CLU_MAX_ALLOWED_PACKET_MSG"] = "Slave duomenų bazės parametro \"max_allowed_packet\" vertė neturi būti mažesnė nei pirminės duomenų bazės.";
$MESS["CLU_MAX_ALLOWED_PACKET_WIZREC"] = "Nustatykite \"max_allowed_packet\" parametrą byloje my.cnf ir perkraukite MySQL.";
$MESS["CLU_SLAVE_VERSION_MSG"] = "Slave duomenų bazės MySQL versija (#slave-version#) turi ne žemesnė nei #required-version# versija.";
$MESS["CLU_VERSION_MSG"] = "Slave duomenų bazės MySQL versija (#slave-version#) turi ne žemesnė nei pirminės duomenų bazės versija (#master-version#).";
$MESS["CLU_SLAVE_RELAY_LOG_MSG"] = "Nenurodytas \"relay-log\" parametras. Replikacija bus nutraukta jei serverio pavadinimas pasikeis.";
$MESS["CLU_RELAY_LOG_WIZREC"] = "my.cnf byloje nustatykite \"relay-log\" parametro vertę (pvz mysqld-relay-bin) ir perkraukite MySQL.";
$MESS["CLU_VERSION_WIZREC"] = "Atnaujinkite savo MySQL ir paleiskite vedlį dar kartą.";
$MESS["CLU_MASTER_STATUS_MSG"] = "Nepakanka prieigos teisių patikrinti replikacijos statusą.";
$MESS["CLU_MASTER_STATUS_WIZREC"] = "Atlikite užklausą:  #sql#.";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_ERR_MSG"] = "Serveryje su ID lygiu #node_id# nuodyta neteisinga parametro auto_increment_increment vertė. Jis turi būti lygus #value# (dabartinė vertė: auto_increment_increment: #current#).";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_NODE_ERR_MSG"] = "Naujame serveryje nuodyta neteisinga parametro auto_increment_increment vertė. Jis turi būti lygus #value# (dabartinė vertė: auto_increment_increment: #current#).";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_WIZREC"] = "Nustatykite parametro auto_increment_increment byloje my.cnf vertę į #value#. Tada perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_AUTO_INCREMENT_INCREMENT_OK_MSG"] = "Klasterio serveriuose parametro auto_increment_increment vertė turi būti lygi #value#.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_ERR_MSG"] = "Serveryje ID# #node_id# nustatyta netinkama parametro auto_increment_offset vertė. Ji neturi būti lygi #current#.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_NODE_ERR_MSG"] = "Naujame serveryje nustatyta netinkama parametro auto_increment_offset vertė. Ji neturi būti lygi #current#.";
$MESS["CLU_AUTO_INCREMENT_OFFSET_WIZREC"] = "Byloje my.cnf nustatykite parametro auto_increment_offset kitokią vertę nei kituose serveriuose. Perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_AUTO_INCREMENT_OFFSET_OK_MSG"] = "Klasterio serverių auto_increment_offset vertės neturėtų sukelti konfliktų.";
$MESS["CLU_RELAY_LOG_ERR_MSG"] = "Serveryje, kurio ID lygus #node_id# neįjungtas žurnalo skaitymas (dabartinė vertė relay-log: #relay-log#).";
$MESS["CLU_RELAY_LOG_OK_MSG"] = "Klasterio serveriuose turi būti įjungtas žurnalo skaitymas (parametras relay-log).";
$MESS["CLU_LOG_SLAVE_UPDATES_MSG"] = "Serveryje ID #node_id# neįjungtas užklausų žurnaliavimas atėjusių iš pirminės (master) duomenų bazės. To gali prireikti jei prie jo bus prijungtos slave duomenų bazės. Dabartinė reikšmė log-slave-updates: #log-slave-updates#.";
$MESS["CLU_LOG_SLAVE_UPDATES_WIZREC"] = "Nustatykite \"log-slave-updates\" parametro vertę į #value# byloje my.cnf. Perkraukite MySQL ir spauskite \"Next\".";
$MESS["CLU_LOG_SLAVE_UPDATES_OK_MSG"] = "Pagrindiniuose klasterio serveriuose turi būti įjungtas užklausų registravimas (žurnaliavimas) atėjusių iš kitų pagrindinių duomenų bazių.";
?>