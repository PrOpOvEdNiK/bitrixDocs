<?
$MESS["SUBSCRIBE_CONFIRM_NAME"] = "Prenumeratos patvirtinimas";
$MESS["SUBSCRIBE_CONFIRM_DESC"] = "#ID# - prenumeratos ID
#EMAIL# - prenumeratos el.pašto adresas
#CONFIRM_CODE# - patvirtinimo kodas
#SUBSCR_SECTION# - skyriuje su prenumeratos redagavimo puslapiu (nurodomas nustatymuose)
#USER_NAME# - prenumeratoriaus vardas (neprivaloma)
#DATE_SUBSCR# - adreso įvedimo/keitimo data
";
$MESS["SUBSCRIBE_CONFIRM_SUBJECT"] = "#SITE_NAME#: Prenumeratos patvirtinimas";
$MESS["SUBSCRIBE_CONFIRM_MESSAGE"] = "Informacinis pranešimas nuo #SITE_NAME#
---------------------------------------

Sveiki,

Jūs gavote šį pranešimą, nes prenumeratos prašymas buvo pateiktas jūsų adresui naujienoms iš #SERVER_NAME# gauti.

Čia yra detali informacija apie jūsų prenumeratą:

Prenumeratos el.adresas .............. #EMAIL#
El.adreso įvedimo/redagavimo data .... #DATE_SUBSCR#

Jūsų patvirtinimo kodas: #CONFIRM_CODE#

Prašome spausti pateiktą šiame laiške nuorodą jūsų prenumeratai patvirtinti.
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#

Arba eikite į šį puslapį ir įveskite savo patvirtinimo kodą rankiniu būdu:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#

Jūs negausite jokio pranešimo, kol neišsiųsite mums savo patvirtinimo.

---------------------------------------------------------------------
Prašome išsaugoti šį pranešimą, nes jame yra informacija apie autorizavimą.
Naudojant patvirtinimo kodą, jūs galite pakeisti prenumeratos parametrus arba jos 
atsisakyti.

Redaguoti parametrus:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#

Atsisakyti prenumeratos:
http://#SERVER_NAME##SUBSCR_SECTION#subscr_edit.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#&action=unsubscribe
---------------------------------------------------------------------

Šis pranešimas sukurtas automatiškai
";
?>