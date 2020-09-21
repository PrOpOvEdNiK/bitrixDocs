<?
$MESS["WD_CONNECT"] = "Conectar";
$MESS["WD_CONNECTION_MANUAL"] = "<a href=\"#LINK#\">Instrucciones de la conexión</a>.";
$MESS["WD_CONNECTION_TITLE"] = "Mapa de la biblioteca de documentos como network drive";
$MESS["WD_CONNECTOR_HELP_MAPDRIVE"] = "<h4><a name=\"oswindowsmapdrive\"></a>Mapeando la librería como un Network Drive</h4>
<div style=\"border:1px solid #ffc34f; background: #fffdbe;padding:1em;\">
	<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		<tr>
			<td style=\"border-right:1px solid #FFDD9D; padding-right:1em;\">
				<img src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" width=\"20\" height=\"18\" border=\"0\"/>
			</td>
			<td style=\"padding-left:1em;\">
				<b>Attention! Windows XP and Windows Server 2003</b> no soportan el protocolo seguro HTTPS/SSL.
			</td>
		</tr>
	</table>
</div>
<p>Para conectar una librería como un disco de red en <b>Windows 7</b> usando el protocolo seguro <b>HTTPS/SSL</b>:  ejecute el comando <b>Start &gt; Run &gt; cmd</b>. En la linea de comandos, ingrese:<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
	<tbody>
		<tr><td width=\"638\" valign=\"top\">
			<p>net use z: https://&lt;your_server&gt;/docs/shared/ /user:&lt;userlogin&gt; *</p>
		</td></tr>
	</tbody>
</table>
<br>
<p>Para conectar la librería de documentos como un disco e red usando el <strong>administrador de archivos</strong>:
<ul>
<li>Ejecute Windows Explorer</b>;</li>
<li>Seleccione <i>Tools > Map Network Drive</i>. El asistente de disco de red se abrirá:
<br />
<br /><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_storage.png',629,459,'Map Network Drive');\">
<img width=\"250\" height=\"183\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_storage_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a></li>
<li>En el campo <b>Drive</b>, especifique una letra para mapear la carpea hacia ella;</li>
<li>En el campo <b>Folder</b>, ingrese la ruta a la librería: <i>http://your_server/docs/shared/</i>. Si usted quiere que esta carpeta esté disponible cuando el sistema se inicie, haga check en la opción <b>Reconnect at logon</b>;</li>
<li>Click in <b>Ready</b>. Si se le solicita User name y Password, ingréselos, lugo click en <b>OK</b>.</li>
</ul>
</p>
<p>Luego, usted podrá abrir la carpeta en Windows explorer y será mostrada como un drive dentro de Mi PC, o podrá usar cualquier adminsitrador de archivos.</p>";
$MESS["WD_CONNECTOR_HELP_OSX"] = "<h2><a name=\"osmacos\"></a>Conectando la Librería en SO MAC y SO MAC X</h2>

<ul>
<li>Seleccione <i>Finder Go->Connect to Server command</i>;</li>
<li>Tipee la dirección de la librería en <b>Server Address</b>:</p>
  <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
    <tbody>
      <tr>
        <td width=\"638\" valign=\"top\"><p>upload_max_filesize = required value; <br/>
          post_max_size = more than upload_max_filesize;</p></td>
      </tr>
    </tbody>
  </table>
  <p><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/macos.png',465,550,'Mac OS X');\">
<img width=\"235\" height=\"278\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/macos_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a></li>
</ul>

";
$MESS["WD_CONNECTOR_HELP_WEBFOLDERS"] = "<h4><a name=\"oswindowsfolders\"></a>Conectando usando Carpetas Web</h4>
<div style=\"border:1px solid #ffc34f; background: #fffdbe;padding:1em;\">
	<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		<tr>
			<td style=\"border-right:1px solid #FFDD9D; padding-right:1em;\">
				<img src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" width=\"20\" height=\"18\" border=\"0\"/>
			</td>
			<td style=\"padding-left:1em;\">
			    <b>Windows 7</b> no soporta el protocolo seguro HTTPS/SSL.<br>
				El compoenene de carpeta web no está instalado en <b>Windows 2003 Server</b>. Usted deberá instalar esto manualmente ( <a href=\"http://www.microsoft.com/downloads/details.aspx?displaylang=ru&FamilyID=17c36612-632e-4c04-9382-987622ed1d64\" target=\"_blank\">instrucciones en el sitio web de Microsoft Corporation</a> ).
		  </td>
		</tr>
	</table>
</div>
<p>Asegúrese de que usted ha hecho las <a href=\"#oswindowsreg\">modificaciones recomendadas para el sistema de registros</a> y servicio de <a href=\"#oswindowswebclient\">Cliente Web se está ejecutando</a>.</p>
<p>Un componente de conexión a la carpeta web especial es requerido para conectar cpn la librería de documentos. Siga las instrucciones en el <a href=\"http://www.microsoft.com/downloads/details.aspx?displaylang=ru&FamilyID=17c36612-632e-4c04-9382-987622ed1d64\" target=\"_blank\">website Microsoft</a> ). </p>
<p>Si está usando <b>Internet Explorer</b>, click en <b>Network Drive</b> en la barra de herramientas.</p>
<p><img src=\"#TEMPLATEFOLDER#/images/en/network_storage_contex_panel.png\" width=\"735\" height=\"70\"  border=\"0\" /></p>

<p>Si usa otro explorador, osi la librería no se abre como un network drive:</p>
<ul>
<li>Ejecute Windows Explorer;</li>
<li>Seleccione <b>Map Network Drive</b>;</li>
<li>Click en el link <b>Connect to a Web site that you can use to store your documents and pictures</b>:</p>
  <p><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_add_1.png',630,461,'Map Network Drive');\">
<img width=\"250\" height=\"183\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_add_1_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a> <br />
Esto ejecutará la adición de una ubicación de red (<b>Add Network Location)</b>.</li>
<li>En la ventana del asistente, click en <b>Next</b>. El siguiente asistene aparecerá;</li>
<li>En esta ventana, haga click en <b>Choose a custom network location,</b> luego click en <b>Next</b>:
  <p><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_add_4.png',610,499,'Add Network Location');\">
<img width=\"250\" height=\"205\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_add_4_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a></li>
<li>Acá, en el campo de <b>Internet or network address</b>, tipee la URL de la carpeta mapeada en el formato: <i>http://your_server/docs/shared/</i>;</li>
<li>Click en <b>Next</b>. Si se le solicita <b>User name</b> y <b>Password</b>, ingréselos, luego click en <b>OK</b>.</li>
</ul>

<p>De ahora en adelante, usted podrá accede a la carpeta haciendo click en  <b>Run > Network Neighborhood > Folder Name</b>.</p>";
$MESS["WD_EMPTY_PATH"] = "La ruta de la red de contacos de trabajo no está especificada.";
$MESS["WD_MACOS_TITLE"] = "El Mapa de la biblioteca del documento en Mac OS X";
$MESS["WD_NOTINSTALLED"] = "Este componente no está instalado como predeterminado en su sistema operativo. Usted puede <a href=\"#LINK#\">descargarlo aquí</a>.";
$MESS["WD_REGISTERPATCH"] = "Las preferencias de seguridad actual rquieren que usted <a href=\"#LINK#\">haga algunos cambios en el registro</a> en el pedido para conectarse al drive d ela red.";
$MESS["WD_SHAREDDRIVE_TITLE"] = "Mostrar instrucciones para conectarse como una network drive";
$MESS["WD_TIP_FOR_2008"] = "Por favor lea la <a href=\"#LINK#\">nota</a> si está usando el Microsoft Windows Server 2008.";
$MESS["WD_USEADDRESS"] = "Usar la siguiente dirección para la conexión:";
$MESS["WD_USECOMMANDLINE"] = "Para conectarse a la biblioteca como drive de la red de contactos de trabajo utilizando HTTPS/SSL, use <b>Start > Run > cmd</b>. Tipee los siguientes comandos en la línea de comando:";
$MESS["WD_WEBFOLDER_TITLE"] = "Conectar como una Carpeta Web";
$MESS["WD_WIN7HTTPSCMD"] = "Para conectar a la biblioteca como drive de la red de contacto de trabajo via protocolo HTTPS/SSL, ejecutar el comando: <b>Start > Execute > cmd</b>.";
?>