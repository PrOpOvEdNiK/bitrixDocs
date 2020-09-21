<?
$MESS["SEC_OTP_SECRET_KEY"] = "Slaptas raktas (tiekiamas su įrenginiu)";
$MESS["SEC_OTP_INIT"] = "Inicializacija";
$MESS["SEC_OTP_PASS1"] = "Pirmasis įrenginio slaptažodį (paspauskite ir užrašykite)";
$MESS["SEC_OTP_PASS2"] = "Antrasis įrenginio slaptažodį (paspauskite ir užrašykite)";
$MESS["SEC_OTP_TYPE"] = "Slaptažodžio generavimo algoritmas";
$MESS["SEC_OTP_STATUS"] = "Dabartinis statusas";
$MESS["SEC_OTP_STATUS_ON"] = "Įjungtas";
$MESS["SEC_OTP_NEW_ACCESS_DENIED"] = "Prieiga prie dviejų etapų autentifikavimo kontrolės buvo atmesta.";
$MESS["SEC_OTP_NEW_SWITCH_ON"] = "Įjungti dviejų etapų autentifikaciją";
$MESS["SEC_OTP_DESCRIPTION_INTRO_TITLE"] = "Vienkartinis slaptažodis";
$MESS["SEC_OTP_DESCRIPTION_INTRO_SITE"] = "Šiandien naudotojas panaudoja prisijungimo vardą ir slaptažodį, norėdamas prisijungti prie jūsų svetainės. Tačiau yra būdai, kaip piktybinis naudotojas gali patekti į jūsų kompiuterį ir pavogti šiuos duomenis, pavyzdžiui, jei naudotojas išsaugo savo slaptažodį. <br>
<b> Dviejų žingsnių autentifikavimas </b> yra rekomenduojama galimybė apsisaugoti nuo įsilaužėlių programinės įrangos. Kiekvieną kartą, kai naudotojas prisijungia prie sistemos, jis turės išlaikyti dviejų lygių patikrinimą. Pirma, įvesti naudotojo vardą ir slaptažodį. Po to įvesti vienkartinį saugos kodą, išsiųsti į jo mobilųjį prietaisą. Esmė yra ta, kad užpuolikas negali pavogti duomenų, nes jis nežino saugumo kodo.";
$MESS["SEC_OTP_DESCRIPTION_INTRO_INTRANET"] = "Nuo šiol Jūsų Bitrix24 yra apsaugotas duomenų šifravimo technologija, prisijungimo vardu ir slaptažodžiu kiekvienam darbuotojui.
<br>
<b>Dviejų žingsnių autentifikavimas </b> yra rekomenduojama galimybė apsisaugoti jūsų Bitrix24 nuo įsilaužėlių programinės įrangos. Kiekvieną kartą, kai naudotojas prisijungia prie sistemos, jis turės išlaikyti dviejų lygių patikrinimą. Pirma, įvesti naudotojo vardą ir slaptažodį. Po to įvesti vienkartinį saugos kodą, išsiųsti į jo mobilųjį prietaisą. Esmė yra ta, kad užpuolikas negali pavogti duomenų, nes jis nežino saugumo kodo.";
$MESS["SEC_OTP_DESCRIPTION_USING_TITLE"] = "Naudojamas vienkartinis slaptažodis";
$MESS["SEC_OTP_DESCRIPTION_USING_STEP_0"] = "Žingsnis 1";
$MESS["SEC_OTP_DESCRIPTION_USING_STEP_1"] = "Žingsnis 2";
$MESS["SEC_OTP_DESCRIPTION_USING"] = "Kai įjungtas dviejų etapų autentifikavimas, naudotojas turės išlaikyti dviejų lygių patikrinimą. <br>
Pirma, įvesti savo elektroninio pašto adresą ir slaptažodį, kaip įprasta. <br>
Po to įvesti vienkartinį apsaugos kodą, išsiųsta į jo mobilųjį prietaisą ar gautą specialųjį raktą.";
$MESS["SEC_OTP_DESCRIPTION_ACTIVATION_TITLE"] = "Aktivavimas ";
$MESS["SEC_OTP_DESCRIPTION_ACTIVATION"] = "Vienkartinis kodas dviejų pakopų autentifikavimui gali būti gautas naudojant specialų įtaisą (raktas), arba nemokamą mobiliąją aplikaciją (Bitrix OTP) kiekvienas naaudotojas turi įdiegti savo mobiliajame prietaise. <br>
Norėdamas įjungti raktą, administratorius turės atidaryti naudotojo profilį ir įvesti du sugeneruotus slaptažodžius. <br>
Norėdamas gauti vienkartinį kodą į mobilųjį prietaisą, naudotojas gali atsisiųsti ir paleisti aplikaciją ir nuskaityti QR kodą nustatymų puslapyje savo naudotojo profilyje arba įvesti paskyros duomenis rankiniu būdu.";
$MESS["SEC_OTP_DESCRIPTION_ABOUT_TITLE"] = "Aprašymas";
$MESS["SEC_OTP_DESCRIPTION_ABOUT"] = "Vienkartinis slaptažodis (OTP) buvo sukurtas kaip dalis OATH iniciatyva. <br>
OTP remiasi hmac ir SHA-1 / SHA-256 / SHA-512. Šiuo metu, du algoritmai yra palaikomi generuoti kodus:
<ul> <li> pagal skaitiklį (hmac Vienkartinis slaptažodis, HOTP), kaip aprašyta <a href=\"https://tools.ietf.org/html/rfc4226\" target=\"_blank\"> RFC4226 </> </li>
<li> pagal laiką (laiko pagrindu vienkartinis slaptažodį, TOTP), kaip aprašyta <a href=\"https://tools.ietf.org/html/rfc6238\" target=\"_blank\"> RFC6238 </a> </li> </ul>
Apskaičiuoti OTP rertė algoritmas paima du įvesties parametrus: slaptas raktas (pradinė reikšmė) ir dabartinė skaitiklio vertė (reikalingų ciklų generavimo skaičių arba esamą laiką, priklausomai nuo algoritmo). Pradinė reikšmė yra išsaugoma prietaise ir svetainėje, kai tik prietaisas buvo inicijuotas. Jei naudojant HOTP, prietaiso skaitiklis didėja per kiekvieną OTP generavimą, o serverio skaitiklis keičiasi per kiekvieną sėkmingą OTP autentifikavimą. Jei naudojate TOTP, skaitiklis nėra išsaugomas prietaise, ir serveris stebi galimus laiko pokyčius prietaise per kiekvieną sėkmingą OTP autentifikavimą. <br>
Kiekvienas iš OTP prietaisų partijoje turi šifruotą failą, kuriame yra pradinės reikšmės (slapti raktai) kiekvienam partijos įrenginiui, failas pririštas prie prietaiso serijos numerio, kurį galima rasti ant prietaiso. <br>
Jei prietaiso ir serverio generatoriaus skaitikliai tampa nesinchronizuoti, jūs galite lengvai sinchronizuot juos iš naujo pagal serverio reikšmes į reikšmes, saugomus įrenginyje. Ši procedūra reikalauja, kad sistemos administratorius (ar naudotojas, kuris turi pakankamai teisių) generuotų dvi iš eilės OTP reikšmes ir įvestų juos svetainėje.<br>
Jūs galite rasti mobiliąją aplikaciją AppStore ir GooglePlay.";
$MESS["SEC_OTP_CONNECT_MOBILE_TITLE"] = "Pajungti mobilų prietaisą";
$MESS["SEC_OTP_CONNECT_MOBILE_STEP_1"] = "Atsisiųsti Bitrix OTP mobiliojo aplikaciją jūsų telefonui <a href=\"https://itunes.apple.com/en/app/bitrix24-otp/id929604673?l=en\" target=\"_new\">AppStore</a> on <a href=\"https://play.google.com/store/apps/details?id=com.bitrixsoft.otp\" target=\"_new\">GooglePlay</a>";
$MESS["SEC_OTP_CONNECT_MOBILE_STEP_2"] = "Paleisti aplikaciją ir paspausti <b>Konfigūruoti</b>";
$MESS["SEC_OTP_CONNECT_MOBILE_STEP_3"] = "Pasirinkite, kaip jūs norite įvesti duomenis: naudojant QR kodą rankiniu būdu";
$MESS["SEC_OTP_CONNECT_MOBILE_SCAN_QR"] = "Pridėkite jūsų mobiliųjį prietaisą prie monitoriaus ir palaukite, kol aplikacija nuskaitys kodą.";
$MESS["SEC_OTP_CONNECT_MOBILE_MANUAL_INPUT"] = "Norėdami įvesti duomenis rankiniu būdu, nurodykite svetainės adresą, savo el.paštą arba naudotojo vardą, slaptą kodą paveikslėlyje ir pasirinkite pagrindinį tipą.";
$MESS["SEC_OTP_CONNECT_MOBILE_MANUAL_INPUT_HOTP"] = " ";
$MESS["SEC_OTP_CONNECT_MOBILE_MANUAL_INPUT_TOTP"] = "pagal laiką";
$MESS["SEC_OTP_CONNECT_MOBILE_INPUT_DESCRIPTION"] = "Kai kodas bus sėkmingai nuskaitytas ar įrašytas rankiniu būdu, jūsų mobilusis telefonas parodys kodą, kurį turėsite įvesti žemiau.";
$MESS["SEC_OTP_CONNECT_MOBILE_ENTER_CODE"] = "Įvesti kodą";
$MESS["SEC_OTP_CONNECT_MOBILE_INPUT_NEXT_DESCRIPTION"] = "OTP algoritmas reikalauja dviejų kodus autentifikavimui. Prašome generuoti kitą kodą ir įvesti jį žemiau.";
$MESS["SEC_OTP_CONNECT_MOBILE_ENTER_NEXT_CODE"] = "Įvesti kitą kodą";
$MESS["SEC_OTP_CONNECT_DONE"] = "Pasirengęs";
$MESS["SEC_OTP_CONNECT_DEVICE_TITLE"] = "Prijunkite raktą";
$MESS["SEC_OTP_CONNECTED"] = "Prisijungęs ";
$MESS["SEC_OTP_ENABLE"] = "Įjungti";
$MESS["SEC_OTP_DISABLE"] = "Išjungti ";
$MESS["SEC_OTP_SYNC_NOW"] = "Sinchronizuoti";
$MESS["SEC_OTP_MOBILE_INPUT_METHODS_SEPARATOR"] = "arba";
$MESS["SEC_OTP_MOBILE_SCAN_QR"] = "Skenuoti QR kodą";
$MESS["SEC_OTP_MOBILE_MANUAL_INPUT"] = "Įvesti kodą rankiniu būdu";
$MESS["SEC_OTP_CONNECT_DEVICE"] = "Prijunkite raktą";
$MESS["SEC_OTP_CONNECT_MOBILE"] = "Prijungti mobilų prietaisą";
$MESS["SEC_OTP_CONNECT_NEW_DEVICE"] = "Prijunkite naują raktą";
$MESS["SEC_OTP_CONNECT_NEW_MOBILE"] = "Prijungti naują mobilų prietaisą";
$MESS["SEC_OTP_ERROR_TITLE"] = "Nepavyko išsaugoti, nes įvyko klaida. ";
$MESS["SEC_OTP_UNKNOWN_ERROR"] = "Netikėta klaida. Prašome pabandyti vėliau.";
$MESS["SEC_OTP_RECOVERY_CODES_BUTTON"] = "Atstatymo kodai";
$MESS["SEC_OTP_RECOVERY_CODES_TITLE"] = "Atstatymo kodai";
$MESS["SEC_OTP_RECOVERY_CODES_DESCRIPTION"] = "Nukopijuokite atkūrimo kodus, kurių jums gali prireikti, jei jūs neteksite savo mobiliojo prietaiso ar negalėsite gauti kodą per aplikaciją dėl bet kurios kitos priežasties.";
$MESS["SEC_OTP_RECOVERY_CODES_WARNING"] = "Laikykite jas patogiai, tarkim, jūsų piniginėje ar rankinėje. Kiekvienas iš kodų gali būti naudojamas tik vieną kartą.";
$MESS["SEC_OTP_RECOVERY_CODES_PRINT"] = "Spausdinti";
$MESS["SEC_OTP_RECOVERY_CODES_SAVE_FILE"] = "Išsaugoti į tekstinį failą";
$MESS["SEC_OTP_RECOVERY_CODES_REGENERATE_DESCRIPTION"] = "Sutrumpinti pagal atkūrimo kodus?<br/>
Kurti naujus.  <br/><br/>
Naujų atkūrimo kodų kūrimas paneigia <br/> anksčiau gautus kodus.";
$MESS["SEC_OTP_RECOVERY_CODES_REGENERATE"] = "Generuoti naują kodą";
$MESS["SEC_OTP_RECOVERY_CODES_NOTE"] = "Kodas gali būti naudojamas tik vieną kartą. Patarimas: pašalinti panaudotus kodus iš sąrašo.";
$MESS["SEC_OTP_WARNING_RECOVERY_CODES"] = "Dviejų etapų autentifikavimas yra įjungtas, tačiau jūs negalite sukurti atkūrimo kodų. Jums gali juos prireikti, jei jūs netekote savo mobiliojo prietaiso ar negalite gauti kodo per aplikaciją dėl bet kurios kitos priežasties.";
$MESS["SEC_OTP_NO_DAYS"] = "visada";
$MESS["SEC_OTP_DEACTIVATE_UNTIL"] = "Išjungta iki #DATE#";
$MESS["SEC_OTP_MANDATORY_EXPIRED"] = "Laikas, per kurį naudotojas turi nustatyti dviejų etapų autentifikavimą, jau pasibaigęs.";
$MESS["SEC_OTP_MANDATORY_ALMOST_EXPIRED"] = "Laikas, per kurį naudotojas turi nustatyti dviejų etapų autentifikavimą, pasibaigs #DATE#.";
$MESS["SEC_OTP_MANDATORY_DISABLED"] = "Privalomas dviejų etapų autentifikavimas išjungtas.";
$MESS["SEC_OTP_MANDATORY_ENABLE_DEFAULT"] = "Reikalauja dviejų etapų autentifikavimo aktyvavimo";
$MESS["SEC_OTP_MANDATORY_ENABLE"] = "Reikalauja dviejų etapų autentifikavimo aktyvavimo per";
$MESS["SEC_OTP_MANDATORY_DEFFER"] = "Išplėtimas";
?>