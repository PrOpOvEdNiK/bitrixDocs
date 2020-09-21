<?
$MESS["CONTENT"] = "<div>Zawartość:
  <ul>
    <li><a href=\"#bizproc\" title=\"Jaki proces biznesowy?\">Procesy Biznesowe</a></li>

    <li><a href=\"#tipical\" title=\"Jakie są typowe procesy biznesowe?\">Typowe Procesy Biznesowe</a></li>

    <li><a href=\"#work\" title=\"Jak stworzyć proces biznesowy\">Tworzenie Procesu Biznesowego</a></li>

    <li><a href=\"#perfomance\" title=\"Jak uruchomić proces biznesowy?\">Uruchamianie Procesu Biznesowego</a></li>
   </ul>
  <h1><a name=\"bizproc\"></a>Proces Biznesowy</h1>

  <p>Określenie <b>procesy biznesowe</b> odnosi się do narzędzia do tworzenia, utrzymania, zarządzania przepływem informacji.</p>

  <p><i><b>Proces Biznesowy</b> jest przepływem informacji (lub dokumentów) przez zdefiniowany schemat. Schemat procesu biznesowego może określać:</i></p>
  <ul>
    <li>jeden, bądź więcej <i>punktów wejścia i wyjścia</i> (start i koniec procesu); </li>
    <li><i>sekwencję akcji (kroki, etapy, funkcje)</i> wykonywane przez algorytm procesu biznesowego. </li>
   </ul>
  <p>W praktyce spotkać można wiele procesów biznesowych od prostych po bardzo skomplikowane. Zwykły proces publikowania dokumentu może zawierać wiele możliwych akcji i zależności i podania różnych danych wejściowych, a także informowania użytkowników na różne sposoby.</p>

  <p><b>Procesy biznesowe</b> umożliwiają każdemu użytkownikowi kreowanie różnych wariacji dla automatyzacji przepływu pracy i informacji.  Edytor procesów biznesowych został zaprojektowany tak, aby był możliwie najprostszy w obsłudze, nawet dla osób bez wiedzy o programowaniu, czy też informatyce. Jednakże notacja procesu biznesowego wymaga, aby osoba projektująca proces miała ponadprzeciętne umiejętności w dziedzinie analizy oraz dogłębną wiedzę na temat tego, jak realizowane są zadania i czynności w firmie, której procesy będzie opisywała.</p>
<p>Edytor procesów biznesowych jest w zasadzie prostym, graficznym interfejsem, wykorzystującym technologię <b>chwyć-i-upuść</b>  do umieszczania bloków funkcyjnych na schemacie. Autor procesu może wyspecyfikować kroki tego procesu i ich sekwencję; wyróżnić specificzne detale odbywające się na jego przebiegu korzystając z wizualnego szablonu.</p>
<p>Specyficzny przebieg informacji jest zdefiniowany szablonem procesu biznesowego, który składa się z wielu akcji. Akcją może być każde zdarzenie wedle Twojego wyboru: stworzenie dokumentu, wysłanie e-maila, dodanie wpisu do bazy danych, założenie zadania, dodanie wydarzenia w kalendarzu, itp.</p>
<p>System zawiera dziesiątki wbudowanych typów akcji i kilka typowych schematów procesów, które mogą być użyte do zamodelowania najczęściej wykorzystywanych procesów biznesowych w organizacji.</p>
<p>Istnieją dwa najpowszechniej stosowane typy procesów biznesowych:</p>
 <ul>
    <li>a <b>sekwencyjny proces biznesowy</b> służy do przeprowadzenia serii kolejno następujących po sobie akcji, dotyczących procesowania dokumentu, bądź sprawy od zdefiniowanego punktu startowego, aż po określony punkt końcowcy; </li>
    <li>a <b>proces biznesowy sterowany statusami</b>, który nie posiada ani punktu startu, ani punktu końcowego; status procesu jest zmieniany podczas jego przebiegu. Taki proces może zostać zakończony na każdym jesgo etapie.</li>
   </ul>

  <h2>Sekwencyjny Proces Biznesowy</h2>

  <p>Ten typ procesu używany jest, gdy zdefiniować można czas i cykl procedury. Typowym przykładem jest stworzenie i zaakceptowanie dokumentu. Każdy proces sekwencyjny zazwyczaj zawiera szereg akcji pomiędzy punktem startowym i końcowym.</p>
  <p><img border=\"1\" alt=\"Przykład: prosty proces liniowy\" title=\"Przykład: prosty proces liniowy\" src=\"/images/bp/en/2.png\" /></p>

  <h2>Proces Biznesowy Sterowany Statusami</h2>

  <p>Przy tym podejściu kreowany jest proces nieposiadający punktu startowego, ani końcowego, ani też zdefiniowanego czasu trwania. Jego przejście może być powtarzane, a także przechodzić między różnymi statusami przez nieograniczony czas, z uwagi na naturę opisanego procesu (np. ciągła aktualizacja dokumentacji).</p>
  <p>Stworzenie procesu biznesowego tego rodzaju jest bardziej skomplikowane niż procesu sekwencyjnego. Natomiast otwiera szerokie możliwości automatyzacji procedur i procesowania informacji. Typowy schemat składa się z kilku statusów, które zawierają akcje i warunki dla zmian statusu.</p>
 <img border=\"1\" alt=\"Przykład: proces ze statusami\" title=\"Przykład: proces ze statusami\" src=\"/images/bp/en/3.png\" />
  <p>Akcja w ramach procesu ze statusami jest zazwyczaj wyrażona procesem sekwencyjnym.</p>

  <h1><a name=\"typowy\"></a>Typowy Proces Biznesowy</h1>

<p>System dostarcza kilka gotowych do użycia szablonów procesów biznesowych. Możesz je dopasowywać do swoich potrzeb i zasad przepływu informacji w Twojej organizacji.</p>
  <h2>\"Prosta akcetacja/głosowanie\" Proces Sekwencyjny</h2>

  <p>Rekomendowany, gdy decyzja może być podjęta zwykłą większością głosów.</p>

  <h2>\"Pierwsze zatwierdzenie\" Proces Sekwencyjny</h2>

  <p>Rekomendowany, gdy wystarczające jest proste zatwierdzenie jednej osoby.</p>

  <h2>&quot;Zatwierdzenie Dokumentu ze Statusami&quot; Proces Sterowany Statusami</h2>

  <p>Rekomendowany, gdy wspólna zgoda jest wymagana, aby zatwierdzić dokument.</p>

  <h2>&quot;Dwupoziomowe Zatwierdzenie&quot; Proces Sekwencyjny</h2>

<p>Rekomendowany, gdy dokument wymaga wcześniejszej ekspertyzy przed przekazaniem do akceptacji.</p>

  <h2>&quot;Opinia Eksperta&quot; Proces Sekwencyjny</h2>

  <p>Rekomendowany w sytuacji, gdy osoba dokonująca akceptacji potrzebuje opinii eksperta.</p>

  <h2>&quot;Odczyt Dokumentu&quot; Proces Sekwencyjny</h2>

  <p>Rekomendowany, gdy pracownicy mają obowiązek zapoznania się z dokuemntem.</p>
  <p>Możesz wyświetlić proces biznesowy odnoszący się do konkretnego dokumentu poprzez wciśnięcie przycisku <b>Więcej</b> i wybranie <b>Procesy biznesowe</b> w menu:</p>
  <p><img border=\"1\" src=\"/images/bp/en/4.png\" alt=\"Wyświetl procesy biznesowe\" title=\"Wyświetl procesy biznesowe\" /></p>
<p>To otworzy <b>Szablon Procesu Biznesowego</b>, stronę na której możesz edytować istniejące i tworzyć nowy proces.</p>
  <p><img border=\"1\" src=\"/images/bp/en/11.png\" alt=\"Strona procesu biznesowego\" title=\"Strona procesu biznesowego\" /></p>
  <h1><a name=\"praca\"></a>Tworzenie Procesu Biznesowego</h1>

  <p>Do utworzenia i edycji procesu biznesowego użyj edytora procesów.</p>

  <p>Zanim zaczniesz budować swój proces biznesowy, musisz zdecydować się na odpowiedni typ procesu: sekwencyjny lub ze statusami. Typ procesu może zostać wybrany, korzystając konteksotowe menu z belki  <b>Szablony Procesu Biznesowego</b> formularz.</p>

  <p>W pierwszym kroku tworzenia procesu biznesowego należy zdefiniować parametry. Paramtery procesu można wykorzystać z poziomu każdego pola komend, akcji, warunku. Po zdefiniowaniu paramterów możesz przejść do tworzenia szablonu.</p>
 <img border=\"1\" title=\"Ustanowienie parametrów procesu\" alt=\"Ustanowienie parametrów procesu\" src=\"/images/bp/en/6.png\" />

  <h2>Tworzenie Procesu Sterowanego Statusami</h2>

  <p>Przede wszystkim utwórz i skonfiguruj wymagane statusy, korzystając z przycisku Dodaj Status. Następnie utwórz komendy dla każdego statusu. Każda komenda stanowi odrębny proces sekwencyjny.</p>
   <img border=\"1\" src=\"/images/bp/en/7.png\" alt=\"Przypisywanie akcji do statusów\" title=\"Przypisywanie akcji do statusów\" />

  <h2>Tworzenie Procesu Sekwencyjnego</h2>

  <p>Podczas tworzenia procesu sekwencyjnego edytor wizualny pokazuje zestaw edytowalnych akcji.</p>

  <p>Edytor wykorzystuje technikę chwyć-i-upuść do dodawnia bloków akcji na schemat. Po dodaniu bloku, konfiguruje się jego parametry. Każdy typ bloku ma swój zestaw parametrów.</p>
 <img border=\"1\" title=\"Dodawanie bloków w edytorze\" alt=\"Dodawanie bloków w edytorze\" src=\"/images/bp/en/8.png\" /><br /><br />
  <h1><a name=\"efektywność\"></a>Uruchamianie Procesu Biznesowego</h1>
<p>Proces biznesowy może być uruchamiany automatycznie lub manualnie, w zależności od jego parametrów. Sposób uruchomienia nie wpływa na sposób wykonywania procedury. Proces może mieć wiele instancji uruchomionych jednocześnie, przebiegających niezależnie od siebie.</p>
  <p>Aby uruchomić proces na określonym dokumencie, kliknij <b>Nowy Proces Biznesowy</b>, komenda dostępna w menu akcji, i wybierz proces z listy.</p>
 <img border=\"1\" src=\"/images/bp/en/5.png\" alt=\"Uruchomienie procesu dla dokumentu\" title=\"Uruchomienie procesu dla dokumentu\" />
<p>Po otwarciu okna parametrów procesu określ parametry i kliknij <b>Start</b>.</p>
 <img border=\"1\" title=\"Ustawienia procesu biznesowego\" alt=\"Ustawienia procesu biznesowego\" src=\"/images/bp/en/9.png\" />
  <p>Jeżeli proces zakłada powiadomienia, zostanie ono wysłane do określonych pracowników w chwili, gdy proces osiągnie określony status i pracownik ma do wykonania jakąś akcję. Aby przeglądać i wykonywać zadania przypisane w procesie, użytkownik powinien kliknąć link <b>Proces Biznesowy</b> w lewym menu w <b>Moja Praca</b> grupie.</p>
</div>";
$MESS["TITLE"] = "Procesy Biznesowe";
?>