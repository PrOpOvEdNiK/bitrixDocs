<?
$MESS["DAV_HELP_NAME"] = "DAV modulis";
$MESS["DAV_HELP_TEXT"] = "DAV modulis leidžia sinchronizuoti kalendorius ir kontaktus tarp portalo ir bet kurios programinės įrangos ir įrenginių, kurie palaiko Caldav ir/arba CardDAV protokolus, pavyzdžiui, \"iPhone\" ir \"iPad\". Programinės įrangos palaikymas teikiamas Mozilla Sunbird, eM Client ir kai kuriomis kitomis programinėmis įrangomis. <br>
<ul>
<li> <b> <a href=\"#caldav\"> Jungtis per Caldav a> </b>
<ul>
<li> <a href=\"#caldavipad\"> Prijunkti \"iPhone\" a> </li>
<li> <a href=\"#carddavsunbird\"> Prijunkti \"Mozilla Sunbird a> </li>
</ul>
</li>
<li> <b> <a href=\"#carddav\"> Jungtis naudojant CardDAV a> </b> </li>
</ul>

<br>

<H3> <a name=\"caldav\"> </a> Jungtis per Caldav </h3>

<H4> <a name=\"caldavipad\"> </a> Prijunkite \"iPhone\" </h4>

Nustatykite savo Apple įrenginį Caldav protokolo palaikymui:
<ol>
<li> Paspauskite <b>Settings</b>  ir pasirinkite <b> \"Mail, Contacts, Calendars> Accounts </b>. </li>
<li> Paspauskite <b>Add Account</b>. </li>
<li> Pasirinkite <b>Other</b> & gt; b>Add CardDAV Account</b>. </li>
<li> Nurodykite svetainės adresą (#SERVER#). Naudokite savo prisijungimo vardą ir slaptažodį. </li>
<li> Naudokite pagrindinę autorizaciją. </li>
<li> Jei norite nurodyti prievado numerį, išsaugokite paskyrą ir atverkite ją redagavimui vėl. </li>
</ol>

Jūsų kalendoriai pasirodys \"Kalendoriai\" programoje. <br>
Norėdami prisijungti kitų naudotojų kalendorius, naudokite nuorodas:<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/</i>,<br>
ir <br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/</i><br>

<br>

<h4><a name=\"carddavsunbird\"></a>Prijungti \"Mozilla Sunbird </h4>
Sukonfigūruoti Mozilla Sunbird darbui per CalDAV:
<ol>
<li> Paleiskite Sunbird ir pasirinkite <b> File & gt; New Calendar</b>.</li>
<li> Pasirinkite <b>On the Network</b> ir spustelėkite <b>Next</b>. </li>
<li> Pasirinkite <b>CalDAV</b> formatą. </li>
<li> Laukelyje <b>Location</b> įveskite: <br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/calendar_ID/</i><br>
arba<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/calendar_ID/</i><br>
ir spustelėkite <b>Next</b>.</li>
<li> Įveskite savo kalendoriui pavadinimą ir pasirinkite jam spalvą. </li>
<li> Įveskite savo naudotojo vardą ir slaptažodį. </li>
</ol>

<br><br>

<h3> <a name=\"carddav\"></a>Jungtis per CardDAV</h3>

Nustatykite savo Apple įrenginį veikimui per CardDAV:
<ol>
<li> Paspauskite <b>Settings</b>  ir pasirinkite <b> \"Mail, Contacts, Calendars> Accounts </b>. </li>
<li> Paspauskite <b>Add Account</b>. </li>
<li> Pasirinkite <b>Other</b> & gt; b>Add CardDAV Account</b>. </li>
<li> Nurodykite svetainės adresą (#SERVER#). Naudokite savo prisijungimo vardą ir slaptažodį. </li>
<li> Naudokite pagrindinę autorizaciją. </li>
<li> Jei norite nurodyti prievado numerį, išsaugokite paskyrą ir atidarykite ją vėl redagavimui. </li>
</ol>

Jūsų kalendoriai pasirodys \"Kontaktai\" programoje. <br>";
?>