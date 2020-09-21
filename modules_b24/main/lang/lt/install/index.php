<?
$MESS["MAIN_ADMIN_GROUP_NAME"] = "Adminisratoriai";
$MESS["MAIN_ADMIN_GROUP_DESC"] = "Pilna prieiga";
$MESS["MAIN_EVERYONE_GROUP_NAME"] = "Visi naudotojai (su neautorizuotais naudotojais)";
$MESS["MAIN_EVERYONE_GROUP_DESC"] = "Visi naudotojai (iskaitant neautorizuotus naudotojus)";
$MESS["MAIN_VOTE_RATING_GROUP_NAME"] = "Naudotojai, kuriems leista balsuoti už reitingą";
$MESS["MAIN_VOTE_RATING_GROUP_DESC"] = "Narystė šioje naudotojų grupėje valdoma automatiškai.";
$MESS["MAIN_VOTE_AUTHORITY_GROUP_NAME"] = "Naudotojai, kuriems leidžiama balsuoti už kompetenciją";
$MESS["MAIN_VOTE_AUTHORITY_GROUP_DESC"] = "Narystė šioje naudotojų grupėje valdoma automatiškai.";
$MESS["MAIN_RULE_ADD_GROUP_AUTHORITY_NAME"] = "Užsiregistruoti naudotojų, kuriems leidžiama balsuoti už kompetenciją, grupėje";
$MESS["MAIN_RULE_ADD_GROUP_RATING_NAME"] = "Užsiregistruoti naudotojų, kuriems leidžiama balsuoti už reitingą, grupėje";
$MESS["MAIN_RULE_REM_GROUP_AUTHORITY_NAME"] = "Pašalinti iš naudotojų, kuriems uždrausta balsuoti už kompetenciją, grupės ";
$MESS["MAIN_RULE_REM_GROUP_RATING_NAME"] = "Pašalinti iš naudotojų, kuriems uždrausta balsuoti už reitingą, grupės ";
$MESS["MAIN_RATING_NAME"] = "Reitingas";
$MESS["MAIN_RATING_AUTHORITY_NAME"] = "Kompetencija";
$MESS["MAIN_RATING_TEXT_LIKE_Y"] = "Patinka";
$MESS["MAIN_RATING_TEXT_LIKE_N"] = "Nepatinka";
$MESS["MAIN_RATING_TEXT_LIKE_D"] = "Patinka";
$MESS["MAIN_DEFAULT_SITE_NAME"] = "Numatytojo svetainė";
$MESS["MAIN_DEFAULT_LANGUAGE_NAME"] = "Angliškai";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_DATE"] = "MM/DD/YYYY";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_DATETIME"] = "MM/DD/YYYY H:MI:SS T";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_NAME"] = "#NAME# #LAST_NAME#";
$MESS["MAIN_DEFAULT_LANGUAGE_FORMAT_CHARSET"] = "iso-8859-1";
$MESS["MAIN_DEFAULT_SITE_FORMAT_DATE"] = "MM/DD/YYYY";
$MESS["MAIN_DEFAULT_SITE_FORMAT_DATETIME"] = "MM/DD/YYYY H:MI:SS T";
$MESS["MAIN_DEFAULT_SITE_FORMAT_NAME"] = "#NAME# #LAST_NAME#";
$MESS["MAIN_DEFAULT_SITE_FORMAT_CHARSET"] = "iso-8859-1";
$MESS["MAIN_MODULE_NAME"] = "Pagrindinis modulis";
$MESS["MAIN_MODULE_DESC"] = "Produkto branduolys";
$MESS["MAIN_INSTALL_DB_ERROR"] = "Nepavyko prisijungti prie duomenų bazės. Prašome patikrinti parametrus.";
$MESS["MAIN_NEW_USER_TYPE_NAME"] = "Buvo registruotas naujas naudotojas";
$MESS["MAIN_NEW_USER_TYPE_DESC"] = "
#USER_ID# - Naudotojo ID
#LOGIN# - Prisijungimo vardas
#EMAIL# - El.paštas
#NAME# - Vardas
#LAST_NAME# - Pavardė
#USER_IP# - Naudotojo IP
#USER_HOST# - Naudotojos serveris";
$MESS["MAIN_USER_INFO_TYPE_NAME"] = "Paskyros informacija";
$MESS["MAIN_USER_INFO_TYPE_DESC"] = "
#USER_ID# - Naudotojo ID
#STATUS# -Paskyros statusas
#MESSAGE# - Pranešimas naudotojui
#LOGIN# - Prisijungimo vardas
#CHECKWORD# - Kontrolinė eilutė slaptažodžio pakeitimui
#NAME# - Vardas
#LAST_NAME# - Pavardė
#EMAIL# - Naudotojo el.paštas";
$MESS["MAIN_NEW_USER_CONFIRM_TYPE_NAME"] = "Naujo naudotojo registracijos informacija";
$MESS["MAIN_NEW_USER_CONFIRM_TYPE_DESC"] = "
#USER_ID# - Naudotojo ID
#LOGIN# - Prisijungimo vardas
#EMAIL# - El.paštas
#NAME# - Vardas
#LAST_NAME# - Pavardė
#USER_IP# - Naudotojo IP
#USER_HOST# - Naudotojo serveris
#CONFIRM_CODE# - Patvirtinimo kodas
";
$MESS["MAIN_USER_INVITE_TYPE_NAME"] = "Naujo naudotojo pakvietimas";
$MESS["MAIN_USER_INVITE_TYPE_DESC"] = "#ID# - Naudotojo ID
#LOGIN# -Prisijungimo vardas
#URL_LOGIN# - Koduotas prisijungimo vardas naudoti URL
#EMAIL# - El.paštas
#NAME# - Vardas
#LAST_NAME# - Pavardė
#PASSWORD# - Naudotojo slaptažodis
#CHECKWORD# - Slaptažodžio patikrinimo eilutė
#XML_ID# - Naudotojo ID susieti su išoriniais duomenų šaltiniais
";
$MESS["MAIN_NEW_USER_EVENT_NAME"] = "#SITE_NAME#: Naujas naudotojas buvo įregistruotas svetainėje";
$MESS["MAIN_NEW_USER_EVENT_DESC"] = "Informacinis pranešimas iš #SITE_NAME#
---------------------------------------

Naujas naudotojas buvo sėkmingai įregistruotas svetainėje  #SERVER_NAME#.

Naudotojo informacija:
Naudotojo ID: #USER_ID#

Vardas: #NAME#
Pavardė: #LAST_NAME#
Naudotojo el.paštas: #EMAIL#

Prisijungimo vardas: #LOGIN#

Pranešimas sugeneruotas automatiškai.";
$MESS["MAIN_USER_INFO_EVENT_NAME"] = "#SITE_NAME#: Registracijos informacija";
$MESS["MAIN_USER_INFO_EVENT_DESC"] = "Informacinis pranešimas iš #SITE_NAME#
---------------------------------------

#NAME# #LAST_NAME#,

#MESSAGE#

Jūsų registracijos informacija:

Naudotojo ID: #USER_ID#
Paskyros statusas: #STATUS#
Prisijungimo vardas: #LOGIN#

To change your password please visit the link below:
http://#SERVER_NAME#/auth/index.php?change_password=yes&lang=en&USER_CHECKWORD=#CHECKWORD#&USER_LOGIN=#LOGIN#

Pranešimas sugeneruotas automatiškai.";
$MESS["MAIN_USER_PASS_REQUEST_EVENT_DESC"] = "Informacinis pranešimas nuo #SITE_NAME#
---------------------------------------

#NAME# #LAST_NAME#,

#MESSAGE#

Norėdami pakeisti slaptažodį, prašome sekti nuorodą::
http://#SERVER_NAME#/auth/index.php?change_password=yes&lang=en&USER_CHECKWORD=#CHECKWORD#&USER_LOGIN=#URL_LOGIN#

Jūsų registracijos informacija:

Naudotojo ID: #USER_ID#
Paskyros statusas: #STATUS#
Prisijungimo vardas: #LOGIN#

Automatiškai sugeneruotas pranešimas.";
$MESS["MAIN_USER_PASS_CHANGED_EVENT_DESC"] = "Informacinis pranešimas nuo #SITE_NAME#
---------------------------------------

#NAME# #LAST_NAME#,

#MESSAGE#

Jūsų registracijos informacija:

Naudotojo ID: #USER_ID#
Paskyros statusas: #STATUS#
Prisijungimo vardas: #LOGIN#

Automatiškai sugeneruotas pranešimas.";
$MESS["MAIN_NEW_USER_CONFIRM_EVENT_NAME"] = "#SITE_NAME#: Naujo naudotojo registracijos patvirtinimas";
$MESS["MAIN_NEW_USER_CONFIRM_EVENT_DESC"] = "Sveikinimai nuo #SITE_NAME#!
------------------------------------------

Sveiki,

Jūs gavote šį laišką, nes jūs (arba kas nors kitas), naudojosi jūsų el.paštu ir užsiregistravo #SERVER_NAME#.

Jūsų registracijos patvirtinimo kodas: #CONFIRM_CODE#

Prašome naudoti nuorodą žemiau, norėdami patikrinti ir aktyvuoti savo registraciją:
http://#SERVER_NAME#/auth/index.php?confirm_registration=yes&confirm_user_id=#USER_ID#&confirm_code=#CONFIRM_CODE#

Arba atidarykite šią nuorodą savo naršyklėje ir įveskite kodą rankiniu būdu:
http://#SERVER_NAME#/auth/index.php?confirm_registration=yes&confirm_user_id=#USER_ID#

Dėmesio! Jūsų paskyra nebus aktyvuota, kol nepatvirtinsite registraciją.

---------------------------------------------------------------------

Automatiškai sugeneruotas pranešimas.";
$MESS["MAIN_USER_INVITE_EVENT_NAME"] = "#SITE_NAME#: Pakvietimas į svetainę";
$MESS["MAIN_USER_INVITE_EVENT_DESC"] = "
Informacinis pranešimas nuo #SITE_NAME#
------------------------------------------
Sveiki #NAME# #LAST_NAME#!

Administratorius pridėjo jus prie registruotų svetainės naudotojų.

Kviečiame apsilankyti mūsų svetainėje.

Jūsų registracijos informacija:

Naudotojo ID: #ID#
Prisijungimo vardas: #LOGIN#

Mes rekomenduojame jums pakeisti automatiškai sugeneruotą slaptažodį.

Norėdami pakeisti slaptažodį, prašome sekti nuorodą:
http://#SERVER_NAME#/auth.php?change_password=yes&USER_LOGIN=#URL_LOGIN#&USER_CHECKWORD=#CHECKWORD#";
$MESS["MF_EVENT_NAME"] = "Siunčiamas pranešimas naudojant grįžtamojo ryšio formą";
$MESS["MF_EVENT_DESCRIPTION"] = "#AUTHOR# - Pranešimo autorius
#AUTHOR_EMAIL# - Autoriaus el.paštas
#TEXT# - Pranešimo tekstas
#EMAIL_FROM# - Siuntėjo el.pašto adresas
#EMAIL_TO# - Gavėjo el.pašto adresas";
$MESS["MF_EVENT_SUBJECT"] = "#SITE_NAME#: Atsiliepimo formos pranešimas";
$MESS["MF_EVENT_MESSAGE"] = "Pranešimas nuo #SITE_NAME#
------------------------------------------

Pranešimas buvo išsiųstas iš grįžtamojo ryšio formos.

Išsiuntė: #AUTHOR#
Siuntėjo el.paštas: #AUTHOR_EMAIL#

Pranešimo tekstas:
#TEXT#

Šis pranešimas buvo sukurtas automatiškai.";
$MESS["MAIN_USER_PASS_REQUEST_TYPE_NAME"] = "Slaptažodžio pakeitimo prašymas ";
$MESS["MAIN_USER_PASS_CHANGED_TYPE_NAME"] = "Slaptažodžio pakeitimo patvirtinimas";
$MESS["MAIN_USER_PASS_REQUEST_EVENT_NAME"] = "#SITE_NAME#: Slaptažodžio pakeitimo prašymas ";
$MESS["MAIN_USER_PASS_CHANGED_EVENT_NAME"] = "#SITE_NAME#: Slaptažodžio pakeitimo patvirtinimas";
$MESS["MAIN_DESKTOP_CREATEDBY_KEY"] = "Sukurta";
$MESS["MAIN_DESKTOP_CREATEDBY_VALUE"] = "Bitrix, Inc. ";
$MESS["MAIN_DESKTOP_URL_KEY"] = "Svetainės URL";
$MESS["MAIN_DESKTOP_URL_VALUE"] = "<a href=\"http://www.bitrixsoft.com\">www.bitrixsoft.com</a>";
$MESS["MAIN_DESKTOP_PRODUCTION_KEY"] = "Išleistas";
$MESS["MAIN_DESKTOP_PRODUCTION_VALUE"] = "12.12.2011";
$MESS["MAIN_DESKTOP_RESPONSIBLE_KEY"] = "Administratorius";
$MESS["MAIN_DESKTOP_RESPONSIBLE_VALUE"] = "John Doe";
$MESS["MAIN_DESKTOP_EMAIL_KEY"] = "El. paštas";
$MESS["MAIN_DESKTOP_EMAIL_VALUE"] = "<a href=\"mailto:info@bitrixsoft.com\">info@bitrixsoft.com</a>";
$MESS["MAIN_DESKTOP_INFO_TITLE"] = "Svetainės informacija";
$MESS["MAIN_DESKTOP_RSS_TITLE"] = "Bitrix naujienos";
$MESS["MAIN_RULE_AUTO_AUTHORITY_VOTE_NAME"] = "Automatinis balsavimas už naudotojo kompetenciją";
$MESS["MAIN_SMILE_DEF_SET_NAME"] = "Numatytieji nustatymai";
$MESS["MAIN_MAIL_CONFIRM_EVENT_TYPE_NAME"] = "Patvirtinkite siuntėjo el. pašto adresą";
$MESS["MAIN_MAIL_CONFIRM_EVENT_TYPE_DESC"] = "
#EMAIL_TO# - patvirtinimo el. pašto adresas
#MESSAGE_SUBJECT# - žinutės tema
#CONFIRM_CODE# - patvirtinimo kodas";
?>