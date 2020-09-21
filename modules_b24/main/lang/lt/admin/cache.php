<?
$MESS["MCACHE_TITLE"] = "Podėlio nustatymai";
$MESS["MAIN_TAB_3"] = "Pašalinti podėlio failus";
$MESS["MAIN_TAB_4"] = "Komponentų padėjimas";
$MESS["MAIN_OPTION_CLEAR_CACHE"] = "Pašalinti podėlio failus";
$MESS["MAIN_OPTION_PUBL"] = "Komponentų podėlio nustatymai";
$MESS["MAIN_OPTION_CLEAR_CACHE_OLD"] = "Tik pasenusius";
$MESS["MAIN_OPTION_CLEAR_CACHE_ALL"] = "Visus";
$MESS["MAIN_OPTION_CLEAR_CACHE_MENU"] = "Meniu";
$MESS["MAIN_OPTION_CLEAR_CACHE_MANAGED"] = "Visą valdomą podėlį";
$MESS["MAIN_OPTION_CLEAR_CACHE_STATIC"] = "Visus puslapius HTML podėlyje";
$MESS["MAIN_OPTION_CLEAR_CACHE_CLEAR"] = "Išvalyti";
$MESS["MAIN_OPTION_CACHE_ON"] = "Komponentų podėlis yra įjungtas pagal nutylėjimą";
$MESS["MAIN_OPTION_CACHE_OFF"] = "Komponentų podėlis yra išjungtas pagal numatymą";
$MESS["MAIN_OPTION_CACHE_BUTTON_OFF"] = "Išjungti padėjimą";
$MESS["MAIN_OPTION_CACHE_BUTTON_ON"] = "Įjungti padėjimą";
$MESS["cache_admin_note4"] = "<p>HTML podėliavimas rekomenduojamas svetainės skyriams, kurie yra keičiami retai ir dažniausiai lankomi anoniminių vartotojų. Kai HTML podėlis įjungta, vyksta šie procesai: </p>
<ul style=\"font-size:100%\">
<li>HTML talpyklos procesai tik išvardyti įtraukimo kaukės ir neišvardyti atskirties kaukės;</li>
<li>Dėl neautorizuotų lankytojų, sistemos patikrinimas dėl puslapio kopijos saugomas HTML podėlyje. Jei puslapis yra rastas podėlyje, jis rodomas be sisteminių modulių. Statistika nestebės lankytojų. Skelbimai, branduolis ir kiti moduliai taip pat nebus įtraukti;</li>
<li>Puslapiai bus siunčiami suspausti, jei Suspaudimo modulis įdiegtas į podėlį jo generavimo metu;</li>
<li>Jei puslapio podėlio nerasta, ji yra apdorojamas įprastu būdu. Baigus puslapio įkėlimą, puslapio kopija bus išsaugota HTML podėlyje;</li>
</ul>
<p>Podėlio valymas:</p>
<ul style=\"font-size:100%\">
<li>Jei duomenų įrašymo metu viršyjama disko kvota, podėlis visiškai iškraunamas;</li>
<li>Pilnas podėlio iškrovimas taip pat atliekamas, jei kokie nors duomenys pasikeitė per Valdymo skydelį;</li>
<li>Jei duomenys yra patalpinami iš viešųjų svetainės puslapių  (pvz. pridedant pastabas ar balsus), tada iškraaunamos tik dalys, susijusios su podėliu;</li>
</ul>
<p>Atkreipkite dėmesį, kad kai neautorizuoti naudotojai aplanko nepodėliuojamose svetainės puslapiuose, sesijos bus pradėta ir HTML-podėlis nebebus aktyvus.</p>
<p>Svarbios pastabos:</p>
<ul style=\"font-size:100%\">
<li>Statistika nėra stebima;</li>
<li>Skelbimų modulis veiks tik HTML podėlio sulurimo metu. Atkreipkite dėmesį, kad tai neturi įtakos išorinių modulių skelbimams (Google Ad Sense ir tt);</li>
<li>Lyginamų objektų rezultatai nebus išsaugoti neautorizuotiems naudotojams (sesija turėtų būti pradėta);</li>
<li>Disko kvota turi būti nustatyta siekiant išvengti DOS atakas į diską;</li>
<li>Visų svetainės skyrių funkcionalumas turi būti patikrintas, įjungus HTML podėlį (pvz. Blog'o Komentarai neveiks su senais blogų šablonais ir tt);</li>
</ul>";
$MESS["MAIN_OPTION_CACHE_OK"] = "Laikinosios atminties failai išvalyti";
$MESS["MAIN_OPTION_CACHE_SUCCESS"] = "Komponentų padėjimo tipas sėkmingai perjungtas";
$MESS["MAIN_OPTION_CACHE_ERROR"] = "Komponentų padėjimo tipas jau nustatytas pagal šią reikšmę";
$MESS["cache_admin_note1"] = "<p>Auto podėlio režimo naudojimas nuostabiai pagreitina jūsų svetainę!</p>
<p>Auto podėlio komponentų režimas atnaujina informaciją pagal tų komponentų parametrus.</p>
<p>Jei norite atnaujinti išsaugotus objektus puslapyje, jūs galite:</p>
<p>1. Atidarykite reikiamą puslapį ir atnaujinkite savo objektus, paspaudę specialų duomenų atnaujinimo mygtuką administracinioje  įrankių juostoje.</p>
<img src=\"/bitrix/images/main/page_cache_en.png\" vspace=\"5\" />
<p>2. Svetainės redagavimo režime  jūs galite spustelėti podėlio išvalymo mygtuką pasirinktas komponentui. </p>
<img src=\"/bitrix/images/main/comp_cache_en.png\" vspace=\"5\" />
<p>3. Eikite į komponento parametrus ir perjunkite reikalingus komponentus į neišsaugojimo podėlyje režimą.</p>
<img src=\"/bitrix/images/main/spisok_en.png\" vspace=\"5\" />
<p>Įjungus išsaugojimo podėlyje režimą (pagal nutylėjimą) visi komponentai su podėlio nustatymu <i>\"Auto\"</i> bus perjungti darbui su podėliu.</p>
<p>Komponentai su podėlio nustatymu <i>\"Podėlis\"</i> ir su nustatytu laiku didesniu nei 0 (nulis) visada veiks podėlio režime.</p>
<p>Komponentai su podėlio nustatymu <i>\"Nenaudoti podėlio\"</i> arba su podėlio laiku lygių 0 (nulis), visada veiks ne podėlio rėžimu.</p>";
$MESS["cache_admin_note2"] = "Pašalinus podėlio failus, visas rodomas turinys bus atnaujintas atsižvelgiant į naujus duomenis.
Nauji podėlio failai bus sukurti palaipsniui pagal užklausimus į tuos puslapius (su podėlio sritimis).";
$MESS["main_cache_managed_saved"] = "Valdomo podėlio parametrai buvo išsaugoti.";
$MESS["main_cache_managed"] = "Valdomas podėlis";
$MESS["main_cache_managed_sett"] = "Valdomo podėlio parametrai";
$MESS["main_cache_managed_on"] = "Valdomas podėlis yra įjungtas.";
$MESS["main_cache_managed_off"] = "Valdomas podėlis yra išjungtas (nerekomenduojama).";
$MESS["main_cache_managed_turn_off"] = "Įšjungti valdomą podėlį (nerekomenduojama).";
$MESS["main_cache_managed_const"] = "BX_COMP_MANAGED_CACHE konstanta nustatyta. Valdomas podėlis pastoviai įjungtas.";
$MESS["main_cache_managed_turn_on"] = "Įjungti valdomą podėlį";
$MESS["main_cache_managed_note"] = "Podėlio valdymo technologija <b>Cache Dependencies</b> atnaujina podėlį kas kartą kai vyksta duomenų pakeitimai. Jei ši funkcija įjungta, jums nereikės atnaujinti podėlio rankiniu būdu, atnaujinant naujienas ar produktus: svetainės lankytojai visada matys aktualią atnaujintą informaciją.

<br><br>Gaukite daugiau informacijos apie podėlio technologijas Bitrix svetainėje.
<br><br><span style=\"color:grey\">Pastaba: ne visi komponentai gali palaikyti šią funkciją.</span>";
$MESS["cache_admin_note5"] = "HTML podėlis visada įjungtas šioje laidoje.";
$MESS["main_cache_wrong_cache_type"] = "Neteisingas podėlio tipas.";
$MESS["main_cache_wrong_cache_path"] = "Neteisingas podėlio failo kelias.";
$MESS["main_cache_in_progress"] = "Šalinami podėlio failai.";
$MESS["main_cache_finished"] = "Podėlio failai yra pašalinti.";
$MESS["main_cache_files_scanned_count"] = "Apdorota:  #value#";
$MESS["main_cache_files_scanned_size"] = "Apdorotų failų dydis: #value#";
$MESS["main_cache_files_deleted_count"] = "Pašalinta:  #value#";
$MESS["main_cache_files_deleted_size"] = "Pašalintų failų dydis: #value#";
$MESS["main_cache_files_delete_errors"] = "Šalinimo klaidos: #value#";
$MESS["main_cache_files_last_path"] = "Dabartinis aplankas: #value#";
$MESS["main_cache_files_start"] = "Pradėti";
$MESS["main_cache_files_continue"] = "Tęsti";
$MESS["main_cache_files_stop"] = "Nutraukti";
?>