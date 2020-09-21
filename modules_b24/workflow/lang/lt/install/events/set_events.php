<?
$MESS["WF_STATUS_CHANGE_NAME"] = "Dokumento statusas buvo pakeistas";
$MESS["WF_STATUS_CHANGE_DESC"] = "#ID# - ID
#ADMIN_EMAIL# - Darbo eigos administratorių el.paštai
#BCC# - Naudotojų, kurie jau keitėdokumentą tam tikru metu arba gali jį keisti, el.paštai
#PREV_STATUS_ID# - ID of previous status of document
#PREV_STATUS_TITLE# - ankstesnio dokumento statuso pavadinimas
#STATUS_ID# - statuso ID
#STATUS_TITLE# - statuso pavadinimas
#DATE_ENTER# - dokumento kurimo data
#ENTERED_BY_ID# - naudotojo, kuris sukūrė dokumentą, ID
#ENTERED_BY_NAME# - naudotojo, kuris sukūrė dokumentą,vardas
#ENTERED_BY_EMAIL# - naudotojo, kuris sukūrė dokumentą, el.paštas
#DATE_MODIFY# - dokumento keitimo data
#MODIFIED_BY_ID# - naudotojo, kuris pakeitė dokumentą, ID
#MODIFIED_BY_NAME# - naudotojo, kuris pakeitė dokumentą, vardas
#FILENAME# - pilnas failo pavadinimas
#TITLE# - failo pavadinimas
#BODY_HTML# - dokumento turinys HTML formatu
#BODY_TEXT# - dokumento turinys TEXT formatu
#BODY# - dokumento turinys, išsaugotas duomenų bazėje
#BODY_TYPE# - dokumento turinio tipas
#COMMENTS# - komentarai
";
$MESS["WF_STATUS_CHANGE_SUBJECT"] = "#SITE_NAME#: Dokumento  # #ID# statusas buvo pakeistas";
$MESS["WF_STATUS_CHANGE_MESSAGE"] = "Dokumento statusas # #ID# buvo pakeistas #SITE_NAME#.
---------------------------------------------------------------------------

Dabar dokumento laukai turi šias reikšmes:

Failas          - #FILENAME#
Pavadinimas         - #TITLE#
Statusas        - [#STATUS_ID#] #STATUS_TITLE#; previous - [#PREV_STATUS_ID#] #PREV_STATUS_TITLE#
Sukurtas        - #DATE_ENTER#; [#ENTERED_BY_ID#] #ENTERED_BY_NAME#
Pakeistas       - #DATE_MODIFY#; [#MODIFIED_BY_ID#] #MODIFIED_BY_NAME#

Turinys (tipas - #BODY_TYPE#):
---------------------------------------------------------------------------
#BODY_TEXT#
---------------------------------------------------------------------------

Komentarai:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Norėdami peržiūrėti ir redaguoti dokumentą, spustelėkite nuorodą:
http://#SERVER_NAME#/bitrix/admin/workflow_edit.php?lang=en&ID=#ID#

Automatiškai sukurtas pranešimas.";
$MESS["WF_NEW_DOCUMENT_NAME"] = "Naujas dokumentas buvo sukurtas";
$MESS["WF_NEW_DOCUMENT_DESC"] = "#ID# - ID
#ADMIN_EMAIL# - Darbo eigos administratorių el.paštai
#BCC# - Naudotojų, kurie jau keitė dokumentą tam tikru metu arba gali jį keisti, el.paštai
#STATUS_ID# - statuso ID
#STATUS_TITLE# - statuso pavadinimas
#DATE_ENTER# - dokumento kurimo data
#ENTERED_BY_ID# - naudotojo, kuris sukūrė dokumentą, ID
#ENTERED_BY_NAME# - naudotojo, kuris sukūrė dokumentą, pavadinimas
#ENTERED_BY_EMAIL# - naudotojo, kuris sukūrė dokumentą, el.paštas
#FILENAME# - pilnas failo pavadinimas
#TITLE# - failo antraštė
#BODY_HTML# - dokumento turinys HTML formatu
#BODY_TEXT# - dokumento turinys TEXT format
#BODY# - dokumento turinys, išsaugotas duomenų bazėje
#BODY_TYPE# - dokumento turinio tipas
#COMMENTS# - komentarai";
$MESS["WF_NEW_DOCUMENT_SUBJECT"] = "#SITE_NAME#: Naujas dokumentas buvo sukurtas";
$MESS["WF_NEW_DOCUMENT_MESSAGE"] = "Naujas dokumentas buvo sukirtas #SITE_NAME#.
---------------------------------------------------------------------------

Dabar dokumento laukai turi šias reikšmes:

ID            - #ID#
Failas          - #FILENAME#
Pavadinimas     - #TITLE#
Statusas        - [#STATUS_ID#] #STATUS_TITLE#
Sukurtas        - #DATE_ENTER#; [#ENTERED_BY_ID#] #ENTERED_BY_NAME#

Turinys (tipas - #BODY_TYPE#):
---------------------------------------------------------------------------
#BODY_TEXT#
---------------------------------------------------------------------------

Komentarai:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Norėdami peržiūrėti ir redaguoti dokumentą, spustelėkite nuorodą:
http://#SERVER_NAME#/bitrix/admin/workflow_edit.php?lang=en&ID=#ID#

Automatiškai sukurtas pranešimas.";
$MESS["WF_IBLOCK_STATUS_CHANGE_NAME"] = "Infoblocko elemento statusas buvo pakeistas";
$MESS["WF_IBLOCK_STATUS_CHANGE_DESC"] = "#ID# - ID
#IBLOCK_ID# - informacijos bloko ID
#IBLOCK_TYPE# - informacijos bloko tipas
#SECTION_ID# - skyriaus ID
#ADMIN_EMAIL# - Darbo eigos administratorių el.paštai
#BCC# - Naudotojų, kurie jau keitė dokumentą tam tikru metu arba gali jį keisti, el.paštai
#PREV_STATUS_ID# - elemento ankstesnio statuso ID
#PREV_STATUS_TITLE# - elemento ankstesnio statuso pavadinimas
#STATUS_ID# - dabartinio statuso ID
#STATUS_TITLE# - dabartinio statuso pavadinimas
#DATE_CREATE# - elemento kurimo data
#CREATED_BY_ID# - naudotojo, kuris sukūrė elementą, ID
#CREATED_BY_NAME# - naudotojo, kuris sukūrė elementą, vardas
#CREATED_BY_EMAIL# - naudotojo, kuris sukūrė elementą, el.paštas
#DATE_MODIFY# - elemento keitimo data
#MODIFIED_BY_ID# - naudotojo, kuris pakeitė elementą, ID
#MODIFIED_BY_NAME# - naudotojo, kuris pakeitė elementą,vardas
#NAME# - elemento pavadinimas
#PREVIEW_HTML# - trumpas aprašymas HTML formatu
#PREVIEW_TEXT# - trumpas aprašymas TEXT formatu
#PREVIEW# - trumpas aprašymas, išsaugotas duomenų bazėje
#PREVIEW_TYPE# - trumpo aprašymo tipas (text | html)
#DETAIL_HTML# - pilnas aprašymas HTML formatu
#DETAIL_TEXT# - pilnas aprašymas TEXT formatu
#DETAIL# - pilnas aprašymas, išsaugotas duomenų bazėje
#DETAIL_TYPE# - pilno aprašymo tipas (text | html)
#COMMENTS# - komentarai
";
$MESS["WF_IBLOCK_STATUS_CHANGE_SUBJECT"] = "#SITE_NAME#: elemento # #ID# statusas buvo pakeistas (informacinis blokas # #IBLOCK_ID#; tipas - #IBLOCK_TYPE#)";
$MESS["WF_IBLOCK_STATUS_CHANGE_MESSAGE"] = "#SITE_NAME#: Elemento # #ID# statusas pasikeitė (informacinis blokas # #IBLOCK_ID#; tipas - #IBLOCK_TYPE#)
---------------------------------------------------------------------------

Dabar dokumento laukai turi šias reikšmes:

Pavadinimas         - #NAME#
Statusas       - [#STATUS_ID#] #STATUS_TITLE#; previous - [#PREV_STATUS_ID#] #PREV_STATUS_TITLE#
Sukurtas   - #DATE_CREATE#; [#CREATED_BY_ID#] #CREATED_BY_NAME#
Pakeistas   - #DATE_MODIFY#; [#MODIFIED_BY_ID#] #MODIFIED_BY_NAME#

Trumpas aprašymas (tipas - #PREVIEW_TYPE#):
---------------------------------------------------------------------------
#PREVIEW_TEXT#
---------------------------------------------------------------------------

Pilnas aprašymas (type - #DETAIL_TYPE#):
---------------------------------------------------------------------------
#DETAIL_TEXT#
---------------------------------------------------------------------------

Komentarai:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Norėdami peržiūrėti ir redaguoti dokumentą, spustelėkite nuorodą:
http://#SERVER_NAME#/bitrix/admin/iblock_element_edit.php?lang=en&WF=Y&PID=#ID#&type=#IBLOCK_TYPE#&IBLOCK_ID=#IBLOCK_ID#&filter_section=#SECTION_ID#

Automatiškai sukurtas pranešimas.";
$MESS["WF_NEW_IBLOCK_ELEMENT_NAME"] = "Buvo sukurtas naujas informacijos bloko elementas";
$MESS["WF_NEW_IBLOCK_ELEMENT_DESC"] = "#ID# - ID
#IBLOCK_ID# - informacijos bloko ID
#IBLOCK_TYPE# - informacijos bloko tipas
#SECTION_ID# - skyriaus ID
#ADMIN_EMAIL# - Darbo eigos administratorių el.paštai
#BCC# - Naudotojų, kurie jau keitė dokumentą tam tikru metu arba gali jį keisti, el.paštai
#STATUS_ID# - dabartinio statuso ID
#STATUS_TITLE# - dabartinio statuso pavadinimas
#DATE_CREATE# - elemento kurimo data
#CREATED_BY_ID# - naudotojo, kuris sukūrė dokumentą, ID
#CREATED_BY_NAME# - naudotojo, kuris sukūrė dokumentą, vardas
#CREATED_BY_EMAIL# - naudotojo, kuris sukūrė dokumentą, el.paštas
#NAME# - elemento pavadinimas
#PREVIEW_HTML# - trumpas aprašymas HTML formatu
#PREVIEW_TEXT# - trumpas aprašymas TEXT format
#PREVIEW# - trumpas aprašymas, išsaugotas duomenų bazėje
#PREVIEW_TYPE# - trumpo aprašymo tipas (text | html)
#DETAIL_HTML# - pilnas aprašymas HTML format
#DETAIL_TEXT# - pilnas aprašymas TEXT format
#DETAIL# - pilnas aprašymas, išsaugotas duomenų bazėje
#DETAIL_TYPE# - pilno aprašymo tipas (text | html)
#COMMENTS# - komentarai";
$MESS["WF_NEW_IBLOCK_ELEMENT_SUBJECT"] = "#SITE_NAME#: Buvo sukurtas naujas informacijos bloko elementas (informacinis blokas # #IBLOCK_ID#; tipas - #IBLOCK_TYPE#)";
$MESS["WF_NEW_IBLOCK_ELEMENT_MESSAGE"] = "#SITE_NAME#: Buvo sukurtas naujas elementas (informainis blokas # #IBLOCK_ID#; tipas - #IBLOCK_TYPE#)
---------------------------------------------------------------------------

Dabar dokumento laukai turi šias reikšmes:

Pavadinimas         - #NAME#
Statusas       - [#STATUS_ID#] #STATUS_TITLE#
Sukurtas       - #DATE_CREATE#; [#CREATED_BY_ID#] #CREATED_BY_NAME#

Trumpas aprašymas (tipas - #PREVIEW_TYPE#):
---------------------------------------------------------------------------
#PREVIEW_TEXT#
---------------------------------------------------------------------------

Pilnas aprašymas (type - #DETAIL_TYPE#):
---------------------------------------------------------------------------
#DETAIL_TEXT#
---------------------------------------------------------------------------

Komentarai:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Norėdami peržiūrėti ir redaguoti dokumentą, spustelėkite nuorodą:
http://#SERVER_NAME#/bitrix/admin/iblock_element_edit.php?lang=en&WF=Y&PID=#ID#&type=#IBLOCK_TYPE#&IBLOCK_ID=#IBLOCK_ID#&filter_section=#SECTION_ID#

Automatiškai sukurtas pranešimas.

";
?>