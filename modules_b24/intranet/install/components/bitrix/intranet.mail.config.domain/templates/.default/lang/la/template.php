<?
$MESS["INTR_MAIL_AJAX_ERROR"] = "Error al ejecutar la consulta";
$MESS["INTR_MAIL_CHECK_JUST_NOW"] = "hace segundos";
$MESS["INTR_MAIL_CHECK_TEXT"] = "Última comprobación en #DATE#";
$MESS["INTR_MAIL_CHECK_TEXT_NA"] = "No hay datos para el estado del dominio";
$MESS["INTR_MAIL_CHECK_TEXT_NEXT"] = "Siguiente check por correo #DATE#";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM"] = "¿Desea desconectar el dominio?";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM_TEXT"] = "¿Desea separar el dominio?<br>Todos los buzones adjuntos al portal se desprenderán también!";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME"] = "nombre inválido";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME_HINT"] = "El nombre de dominio puede incluir caracteres latinos, dígitos y guiones; No puede comenzar o terminar con un guión o repetir el guión en las posiciones 3 y 4. Finalizar el nombre con el <b>.ru</b>.";
$MESS["INTR_MAIL_DOMAIN_CHECK"] = "Verificar";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_HINT"] = "Elige un nombre en el dominio .ru";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_TITLE"] = "Elija un Dominio";
$MESS["INTR_MAIL_DOMAIN_EMPTY_NAME"] = "ingrese su nombre";
$MESS["INTR_MAIL_DOMAIN_EULA_CONFIRM"] = "Acepto los términos de la <a href=\"http://www.bitrix24.ru/about/domain.php\" target=\"_blank\">Acuerdo de Licencia</a>";
$MESS["INTR_MAIL_DOMAIN_HELP"] = "Si no tiene configurado su dominio para usarlo con Yandex Hosted E-Mail, hágalo ahora.
<br/><br/>
- <a href=\"https://passport.yandex.com/registration/\" target=\"_blank\">Crear una cuenta de correo electrónico alojada de Yandex</a> o usar un buzón existente si tiene uno.
- <a href=\"https://pdd.yandex.ru/domains_add/\" target=\"_blank\">Conectar su dominio</a> a Yandex Hosted E-Mail<sup> (<a href=\"http://help.yandex.ru/pdd/add-domain/add-exist.xml\" target=\"_blank\" title=\"¿Cómo lo hago?\">?</a>)</sup><br/>
- Compruebe la propiedad de su dominio <sup>(<a href=\"http://help.yandex.ru/pdd/confirm-domain.xml\" target=\"_blank\" title=\"¿Cómo lo hago?\">?</a>)</sup><br/>
- Configurar registros MX <sup>(<a href=\"http://help.yandex.ru/pdd/records.xml#mx\" target=\"_blank\" title=\"¿Cómo lo hago?\">?</a>)</sup> o elimine su dominio a Yandex <sup>(<a href=\"http://help.yandex.ru/pdd/hosting.xml#delegate\" target=\"_blank\" title=\"¿Cómo lo hago?\">?</a>)</sup>
<br/><br/>
Una vez configurada su cuenta de E-Mail de Yandex Hosted, adjunte el dominio a su Bitrix24:
<br/><br/>
- <a href=\"https://pddimp.yandex.ru/api2/admin/get_token\" target=\"_blank\" onclick=\"window.open(this.href, '_blank', 'height=480,width=720,top='+parseInt(screen.height/2-240)+',left='+parseInt(screen.width/2-360)); return false; \">Obtener un token</a> (complete los campos del formulario y haga clic en \"Obtener token\". Una vez que aparece el token, cópielo en el Portapapeles)<br/>
- Agregue el dominio y el token a los parámetros.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1"] = "Step&nbsp;1.&nbsp;&nbsp;Confirmar propiedad del dominio";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_A"] = "Cargar un archivo con nombre <b>#SECRET_N#.html</b> a su sitio web del directorio raíz. El archivo debe contener el texto: <b>#SECRET_C#</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B"] = "Para configurar el registro CNAME, debe tener acceso de escritura a los registros DNS de su dominio en un registrador o servicio de alojamiento web con el que haya registrado su dominio. Encontrará estos ajustes en su cuenta o en el panel de control.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAME"] = "Nombre de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAMEV"] = "<b>yamail-#SECRET_N#</b> (or <b>yamail-#SECRET_N#.#DOMAIN#.</b> que depende de la interfaz. Observe el período al final.)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_PROMPT"] = "Especifique estos valores:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_TYPE"] = "Tipo de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUE"] = "Valor:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUEV"] = "<b>mail.yandex.ru.</b> (nuevamente, observe el período)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C"] = "Establezca la dirección de correo electrónico de contacto en su información de registro de dominio en <b>#SECRET_N#@yandex.ru</b>. Utilice el panel de control del registrador de dominios para establecer la dirección de correo electrónico.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C_HINT"] = "Cambie esta dirección a su correo electrónico real tan pronto como se confirme el dominio.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_HINT"] = "Si tiene alguna pregunta para verificar la propiedad de su dominio, comuníquese con el helpdesk al <a href=\"https://helpdesk.bitrix24.com/\" target=\"_blank\">helpdesk.bitrix24.com</a>.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_OR"] = "o";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_PROMPT"] = "Debe confirmar que es propietario del nombre de dominio especificado utilizando uno de los métodos siguientes:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2"] = "Step&nbsp;2.&nbsp;&nbsp;Configurar registros MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_HINT"] = "Elimine todos los demás registros MX y TXT que no estén relacionados con Yandex. Los cambios realizados en los registros MX pueden tardar de un par de horas a tres días para ser actualizados a través de Internet.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_MXPROMPT"] = "Cree un nuevo registro MX con los siguientes parámetros:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAME"] = "Nombre de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAMEV"] = "<b>@</b> (or <b>#DOMAIN#.</b> - si es requerido. Observe el período al final)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PRIORITY"] = "Prioridad: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PROMPT"] = "Una vez que haya confirmado la propiedad de su dominio, tendrá que cambiar los registros MX correspondientes en su alojamiento web.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TITLE"] = "Configurar registros MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TYPE"] = "Tipo de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUE"] = "Valor:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUEV"] = "<b>mx.yandex.net.</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_TITLE"] = "Para conectar su dominio a Bitrix24, hay algunos pasos.";
$MESS["INTR_MAIL_DOMAIN_LONG_NAME"] = "máx. 63 caracteres antes de .ru";
$MESS["INTR_MAIL_DOMAIN_NAME_FREE"] = "Este nombre esta disponible";
$MESS["INTR_MAIL_DOMAIN_NAME_OCCUPIED"] = "este nombre no está disponible";
$MESS["INTR_MAIL_DOMAIN_NOCONFIRM"] = "Dominio no confirmado";
$MESS["INTR_MAIL_DOMAIN_NOMX"] = "Registros MX no configurados";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TEXT"] = "Una vez conectado, no podrás cambiar el nombre del dominio<br>o conseguir otro porque puedes registrar solo un dominio para su Bitrix24.<br><br>Si encuentra el nombre <b>#DOMAIN#</b> está correcto, confirme su nuevo dominio.";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TITLE"] = "Comprueba que ha ingresado el nombre de dominio correctamente.";
$MESS["INTR_MAIL_DOMAIN_REMOVE"] = "Separar";
$MESS["INTR_MAIL_DOMAIN_SAVE"] = "Guardar";
$MESS["INTR_MAIL_DOMAIN_SAVE2"] = "Adjuntar";
$MESS["INTR_MAIL_DOMAIN_SETUP_HINT"] = "El nombre de dominio puede tardar de 1 hora a varios días para confirmar.";
$MESS["INTR_MAIL_DOMAIN_SHORT_NAME"] = "al menos dos caracteres antes de .ru";
$MESS["INTR_MAIL_DOMAIN_STATUS_CONFIRM"] = "Confirmado";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOCONFIRM"] = "No confirmado";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOMX"] = "Registros MX no configurados";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE"] = "Estado del enlace del dominio";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE2"] = "Dominio confirmado";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_MORE"] = "Mostrar otras opciones";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_TITLE"] = "Por favor, elige otro nombre o escoja uno";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_WAIT"] = "Buscando nombres posibles...";
$MESS["INTR_MAIL_DOMAIN_TITLE"] = "Si su dominio está configurado para trabajar en Yandex.Mail para dominios, simplemente ingrese el nombre de dominio y el token en el siguiente formulario";
$MESS["INTR_MAIL_DOMAIN_TITLE2"] = "El dominio está ahora vinculado a su portal";
$MESS["INTR_MAIL_DOMAIN_TITLE3"] = "Dominio para su correo electrónico";
$MESS["INTR_MAIL_DOMAIN_WAITCONFIRM"] = "Esperando confirmacion";
$MESS["INTR_MAIL_DOMAIN_WAITMX"] = "Registros MX no configurados";
$MESS["INTR_MAIL_DOMAIN_WHOIS"] = "Check";
$MESS["INTR_MAIL_GET_TOKEN"] = "obtener";
$MESS["INTR_MAIL_INP_CANCEL"] = "Cancelar";
$MESS["INTR_MAIL_INP_DOMAIN"] = "Nombre de dominio";
$MESS["INTR_MAIL_INP_PUBLIC_DOMAIN"] = "Los empleados pueden registrar buzones en este dominio";
$MESS["INTR_MAIL_INP_TOKEN"] = "Token";
$MESS["INTR_MAIL_MANAGE"] = "Configurar los buzones de correo de los empleados";
?>