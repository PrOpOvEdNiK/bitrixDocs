<?
$MESS["INTR_MAIL_AJAX_ERROR"] = "Error en la ejecución de consulta";
$MESS["INTR_MAIL_CHECK_JUST_NOW"] = "hace unos segundos";
$MESS["INTR_MAIL_CHECK_TEXT"] = "Última revisión #DATE#";
$MESS["INTR_MAIL_CHECK_TEXT_NA"] = "No hay datos de estado del dominio";
$MESS["INTR_MAIL_CHECK_TEXT_NEXT"] = "Próxima revisión del e-mail el #DATE#";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM"] = "¿Desea desconectar el dominio?";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM_TEXT"] = "¿Desea separar el dominio?<br>Todos los buzones conectados al portal se separarán así!";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME"] = "nombre inválido";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME_HINT"] = "El dominio puede incluir caracteres latinos, números y guiones; no puede empezar ni terminar con un guión, o repetir el guión en las posiciones 3 y 4. Terminar el nombre con <b>.com</b>.";
$MESS["INTR_MAIL_DOMAIN_CHECK"] = "Verificar";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_HINT"] = "Elegir un nombre de dominio en .com";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_TITLE"] = "Elija un Dominio";
$MESS["INTR_MAIL_DOMAIN_EMPTY_NAME"] = "ingrese el nombre";
$MESS["INTR_MAIL_DOMAIN_EULA_CONFIRM"] = "Acepto las condiciones de la <a href=\"http://www.bitrix24.ru/about/domain.php\" target=\"_blank\">License Agreement</a>";
$MESS["INTR_MAIL_DOMAIN_HELP"] = "Si usted no tiene su dominio configurado para su uso con Yandex Hosted E-Mail, hágalo ahora. <br/><br/>
  - <a href=\"https://passport.yandex.com/registration/\" target=\"_blank\">Cree una cuenta Yandex Hosted E-Mail</a> o use un buzón existente, si usted tiene uno.<br />
  - <a href=\"https://pdd.yandex.ru/domains_add/\" target=\"_blank\">Conecte su dominio</a> a Yandex Hosted E-Mail <sup>(<a href=\"http://help.yandex.ru/pdd/add-domain/add-exist.xml\" target=\"_blank\" title=\"¿Cómo lo hago?\">?</a>)</sup><br/>
  - Compruebe la propiedad del dominio <sup>(<a href=\"http://help.yandex.ru/pdd/confirm-domain.xml\" target=\"_blank\" title=\"Cómo hago esto?\">?</a>)</sup><br/> 
  - Configure los registros MX <sup>(<a href=\"http://help.yandex.ru/pdd/records.xml#mx\" target=\"_blank\" title=\" Cómo hago eso \">?</a>)</sup> o delegue su dominio en Yandex <sup>(<a href=\"http://help.yandex.ru/pdd/hosting.xml#delegate\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup>
  <br/><br/> Una vez que su cuenta Yandex Hosted E-Mail se ha configurado, conecte el dominio a su Bitrix24:
  <br/>
  <br/>
  - <a href=\"https://pddimp.yandex.ru/api2/admin/get_token\" target=\"_blank\" onclick=\"window.open(this.href, '_blank', 'height=480,width=720,top='+parseInt(screen.height/2-240)+',left='+parseInt(screen.width/2-360)); return false; \">Consiga el token</a> (complete los campos del formulario y haga clic en \"Get token\". Una vez que aparezca el símbolo, cópielo al Portapapeles).<br/>
  - Añada el dominio y el token a los parámetros solicitados por Bitrix24.
";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1"] = "Step&nbsp;1.&nbsp;&nbsp;Confirme la propiedad del dominio";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_A"] = "Carga un archivo llamado <b>#SECRET_N#.html</b> en el directorio root del sitio Web. El archivo debe contener el texto: <b>#SECRET_C#</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B"] = "Para configurar el registro CNAME, que necesita para tener acceso de escritura a los registros DNS de su dominio en un registrador o servicio de hospedaje web con la que se ha registrado su dominio. Encontrará estos valores en la cuenta o el panel de control.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAME"] = "Nombre de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAMEV"] = "<b>yamail-#SECRET_N#</b> (or <b>yamail-#SECRET_N#.#DOMAIN#.</b> que depende de la interfaz. Observe el punto al final.)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_PROMPT"] = "Especifique los siguientes valores:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_TYPE"] = "Tipo de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUE"] = "Valor:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUEV"] = "<b>mail.yandex.ru.</b> (nuevamente, observe el período)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C"] = "Establezca la dirección de correo electrónico de contacto en su información de registro de dominio a <b>#DOMAIN#+#SECRET_N#@yandex.ru</b>. Utilice el panel de control del registrador de dominios para establecer la dirección de correo electrónico.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C_HINT"] = "Cambiar la dirección de su e-mail real tan pronto como el dominio sea confirmado.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_HINT"] = "Si usted tiene cualquier pregunta sobre como comprobar su propiedad de dominio, póngase en contacto con el servicio de soporte <a href=\"http://www.bitrixsoft.com/support/\" target=\"_blank\">www.bitrixsoft.com/support/</a>.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_OR"] = "ó";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_PROMPT"] = "Necesita confirmar que usted es el propietario del nombre de dominio especificado usando uno de los siguientes métodos:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2"] = "Step&nbsp;2.&nbsp;&nbsp;Configurar registros MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_HINT"] = "Eliminar todos los demás registros MX y TXT que no están relacionados con Yandex. Los cambios realizados en los registros MX pueden tardar desde un par de horas hasta tres días para ser actualizados a través de Internet.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_MXPROMPT"] = "Crear un nuevo registro MX con los siguientes parámetros:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAME"] = "Nombre de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAMEV"] = "<b>@</b> (or <b>#DOMAIN#.</b> - Si es necesario. Observe el punto al final)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PRIORITY"] = "Prioridad:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PROMPT"] = "Una vez que haya confirmado su propiedad del dominio, usted tendrá que cambiar los registros MX correspondientes de su alojamiento web.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TITLE"] = "Configurar registros MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TYPE"] = "Tipo de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUE"] = "Valor:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUEV"] = "<b>mx.yandex.ru.</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_TITLE"] = "Para conectar tu dominio a Bitrix24, hay pocos pasos.";
$MESS["INTR_MAIL_DOMAIN_LONG_NAME"] = "max. 63 caracteres antes de .com";
$MESS["INTR_MAIL_DOMAIN_NAME_FREE"] = "este nombre está disponible";
$MESS["INTR_MAIL_DOMAIN_NAME_OCCUPIED"] = "este nombre no está disponible";
$MESS["INTR_MAIL_DOMAIN_NOCONFIRM"] = "Dominio no confirmado";
$MESS["INTR_MAIL_DOMAIN_NOMX"] = "Registros MX no configurados";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TEXT"] = "Una vez conectado, usted no será capaz de cambiar el nombre de dominio<br>o obtener otra porque sólo puede registrar<br>un dominio para Bitrix24.<br><br>Si encuentra que el nombre <b>#DOMAIN#</b> es correcto, confirme su nuevo dominio.";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TITLE"] = "Por favor, compruebe que ha introducido el nombre de dominio correctamente.";
$MESS["INTR_MAIL_DOMAIN_REMOVE"] = "Separar";
$MESS["INTR_MAIL_DOMAIN_SAVE"] = "Guardar";
$MESS["INTR_MAIL_DOMAIN_SAVE2"] = "Adjuntar";
$MESS["INTR_MAIL_DOMAIN_SETUP_HINT"] = "El nombre de dominio puede tardar de 1 hora a varios días para confirmar.";
$MESS["INTR_MAIL_DOMAIN_SHORT_NAME"] = "al menos dos caracteres antes de .com";
$MESS["INTR_MAIL_DOMAIN_STATUS_CONFIRM"] = "Confirmado";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOCONFIRM"] = "No confirmado";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOMX"] = "Registros MX no configurados";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE"] = "Estado del enlace del dominio";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE2"] = "Dominio confirmado";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_MORE"] = "Mostrar otras opciones";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_TITLE"] = "Por favor, venga con otro nombre o elija uno";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_WAIT"] = "Búsqueda de posibles nombres...";
$MESS["INTR_MAIL_DOMAIN_TITLE"] = "Si su dominio está configurado para trabajar en Yandex.Mail para dominios, simplemente introduzca el nombre de dominio y token en el formulario que aparece a continuación";
$MESS["INTR_MAIL_DOMAIN_TITLE2"] = "El dominio está ahora vinculado a su portal";
$MESS["INTR_MAIL_DOMAIN_TITLE3"] = "Dominio para el correo electrónico";
$MESS["INTR_MAIL_DOMAIN_WAITCONFIRM"] = "Esperando confirmación";
$MESS["INTR_MAIL_DOMAIN_WAITMX"] = "Registros MX no configurados";
$MESS["INTR_MAIL_DOMAIN_WHOIS"] = "Comprobar";
$MESS["INTR_MAIL_GET_TOKEN"] = "obtener";
$MESS["INTR_MAIL_INP_CANCEL"] = "Cancelar";
$MESS["INTR_MAIL_INP_DOMAIN"] = "Nombre de dominio";
$MESS["INTR_MAIL_INP_PUBLIC_DOMAIN"] = "Los empleados pueden registrar los buzones en este dominio";
$MESS["INTR_MAIL_INP_TOKEN"] = "Token";
$MESS["INTR_MAIL_MANAGE"] = "Configure los buzones de los empleados";
?>