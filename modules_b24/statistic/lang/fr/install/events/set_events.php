<?
$MESS["STATISTIC_ACTIVITY_EXCEEDING_DESC"] = "#ACTIVITY_TIME_LIMIT# - intervalle de test (sec.)
#ACTIVITY_HITS# - nombre de 'hits' pour un intervalle de test
#ACTIVITY_HITS_LIMIT# - nombre maximum de 'hits' pour un intervalle de temps test (limite d'activité)
#ACTIVITY_EXCEEDING# - dépassement du nombre de 'hits'
#CURRENT_TIME# - moment de blocage (temps sur le serveur)
#DELAY_TIME# - durée de blocage
#USER_AGENT# - UserAgent
#SESSION_ID# -  ID sessions
#SESSION_LINK# - lien à la session
#SERACHER_ID# - ID moteur de recherche
#SEARCHER_NAME# - intitulé du moteur de recherche
#SEARCHER_LINK# - lien à la liste des 'hits' du moteur de recherche
#VISITOR_ID# - ID visiteur
#VISITOR_LINK# - lien au profile du visiteur
#STOPLIST_LINK# - lien pour ajouter le visiteur dans la liste noire";
$MESS["STATISTIC_ACTIVITY_EXCEEDING_MESSAGE"] = "Sur le site #SERVER_NAME# le visiteur a dépassé la limite d'activité imposée.

A partir de #CURRENT_TIME# le visiteur est bloqué pour #DELAY_TIME# secondes.

Activité des hits - #ACTIVITY_HITS# pour #ACTIVITY_TIME_LIMIT# secondes (limite - #ACTIVITY_HITS_LIMIT#)
Visiteur - #VISITOR_ID#
Session - #SESSION_ID#
Moteur de recherche - [#SERACHER_ID#] #SEARCHER_NAME#
Agent utilisateur - #USER_AGENT#

>===============================================================================================
Pour ajouter dans la liste noire suivez le lien ci-dessous:
http://#SERVER_NAME##STOPLIST_LINK#
Pour consulter la session du visiteur, suivez le lien ci-dessous:
http://#SERVER_NAME##SESSION_LINK#
Pour consulter le fichier PRO du visiteur, suivez le lien ci-dessous:
http://#SERVER_NAME##VISITOR_LINK#
Pour consulter la statistique des hits du moteur de recherche, suivez le lien ci-dessous:
http://#SERVER_NAME##SEARCHER_LINK#";
$MESS["STATISTIC_ACTIVITY_EXCEEDING_NAME"] = "Limite d'activité des visiteurs a dépassé";
$MESS["STATISTIC_ACTIVITY_EXCEEDING_SUBJECT"] = "#SERVER_NAME# : Limite d'activité dépassée";
$MESS["STATISTIC_DAILY_REPORT_DESC"] = "#EMAIL_TO# - Adresse email de l'administrateur du site
#SERVER_TIME# -    heure d'envoi du rapport sur le serveur
#HTML_HEADER# - ouverture du tag HTML + CSS styles 
#HTML_COMMON# - tableau de fréquentation du site (hits, sessions, hébergeur, visiteurs, évènements) (HTML)
#HTML_ADV# - tableau des campagnes publicitaires (TOP 10) (HTML)
#HTML_EVENTS# - tableau des types d'évènements (TOP 10) (HTML)
#HTML_REFERERS# - tableau des sites de référence (TOP 10) (HTML)
#HTML_PHRASES# - tableau des phrases de recherche (TOP 10) (HTML)
#HTML_SEARCHERS# - tableau de l'indexation du site (TOP 10) (HTML)
#HTML_FOOTER# - fermeture du tag HTML";
$MESS["STATISTIC_DAILY_REPORT_MESSAGE"] = "#HTML_HEADER#
<font class='h2'>La statistique généralisée du site<font color='#A52929'>#SITE_NAME#</font><br>
Les données sur <font color='#0D716F'>#SERVER_TIME#</font></font>
<br><br>
<a class='tablebodylink' href='http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#'>http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#</a>
<br>
<hr><br>
#HTML_COMMON#
<br>
#HTML_ADV#
<br>
#HTML_REFERERS#
<br>
#HTML_PHRASES#
<br>
#HTML_SEARCHERS#
<br>
#HTML_EVENTS#
<br>
<hr>
<a class='tablebodylink' href='http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#'>http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#</a>
#HTML_FOOTER#";
$MESS["STATISTIC_DAILY_REPORT_NAME"] = "Statistiques du site de rapport quotidien";
$MESS["STATISTIC_DAILY_REPORT_SUBJECT"] = "#SERVER_NAME# : Statistiques du site (#SERVER_TIME#)";
?>