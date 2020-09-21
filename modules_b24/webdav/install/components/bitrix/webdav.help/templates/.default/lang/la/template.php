<?
$MESS["WD_HELP_BPHELP_TEXT"] = "<p><b>Nota</b>: información detallada sobre los procesos de negocio se puede encontrar en el<a href=\"#LINK#\" target=\"_blank\">procesos de negocio</a> página.</p>";
$MESS["WD_HELP_FULL_TEXT"] = "<p>La librería de documentos ofrece dos caminos para administrar documentos: usando el explorador WEB (Internet Explorer, Opera, Fire Fox,etc.), o vía el cliente WebDAV (carpetas web y drivers remotos en Windows). 
  <br />
</p>
 
<ul> 	 
  <li><b><a href=\"#iewebfolder\" >Usando Navegadores Web para administrar documentos</a></b></li>
 	 
  <li><b><a href=\"#ostable\" >Tabla comparativa con la aplicación WebDAV</a></b></li>
 	 
  <li><b><a href=\"#oswindows\" >Conectando la Librería de documentos en Windows</a></b></li>
 	 
  <ul> 		 
    <li><a href=\"#oswindowsnoties\" >Limitaciones en Windows</a></li>
   		 
    <li><a href=\"#oswindowsreg\" >Habilitando no-HTTPS autorización</a></li>
   		 
    <li><a href=\"#oswindowswebclient\" >Ejecutando cliente web Services</a></li>
   		 
    <li><a href=\"#oswindowsfolders\" >Conectando y usando carpetas web</a></li>
   		 
    <li><a href=\"#oswindowsmapdrive\" >Mapeando la Librería como un Network Drive</a></li>
   	</ul>
 	 
  <li><b><a href=\"#osmacos\" >Conectado una librería en SO Mac OS y SO Mac X</a></b></li>
 	 
  <li><b><a href=\"#maxfilesize\" >Aumentando el tamaña máximo de archivos cargados</a></b></li>
 </ul>
 
<h2><a name=\"browser\"></a>Usando Navegadores Web para administrar documentos</h2>
 
<h4>
<a name=\"upload\"></a>
 Cargando documentos</h4>
 
<p>Antes de iniciar la carga, abra la carpeta con los documentos que necesitan ser cargados. Luego, click en <strong>Cargar</strong>, en la barra de herramientas contextual:</p>
 
<p><img src=\"#TEMPLATEFOLDER#/images/en/upload_contex_panel.png\" width=\"679\" height=\"65\"  border=\"0\"/></p>
 
<p>Un formulario de carga de archivos será mostrado. Este formulario cuenta con 3 vistas:</p>
 
<ul> 
  <li><b>Estándard</b>: carga los documentos especificados para una o varias carpetas (haciendo click en <strong>Agregar Archivos</strong>) o todos los documentos desde una o más carpetas (haciendo click en <strong>Agregar Carpetas</strong><b></b>);</li>
 
  <li><b>Clásico</b>: carga los documentos especificados &agrave;ra sólo una caperta;</li>
 
  <li><b>Simple</b>: carga sólo un documento.</li>
 </ul>
 
<p>Selecciones el modo de vista con el que más cómodo se sienta y seleccione archivos y carpetas a cargar.</p>
<p><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/load_form.png',737,638,'Document uploading form');\">
<img src=\"#TEMPLATEFOLDER#/images/en/load_form_sm.png\" style=\"CURSOR: pointer\" width=\"300\" height=\"260\" alt=\"Click to Enlarge\"  border=\"0\"/></a></p>
<p>Click <b>Cargar</b>.</p>
 
<h4>
<a name=\"bizproc\"></a>
 Ejecutando un Business Process</h4>
 
<p>En ciertos casos, un documento requiere que una o más operaciones sean realizadas sobre él. Por ejemplo, un documento puede necesitar ser aprobado o negociado. Acá; es donde los Business Process entran en acción.</p>
 
<p>Para crear un Business Process, haga click sobre el Botón <b>de Acción</b> <img src=\"#TEMPLATEFOLDER#/images/en/action_button.png\" width=\"30\" height=\"26\" border=\"0\"/> en la fila del documento correspondiente y elija <b>Nuevo Business Process</b>:</p>
 
<p><img src=\"#TEMPLATEFOLDER#/images/en/new_bizproc.png\" width=\"442\" height=\"263\" border=\"0\"/></p>
 
<p>La página de ejecución del <b>Business Process</b> se abrirá, y podrá completar los parámetros del business process que ha seleccionado.</p>
 
<p>Para administrar plantillas de business process, haga click en el botón <b>Business Process</b>, en el panel contextual:</p>
 
<p><img src=\"#TEMPLATEFOLDER#/images/en/bizproc_contex_panel.png\" width=\"734\" height=\"67\" border=\"0\"/></p>
 
<h4>
<a name=\"delete\"></a>
 Editando y eliminando documentos</h4>
 
<p>Los comandos de modificación de documentos están disponibles desde el menú contextual:</p>
 
<p><img src=\"#TEMPLATEFOLDER#/images/en/delete_file.png\" width=\"388\" height=\"227\" border=\"0\"/></p>
 Alternativamente, usted puede usar la opción de grupo en panel de acción para aplicar una acción requerida a múltiples documentos. 
<br />
 
<h4>
<a name=\"office\"></a>
 Editando documentos usando Microsoft Office 2003 y últimas versiones</h4>
 
<p><b>Atención!</b> Esta función está disponible sólo cuando edite documentos en <b>Internet Explorer</b>.</p>
 
<p>Click en el ícono del lapicero, edita el documento, lo guarda y cierra la aplicación. Todos los cambios serán guardados en el lado servidor.</p>
 <i><div class=\"hint\"><b>Nota</b>: el documento tiene un ícono identificados de estatus. El ícono amarillo <i><img src=\"/upload/medialibrary/ce3/yellow_status.png\" title=\"yellow_status.png\" border=\"0\" alt=\"yellow_status.png\" width=\"14\" height=\"14\"  /></i> muestra que el documento está siendo editado por usted, el ícono rojo <img src=\"/upload/medialibrary/67a/red_status.png\" title=\"red_status.png\" border=\"0\" alt=\"red_status.png\" width=\"14\" height=\"14\"  /> indica que el documento está siendo editado por alguien más. Use el botón de menú de acciones para desbloquear el documento.</div></i> 
<h2>
<a name=\"ostable\"></a>
 Tabla comparativa de la Aplicación WebDAV</h2>
 
<p><b>Nota!</b> <i>Cuando es usado el cliente WebDav para administrar la librería en el modo workflow o business process: 
    <br />
   </i></p>
 
<ul><i>
    <li>un business process no puede ser ejecutado sobre un documento; </li>
   	 
    <li>los documentos no pueden ser cargados o editados si estos están en un business process con auto ejecusión con parámetros obligatorios sin valores predeterminados;</li>
   	 
    <li>el versionado del documento no será seguido. </li>
  </i></ul>
 <i><p></p>
 
  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"wd-main data-table\"> 	<thead> 		 
      <tr class=\"wd-row\"> 			<th class=\"wd-cell\">Cliente WebDAV</th> 			<th class=\"wd-cell\">Autorización Básica</th> 			<th class=\"wd-cell\">Autorización Windows 
          <br />
         	 (IWA)</th> 			<th class=\"wd-cell\">SSL</th> 			<th class=\"wd-cell\">Puertot</th> 			<th class=\"wd-cell\">Presente 
          <br />
         			 en OS</th> 		</tr>
     	</thead> 	 
    <tbody> 		 
      <tr> 			<td><a href=\"#oswindowsfolders\" ><u>Web folder</u></a>, Windows 7</td> 			<td>+</td> 			<td>+</td> 			<td>-</td> 			<td>todos</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsfolders\" ><u>Web folder</u></a>, Vista SP1</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsfolders\" ><u>Web folder</u></a>, Windows XP</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsfolders\" ><u>Web folder</u></a>, Windows 2003/2000</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>-</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsfolders\" ><u>Web folder</u></a>, Windows Server 2008</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>-</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsmapdrive\" ><u>Network drive</u></a>, Windows 7</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsmapdrive\" ><u>Network drive</u></a>, Vista SP1</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsmapdrive\" ><u>Network drive</u></a>, Windows XP</td> 			<td>-</td> 			<td>+</td> 			<td>-</td> 			<td>80</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#oswindowsmapdrive\" ><u>Network drive</u></a>, Windows 2003/2000</td> 			<td>-</td> 			<td>+</td> 			<td>-</td> 			<td>80</td> 			<td>+</td> 		</tr>
     		 
      <tr> 			<td>MS Office 2007/2003/XP</td> 			<td>+</td> 			<td>+</td> 			<td>+</td> 			<td>todos</td> 			<td>-</td> 		</tr>
     		 
      <tr> 			<td>MS Office 2010</td> 			<td>+</td> 			<td>+</td> 			<td>La única opción</td> 			<td>todos</td> 			<td>-</td> 		</tr>
     		 
      <tr> 			<td><a href=\"#osmacos\" ><u>MAC OS X</u></a></td> 			<td>+</td> 			<td>-</td> 			<td>+</td> 			<td>todos</td> 			<td>+</td> 		</tr>
     	</tbody>
   </table>
 
  <br />
 
  <h2>
<a name=\"oswindows\"></a>
 Conectando la librería de documentos en Windows</h2>
 
  <h4>
<a name=\"oswindowsnoties\"></a>
 Limitaciones en Windows</h4>
 
  <div style=\"border: 1px solid rgb(255, 195, 79); background: none repeat scroll 0% 0% rgb(255, 253, 190); padding: 1em;\"> 	 
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"> 		 
      <tbody> 
        <tr> 			<td style=\"padding-right: 1em;      border-right: 1px solid rgb(255, 221, 157);\"> 				<img src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" width=\"20\" height=\"18\" border=\"0\"  /> 			</td> 			<td style=\"padding-left: 1em;\"> 				 
            <p><b>Windows 7</b> se prohíbe la autorización básica por defecto; usted tiene que editar el sistema de registro para habilitarlo (vea <a href=\"#oswindowsreg\" >detalles</a>). El componente de carpeta web no soporta el protocolo seguro. Usted deberá usar http para acceder a la librería.</p>
           				 
            <p><b>Windows Vista</b> se prohíbe la autorización básica por defecto; usted tiene que editar el sistema de registro para habilitarlo (vea <a href=\"#oswindowsreg\" >detalles</a>).</p>
           				 
            <p><b>Windows XP</b> requiere un puerto específico e la URL, incluido el puerto 80 estándard (ejemple: http://servername:80/).</p>
           				 
            <p><b>Windows 2008 Server</b> no instala el cliente web por defecto. Debe instalarlo manualmente:</p>
           
            <ul> 						 
              <li><i>Start -&gt; Administrative Tools -&gt; Server Manager -&gt; Features</i></li>
             						 
              <li>Click <b>Add Features</b></li>
             						 
              <li>Select Desktop Experience and install it</li>
             </ul>
           					Luego, edite el registro del sistema (vea <a href=\"#oswindowsreg\" >detalles</a>). 				 
            <p></p>
           				 
            <p><b>Usted tiene que asegurarse que su servicio Cliente web esté ejecutándose antes de conectar la librería.</b></p>
           			</td> 		</tr>
       	</tbody>
     </table>
   </div>
 
  <h4><a name=\"oswindowsreg\" >Habilitando autorización sin HTTPS</a></h4>
 <a name=\"oswindowsreg\"></a> 
  <p>Cambie el valor del parámetro de <strong>Autenticación básica</strong> en el sistema de registros. Descargue:</p>
 
  <ul> 
    <li> 
<a name=\"oswindowsreg\" ></a>
 <a href=\"/bitrix/webdav/xp.reg\" >.reg file</a> para <b>Windows XP, Windows 2003 Server</b>;</li>
   
    <li><a name=\"oswindowsreg\"></a><a href=\"/bitrix/webdav/vista.reg\" > .reg file</a> para <b>Windows 7, Vista, Windows 2008 Server</b>.</li>
   </ul>
 
  <p>Click en <b>Run</b> en el dialogo del archivo descargado; luego, click en <b>Yes</b> en el dialogo del <strong>Editor de Registro</strong>:</p>
 
 <p><img src=\"#TEMPLATEFOLDER#/images/en/editor_warning.png\" width=\"574\" height=\"201\" border=\"0\"/></p>
 
  <p>Si usa otro explorador diferente a Internet Explorer, el archivo será descargado, pero el Editor de Registro no se iniciará automáticamente. Usted deberá ejecutar, el archivo descargado, manualmente.</p>
 
  <p><b>Usando el Editor de Registro para Editar el parámetro</b></p>
 
  <p>Click <b>Start &gt; Run</b>.</p>
 
  <p><img src=\"#TEMPLATEFOLDER#/images/en/regedit.png\" width=\"427\" height=\"235\" border=\"0\"/></p>
 
  <p>En el campo <b>Open</b>, tipee <b>regedit</b> y click en <b>OK</b>.</p>
 
  <p>Para <b>Windows XP, Windows 2003 Server</b> cambie el parámetro a:</p>
 
  <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\"> 
    <tbody> 
      <tr><td width=\"638\" valign=\"top\"> 
          <p>[HKEY_LOCAL_MACHINE\\SYSTEM\\CurrentControlSet\\Services\\WebClient\\Parameters] &quot;UseBasicAuth&quot;=dword:00000001</p>
         </td></tr>
     </tbody>
   </table>
 
  <p>Para <b>Windows 7, Vista, Windows 2008 Server</b> cambie el parámetro o cree la entrada en el registro:</p>
 	 
  <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\"> 		 
    <tbody> 			 
      <tr><td width=\"638\" valign=\"top\"> 				 
          <p>[HKEY_LOCAL_MACHINE\\SYSTEM\\CurrentControlSet\\Services\\WebClient\\Parameters] 				 
            <br />
           				&quot;BasicAuthLevel&quot;=dword:00000002</p>
         			</td></tr>
     		</tbody>
   	</table>
 
  <p>Reinicie el servicio <a href=\"#oswindowswebclient\" ><b>Webclient</b></a>.</p>
 
  <h4>
<a name=\"oswindowswebclient\"></a>
 <b>Ejecutando el servicio Cliente Web</b></h4>
 
  <p>Click <b>Start &gt; Control Panel &gt; System and Security &gt; Administrative Tools &gt; Services</b> para abrir la ventana de <b>Services</b>: </p>
 
  <p><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/webclient.png',820,599,'Services');\">
<img src=\"#TEMPLATEFOLDER#/images/en/webclient_sm.png\" style=\"CURSOR: pointer\" width=\"250\" height=\"183\" alt=\"Click to Enlarge\"  border=\"0\"/></a></p>
 
  <p>Busque el servicio <strong>Cliente Web</strong> en la lista y ejecútelo o reinícielo. Para iniciar el servicio automáticamente al iniciar, cambie el parámetro <b>Startup</b> a <b>Automatic</b>: </p>
 
  <p><img src=\"#TEMPLATEFOLDER#/images/en/properties.png\"  width=\"418\" height=\"474\" alt=\"Click to Enlarge\"  border=\"0\"/></p>
 
  <p>Ahora puede mapear la carpeta.</p>
 
  <h4>
<a name=\"oswindowsfolders\"></a>
 Conectando usando Carpetas Web</h4>
 
  <div style=\"border: 1px solid rgb(255, 195, 79); background: none repeat scroll 0% 0% rgb(255, 253, 190); padding: 1em;\"> 	 
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"> 		 
      <tbody> 
        <tr> 			<td style=\"padding-right: 1em;      border-right: 1px solid rgb(255, 221, 157);\"> 				<img src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" width=\"20\" height=\"18\" border=\"0\"/>		</td> 			<td style=\"padding-left: 1em;\"> 			 <b>Windows 7</b> no soporta el protocolo seguro HTTPS/SSL. 
            <br />
           				El componente de carpeta web no está instalado en <b>Windows 2003 Server</b>. Usted deberá instalar esto manualmente ( <a href=\"http://www.microsoft.com/downloads/details.aspx?displaylang=ru&FamilyID=17c36612-632e-4c04-9382-987622ed1d64\" target=\"_blank\" >instrucciones en el sitio web de Microsoft Corporation</a> ). 		 </td> 		</tr>
       	</tbody>
     </table>
   </div>
 
  <p>Asegúrese de que usted ha hecho las <a href=\"#oswindowsreg\" >modificaciones recomendadas para el sistema de registros</a> y servicio de <a href=\"#oswindowswebclient\" >Cliente Web se está ejecutando</a>.</p>
 
  <p>Un componente de conexión a la carpeta web especial es requerido para conectar cpn la librería de documentos. Siga las instrucciones en el <a href=\"http://www.microsoft.com/downloads/details.aspx?displaylang=ru&FamilyID=17c36612-632e-4c04-9382-987622ed1d64\" target=\"_blank\" >website Microsoft</a> ). </p>
 
  <p>Si está usando <b>Internet Explorer</b>, click en <b>Network Drive</b> en la barra de herramientas.</p>
 
  <p><img src=\"#TEMPLATEFOLDER#/images/en/network_storage_contex_panel.png\" width=\"735\" height=\"70\"  border=\"0\" /></p>
 
  <p>Si usa otro explorador, osi la librería no se abre como un network drive:</p>
 
  <ul> 
    <li>Ejecute Windows Explorer;</li>
   
    <li>Seleccione <b>Map Network Drive</b>;</li>
   
    <li>Click en el link <b>Connect to a Web site that you can use to store your documents and pictures</b>: 

     
      <p><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_add_1.png',630,461,'Map Network Drive');\">
<img width=\"250\" height=\"183\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_add_1_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a>
        <br />
       Esto ejecutará la adición de una ubicación de red (<b>Add Network Location)</b>.</p>
     </li>
   
    <li>En la ventana del asistente, click en <b>Next</b>. El siguiente asistene aparecerá;</li>
   
    <li>En esta ventana, haga click en <b>Choose a custom network location,</b> luego click en <b>Next</b>: 
      <br />
     <a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_add_4.png',610,499,'Add Network Location');\">
<img width=\"250\" height=\"205\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_add_4_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a>
      <br />
     </li>
   
    <li>Acá, en el campo de <b>Internet or network address</b>, tipee la URL de la carpeta mapeada en el formato: <i>http://your_server/docs/shared/</i>;</li>
   
    <li>Click en <b>Next</b>. Si se le solicita <b>User name</b> y <b>Password</b>, ingréselos, luego click en <b>OK</b>.</li>
   </ul>
 
  <p>De ahora en adelante, usted podrá accede a la carpeta haciendo click en <b>Run &gt; Network Neighborhood &gt; Folder Name</b>.</p>
 
  <h4>
<a name=\"oswindowsmapdrive\"></a>
 Mapeando la librería como un Network Drive</h4>
 
  <div style=\"border: 1px solid rgb(255, 195, 79); background: none repeat scroll 0% 0% rgb(255, 253, 190); padding: 1em;\"> 	 
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"> 		 
      <tbody> 
        <tr> 			<td style=\"padding-right: 1em;      border-right: 1px solid rgb(255, 221, 157);\"> 				<img src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" width=\"20\" height=\"18\" border=\"0\"  /> 			</td> 			<td style=\"padding-left: 1em;\"> 				<b>Attention! Windows XP and Windows Server 2003</b> no soportan el protocolo seguro HTTPS/SSL. 			</td> 		</tr>
       	</tbody>
     </table>
   </div>
 
  <p>Para conectar una librería como un disco de red en <b>Windows 7</b> usando el protocolo seguro <b>HTTPS/SSL</b>: ejecute el comando <b>Start &gt; Run &gt; cmd</b>. En la línea de comandos, ingrese: 
    <br />
   
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\"> 	 
      <tbody> 		 
        <tr><td width=\"638\" valign=\"top\"> 			 
            <p>net use z: https://&lt;your_server&gt;/docs/shared/ /user:&lt;userlogin&gt; *</p>
           		</td></tr>
       	</tbody>
     </table>
   
    <br />
   </p>
 
  <p>Para conectar la librería de documentos como un disco e red usando el <strong>administrador de archivos</strong>: </p>
 
  <ul> 
    <li>Ejecute Windows Explorer;</li>
   
    <li>Seleccione <i>Tools &gt; Map Network Drive</i>. El asistente de disco de red se abrirá: 
      <br />
     
      <br />
     <a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_storage.png',629,459,'Map Network Drive');\">
<img width=\"250\" height=\"183\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_storage_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a></li>
   
    <li>En el campo <b>Drive</b>, especifique una letra para mapear la carpeta hacia ella;</li>
   
    <li>En el campo <b>Folder</b>, ingrese la ruta a la librería: <i>http://your_server/docs/shared/</i>. Si usted quiere que esta carpeta esté disponible cuando el sistema se inicie, haga check en la opción <b>Reconnect at logon</b>;</li>
   
    <li>Click in <b>Ready</b>. Si se le solicita User name y Password, ingréselos, luego click en <b>OK</b>.
 
      <p>Luego, usted podrá abrir la carpeta en Windows Explorer y será mostrada como un drive dentro de Mi PC, o podrá usar cualquier administrador de archivos.</p>
 
      <h2>
        <a name=\"osmacos\"></a>
        Conectando la Librería en SO MAC y SO MAC X</h2>
 
      <ul> 
        <li>Seleccione <i>Finder Go-&gt;Connect to Server command</i>;</li>
        
        <li>Tipee la dirección de la librería en <b>Server Address</b>: 
          <br />
          <a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/macos.png',465,550,'Mac OS X');\">
<img width=\"235\" height=\"278\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/macos_sm.png\" style=\"cursor: pointer;\" alt=\"Click to Enlarge\" /></a>
         
        </li>
      </ul>
 
      <h2>
        <a name=\"maxfilesize\"></a>
        Aumentando el tamaña máximo de archivos cargados</h2>
 
      <p>Básicamente, el tamaño máximo de archivos a cargar es el valor de variables PHP (<b>upload_max_filesize</b> o <b>post_max_size</b>) y de parámetros en los componentes.</p>
 
      <p>Para incrementar el tamaño máximo permitido, edite los siguientes valores en <b>php.ini</b>:</p>
 
      <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\"> 
        <tbody> 
          <tr>
            <td width=\"638\" valign=\"top\"> 	 
              <p>upload_max_filesize = required value; 	 
                <br />
                post_max_size = more than upload_max_filesize;</p>
            </td>
          </tr>
        </tbody>
      </table>
 
      <p>Si usa un hosting virtual, edite <b>.htaccess</b> también:</p>
 
      <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\"> 
        <tbody> 
          <tr>
            <td width=\"638\" valign=\"top\"> 	 
              <p>php_value upload_max_filesize required value 
                <br />
                php_value post_max_size more than _upload_max_filesize</p>
            </td>
          </tr>
        </tbody>
      </table>
 
      <p>Es probable que tenga que ponerse en contacto con su administrador de hosting con el fin de cambiar los valores de las variables PHP (<b>upload_max_filesize</b> y <b>post_max_size</b>).</p>
 
      <p>Después de que las cuotas PHP hayan sido incrementadas, edite los parámetros de sus componentes de acuerdo a los nuevos valores.</p>
    </li>
  </ul>
</i>";
?>