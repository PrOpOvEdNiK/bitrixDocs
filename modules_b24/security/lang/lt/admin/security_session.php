<?
$MESS["SEC_SESSION_ADMIN_SAVEDB_TAB"] = "Sesijos duomenų bazėje";
$MESS["SEC_SESSION_ADMIN_SAVEDB_TAB_TITLE"] = "Konfigūruoti sesijos išsaugojimą duomenų bazėje";
$MESS["SEC_SESSION_ADMIN_TITLE"] = "Sesijos apsauga";
$MESS["SEC_SESSION_ADMIN_DB_ON"] = "Sesijos duomenys yra išsaugojami apsaugos modulio duomenų bazėje.";
$MESS["SEC_SESSION_ADMIN_DB_OFF"] = "Sesijos duomenys nėra išsaugojami apsaugos modulio duomenų bazėje.";
$MESS["SEC_SESSION_ADMIN_DB_BUTTON_OFF"] = "Neišsaugoti sesijos duomenų apsaugos modulio duomenų bazėje.";
$MESS["SEC_SESSION_ADMIN_DB_BUTTON_ON"] = "Išsaugoti sesijos duomenis apsaugos modulio duomenų bazėje.";
$MESS["SEC_SESSION_ADMIN_DB_NOTE"] = "<p>Dauguma interneto atakų pavogia autorizuotų naudotojų sesijos duomenis. Įjungus<b> seanso apsauga</b>, sesijos vogimas taps beprasmiškas.</p>
<p>Prie standartinių sesijos apsaugos galimybių jūs galite nustatyti naudotojų grupės nustatymuose <b> proatyvią sesijos apsaugą</b>:
<ul style='font-size:100%'>
<li>ji periodiškai keičia sesijos ID, ir dažnis gali būti nustatytas;</li>
<li>saugo sesijos duomenis modulio lentelėje.</li>
</ul>
<p>Sesijos duomenų išsaugojimas modulio duomenų bazėje neleidžia vogti duomenis, paleidus skriptą kituose virtualiuose serveriuose, kas pašalina virtualaus hostingo konfigūracijos klaidas, blogus laikinojo aplanko leidimų nustatymus ir kitas problemas, susijusias su operacine sistema. Ji taip pat sumažina failų sistemos įtampą, iškrovus operacijas į duomenų bazės serverį.</p>
<p><i>Rekomenduojama aukštame lygyje.</i></p>";
$MESS["SEC_SESSION_ADMIN_SESSID_TAB"] = "ID keitimas";
$MESS["SEC_SESSION_ADMIN_SESSID_TAB_TITLE"] = "Konfigūruoti periodiiškus sesijos ID keitimus";
$MESS["SEC_SESSION_ADMIN_SESSID_ON"] = "Sesijos ID keitimas yra įjungtas. ";
$MESS["SEC_SESSION_ADMIN_SESSID_OFF"] = "Sesijos ID keitimas yra išjungtas. ";
$MESS["SEC_SESSION_ADMIN_SESSID_BUTTON_OFF"] = "Išjungti ID keitimą";
$MESS["SEC_SESSION_ADMIN_SESSID_BUTTON_ON"] = "Įjungti ID keitimą";
$MESS["SEC_SESSION_ADMIN_SESSID_TTL"] = "Sesijos ID trukmė, sek.";
$MESS["SEC_SESSION_ADMIN_SESSID_NOTE"] = "<p> Jei ši funkcija įjungta, sesijos ID keisis po nustatyto laikotarpio. Tai padidina serverio apkrovą, bet daro ID vogimą be tuometinio naudojimosi visiškai beprasmiška. </ P>
<p> <i> Rekomenduojama aukštame lygyje. </ i> </ p>";
$MESS["SEC_SESSION_ADMIN_DB_WARNING"] = "Dėmesio! Perjungus arba išjungus sesijos režimą, šiuo metu autorizuotieji naudotojai praras autorizavimą (sesijų duomenys bus sunaikinti).";
$MESS["SEC_SESSION_ADMIN_SESSID_WARNING"] = "Session ID nesuderinamas su proaktyvios apsaugos moduliu. Identifikatorius, sugrįžęs su session_id() funkcija, negali turėti daugiau nei 32 simbolių ir turi turėti tik lotyniškas raides arba skaičius.";
?>