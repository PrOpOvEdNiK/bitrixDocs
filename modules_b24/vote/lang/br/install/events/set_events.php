<?
$MESS["VOTE_FOR_DESC"] = "#ID# - ID do resultado da votação
#TIME# - Tempo de votação
#VOTE_TITLE# - Nome da votação
#VOTE_DESCRIPTION# - Descrição da votação
#VOTE_ID# - ID da votação
#CHANNEL# - Nome do grupo de votação
#CHANNEL_ID# - ID do grupo de votação
#VOTER_ID# - ID dos usuários votantes
#USER_NAME# - Nome completo do usuário
#LOGIN# - login
#USER_ID# - ID de usuário
#STAT_GUEST_ID# - ID de visitante no módulo de análise da web
#SESSION_ID# - ID da sessão no módulo de análise da web
#IP# - Endereço IP 
#VOTE_STATISTIC# -Estatísticas resumidas deste tipo de votação ( - Pergunta- Resposta)
#URL# - URL da votação";
$MESS["VOTE_FOR_MESSAGE"] = "#USER_NAME# votou na enquete \"#VOTE_TITLE#\":
#VOTE_STATISTIC#

http://#SERVER_NAME##URL#
Mensagem gerada automaticamente.";
$MESS["VOTE_FOR_NAME"] = "Novo voto";
$MESS["VOTE_FOR_SUBJECT"] = "#SITE_NAME#: [V] #VOTE_TITLE#";
$MESS["VOTE_NEW_DESC"] = "#ID# - ID do resultado da votação
#TIME# - Tempo de votação
#VOTE_TITLE# - Nome da votação
#VOTE_DESCRIPTION# - Descrição da votação
#VOTE_ID# - ID da votação
#CHANNEL# - Nome do grupo de votação
#CHANNEL_ID# - ID do grupo de votação
#VOTER_ID# - ID dos usuários votantes
#USER_NAME# - Nome completo do usuário
#LOGIN# - login
#USER_ID# - ID de usuário
#STAT_GUEST_ID# - ID de visitante no módulo de análise da web
#SESSION_ID# - ID da sessão no módulo de análise da web
#IP# - Endereço IP 
#VOTE_STATISTIC# -Estatísticas resumidas deste tipo de votação ( - Pergunta- Resposta)
#URL# - URL da votação

";
$MESS["VOTE_NEW_MESSAGE"] = "Nova votação

Votar - [##VOTE_ID#] #VOTE_TITLE#
Grupo - [#CHANNEL_ID#] #CHANNEL#

-------------------------------------------------- ------------

Convidado - [#VOTER_ID#] (#LOGIN#) #USER_NAME# [#STAT_GUEST_ID#]
Sessão - #SESSION_ID#
Endereco IP - #IP#
Tempo - #TEMPO#

Para ver os resultados da votação:
http:// #SERVER_NAME# /bitrix/admin/vote_user_results.php?event_id=#ID#&lang=ru


Veja o Resultado do diagrama de Ligação da votação de visitantes:
http:// #SERVER_NAME#/bitrix/admin/vote_results.php?lang=ru&VOTE_ID=#VOTE_ID#

Mensagem gerada automaticamente.
";
$MESS["VOTE_NEW_NAME"] = "nova votação";
$MESS["VOTE_NEW_SUBJECT"] = "#SITE_NAME#: Nova votação para \"[#VOTE_ID#] #VOTE_TITLE#\"";
?>