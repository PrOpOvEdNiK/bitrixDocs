<?
$MESS["DAV_HELP_NAME"] = "Módulo DAV";
$MESS["DAV_HELP_TEXT"] = "El módulo del DAV brindan la sincronización de los calendario y de los contactos entre el portal y cualquier otro software y hardware que soporte protocolos CalDAV y/o CardDAV, por ejemplo iPhone y iPad. El soporte del software es brindado por Mozilla Sunbird, el cliente eM y algunas otras aplicaciones del software.<br><br><ul>
	<li><b><a href=\"#caldav\">Conexión usando CalDav</a></b>
	  <ul>
		<li><a href=\"#caldavipad\">Conexión a iPhone</a></li>
		<li><a href=\"#carddavsunbird\">Conexión a Mozilla Sunbird</a></li>
	</ul>
	</li>
	<li><b><a href=\"#carddav\">Conexión usando CardDav</a></b></li>
</ul>

<br><br>

<h3><a name=\"caldav\"></a>Conexión usando CalDav</h3>

<h4><a name=\"caldavipad\"></a>Conexión iPhone</h4>

Para configurar dispositivos Apple para que soporten CalDAV:
<ol>
<li>Click en <b>Ajustes</b> y seleccione <b>Cuentas y contraseñas</b>.</li>
<li>Click <b>Agregar cuenta</b>.</li>
<li>Seleccione <b>Otros</b> &gt; <b>Agrear cuenta CalDAV</b>.</li>
<li>Especificar la dirección de este sitio web como servidor (#SERVER#). Usar su usuario y contraseña.</li>
<li>Usar Autorización Básica.</li>
<li>Para especificar el número de puerto, guarde la cuenta y ábrala nuevamente. Luego edítela.</li>
</ol>

Sus calendarios aparecerán en la aplicación \"Calendar\".<br>
Para conectar otros calendarios de usuarios calendarios, use lo siguientes links:<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/</i><br> 
y
<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/</i><br>

<br><br>

<h4><a name=\"carddavsunbird\"></a>Conexión Mozilla Sunbird</h4>

Para configurar Mozilla Sunbird y usarlo con CalDAV:
<ol>
<li>Ejecutd Sunbird y seleccione <b>Archivo &gt; Nuevo Calendario</b>.</li>
<li>Seleccione <b>En la Red</b> click en <b>Siguiente</b>.</li>
<li>Seleccione formato <b>CalDAV</b>.</li>
<li>En el campo <b>Ubicación</b>, ingrese:<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/calendar_ID/</i><br> 
o
<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/calendar_ID/</i><br>
y oprima <b>Siguiente</b>.</li>
<li>Dele a su calendario un nombre y seleccione un color para él.</li>
<li>Ingrese su nombre y contraseña.</li>
</ol>
<h3><a name=\"carddav\"></a>Conexión usando CardDav</h3>

Para configurar su dispositivo Apple para soportar CardDAV:
<ol>
<li>Click <b>Configuraciones</b> y seleccionar <b>Cuentas y contraseñas</b>.</li>
<li>Click <b>Agregar cuenta</b>.</li>
<li>Seleccionar <b>Otro</b> &gt; <b>Agregar la cuenta CardDAV</b>.</li>
<li>Especificar esta dirección de sitio web como servidor (#SERVER#). Use su usuario y contraseña.</li>
<li>Usar autorización básica.</li>
<li>Para especificar el número de puerto, guarde la cuenta y ábrala para editarla nuevamente.</li>
</ol>

Sus calendarios aparecerán en la aplicación \"Contactos\" .<br>";
?>