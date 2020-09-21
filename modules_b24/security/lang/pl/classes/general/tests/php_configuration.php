<?
$MESS["SECURITY_SITE_CHECKER_DISPLAY_ERRORS_RECOMMENDATION"] = "Dodaj lub zmień następujące linie w ustawieniach PHP:<br>display_errors = Off";
$MESS["SECURITY_SITE_CHECKER_LOW_PHP_VERSION_ENTROPY"] = "Wersja php jest nieaktualna";
$MESS["SECURITY_SITE_CHECKER_LOW_PHP_VERSION_ENTROPY_DETAIL"] = "Aktualna wersja PHP nie obsługuje instalacji dodatkowego źródła entropii podczas tworzenia identyfikatora sesji";
$MESS["SECURITY_SITE_CHECKER_LOW_PHP_VERSION_ENTROPY_RECOMMENDATION"] = "Zaktualizuj PHP do wersji 5.3.3 lub wyższej, najlepiej do najnowszej stabilnej wersji";
$MESS["SECURITY_SITE_CHECKER_PHP_ASP"] = "Znaczniki w stylu ASP są włączony";
$MESS["SECURITY_SITE_CHECKER_PHP_ASP_DETAIL"] = "Tylko kilku programistów wie, że ta opcja istnieje. Opcja ta jest zbędna.";
$MESS["SECURITY_SITE_CHECKER_PHP_ASP_RECOMMENDATION"] = "Dodaj lub zmień następujące linie w ustawieniach PHP:<br>asp_tags = Off";
$MESS["SECURITY_SITE_CHECKER_PHP_COOKIEONLY"] = "ID sesji są zapisywane w innych magazynach poza plikami cookies";
$MESS["SECURITY_SITE_CHECKER_PHP_COOKIEONLY_DETAIL"] = "Zapisanie ID sesji w miejscach innych niż pliki cookies może doprowadzić do przejęcia sesji.";
$MESS["SECURITY_SITE_CHECKER_PHP_COOKIEONLY_RECOMMENDATION"] = "Dodaj lub zmień następujące linie w ustawieniach PHP:<br>session.use_only_cookies = On";
$MESS["SECURITY_SITE_CHECKER_PHP_ENTROPY"] = "brak dodatkowych źródeł entropii dla ID sesji jest zdefiniowany";
$MESS["SECURITY_SITE_CHECKER_PHP_ENTROPY_DETAIL"] = "Brak dodatkowych entropii mogą być wykorzystywane do przewidywania liczb losowych.";
$MESS["SECURITY_SITE_CHECKER_PHP_ENTROPY_RECOMMENDATION"] = "Dodaj następującą linię do ustawień PHP:<br>session.entropy_file = /dev/urandom<br>session.entropy_length = 128";
$MESS["SECURITY_SITE_CHECKER_PHP_FOPEN"] = "odczyt dostępu w nakładkach URL jest dozwolony";
$MESS["SECURITY_SITE_CHECKER_PHP_FOPEN_DETAIL"] = "Ta opcja nie jest wymagana, ale może być  wykorzystana przez atakującego";
$MESS["SECURITY_SITE_CHECKER_PHP_FOPEN_RECOMMENDATION"] = "Dodaj lub zmień następujące linie w ustawieniach PHP:<br>allow_url_fopen = Off";
$MESS["SECURITY_SITE_CHECKER_PHP_HTTPONLY"] = "Pliki cookie są dostępne z JavaScript";
$MESS["SECURITY_SITE_CHECKER_PHP_HTTPONLY_DETAIL"] = "Tworzenie plików cookie dostępne z JavaScript zwiększy nasilenie udanych ataków XSS.";
$MESS["SECURITY_SITE_CHECKER_PHP_HTTPONLY_RECOMMENDATION"] = "Dodaj lub zmień następujące linie w ustawieniach PHP:<br>session.cookie_httponly = On";
$MESS["SECURITY_SITE_CHECKER_PHP_INCLUDE"] = "nakładki URL są włączone";
$MESS["SECURITY_SITE_CHECKER_PHP_INCLUDE_DETAIL"] = "absolutnie nie polecam tej opcji.";
$MESS["SECURITY_SITE_CHECKER_PHP_INCLUDE_RECOMMENDATION"] = "Dodaj lub zmień następujące linie w ustawieniach PHP:<br>allow_url_include = Off";
$MESS["SECURITY_SITE_CHECKER_PHP_MBSTRING_SUBSTITUTE"] = "Mbstring usówa błędne znaki";
$MESS["SECURITY_SITE_CHECKER_PHP_MBSTRING_SUBSTITUTE_DETAIL"] = "Umiejętność usówania błędnych znaków może być wykorzytywana do tzw. błędnych ataków sekwencją bajtów.";
$MESS["SECURITY_SITE_CHECKER_PhpConfigurationTest_NAME"] = "Sprawdź ustawienia PHP";
?>