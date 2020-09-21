<?
$MESS["INTR_MAIL_AJAX_ERROR"] = "Błąd wykonania zapytrania";
$MESS["INTR_MAIL_CHECK_JUST_NOW"] = "sekund temu";
$MESS["INTR_MAIL_CHECK_TEXT"] = "Ostatnio sprawdzane: #DATE#";
$MESS["INTR_MAIL_CHECK_TEXT_NA"] = "Brak danych dla statusu domeny";
$MESS["INTR_MAIL_CHECK_TEXT_NEXT"] = "Następne sprawdzanie maila #DATE#";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM"] = "Czy chcesz odłączyć domenę?";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM_TEXT"] = "Chcesz odłączyć domenę?<br>Wszystkie skrzynki pocztowe powiązane z portalem również zostaną odłączone!";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME"] = "błędna nazwa";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME_HINT"] = "Nazwa domeny może zawierać łacińskie znaki, cyfry i myślniki; nie może zaczynać się lub kończyć myślnikiem lub powtarzać myślnik na pozycji 3 i 4. Zakończ nazwę <b>.ru</b>.";
$MESS["INTR_MAIL_DOMAIN_CHECK"] = "Zweryfikuj";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_HINT"] = "Wybierz nazwę na domenie .ru";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_TITLE"] = "Wybierz domenę";
$MESS["INTR_MAIL_DOMAIN_EMPTY_NAME"] = "wprowadź nazwę";
$MESS["INTR_MAIL_DOMAIN_EULA_CONFIRM"] = "Akceptuję warunki <a href=\"http://www.bitrix24.ru/about/domain.php\" target=\"_blank\">Umowy licencyjnej</a>";
$MESS["INTR_MAIL_DOMAIN_HELP"] = "Jeżeli nie masz skonfigurowanej swojej domeny do używania z E-mailami Yandex, zrób to teraz.
<br/><br/>
- <a href=\"https://passport.yandex.com/registration/\" target=\"_blank\">Utwórz konto e-mail Yandex</a> lub wykorzystaj istniejącą skrzynkę, jeżeli takową posiadasz.
- <a href=\"https://pdd.yandex.ru/domains_add/\" target=\"_blank\">Dołącz swoją domenę</a> do e-maila Yandex<sup> (<a href=\"http://help.yandex.ru/pdd/add-domain/add-exist.xml\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup><br/>
- Potwierdź, że jesteś właścicielem domeny <sup>(<a href=\"http://help.yandex.ru/pdd/confirm-domain.xml\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup><br/>
- Skonfiguruj rekordy MX <sup>(<a href=\"http://help.yandex.ru/pdd/records.xml#mx\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup> lub oddeleguj swoją domenę do Yandex <sup>(<a href=\"http://help.yandex.ru/pdd/hosting.xml#delegate\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup>
<br/><br/>
Gdy towje konto e-mail Yandex zostanie skonfigurowane dołącz domenę do swojego Bitrix24:
<br/><br/>
- <a href=\"https://pddimp.yandex.ru/api2/admin/get_token\" target=\"_blank\" onclick=\"window.open(this.href, '_blank', 'height=480,width=720,top='+parseInt(screen.height/2-240)+',left='+parseInt(screen.width/2-360)); return false; \">Uzyskaj token</a> (wypełnij pola formularza i kliknij \"Uzyskaj token&quot;. Gdy tylko token się pojawi, skopiuj go do Schowska)<br/>
- Dodaj domenę i token do parametrów.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1"] = "Krok&nbsp;1.&nbsp;&nbsp;Potwierdź, że jesteś właścicielem domeny";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_A"] = "Załaduj plik o nazwie <b>#SECRET_N#.html</b> do swojego katalogu głównego. Plik musi zawierać tekst: <b>#SECRET_C#</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B"] = "Aby skonfigurować rekord CNAME, musisz posiadać dostęp do zapisu w rekordach DNS swojej domeny w rejestrze lub u dostarczyciela sieci, u którego masz zarejestrowaną domenę. Znajdziesz te ustawienia na swoim koncie lub w panelu kontrolnym.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAME"] = "Nazwa rekordu: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAMEV"] = "<b>yamail-#SECRET_N#</b> (or <b>yamail-#SECRET_N#.#DOMAIN#.</b> która zależy od interfejsu. Zwróć uwagę na kropkę na końcu.)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_PROMPT"] = "Określ te wartości:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_TYPE"] = "Typ rekordu: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUE"] = "Wartość: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUEV"] = "<b>mail.yandex.ru.</b> (ponownie, zwróć uwagę na kropkę na końcu)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C"] = "Ustaw kontaktowy adres e-mail w informacji do rejestracji na twoją domenę na <b>#SECRET_N#@yandex.ru</b>. Użyj panelu kontrolnego rejestracji swojej domeny, aby ustawić adres e-mail.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C_HINT"] = "Zmień ten adres na swój rzeczywisty e-mail, jak tylko domena zostanie potwierdzona.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_HINT"] = "W razie pytań związanych z potwierdzeniem prawa własności domeny, proszę skontaktowac się z pomocą na <a href=\"http://www.bitrixsoft.com/support/\" target=\"_blank\">www.bitrixsoft.com/support/</a>.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_OR"] = "lub";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_PROMPT"] = "Musisz potwierdzić, że posiadasz nazwę określonej domeny używając jednej z następujących metod:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2"] = "Krok&nbsp;2.&nbsp;&nbsp;Skonfiguruj rekordy MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_HINT"] = "Usuń wszystkie rekordy MX i TXT, które nie są powiązane z Yandex. Zmiany przeprowadzone na rekordach MX mogą zająć od kilku godzin do trzech dni, aby zostały zaktualizowane przez Internet.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_MXPROMPT"] = "Utwórz nowy rekord MX z następującymi parametrami:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAME"] = "Nazwa rekordu:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAMEV"] = "<b>@</b> (lub <b>#DOMAIN#.</b> - jeżeli wymagane. Zwróć uwagę na kropkę na końcu)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PRIORITY"] = "Priorytet: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PROMPT"] = "Gdy już potwierdzisz własność swojej domeny, musisz zmienić odpowiednie rekordy MX na swojej stronie internetowej.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TITLE"] = "Konfiguruj rekordy MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TYPE"] = "Typ rekordu:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUE"] = "Wartość:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUEV"] = "<b>mx.yandex.net.</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_TITLE"] = "Aby połączyć swoją domenę z Bitrix24, wystarczy tylko kilka kroków.";
$MESS["INTR_MAIL_DOMAIN_LONG_NAME"] = "maksymalnie 63 znaki przed .ru";
$MESS["INTR_MAIL_DOMAIN_NAME_FREE"] = "ta nazwa jest dostępna";
$MESS["INTR_MAIL_DOMAIN_NAME_OCCUPIED"] = "ta nazwa nie jest dostępna";
$MESS["INTR_MAIL_DOMAIN_NOCONFIRM"] = "Domena niepotwierdzona";
$MESS["INTR_MAIL_DOMAIN_NOMX"] = "Rekordy MX nieskonfigurowane";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TEXT"] = "Po połączeniu nie będziesz mógł zmienić nazwy domeny<br>lub uzyskać innej, pownieważ możesz zarejestrować<br>tylko jedną domenę dla swojego Bitrix24.<br><br>Jeżeli stwierdzisz, że nazwa <b>#DOMAIN#</b> jest poprawna, potwierdź swoją nową domenę.";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TITLE"] = "Proszę sprawdzić, czy nazwa domeny została poprawnie wprowadzona.";
$MESS["INTR_MAIL_DOMAIN_REMOVE"] = "Odłącz";
$MESS["INTR_MAIL_DOMAIN_SAVE"] = "Zapisz";
$MESS["INTR_MAIL_DOMAIN_SAVE2"] = "Dołącz";
$MESS["INTR_MAIL_DOMAIN_SETUP_HINT"] = "Potwierdzenie nazwy domeny może potrwać od 1 godziny do kilku dni.";
$MESS["INTR_MAIL_DOMAIN_SHORT_NAME"] = "co najmniej dwa znaki przed .ru";
$MESS["INTR_MAIL_DOMAIN_STATUS_CONFIRM"] = "Potwierdzona";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOCONFIRM"] = "Nie potwierdzona";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOMX"] = "Rekordy MX nieskonfigurowane";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE"] = "Status połączenia domeny";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE2"] = "Domena potwierdzona";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_MORE"] = "Pokaż inne opcje";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_TITLE"] = "Proszę wymyślić inną nazwę lub wybrać jedną";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_WAIT"] = "Szukaj dostępnych nazw...";
$MESS["INTR_MAIL_DOMAIN_TITLE"] = "Jeżeli Twoja domena jest skonfigurowana do pracy z Yandex.Mail dla domen, wystarczy, że wprowadzić nazwę domeny i token w formularzu poniżej";
$MESS["INTR_MAIL_DOMAIN_TITLE2"] = "Domena jest teraz połączona z twoim portalem";
$MESS["INTR_MAIL_DOMAIN_TITLE3"] = "Domena dla twojego e-maila";
$MESS["INTR_MAIL_DOMAIN_WAITCONFIRM"] = "Oczekiwanie na potwierdzenie";
$MESS["INTR_MAIL_DOMAIN_WAITMX"] = "Rekordy MX nieskonfigurowane";
$MESS["INTR_MAIL_DOMAIN_WHOIS"] = "Sprawdź";
$MESS["INTR_MAIL_GET_TOKEN"] = "uzyskaj";
$MESS["INTR_MAIL_INP_CANCEL"] = "Anuluj";
$MESS["INTR_MAIL_INP_DOMAIN"] = "Nazwa domeny";
$MESS["INTR_MAIL_INP_PUBLIC_DOMAIN"] = "Pracownicy mogą rejestrować skrzynki pocztowe na tej domenie";
$MESS["INTR_MAIL_INP_TOKEN"] = "Token";
$MESS["INTR_MAIL_MANAGE"] = "Skonfiguruj skrzynki pocztowe pracowników";
?>