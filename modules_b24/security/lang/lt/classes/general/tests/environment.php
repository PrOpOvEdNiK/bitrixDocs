<?
$MESS["SECURITY_SITE_CHECKER_EnvironmentTest_NAME"] = "Aplinkos patikrinimas";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR"] = "Sesijos failų saugyklos katalogas yra pasiekiamas visiems sistemos naudotojams";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR_DETAIL"] = "Šis pažeidžiamumas gali būti naudojamas skaityti arba keisti sesijos duomenis, paleidžiant skriptą kitame virtualiame serveryje.";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR_RECOMMENDATION"] = "Konfigūruoti prieigos teises teisingai, arba pakeisti katalogą. Kitas variantas yra išsaugoti sesijas duomenų bazėje:<a href=\"/bitrix/admin/security_session.php\">Sesijos apsauga</a>.";
$MESS["SECURITY_SITE_CHECKER_SESSION_DIR_ADDITIONAL"] = "Sesijos išsaugojimo katalogas: #DIR#<br>
Leidimas: #PERMS#";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION"] = "Sesijos saugojimo katalogas gali turėti įvairių projektų sesijas.";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_DETAIL"] = "Tai gali padėti užpuolikui skaityti ir rašyti sesijos duomenis, naudojant kitų virtualių serverių skriptus.";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_RECOMMENDATION"] = "Keisti katalogą ar saugoti sesijas duomenų bazėje: <a href=\"/bitrix/admin/security_session.php\">Sesijos apsauga</a>.";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_ADDITIONAL_OWNER"] = "Prie=astis: failo savininkas yra ne dabartinis naudrtotojas<br>
Failas: #FILE#<br>
Failo savininko UID: #FILE_ONWER#<br>
Dabartinio naudotojo UID: #CURRENT_OWNER#<br>";
$MESS["SECURITY_SITE_CHECKER_COLLECTIVE_SESSION_ADDITIONAL_SIGN"] = "Priežastis: sesijos failas nėra pasirašytas dabartiniu savetainės parašu<br>
Failas: #FILE#<br>
Dabartinis svetainės parašas: #SIGN#<br>
Failo turinys: <pre>#FILE_CONTENT#</pre>";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP"] = "PHP skriptai yra paleisti įkeltų failų kataloge.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DETAIL"] = "Kartais kūrėjai neskiria pakankamai dėmesio tinkamo failo pavadinimo filtrams. Užpuolikas gali išnaudoti šį pažeidžiamumą ir pradėti visiškai kontroliuoti jūsų projektą.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_RECOMMENDATION"] = "Konfigūruoti jūsų web serverį teisingai. ";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DOUBLE"] = "PHP su dvigubu išplėtimu (pvz php.lala) yra atliekamas įkeltų failų kataloge.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DOUBLE_DETAIL"] = "Kartais kūrėjai neskiria pakankamai dėmesio tinkamo failo pavadinimo filtrams. Užpuolikas gali išnaudoti šį pažeidžiamumą ir pradėti visiškai kontroliuoti jūsų projektą.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PHP_DOUBLE_RECOMMENDATION"] = "Konfigūruokite jūsų web serverį teisingai. ";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PY"] = "Python skriptai yra paleisti įkeltų failų kataloge.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PY_DETAIL"] = "Kartais kūrėjai neskiria pakankamai dėmesio tinkamo failo pavadinimo filtrams. Užpuolikas gali išnaudoti šį pažeidžiamumą ir pradėti visiškai kontroliuoti jūsų projektą.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_EXECUTABLE_PY_RECOMMENDATION"] = "Konfigūruokite jūsų web serverį teisingai. ";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_HTACCESS"] = "Apache neturi apdoroti .htaccess failus įkeltų failų kataloge";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_HTACCESS_DETAIL"] = "Kartais kūrėjai neskiria pakankamai dėmesio tinkamo failo pavadinimo filtrams. Užpuolikas gali išnaudoti šį pažeidžiamumą ir pradėti visiškai kontroliuoti jūsų projektą.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_HTACCESS_RECOMMENDATION"] = "Konfigūruokite jūsų web serverį teisingai. ";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_NEGOTIATION"] = "Apache turinio derybos yra įjungtos failų įkėlimo kataloge.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_NEGOTIATION_DETAIL"] = "Apache turinio derybos nerekomenduojamos, nes jis gali patirti XSS atakas.";
$MESS["SECURITY_SITE_CHECKER_UPLOAD_NEGOTIATION_RECOMMENDATION"] = "Konfigūruokite jūsų web serverį teisingai. ";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER"] = "PHP veikia kaip privilegijuotas naudotojas";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER_DETAIL"] = "Veikiantis PHP kaip priviligijuotas naudotojas (pvz. root) gali sukompromituoti projekto saugumą";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER_RECOMMENDATION"] = "Sukonfigūruokite savo serverį, kad jis veiktų kaip neprivilegijuotas  PHP naudotojas.";
$MESS["SECURITY_SITE_CHECKER_PHP_PRIVILEGED_USER_ADDITIONAL"] = "#UID#/#GID#";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR"] = "Laikini failai yra kaupiami projekto root kataloge";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR_DETAIL"] = "Nerekomenduojama saugoti laikinus failus sukurtus CTempFile pagalba root kataloge.";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR_RECOMMENDATION"] = "Apibrėžkite konstantą \"BX_TEMPORARY_FILES_DIRECTORY\" faile \"bitrix/php_interface/dbconn.php\" ir nurodykite reikiamą kelią. <br />
Atlikite žingsnius: <br />
1. Pasirinkite laikinojo katalogo pavadinimą ir sukurkite jį. Pvz.: \"/home/bitrix/tmp/www\":
<pre>
mkdir -p -m 700 /home/bitrix/tmp/www
</pre>
2. Apibrėžkite konstantą , kad sistema žinotų kur jus norite kaupti laikinas bylas:
<pre>
define(\"BX_TEMPORARY_FILES_DIRECTORY\", \"/home/bitrix/tmp/www\");
</pre>";
$MESS["SECURITY_SITE_CHECKER_BITRIX_TMP_DIR_ADDITIONAL"] = "Dabartinis katalogas: #DIR#";
?>