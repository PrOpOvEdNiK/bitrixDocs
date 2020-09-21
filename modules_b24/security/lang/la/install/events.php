<?
$MESS["VIRUS_DETECTED_DESC"] = "#EMAIL# - Dirección de e-mail del administrador del sitio web (desde las configuraciones del Módulo Principal)";
$MESS["VIRUS_DETECTED_MESSAGE"] = "Mensaje informativo de #SITE_NAME#
------------------------------------------
Usted recibe este mensaje debido a que la Protección Proactiva ha #SERVER_NAME# ha detectado un código potencialmente peligroso.
1.  El código potencialmente peligroso, ha sido retirado del sitio web.
2. Revise el log de eventos para asegurarse de que el código es realmente perjudicial, y no se trata de un simple contador o framework.
  (link: http://#SERVER_NAME#/bitrix/admin/event_log.php?lang=la&set_filter=Y&find_type=audit_type_id&find_audit_type[]=SECURITY_VIRUS)
3.  Si el código no es peligroso, agréguelo en el listado de excepciones en la página de configuraciones del Antivirus.
  (link: http://#SERVER_NAME#/bitrix/admin/security_antivirus.php?lang=la&tabControl_active_tab=exceptions )
4.  Si el código es un virus. Complete los siguientes pasos:

        a) Cambie la contraseña del administrador y de otras personas responsables del sitio web.
        b) Cambie el login, y contraseña de los accesos ssh y ftp. 
        c) Compruebe y elimine el virus de las computadoras de los administradores que tienen accesos ssh o ftp al sitio web.
         d) Cambie a apagado el guardado de contraseñas en programas que proveen acceso al sitio web mediante ssh o ftp. 
        e) Elimine el código peligros desde los archivos infectados. Por ejemplo, reinstale los archivos infectados usando el más reciente backup realizado. 

---------------------------------------------------------------------
  Este mensaje se generó automáticamente.";
$MESS["VIRUS_DETECTED_NAME"] = "Virus detectado";
$MESS["VIRUS_DETECTED_SUBJECT"] = "#SITE_NAME#:  Virus detectado";
?>