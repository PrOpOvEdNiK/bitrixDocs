<?
$MESS["BP_DBLA_TASK"] = "Patvirtinti dokumentą: \"{=Document:NAME}\"";
$MESS["BP_DBLA_APP"] = "Patvirtintas";
$MESS["BP_DBLA_APPROVE_TITLR"] = "Dokumento patvirtinimas: Etapas 1";
$MESS["BP_DBLA_APPROVE2_TITLE"] = "Dokumento patvirtinimas: Etapas 2";
$MESS["BP_DBLA_M"] = "Siųsti el. pranešimą";
$MESS["BP_DBLA_APPROVE"] = "Prašome patvirtnti arba atmesti dokumentą. ";
$MESS["BP_DBLA_APPROVE2"] = "Prašome patvirtnti arba atmesti dokumentą. ";
$MESS["BP_DBLA_MAIL2_SUBJ"] = "Prašome atsakyti dėl \"{=Document:NAME}\"";
$MESS["BP_DBLA_PUB_TITLE"] = "Paskelbti dokumentą";
$MESS["BP_DBLA_DESC"] = "Rekomenduojama, kai dokumentui reikalinga preliminari ekspertizė prieš jį patvirtinant. Pirmame proceso etape dokumentas yra patvirtintas eksperto. Jei ekspertas atmetė dokumentą, pastarasis grąžinamas peržiūrėti autoriui. Jei dokumentas yra patvirtintas, jis perduodamas galutinai patvirtinti pasirinktai darbuotojų grupei  paprastos balsų daugumos pagrindu. Jei galutinis balsavimas nesėkmingas, dokumentas grąžinamas, ir peržiūros ir patvirtinimo procedūra prasideda iš naujo.";
$MESS["BP_DBLA_NAPP_DRAFT"] = "Išsiųsta peržiūrai";
$MESS["BP_DBLA_S"] = "Veiksmų seka";
$MESS["BP_DBLA_T"] = "Nuoseklus verslo procesas";
$MESS["BP_DBLA_PARAM1"] = "1 etapo balsuojantys asmenys";
$MESS["BP_DBLA_PARAM2"] = "2 etapo balsuojantys asmenys";
$MESS["BP_DBLA_APP_S"] = "Statusas: patvirtinta";
$MESS["BP_DBLA_NAPP_DRAFT_S"] = "Statusas: įšsiųsta peržiūrai";
$MESS["BP_DBLA_MAIL_TEXT"] = "Dokumentas \"{=Document:NAME}\" praėjo pirmąjį patvirtinimo etapą.

Dokumentas patvirtintas. 

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_MAIL_SUBJ"] = "Dokumentas praėjo 1 etapą";
$MESS["BP_DBLA_MAIL4_TEXT"] = "1 etapo patvirtinimas \"{=Document:NAME}\" atliktas. 

Dokumentas buvo atmestas. 

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_NAME"] = "Dviejų etapų patvirtinimas";
$MESS["BP_DBLA_MAIL3_TEXT"] = "Baisavimas dėl \"{=Document:NAME}\" atliktas.

Dokumentas buvo patvirtintas {=ApproveActivity2:ApprovedPercent}% balsų.

Patvirtinta: {=ApproveActivity2:ApprovedCount}																										
Atmesta: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_NAPP_TEXT"] = "Balsavimas dėl \"{=Document:NAME}\" atliktas.
						
Dokumentas buvo atmestas.

Patvirtinta: {=ApproveActivity2:ApprovedCount}																										
Atmesta: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_NAPP"] = "Balsavimas dėl \"{=Document:NAME}: dokumentas buvo atmestas.";
$MESS["BP_DBLA_MAIL3_SUBJ"] = "Balsavimas dėl \"{=Document:NAME}: dokumentas buvo patvirtintas.";
$MESS["BP_DBLA_MAIL4_SUBJ"] = "Balsavimas dėl \"{=Document:NAME}: dokumentas buvo atmestas.";
$MESS["BP_DBLA_APPROVE_TEXT"] = "Jūs turite patvirtinti arba atmesti dokumentą \"{=Document:NAME}\".
		
Autorius: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_TASK_DESC"] = "Jūs turite patvirtinti arba atmesti dokumentą \"{=Document:NAME}\".

Tęskite atidarant nuorodą: http://#HTTP_HOST##TASK_URL#";
$MESS["BP_DBLA_APPROVE2_TEXT"] = "Jūs turite patvirtinti arba atmesti dokumentą \"{=Document:NAME}\".

Autorius:  {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_MAIL2_TEXT"] = "Jūs turite patvirtinti arba atmesti dokumentą \"{=Document:NAME}\".

Tęskite atidarant nuorodą: http://#HTTP_HOST##TASK_URL#";
?>