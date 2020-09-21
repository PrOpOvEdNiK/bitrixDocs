<?
$MESS["BP_DBLA_APP"] = "Aprobado";
$MESS["BP_DBLA_APPROVE"] = "Por favor aprobar o rechazar el documento.";
$MESS["BP_DBLA_APPROVE2"] = "Por favor aprobar o rechazar el documento.";
$MESS["BP_DBLA_APPROVE2_TEXT"] = "
Usted tiene que aprobar o rechazar el documento \"{=Document:NAME}\".

Autor: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_APPROVE2_TITLE"] = "Aprobación del documento: Etapa 2";
$MESS["BP_DBLA_APPROVE_TEXT"] = "Usted tiene que aprobar o rechazar el documento \"{=Document:NAME}\".

Autor: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_APPROVE_TITLR"] = "Aprobación del documento: Etapa 1";
$MESS["BP_DBLA_APP_S"] = "Estado: Aprobado";
$MESS["BP_DBLA_DESC"] = "Recomendado cuando un documento requiere de una evaluación preliminar de expertos antes de su aprobación. Durante el proceso de primera etapa de un documento sea refrendada por un experto. Si un experto rechaza el documento este último se devuelve a un autor para su revisión. Si el documento es aprobado, se transmite para su aprobación final por un selecto grupo de empleados de manera simple mayoría. Si la votación final no, se devuelve el documento para su revisión y el procedimiento de aprobación se inicia desde el principio.";
$MESS["BP_DBLA_M"] = "Mensaje de Correo electrónico ";
$MESS["BP_DBLA_MAIL2_SUBJ"] = "por favor responder con respecto a \"{=Document:NAME}\"";
$MESS["BP_DBLA_MAIL2_TEXT"] = "Usted tiene que aprobar o rechazar el documento \"{=Document:NAME}\".

Proceda abriendo el enlace: http://#HTTP_HOST##TASK_URL#

Autor: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_MAIL3_SUBJ"] = "Votación sobre {=Document:NAME}: el documento ha sido aceptado.";
$MESS["BP_DBLA_MAIL3_TEXT"] = "Votación sobre \"{=Document:NAME}\" ha sido completada.

El documento fue aceptado por {=ApproveActivity2:ApprovedPercent}% de los votos.

Aprobado:  {=ApproveActivity2:ApprovedCount}
Rechazado: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_MAIL4_SUBJ"] = "Votación sobre {=Document:NAME}: el documento ha sido rechazado.";
$MESS["BP_DBLA_MAIL4_TEXT"] = "La primera etapa de aprobación \"{=Document:NAME}\" ha concluido.

El documento fue rechazado.

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_MAIL_SUBJ"] = "El documento ha pasado Etapa 1";
$MESS["BP_DBLA_MAIL_TEXT"] = "El documento \"{=Document:NAME}\" ha pasado a la primera etapa de aprobación

El documento ha sido aprobado.

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_NAME"] = "Aprobación de dos etapas";
$MESS["BP_DBLA_NAPP"] = "Votación sobre {=Document:NAME}: el documento ha sido rechazado";
$MESS["BP_DBLA_NAPP_DRAFT"] = "Envido para revisión";
$MESS["BP_DBLA_NAPP_DRAFT_S"] = "Estado: Enviado para revisión";
$MESS["BP_DBLA_NAPP_TEXT"] = "Votación sobre \"{=Document:NAME}\" ha sido completada.

El documento fue rechazado.

Aprobado:  {=ApproveActivity2:ApprovedCount}
Rechazado: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_PARAM1"] = "Etapa 1 Votación de personas";
$MESS["BP_DBLA_PARAM2"] = "Etapa 2 Votación de personas";
$MESS["BP_DBLA_PUB_TITLE"] = "Publicar documento";
$MESS["BP_DBLA_S"] = "Secuencia de acciones";
$MESS["BP_DBLA_T"] = "Proceso de negocios secuencial";
$MESS["BP_DBLA_TASK"] = "Aprobar documento: \"{=Document:NAME}\"";
$MESS["BP_DBLA_TASK_DESC"] = "Usted tiene que aprobar o rechazar el documento \"{=Document:NAME}\".

Proceda abriendo el enlace: http://#HTTP_HOST##TASK_URL#

Autor: {=Document:CREATED_BY_PRINTABLE}";
?>