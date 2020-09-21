<?
$MESS["WF_IBLOCK_STATUS_CHANGE_DESC"] = "#ID# - ID
#IBLOCK_ID# - ID de block de información
#IBLOCK_TYPE# - tipo de block de información
#SECTION_ID# - ID de la sección
#ADMIN_EMAIL# - EMails del flujo de trabajo de los administradores
#BCC# - Emails de los usuarios que ya han modificado el tiempo o algún elemento que pueda modificarlo
#PREV_STATUS_ID# - ID del estado previo del elemento
#PREV_STATUS_TITLE# - nombre del estado previo del elemento
#STATUS_ID# -  estado actual del ID
#STATUS_TITLE# - nombre del estado actual
#DATE_CREATE# - fecha de creación del elemento
#CREATED_BY_ID# - ID del usuario que creó el elemento
#CREATED_BY_NAME# - nombre del usuario que creó el elemento
#CREATED_BY_EMAIL# - EMail del usuario que creó el elemento
#DATE_MODIFY# - fecha de modificación del elemento
#MODIFIED_BY_ID# - ID del usuario que modificó el elemento
#MODIFIED_BY_NAME# - nombre del usuario que modificó el documento
#NAME# - nombre del elemento
#PREVIEW_HTML# - descripción breve en formato de HTML
#PREVIEW_TEXT# - descripción breve en formato de TEXTO
#PREVIEW# - descripción breve almacenada en la base de datos
#PREVIEW_TYPE# - Formato para el texto previo (texto | html)
#DETAIL_HTML# - descripción completa en formato HTML
#DETAIL_TEXT# - descripción completa en formato TEXTO
#DETAIL# - descripción completa almacenada en la base de datos
#DETAIL_TYPE# - tipo de descripción completa (texto | html)
#COMMENTS# - comentarios";
$MESS["WF_IBLOCK_STATUS_CHANGE_MESSAGE"] = "#SITE_NAME#: estado del elemento ##ID# fue cambiado (block de información ##IBLOCK_ID#; tipo - #IBLOCK_TYPE#)
---------------------------------------------------------------------------

Ahora los campos del elemento tienen los siguientes valores:

Nombre         - #NAME#
Status       - [#STATUS_ID#] #STATUS_TITLE#; previous - [#PREV_STATUS_ID#] #PREV_STATUS_TITLE#
Creado      - #DATE_CREATE#; [#CREATED_BY_ID#] #CREATED_BY_NAME#
Modificado     - #DATE_MODIFY#; [#MODIFIED_BY_ID#] #MODIFIED_BY_NAME#

Breve descripción (type - #PREVIEW_TYPE#):
---------------------------------------------------------------------------
#PREVIEW_TEXT#
---------------------------------------------------------------------------

Descripción completa de (type - #DETAIL_TYPE#):
---------------------------------------------------------------------------
#DETAIL_TEXT#
---------------------------------------------------------------------------

Comentarios:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Para ver y editar documento visitar el link:
http://#SERVER_NAME#/bitrix/admin/iblock_element_edit.php?lang=en&WF=Y&PID=#ID#&type=#IBLOCK_TYPE#&IBLOCK_ID=#IBLOCK_ID#&filter_section=#SECTION_ID#

Mensaje generado automáticamente.";
$MESS["WF_IBLOCK_STATUS_CHANGE_NAME"] = "Estado del elemento del block de información fue cambiado";
$MESS["WF_IBLOCK_STATUS_CHANGE_SUBJECT"] = "#SITE_NAME#: Status del elemento ##ID# fue cambiado (block de información ##IBLOCK_ID#; tipo - #IBLOCK_TYPE#)";
$MESS["WF_NEW_DOCUMENT_DESC"] = "#ID# - ID
#ADMIN_EMAIL# - EMails flujo de trabajo de los administradores
#BCC# - Emails de los usuarios que ya han modificado el documento de algún tiempo o que se puede modificar#STATUS_ID# -  ID del estado
#STATUS_TITLE# - nombre del estado
#DATE_ENTER# - fecha de creación del documento
#ENTERED_BY_ID# - ID del usuario que creó el documento
#ENTERED_BY_NAME# - nombre del usuario que creó el documento
#ENTERED_BY_EMAIL# - E-Mail del usuario que ha creado el documento
#FILENAME# - nombre completo del archivo
#TITLE# - título del archivo
#BODY_HTML# - el contenido de sus documentos en formato de HTML
#BODY_TEXT# - el contenido de sus documentos en formato de TEXTO
#BODY# - el contenido de los documentos está almacenado en la base de datos
#BODY_TYPE# - tipo de contenido de documento
#COMMENTS# - comentarios";
$MESS["WF_NEW_DOCUMENT_MESSAGE"] = "Un nuevo documento ha sido creado en  #SITE_NAME#.
---------------------------------------------------------------------------

Ahora los campos del documento tienen los siguientes valores:

ID            - #ID#
Archivo          - #FILENAME#
Título        - #TITLE#
Status        - [#STATUS_ID#] #STATUS_TITLE#
Creado        - #DATE_ENTER#; [#ENTERED_BY_ID#] #ENTERED_BY_NAME#

Contenidos (tipo - #BODY_TYPE#):
---------------------------------------------------------------------------
#BODY_TEXT#
---------------------------------------------------------------------------

Comentarios:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Para ver y editar el documento visite el link:
http://#SERVER_NAME#/bitrix/admin/workflow_edit.php?lang=en&ID=#ID#

Mensaje generado automáticamente.";
$MESS["WF_NEW_DOCUMENT_NAME"] = "Un nuevo documento fue creado";
$MESS["WF_NEW_DOCUMENT_SUBJECT"] = "#SITE_NAME#: Un nuevo documento fue creado";
$MESS["WF_NEW_IBLOCK_ELEMENT_DESC"] = "#ID# - ID
#IBLOCK_ID# - ID del block de información
#IBLOCK_TYPE# - tipo de block de información
#SECTION_ID# - ID de la sección
#ADMIN_EMAIL# - EMails del flujo de trabajo de los administradores
#BCC# - Emails de los usuarios que ya han modificado el tiempo o algún elemento que pueda modificarlo
#STATUS_ID# -  ID del estado actual
#STATUS_TITLE# - nombre del estado actual
#DATE_CREATE# - fecha de creación del elemento
#CREATED_BY_ID# - ID del usuario que ha creado del elemento
#CREATED_BY_NAME# - nombre del usuario que ha creado el elemento
#CREATED_BY_EMAIL# - EMail del usuario que creó el documento
#NAME# - nombre del elemento
#PREVIEW_HTML# - descripción breve formato de HTML
#PREVIEW_TEXT# - descripción breve formato de TEXT
#PREVIEW# - descripción breve almacenada en la base de datos
#PREVIEW_TYPE# - tipo de descripción breve (texto | html)
#DETAIL_HTML# - descripción completa en formato de HTML
#DETAIL_TEXT# - descripción completa en formato de TEXT
#DETAIL# - descripción completa almacenada en la base de datos
#DETAIL_TYPE# - tipo de descripción completa(texto | html)
#COMMENTS# - comentarios";
$MESS["WF_NEW_IBLOCK_ELEMENT_MESSAGE"] = "#SITE_NAME#: Un nuevo elemento ha sido creado(block de información # #IBLOCK_ID#; tipo - #IBLOCK_TYPE#)
---------------------------------------------------------------------------

Ahora los elementos tienen los siguientes valores:

Nombre         - #NAME#
Status       - [#STATUS_ID#] #STATUS_TITLE#
Creado      - #DATE_CREATE#; [#CREATED_BY_ID#] #CREATED_BY_NAME#

Breve descripción (tipo - #PREVIEW_TYPE#):
---------------------------------------------------------------------------
#PREVIEW_TEXT#
---------------------------------------------------------------------------

Descripción completa de (tipo - #DETAIL_TYPE#):
---------------------------------------------------------------------------
#DETAIL_TEXT#
---------------------------------------------------------------------------

Comentarios:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Para ver y editar el docuemnto visitar el link:
http://#SERVER_NAME#/bitrix/admin/iblock_element_edit.php?lang=en&WF=Y&PID=#ID#&type=#IBLOCK_TYPE#&IBLOCK_ID=#IBLOCK_ID#&filter_section=#SECTION_ID#

Mensaje generado automáticamente.";
$MESS["WF_NEW_IBLOCK_ELEMENT_NAME"] = "Nuevo elemento de block de información fue creado";
$MESS["WF_NEW_IBLOCK_ELEMENT_SUBJECT"] = "#SITE_NAME#: Un nuevo elemento fue creado (block informativo # #IBLOCK_ID#; tipo - #IBLOCK_TYPE#)";
$MESS["WF_STATUS_CHANGE_DESC"] = "#ID# - ID
#ADMIN_EMAIL# - Correos electrónicos de flujo de trabajo de los administradores
#BCC# - Correos electrónicos de los usuarios que ya han modificado el documento de algún tiempo o que se puede modificar
#PREV_STATUS_ID# - ID del estado previo del documento
#PREV_STATUS_TITLE# - nombre del estado previo del documento
#STATUS_ID# - ID del estado
#STATUS_TITLE# - nombre del estado
#DATE_ENTER# - fecha de creación del documento
#ENTERED_BY_ID# - ID del usuario que creo el documento
#ENTERED_BY_NAME# - nombre del usuario que creo el documento
#ENTERED_BY_EMAIL# - EMail del usuario que cre el documento
#DATE_MODIFY# - fecha de modicficación del documento
#MODIFIED_BY_ID# - ID del usuario que creó el documento
#MODIFIED_BY_NAME# - nombre del usuario que creó el documento
#FILENAME# - full file name
#TITLE# - file title
#BODY_HTML# - document contents in HTML format
#BODY_TEXT# - document contents in TEXT format
#BODY# - document's content stored in database
#BODY_TYPE# - type of document contents
#COMMENTS# - comments";
$MESS["WF_STATUS_CHANGE_MESSAGE"] = "Estado del documento # #ID# fue cambiado a #SITE_NAME#.
---------------------------------------------------------------------------

Ahora los campos en el documento tienen los siguientes valores:

Archivo         - #FILENAME#
Título         - #TITLE#
Status        - [#STATUS_ID#] #STATUS_TITLE#; previous - [#PREV_STATUS_ID#] #PREV_STATUS_TITLE#
Creado       - #DATE_ENTER#; [#ENTERED_BY_ID#] #ENTERED_BY_NAME#
Modificado      - #DATE_MODIFY#; [#MODIFIED_BY_ID#] #MODIFIED_BY_NAME#

Contenidos (type - #BODY_TYPE#):
---------------------------------------------------------------------------
#BODY_TEXT#
---------------------------------------------------------------------------

Comentarios:
---------------------------------------------------------------------------
#COMMENTS#
---------------------------------------------------------------------------

Para ver y editar el documento visitar el link:
http://#SERVER_NAME#/bitrix/admin/workflow_edit.php?lang=en&ID=#ID#

Mensaje generado automáticamente.";
$MESS["WF_STATUS_CHANGE_NAME"] = "El estado del documento fue cambiado";
$MESS["WF_STATUS_CHANGE_SUBJECT"] = "#SITE_NAME#: Estado del documento # #ID# fue cambiado";
?>