<?
$MESS["DAV_HELP_NAME"] = "DAV Módulo";
$MESS["DAV_HELP_TEXT"] = "O módulo DAV estabelece a sincronização dos calendários e contatos entre o portal e qualquer software e hardware que suporte CalDAV e/ou protocolos CardDAV para iPhone e iPad, por exemplo. Suporte de software é fornecido por Mozilla Sunbird, eM Client e algumas outras aplicações de software. <br><br>
<ul>
<li><b><a href=\"#caldav\">Conectar usando CalDav</a></b>
<ul>
<li><a href=\"#caldavipad\">Conectar iPhone</a></li>
<li><a href=\"#carddavsunbird\">Conectar Mozilla Sunbird</a></li>
</ul>
</li>
<li><b><a href=\"#carddav\">Conectar usando CardDav</a></b></li>
</ul>

<br><br>

<h3><a name=\"caldav\"></a>Conectar usando CalDav</h3>

<h4><a name=\"caldavipad\"></a>Conectar iPhone</h4>


Para configurar seu aparelho Apple para suportar CalDAV: 
<ol> 
<li>Clique em <b>Configurações</b> e selecione <b>Contas e Senhas</b>.</li> 
<li>Clique em <b>Adicionar Conta</b>.</li> 
<li>Selecione <b>Outros</b> &gt; <b>Adicionar Conta CalDAV</b>.</li> 
<li>Especifique este endereço de site como servidor (#SERVER#). Use seu login e senha.</li> 
<li>Usar Autorização básica.</li> 
<li>Para especificar o número da porta, salve a conta e a abra para edição novamente.</li> 
</ol> 

Seus calendários serão exibidos na aplicação \"Calendário\".<br> 
Para conectar a calendários de outros usuários, use links: <br> 
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/</i><br>
e<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/</i><br>

<br><br>

<h4><a name=\"carddavsunbird\"></a>Conectar a Mozilla Sunbird</h4>

Para configurar Mozilla Sunbird para uso com CalDAV:
<ol>
<li>Execute Sunbird e selecione  <b>Arquivo &gt; Novo Calendário</b>.</li>
<li>Selecione <b>Na Rede</b> e clique em <b>Próximo</b>.</li>
<li>Selecione formato <b>CalDAV</b>. </li>
<li>No campo <b>Localização</b>, digite:<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/user_name/calendar/calendar_ID/</i><br>
ou<br>
<i>#SERVER#/bitrix/groupdav.php/site_ID/group_ID/calendar/calendar_ID/</i><br>
e clique <b>Próximo</b>.</li>
<li>Dê um nome a seu calendário e selecione uma cor para ele.</li>
<li>Digite seu nome de usuário e senha.</li>
</ol>

<br><br>

<h3><a name=\"carddav\"></a>Conectar usando CardDav</h3>

Para configurar seu dispositivo Apple para suportar CardDAV:
<ol>
<li>Clique em <b>Configurações</b> e selecione <b>Contas e Senhas</b>.</li>
<li>Clique em <b>Adicionar Conta</b>.</li>
<li>Selecione <b>Outros</b> &gt; <b>Adicionar Conta CardDAV</b>.</li>
<li>Especifique este endereço de website como servidor (#SERVER#). Use seu login e senha.</li>
<li>Use Autorização Básica.</li>
<li>Para especificar o número de porta, salve a conta e a abra novamente para edição.</li>
</ol>

Seus calendários aparecerão na aplicação \"Contatos\".<br>

";
?>