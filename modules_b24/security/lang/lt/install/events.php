<?
$MESS["VIRUS_DETECTED_NAME"] = "Aptiktas virusas";
$MESS["VIRUS_DETECTED_DESC"] = "#EMAIL# - Svetainės administratoriaus e-pašto adresas (iš branduolio modulio nustatymų)";
$MESS["VIRUS_DETECTED_SUBJECT"] = "#SITE_NAME#: Aptiktas virusas";
$MESS["VIRUS_DETECTED_MESSAGE"] = "Informacinis pranešimas iš #SITE_NAME# 

------------------------------------------

Jūs gavote šį pranešimą kaip potencialiai pavojingo kodo aptikimo rezultatą iš proaktyvios #SERVER_NAME#  apsaugos sistemos.

1.  Potencialiai pavojingas kodas buvo iškirptas iš html. 
2.  Patikrinkite įvykių žurnalą ir įsitikinkite, kad kodas yra iš tiesų žalingas, ir tai ne vien skaitiklis arba struktūra.
	(nuoroda: http://#SERVER_NAME#/bitrix/admin/event_log.php?lang=en&set_filter=Y&find_type=audit_type_id&find_audit_type[]=SECURITY_VIRUS )
3.  Jei kodas yra nekenksmingas, įtraukite jį į \"Išimtčių\" sąrašą antivirusos nustatymų puslapyje. 
	(nuoroda: http://#SERVER_NAME#/bitrix/admin/security_antivirus.php?lang=en&tabControl_active_tab=exceptions )
4.  Jei kodas yra virusas, tada atlikite šiuos žingsnius:

	a) Pakeiskite administratoriaus ir kitų atsakingų vartotojų prisijungimo slaptažodį svetainėje.
	b) Pakeiskite prisijungimo slaptažodį ssh ir ftp.
	c) Ištirkite ir pašalinkite virusus iš administratorių, kurie turi prieigą prie svetainės per ssh ar ftp, kompiuterių.
	d) Išjunkite slaptažodžių saugojimo programas, kurios suteikia prieigą prie svetainės per ssh ar ftp. 
	e) Pašalinkite kenksmingą kodą iš užkrėstų failų. Pavyzdžiui, iš naujo įdiekite užkrėstus failus naudojant naujausią atsarginę kopiją.

---------------------------------------------------------------------
Šis pranešimas buvo sugeneruotas automatiškai.";
?>