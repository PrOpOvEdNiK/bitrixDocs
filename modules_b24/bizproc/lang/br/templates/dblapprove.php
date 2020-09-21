<?
$MESS["BP_DBLA_APP"] = "Aprovado";
$MESS["BP_DBLA_APPROVE"] = "Por favor, aprove ou recuse o documento.";
$MESS["BP_DBLA_APPROVE2"] = "Por favor, aprove ou recuse o documento.";
$MESS["BP_DBLA_APPROVE2_TEXT"] = "Você tem que aprovar ou recusar o documento \"{=Document:NAME}\".

Author: {=Document:CREATED_BY_PRINTABLE}		";
$MESS["BP_DBLA_APPROVE2_TITLE"] = "Aprovação do Documento: Estágio 2";
$MESS["BP_DBLA_APPROVE_TEXT"] = "Você tem que aprovar ou recusar o documento \"{=Document:NAME}\".
		
Autor: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_APPROVE_TITLR"] = "Aprovação do Documento: Estágio 1";
$MESS["BP_DBLA_APP_S"] = "Status: Aprovado";
$MESS["BP_DBLA_DESC"] = "Recomendado quando um documento necessita de uma avaliação minuciosa antes de ser aprovado. Durante o primeiro estágio do processo o documento é atestado por alguém com competência no assunto. Se o avaliador rejeitar o documento, este irá retornar para o seu criador para uma revisão. Se o documento for aprovado, este será encaminhado para a aprovação final por um grupo pré-selecionado de colaboradores onde se utilizará o voto da maioria. Se a votação final falhar, o documento voltará para revisão e o processo de aprovação do documento recomeçará novamente desde o início.";
$MESS["BP_DBLA_M"] = "Mensagem de Email";
$MESS["BP_DBLA_MAIL2_SUBJ"] = "Por favor, responda sobre \"{=Document:NAME}\"";
$MESS["BP_DBLA_MAIL2_TEXT"] = "Você tem que aprovar ou recusar o documento \"{=Document:NAME}\".
		
Prossiga abrindo o seguinte link: #BASE_HREF##TASK_URL#

Autor: {=Document:CREATED_BY_PRINTABLE}";
$MESS["BP_DBLA_MAIL3_SUBJ"] = "Votação para o documento \"{=Document:NAME}\": O documento foi aceito.";
$MESS["BP_DBLA_MAIL3_TEXT"] = "A votação para o documento \"{=Document:NAME}\" foi concluída. 
O documento foi aceito por {=ApproveActivity2:ApprovedPercent}% de votos.

Aprovado: {=ApproveActivity2:ApprovedCount}																										
Recusado: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_MAIL4_SUBJ"] = "Votação para o documento \"{=Document:NAME}\": O documento foi recusado.";
$MESS["BP_DBLA_MAIL4_TEXT"] = "O primeiro estágio de aprovação \"{=Document:NAME}\" foi concluído.

O documento foi recusado.

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_MAIL_SUBJ"] = "O documento passou no Estágio 1.";
$MESS["BP_DBLA_MAIL_TEXT"] = "O documento \"{=Document:NAME}\" passou no primeiro estágio de aprovação.											

O documento foi aprovado.																										

{=ApproveActivity1:Comments}";
$MESS["BP_DBLA_NAME"] = "Aprovação em 2 estágios";
$MESS["BP_DBLA_NAPP"] = "Votação para o documento \"{=Document:NAME}\": O documento foi recusado.";
$MESS["BP_DBLA_NAPP_DRAFT"] = "Enviado para revisão";
$MESS["BP_DBLA_NAPP_DRAFT_S"] = "Status: Enviado para revisão";
$MESS["BP_DBLA_NAPP_TEXT"] = "A votação para o documento \"{=Document:NAME}\" foi concluída.
						
O documento foi recusado.

Aprovado: {=ApproveActivity2:ApprovedCount}																										
Recusado: {=ApproveActivity2:NotApprovedCount}

{=ApproveActivity2:Comments}";
$MESS["BP_DBLA_PARAM1"] = "Pessoas Votantes do Estágio 1";
$MESS["BP_DBLA_PARAM2"] = "Pessoas Votantes do Estágio 2";
$MESS["BP_DBLA_PUB_TITLE"] = "Publicar Documento";
$MESS["BP_DBLA_S"] = "Sequência de Ações";
$MESS["BP_DBLA_T"] = "Processo de Negócio Sequencial";
$MESS["BP_DBLA_TASK"] = "Aprovar documento: \"{=Document:NAME}\"";
$MESS["BP_DBLA_TASK_DESC"] = "Você tem que aprovar ou recusar o documento \"{=Document:NAME}\".
		
Prossiga abrindo o seguinte link: #BASE_HREF##TASK_URL#

Autor: {=Document:CREATED_BY_PRINTABLE}";
?>