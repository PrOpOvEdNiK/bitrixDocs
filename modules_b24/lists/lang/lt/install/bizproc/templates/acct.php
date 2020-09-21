<?
$MESS["LIBTA_NAME"] = "Pavadinimas";
$MESS["LIBTA_TYPE"] = "Tipas";
$MESS["LIBTA_TYPE_ADV"] = "Reklama";
$MESS["LIBTA_TYPE_EX"] = "Reprezentacinės išmokos";
$MESS["LIBTA_TYPE_C"] = "Atlygintinės išlaidos";
$MESS["LIBTA_TYPE_D"] = "Kita";
$MESS["LIBTA_CREATED_BY"] = "Sukūrė";
$MESS["LIBTA_DATE_CREATE"] = "Sukurta";
$MESS["LIBTA_FILE"] = "Failas (sąskaitos faktūros kopija)";
$MESS["LIBTA_NUM_DATE"] = "Sąskaitos faktūros numeris ir data";
$MESS["LIBTA_SUM"] = "Suma";
$MESS["LIBTA_PAID"] = "Apmokėta";
$MESS["LIBTA_PAID_NO"] = "Ne";
$MESS["LIBTA_PAID_YES"] = "Taip";
$MESS["LIBTA_BDT"] = "Biudžeto punktas";
$MESS["LIBTA_DATE_PAY"] = "Mokėjimo data (pateikta buhalterio)";
$MESS["LIBTA_NUM_PP"] = "Mokėjimo užsakymo numeris (pateiktas buhalterio)";
$MESS["LIBTA_DOCS"] = "Dokumentų kopijos";
$MESS["LIBTA_DOCS_YES"] = "Taip";
$MESS["LIBTA_DOCS_NO"] = "Ne";
$MESS["LIBTA_APPROVED"] = "Patvirtinta";
$MESS["LIBTA_APPROVED_R"] = "Atmesta";
$MESS["LIBTA_APPROVED_N"] = "Nepatvirtinta";
$MESS["LIBTA_APPROVED_Y"] = "Patvirtinta";
$MESS["LIBTA_T_PBP"] = "Nuoseklus verslo procesas";
$MESS["LIBTA_T_SPA1"] = "Nustatyti leidymą: autorius";
$MESS["LIBTA_T_PDA1"] = "Skelbti dokumentą";
$MESS["LIBTA_STATE1"] = "Patvirtintas";
$MESS["LIBTA_T_SSTA1"] = "Sstatusas: patvirtintas";
$MESS["LIBTA_T_ASFA1"] = "Nustatyti dokumento lauką \"Patvirtintas\"";
$MESS["LIBTA_T_SVWA1"] = "Nustatyti prižiūrėtoją";
$MESS["LIBTA_T_WHILEA1"] = "Patvirtinimo ciklas";
$MESS["LIBTA_T_SA0"] = "Veiksmų seka";
$MESS["LIBTA_T_IFELSEA1"] = "Pasiekę prižiūrėtojai";
$MESS["LIBTA_T_IFELSEBA1"] = "Taip";
$MESS["LIBTA_T_ASFA2"] = "Nustatyti dokumento lauką \"Patvirtintas\"";
$MESS["LIBTA_T_IFELSEBA2"] = "Ne";
$MESS["LIBTA_T_GUAX1"] = "Pasirinkti prižiūrėtoją";
$MESS["LIBTA_T_SVWA2"] = "Nustatyti prižiūrėtoją";
$MESS["LIBTA_T_SPAX1"] = "Nustatyti leidimą: prižiūrėtojas";
$MESS["LIBTA_SMA_MESSAGE_1"] = "Prašome patvirtinti sąskaitą faktūrą
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Suma: {=Document:PROPERTY_SUM}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_SMA_MESSAGE_1"] = "Pranešimas: sąskaitos faktūros patvirtinimo prašymas";
$MESS["LIBTA_XMA_MESSAGES_1"] = "BIP: Sąskaitos faktūros patvirtinimas";
$MESS["LIBTA_XMA_MESSAGET_1"] = "Prašome patvirtinti sąskaitą faktūrą

Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/


Verslo proceso užduotys:
{=Variable:TasksLink}";
$MESS["LIBTA_T_XMA_MESSAGES_1"] = "Pranešimas: sąskaitos faktūros patvirtinimas";
$MESS["LIBTA_AAQN1"] = "Patvirtinti sąskaitą faktūrą";
$MESS["LIBTA_AAQD1"] = "Jums reikia patvirtinti arba atmesti sąskaitą faktūrą

Pavadinimas: {=Document:NAME}
Sukurta: {=Document:DATE_CREATE}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}
Failas: {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_AAQN1"] = "Patvirtinti sąskaitos faktūros apmokėjimą";
$MESS["LIBTA_STATE2"] = "Patvirtinta ({=Variable:Approver_printable})";
$MESS["LIBTA_T_SSTA2"] = "Statusas: patvirtinta";
$MESS["LIBTA_STATE3"] = "Nepatvirtnta ({=Variable:Approver_printable})";
$MESS["LIBTA_T_SSTA3"] = "Statusas: nepatvirtinta";
$MESS["LIBTA_T_ASFA3"] = "Nustatyti dokumento lauką \"Patvirtintas\"";
$MESS["LIBTA_T_IFELSEA2"] = "Sąskaita faktūra patvirtinta";
$MESS["LIBTA_T_IFELSEBA3"] = "Taip";
$MESS["LIBTA_SMA_MESSAGE_2"] = "Aš tvirtinu sąskaitą faktūrą

Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_SMA_MESSAGE_2"] = "Pranešimas: sąskaita faktūra patvirtinta";
$MESS["LIBTA_T_SPAX2"] = "Nuatatyti leidimus: patvirtinimo vadybininkui";
$MESS["LIBTA_SMA_MESSAGE_3"] = "Prašome patvirtinti sąskaitos faktūros apmokėjimą

Patvirtino: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}

{=Variable:Link}{=Document:ID}/

Užduotys:
{=Variable:TasksLink}";
$MESS["LIBTA_T_SMA_MESSAGE_3"] = "Pranešimas: mokėjimo patvirtinimas";
$MESS["LIBTA_XMA_MESSAGES_2"] = "BIP: mokėjimo patvirtinimas";
$MESS["LIBTA_XMA_MESSAGET_2"] = "Prašome patvirtinti sąskaitos faktūros apmokėjimą

Patvirtino: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/

Užduotys:
{=Variable:TasksLink}";
$MESS["LIBTA_T_XMA_MESSAGES_2"] = "Pranešimas: Mokėjimo patvirtinimas";
$MESS["LIBTA_STATE4"] = "Mokėjimas patvirtintas";
$MESS["LIBTA_T_SSTA4"] = "Statusas: mokėjimas patvirtintas";
$MESS["LIBTA_AAQN2"] = "Patvirtinti sąskaitos faktūros apmokėjimą \"{=Document:NAME}\"";
$MESS["LIBTA_AAQD2"] = "Jums reikia patvirtinti arba atmesti sąskaitos faktūros apmokėjimą

Patvirtino: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}
Failas: {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_AAQN2"] = "Sąskaitos faktūros apmokėjimo patvirtinimas";
$MESS["LIBTA_T_SVWA3"] = "Nustatyti kintamąją";
$MESS["LIBTA_STATE5"] = "Apmokėjimas patvirtintas";
$MESS["LIBTA_T_SSTA5"] = "Statusas: apmokėjimas patvirtintas";
$MESS["LIBTA_SMA_MESSAGE_4"] = "Sąskaitos faktūros apmokėjimo patvirtinas

Sukurta: {=Document:DATE_CREATE}
Anraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_SMA_MESSAGE_4"] = "Pranešimas: mokėjimas patvirtintas";
$MESS["LIBTA_T_SPAX3"] = "Nustatyti leidimus: mokėtojui";
$MESS["LIBTA_SMA_MESSAGE_5"] = "Prašome apmokėti sąskaitą faktūrą

Apmokėjimas patvirtintas: {=Variable:PaymentApprover_printable}
Sąskaita faktūra patvirtinta: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūroos numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/

Užduotys:
{=Variable:TasksLink}";
$MESS["LIBTA_T_SMA_MESSAGE_5"] = "Pranešimas: sąskaita faktūra";
$MESS["LIBTA_XMA_MESSAGES_3"] = "BIP: sąskaita faktūra";
$MESS["LIBTA_XMA_MESSAGET_3"] = "Prašome apmokėti sąskaitą faktūrą

Apmokėjimas patvirtintas : {=Variable:PaymentApprover_printable}
Sąskaita faktūra patvirtinta: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}

{=Variable:Link}{=Document:ID}/

Užduotys:
{=Variable:TasksLink}";
$MESS["LIBTA_T_XMA_MESSAGES_3"] = "Pranešimas: sąskaita faktūra";
$MESS["LIBTA_STATE6"] = "Laukiama apmokėjimo";
$MESS["LIBTA_T_SSTA6"] = "Statusas: laukiama apmokėjimo";
$MESS["LIBTA_T_ASFA4"] = "Redaguoti dokumentą";
$MESS["LIBTA_STATE7"] = "Apmokėta";
$MESS["LIBTA_T_SSTA7"] = "Statusas: sąskaita faktūra apmokėta";
$MESS["LIBTA_SMA_MESSAGE_6"] = "Sąskaita faktūra apmokėta; reikalinga dokumentacija.


Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
";
$MESS["LIBTA_T_SMA_MESSAGE_6"] = "Pranešimas: sąskaita faktūra apmokėta";
$MESS["LIBTA_T_SPAX4"] = "Nustatyti leidimus: buhalteriui";
$MESS["LIBTA_SMA_MESSAGE_7"] = "Surinkta visa faktūrų dokumentacija

Mokėjimo data: {=Document:PROPERTY_DATE_PAY}
Mokėjimo užsakymo numeris: {=Document:PROPERTY_NUM_PAY}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}

{=Variable:Link}{=Document:ID}/

Užduotys:
{=Variable:TasksLink}";
$MESS["LIBTA_T_SMA_MESSAGE_7"] = "Pranešimas: surinkta faktūrų dokumentacija";
$MESS["LIBTA_T_ASFA5"] = "Redaguoti dokumentą";
$MESS["LIBTA_STATE8"] = "Uždaryta";
$MESS["LIBTA_T_SSTA8"] = "Statusas: sąskaita faktūra uždaryta";
$MESS["LIBTA_SMA_MESSAGE_8"] = "Dokumentacija gauta.

Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_SMA_MESSAGE_8"] = "Pranešimas: dokumentacija gauta.";
$MESS["LIBTA_STATE9"] = "Apmokėjimas atmestas";
$MESS["LIBTA_T_SSTA9"] = "Statusas: apmokėjimas atmestas";
$MESS["LIBTA_SMA_MESSAGE_9"] = "Apmokėjimas nepatvirtintas

Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/
";
$MESS["LIBTA_T_SMA_MESSAGE_9"] = "Pranešimas: apmokėjimas nepatvirtintas";
$MESS["LIBTA_T_IFELSEBA4"] = "Ne";
$MESS["LIBTA_SMA_MESSAGE_10"] = "Sąskaita faktūra nepatvirtinta

Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_T_SMA_MESSAGE_10"] = "Pranešimas: sąskaita faktūra nepatvirtinta";
$MESS["LIBTA_T_SPAX5"] = "Nustatyti leidimus: pabaigai";
$MESS["LIBTA_V_BK"] = "Buhalterija (patvirtinimas)";
$MESS["LIBTA_V_MNG"] = "Valdyba";
$MESS["LIBTA_V_APPRU"] = "Prižiūrėtojas";
$MESS["LIBTA_V_BKP"] = "Buhalterija (mokėjimas)";
$MESS["LIBTA_V_BKD"] = "Buhalterija (dokumentacija)";
$MESS["LIBTA_V_MAPPR"] = "Valdyba (patvirtinimas)";
$MESS["LIBTA_V_LINK"] = "Nuoroda";
$MESS["LIBTA_V_TLINK"] = "Nuoroda į užduotis";
$MESS["LIBTA_V_PDATE"] = "Mokėjimo data";
$MESS["LIBTA_V_PNUM"] = "Mokėjimo užsakymo numeris";
$MESS["LIBTA_V_APPR"] = "Apmokėjimą patvirtino";
$MESS["LIBTA_BP_TITLE"] = "Sąskaitos faktūros";
$MESS["LIBTA_RIA10_NAME"] = "Apmokėti sąskaitą \"{=Document:NAME}\"";
$MESS["LIBTA_RIA10_DESCR"] = "Apmokėti sąskaitą

Apmokėjimas patvirtintas: {=Variable:PaymentApprover_printable}
Sąskaita faktūra patvirtinta: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}
Failas: {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_RIA10_R1"] = "Apmokėjimo data";
$MESS["LIBTA_RIA10_R2"] = "Apmokėjimo užsakymo numeris";
$MESS["LIBTA_T_RIA10"] = "Apmokėti sąskaitą faktūrą";
$MESS["LIBTA_RRA15_NAME"] = "Surinkti dokumentaciją apie \"{=Document:NAME}\"";
$MESS["LIBTA_RRA15_DESCR"] = "Surinkti dokumentaciją apie

Apmokėjimas patvirtintas: {=Variable:PaymentApprover_printable}
Sąskaita faktūra patvisrinta: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}
Failas: {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_RRA15_SM"] = "Surinkti dokumentus";
$MESS["LIBTA_RRA15_TASKBUTTON"] = "Dokumentacija surinkta";
$MESS["LIBTA_T_RRA15"] = "Dokumentacija apie";
$MESS["LIBTA_RRA17_NAME"] = "Patvirtinti dokumentų gavimą \"{=Document:NAME}\"";
$MESS["LIBTA_RRA17_DESCR"] = "Patvirtinu, kad gavau sąskaitos faktūros dokumentaciją.

Apmokėjimo data: {=Document:PROPERTY_DATE_PAY}
Apmokėjimo užsakymo numeris: {=Document:PROPERTY_NUM_PAY}
Apmokėjimas patvirtintas: {=Variable:PaymentApprover_printable}
Sąskaita faktūra patvirtinta: {=Variable:Approver_printable}
Sukūrė: {=Document:CREATED_BY_PRINTABLE}
Sukurta: {=Document:DATE_CREATE}
Antraštė: {=Document:NAME}
Tipas: {=Document:PROPERTY_TYPE}
Sąskaitos faktūros numeris ir data: {=Document:PROPERTY_NUM_DATE}
Suma: {=Document:PROPERTY_SUM}
Biudžeto punktas: {=Document:PROPERTY_BDT}
Failas: {=Variable:Domain}{=Document:PROPERTY_FILE}

{=Variable:Link}{=Document:ID}/";
$MESS["LIBTA_RRA17_BUTTON"] = "Dokumentacija gauta";
$MESS["LIBTA_T_RRA17_NAME"] = "Dokumentacija gauta";
$MESS["LIBTA_V_DOMAIN"] = "Domenas";
?>