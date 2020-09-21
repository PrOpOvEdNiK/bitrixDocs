<?
$MESS['STATISTIC_ACTIVITY_EXCEEDING_NAME'] = 'Aktyvumo limito viršijimas';
$MESS['STATISTIC_ACTIVITY_EXCEEDING_DESC'] = '#ACTIVITY_TIME_LIMIT# - testinis laiko intervalas
#ACTIVITY_HITS# - hitų kiekis per testinį laiko tarpą
#ACTIVITY_HITS_LIMIT# - maksimalus hitų kiekis per testinį laiko periodą (aktyvumo limitas)
#ACTIVITY_EXCEEDING# - hitų kiekio viršijimas
#CURRENT_TIME# - blokavimo momentas (serverio laikas)
#DELAY_TIME# - blokavimo trukmė
#USER_AGENT# - UserAgent
#SESSION_ID# - sesijos ID
#SESSION_LINK# - sesijos nuoroda
#SERACHER_ID# - paieškos sistemos ID
#SEARCHER_NAME# - paieškos sistemos pavadinimas
#SEARCHER_LINK# - nuoroda į paieškos sistemos hitų sąrašą
#VISITOR_ID# - lankytojo ID
#VISITOR_LINK# - nuoroda į lankytojo profailą
#STOPLIST_LINK# - nuorodą lankytojo pridėjimui į stop-sąrašą';
$MESS['STATISTIC_DAILY_REPORT_NAME'] = 'Kasdieninė svetainės statistika';
$MESS['STATISTIC_DAILY_REPORT_DESC'] = '#EMAIL_TO# - svetainės administratoriaus el.paštas
#SERVER_TIME# - laikas serveryje ataskaitos siuntimo metu
#HTML_HEADER# - HTML žymės atidarimas + CSS stiliai
#HTML_COMMON# - svetainės lankomumo lentelė (hitai, sesijos, hostai, lankytojai, įvykiai) (HTML)
#HTML_ADV# - reklaminių kompanijų lentelė (TOP 10) (HTML)
#HTML_EVENTS# - įvykių tipų lentelė (TOP 10) (HTML)
#HTML_REFERERS# - nurodančių svetainių sąrašas (TOP 10) (HTML)
#HTML_PHRASES# - paieškos frazių lentelė (TOP 10) (HTML)
#HTML_SEARCHERS# - svetainės indeksacijos lentelė (TOP 10) (HTML)
#HTML_FOOTER# - HTML žymės uždarimas';
$MESS['STATISTIC_DAILY_REPORT_SUBJECT'] = '#SERVER_NAME#: Svetainės statistika (#SERVER_TIME#) ';
$MESS['STATISTIC_DAILY_REPORT_MESSAGE'] = '#HTML_HEADER#
<font class=\"h2\">Svetainės statistikos santrauka <font color=\"#a52929\">#SITE_NAME#</font><br>
Duomenys už <font color=\"#0d716f\">#SERVER_TIME#</font></font>
<br><br>
<a class=\"tablebodylink\" href=\"http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#\">http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#</a>
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
<a class=\"tablebodylink\" href=\"http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#\">http://#SERVER_NAME#/bitrix/admin/stat_list.php?lang=#LANGUAGE_ID#</a>
#HTML_FOOTER#';
$MESS['STATISTIC_ACTIVITY_EXCEEDING_SUBJECT'] = '#SERVER_NAME#: Aktyvumo limito viršijimas';
$MESS['STATISTIC_ACTIVITY_EXCEEDING_MESSAGE'] = 'Svetainėje #SERVER_NAME# naudotojas viršijo nustatytą aktyvumo limitą.

Pradedant nuo #CURRENT_TIME# naudotojas blokuojamas #DELAY_TIME# sek.

Aktyvumas  - #ACTIVITY_HITS# hitų per #ACTIVITY_TIME_LIMIT# sek. (limitas - #ACTIVITY_HITS_LIMIT#)
Naudotojas  - #VISITOR_ID#
Sesija      - #SESSION_ID#
Paieškos sitema   - [#SERACHER_ID#] #SEARCHER_NAME#
UserAgent   - #USER_AGENT#

&gt;===============================================================================================
Pridėti į stop-sąrašą pasinaudokyte šia nuoroda:
http://#SERVER_NAME##STOPLIST_LINK#
Peržiūrėti naudotojo sesiją pasinaudokyte šia nuoroda:
http://#SERVER_NAME##SESSION_LINK#
Peržiūrėti naudotojo profailą pasinaudokyte šia nuoroda:
http://#SERVER_NAME##VISITOR_LINK#
Peržiūrėti paieškos sistemos hitų statistiką pasinaudokyte šia nuoroda:
http://#SERVER_NAME##SEARCHER_LINK#';
?>