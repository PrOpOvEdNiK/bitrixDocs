<?
$MESS["WD_HELP_BPHELP_TEXT"] = "<p><b>Nota</b>: informações detalhadas sobre os processos de negócios podem ser encontradas na página<a href=\"#LINK#\" target=\"_blank\">Processos de Negócios</a>.</p>";
$MESS["WD_HELP_FULL_TEXT"] = "A biblioteca de documentos oferece duas abordagens para lidar com documentos: usando um navegador web (Internet Explorer, Opera, Fire Fox etc ), ou através do cliente WebDAV ( pastas web e unidades remotas em Windows) .<br>
<ul>
<li><b><a href=\"#iewebfolder\">Usando navegadores da Web para gerenciar documentos</a></b></li>
<li><b><a href=\"#ostable\">WebDAV Aplicação Tabela de comparação</a></b></li>
<li><b><a href=\"#oswindows\">Conexão da biblioteca de documentos no Windows</a></b></li>
<ul>
<li><a href=\"#oswindowsnoties\">Limitações no Windows</a></li>
<li><a href=\"#oswindowsreg\">Ativando não- HTTPS autorização</a></li>
<li><a href=\"#oswindowswebclient\">Correndo Client Service Web</a></li>
<li><a href=\"#oswindowsfolders\">Conectando e usando pastas da Web</a></li>
<li><a href=\"#oswindowsmapdrive\">Mapeamento da Biblioteca como uma unidade de rede</a></li>

</ul>
<li><b><a href=\"#osmacos\">Conectando uma Biblioteca no Mac OS e Mac OS X</a></b></li>
<li><b><a href=\"#maxfilesize\">aumentar o tamanho máximo dos arquivos enviados</a></b></li>
</ul>


<h2><a name=\"browser\"></a>Utilizando Navegadores Web para gerenciar documentos</h2>
<h4><a name=\"upload\"></a>Upload de Documentos</h4>
<p>Antes de iniciar o upload, abra a pasta em que os documentos precisam ser enviados. Então ,<b>Carregar</b> clique, na barra de ferramentas de contexto:</p>
<p><img src=\"#TEMPLATEFOLDER#/images/en/upload_contex_panel.png\" width=\"679\" height=\"65\" border=\"0\"/></p>
<p>Um formulário de upload de arquivos vai aparecer. Esta forma tem os seguintes três modos de visualização :</p>
<ul>
<li><b>padrão</b>: Imagens especificado documentos a partir de uma ou várias pastas (clicando <b>Add Files</b>) ou todos os documentos a partir de uma ou várias pastas (clicando <b>Adicionar pasta</b>);</li>
<li><b>clássico</b>: Imagens especificado documentos de apenas uma pasta;</li>
<li><b>simples</b>: envios apenas um documento especificado</li>
</ul>

<p>Selecione o modo de visualização que você se sinta confortável e selecionar arquivos ou pastas para upload.</p>
<p>href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/load_form.png',737,638,'Document upload form');\">
<img src=\"#TEMPLATEFOLDER#/images/en/load_form_sm.png\" style=\"CURSOR: pointer\" width=\"300\" height=\"260\" alt=\"Click para Enlarge\" border=\"0\"/></a></p>

<p>Clique <b>Carregar</b>.</p>

<h4><a name=\"bizproc\"></a>Execução de um Processo de Negócio</h4>

<p>Em certos casos, um documento requer uma ou mais das operações a serem realizadas sobre ela. Por exemplo, um documento pode ter de ser aprovado ou negociado. Este é o lugar onde os processos de negócios entram em jogo.</P>

<p>Para criar um processo de negócio, clique sobre a Ação <b>fronteira</b> <img src=\"#TEMPLATEFOLDER#/images/en/action_button.png\" width=\"30\" height=\"26\" border=\"0\"/> botão na linha com o documento relevante e escolha <b>Processo de Novos Negócios</b>:</p>
<p><img height=\"263\" width=\"442\" src=\"#TEMPLATEFOLDER#/images/en/new_bizproc.png\" border=\"0\"/></p>
<p>O Processo <b>Run Business</b> página se abre, onde você pode preencher os parâmetros do processo de negócio que você selecionou.</p>
#BPHELP#
<p>Para gerenciar os modelos de processos de negócios, clique sobre o Processo <b>Negócios</b>, no painel de contexto:</p>
<p><img src=\"#TEMPLATEFOLDER#/images/en/bizproc_contex_panel.png\" width=\"734\" height=\"67\" border=\"0\"/></p>

<h4><a name=\"delete\"></a>Edição e exclusão de documentos</h4>
<p>Os comandos de modificação do documento estão disponíveis no menu de contexto:
<p><img height=\"227\" width=\"388\" src=\"#TEMPLATEFOLDER#/images/en/delete_file.png\" border=\"0\"/></p> Alternativamente, você pode usar o painel de ação do grupo para aplicar uma ação necessária para vários documentos.
<br/>
<h4><a name=\"office\"></a>edição de documentos usando o Microsoft Office 2003 e versões posteriores</h4>
<p><b>Atenção!</b> Esta função está disponível apenas na edição de documentos em <b>Internet Explorer</b>.</p>

<p>Clique no ícone de lápis, editar o documento, salvá-lo e fechar o aplicativo. Todas as alterações serão salvas no lado do servidor .</P>
<i><div class=\"hint\"><b>Nota</b>: o documento tem um ícone que indica o status de bloqueio. O ícone amarelo<img height=\"14\" width=\"14\" src=\"#TEMPLATEFOLDER#/images/yellow_status.png\" border=\"0\"/>mostra que o documento está sendo editado por você; o ícone vermelho<img height=\"14\" width=\"14\" src=\"#TEMPLATEFOLDER#/images/red_status.png\" border=\"0\"/>significa que o arquivo está bloqueado por outra pessoa. Utilize o menu de botão de ação para desbloquear o documento.
</div></i>

<br>
<h2><a name=\"ostable\"></a>Comparação WebDAV Aplicação Tabela</h2>

<p><b>Observação ! existe</b><i>Certas limitações ao usar clientes WebDAV para gerenciar a biblioteca em modo de processo de fluxo de trabalho ou de negócios :<br>
<ul><li>um processo de negócio não pode ser executado em um documento;</li>
<li>documentos não pode ser carregado ou editado se há processos de negócios autorun com parâmetros obrigatórios sem valores padrão;</li>
<li>versões de documentos não são rastreadas.</i></li></ul>
</p>

<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wd-main data-table\">
<thead>
<tr class=\"wd-row\">
<th cliente WebDAV class=\"wd-cell\"></th>
<th class=\"wd-cell\">autorização /><br Básico</th>
<th class=\"wd-cell\">do Windows<br />autorização (IWA)</th>
<th class=\"wd-cell\">SSL</th>
<th class=\"wd-cell\">Porto</th>
<th class=\"wd-cell\">/><br Presente em OS</th>
</tr>
</thead>
<tbody>
<tr>
<td><a href=\"#oswindowsfolders\"><u>pasta da Web</u></a>, o Windows 7</td>
<td>+</td>
<td>+</td>
<td>-</td>
<td>tudo</td>
<td>+</td>
</tr>
<tr>
<td><a href=\"#oswindowsfolders\"><u>pasta da Web</u></a>, o Vista SP1</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>+</td>
</tr>
<tr>
<td><a href=\"#oswindowsfolders\"><u>pasta da Web</u></a>, o Windows XP</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>+</td>
</tr>
<tr>
<td><a href=\"#oswindowsfolders\"><u>pasta da Web</u></a>, o Windows 2003/2000</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>-</td>
</tr>
<tr>
<td><a href=\"#oswindowsfolders\"><u>pasta da Web</u></a>, o Windows Server 2008</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>-</td>
</tr>
<tr>
<td><a href=\"#oswindowsmapdrive\"><u>Rede unidade</u></a>, o Windows 7</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>+</td>
</tr>
<tr>
<td><a href=\"#oswindowsmapdrive\"><u>Rede unidade</u></a>, o Vista SP1</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>+</td>
</tr>
<tr>
<td><a href=\"#oswindowsmapdrive\"><u>Rede unidade</u></a>, o Windows XP</td>
<td>-</td>
<td>+</td>
<td>-</td>
<td>80</td>
<td>+</td>
</tr>
<tr>
<td><a href=\"#oswindowsmapdrive\"><u>Rede unidade</u></a>, o Windows 2003/2000</td>
<td>-</td>
<td>+</td>
<td>-</td>
<td>80</td>
<td>+</td>
</tr>
<tr>
<td>MS Office 2007/2003/XP</td>
<td>+</td>
<td>+</td>
<td>+</td>
<td>tudo</td>
<td>-</td>
</tr>
<tr>
<td>MS Office 2010</td>
<td>+</td>
<td>+</td>
<td>a única opção</td>
<td>tudo</td>
<td>-</td>
</tr>
<tr>
<td><a href=\"#osmacos\"><u>MAC OS X</u></a></td>
<td>+</td>
<td>-</td>
<td>+</td>
<td>tudo</td>
<td>+</td>
</tr>
</tbody>
</table>
<br>
<h2><a name=\"oswindows\"></a>Conectar a biblioteca de documentos no Windows</h2>
<h4><a name=\"oswindowsnoties\"></a>Limitações no Windows</h4>
<div style=\"border:1px sólida #ffc34f; background: #fffdbe;padding:1em;\">
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
<tr>
<td style=\"border-right:1px sólida padding-right:1em;\">#FFDD9D;
<img height=\"18\" width=\"20\" src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" border=\"0\"/>
</td>
<td style=\"padding-left:1em;\">
<p><b>Windows 7</b> proíbe autorização básica por padrão; você terá que editar o registro do sistema para ativá-lo (<a href=\"#oswindowsreg\">ver detalhes</a>). O componente de pasta web não suporta protocolo seguro. Você terá que usar HTTP para acessar a biblioteca.</p>

<p><b>Windows Vista</b> proíbe autorização básica por padrão; você terá que editar o registro do sistema para ativá-lo (<a href=\"#oswindowsreg\">ver detalhes</a>).</p>
<p><b>Windows XP</b> requer um número de porta explícito em uma URL, mesmo que usando o padrão porta 80 (por exemplo, http://servername:80/).</p>
<p><b>Windows 2008 Server</b> não instalar o serviço WebClient por padrão. Você tem que instalá-lo manualmente :
<ul>
<li><i>Iniciar - >Ferramentas Administrativas ->Gerenciador do Servidor - >Características</i></li>
<li>Clique <b>Adicionar Recursos</b></li>
Experiência
<li>Selecione Desktop e instalá-lo</li>
</ul>
Em seguida, editar o registro do sistema (<a href=\"#oswindowsreg\">ver detalhes</a>).
</p>

<p><b>Você tem que garantir o serviço WebClient estiver em execução antes de ligar para a biblioteca.</b></p>
</td>
</tr>
</table>
</div>

<h4><a name=\"oswindowsreg\">Ativando não- HTTPS autorização</h4>
<p>Altere o valor da autenticação básica parâmetro no registro do sistema. Download:</p>
<ul>
  <li><a href=\"/bitrix/webdav/xp.reg\">.reg</a>para <b>Windows XP, Windows Server 2003</b>;</li>
  <li><a href=\"/bitrix/webdav/vista.reg\">.reg</a>para <b>Windows 7, Vista, Windows 2008 Server</b>.</li>
</ul>
<p>Clique <b>Run</b> na caixa de diálogo de download de arquivo; em seguida, clique em <b>Sim</b> na caixa de diálogo <b>Editor do Registro</b>:</p>
<p><img height=\"201\" width=\"574\" src=\"#TEMPLATEFOLDER#/images/en/editor_warning.png\" border=\"0\"/></p>
<p>Se você usar outros navegadores de Internet Explorer, o arquivo será baixado, mas o Editor do Registro não será iniciado automaticamente. Você terá que executar o arquivo baixado manualmente</b>.</P>
<p><b>Usar o Editor do Registro para editar o parâmetro</b></p>
<p>Clique <b>Iniciar>Executar</b>.</P>

<p><img height=\"235\" width=\"427\" src=\"#TEMPLATEFOLDER#/images/en/regedit.png\" border=\"0\"/></a></p>

<p>No <b>Abrir</b>, digite regedit e clique em <b>OK</b>.</p>
<p>Para <b>Windows XP, Windows Server 2003</b> alterar o parâmetro para :</p>
<p></p>
  <table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
    <tbody>
      <td width=\"638\" valign=\"top\">
          <p>[HKEY_LOCAL_MACHINE \\ SYSTEM \\ CurrentControlSet \\ Services \\ WebClient \\ Parameters ] \" UseBasicAuth \" = dword: 00000001</p>
         </td></tr>
     </tbody>
   </table>
<p></p>
<p>Para <b>Windows 7, Vista, Windows 2008 Server</b> alterar o parâmetro ou criar a entrada de registo :</p>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tbody>
<td width=\"638\" valign=\"top\">
<p>[HKEY_LOCAL_MACHINE \\ SYSTEM \\ CurrentControlSet \\ Services \\ WebClient \\ Parameters ]
<br />
\" BasicAuthLevel \" = dword: 00000002</p>
</td></tr>
</tbody>
</table>

<p>Reinicie o<a href=\"#oswindowswebclient\"><b>Webclient</b></a>serviço.</p>
<h4><a name=\"oswindowswebclient\"></a><b>Executando o serviço Web do cliente</b></h4>
<p>Clique <b>Iniciar > Painel de Controle > Sistema e Segurança > Ferramentas Administrativas > Serviços</b> para abrir os Serviços da janela:
<p>href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/webclient.png',820,599,'Services');\">
<img src=\"#TEMPLATEFOLDER#/images/en/webclient_sm.png\" style=\"CURSOR: pointer\" width=\"250\" height=\"183\" alt=\"Click para Enlarge\" border=\"0\"/></a></p>
<p>Encontre o Cliente Web serviço na lista e executar ou reiniciá-lo. Para que o serviço executado na inicialização do sistema, mudar o <b>Startup</b> parâmetro para <b>automática</b>:
<p><img height=\"474\" width=\"418\" src=\"#TEMPLATEFOLDER#/images/en/properties.png\" alt=\"Click para Enlarge\" border=\"0\"/></p></li>
<p>Agora você pode mapear a pasta.</p>

<h4><a name=\"oswindowsfolders\">Ligar Utilizando pastas da Web</h4>
<div style=\"border:1px sólida #ffc34f; background: #fffdbe;padding:1em;\">
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
<tr>
<td style=\"border-right:1px sólida padding-right:1em;\">#FFDD9D;
<img height=\"18\" width=\"20\" src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" border=\"0\"/>
</td>
<td style=\"padding-left:1em;\">
<b>Windows 7</b> não suporta HTTPS / SSL protocolo seguro .<br>
O componente de pastas da Web não está instalado no Windows 2003 <b>Servidor</b>. Você vai ter que instalá-lo manualmente (<a href=\"http://www.microsoft.com/downloads/details.aspx?displaylang=ru&FamilyID=17c36612-632e-4c04-9382-987622ed1d64\" target = \" _blank \">instruções no site Microsoft Corporation</a>). </td>
</tr>
</table>
</div>
<p>Certifique-se que você fez a modificação adequada<a href=\"#oswindowsreg\">no registro do sistema</a>e<a href=\"#oswindowswebclient\">Webclient serviço está sendo executado</a>.</p>
<p>Um componente de conexão de pasta web especial é necessário para se conectar à biblioteca de documentos. Siga as instruções no<a href=\"http://www.microsoft.com/downloads/details.aspx?displaylang=ru&FamilyID=17c36612-632e-4c04-9382-987622ed1d64\" target = \" _blank \">site da Microsoft</a>).</p>
<p>Se você estiver usando <b>Internet Explorer</b>, clique em <b>Unidade de Rede</b> na barra de ferramentas.</p>
<p><img src=\"#TEMPLATEFOLDER#/images/en/network_storage_contex_panel.png\" width=\"735\" height=\"70\" border=\"0\" /></p>

<p>Ao usar outros navegadores, ou se a biblioteca não foi aberto como uma unidade de rede :</p>
<ul>
<li>Run Windows Explorer;</li>
<li>Selecione <b>Mapear unidade de rede</b>;</li>
<li>Clique no link <b>Ligação a um site que você pode usar para armazenar seus documentos e imagens</b>:</p>
<p>href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_add_1.png',630,461,'Map Rede Drive');\">
<img width=\"250\" height=\"183\" border=\"0\" src=\"#TEMPLATEFOLDER#/images/en/network_add_1_sm.png\" style=\"cursor:pointer; \"alt=\"Clique para ampliar\"/></a><br />Isto irá executar o <b>Adicionar Local de Rede</b>.</li>
<li>Na janela do assistente, clique em <b>Próxima</b>. A próxima janela do assistente irá aparecer;</li>
<li>Nesta janela, clique em <b>Escolha um local de rede personalizado</b> e, em seguida, clique em <b>Próxima</b>:
<p>href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_add_4.png',610,499,'Add Rede Location');\">
<img width = \" 250 \" height = \"205\" border = \"0 \" src = \"#TEMPLATEFOLDER# / images/en/network_add_4_sm.png \" style = \" cursor : pointer; \" alt = \"Clique para ampliar \" /></a></li>
<li>Aqui, na Internet ou rede endereço, digite a URL da pasta de mapeamento no formato:<i>http://your_server/docs/shared/</i>,</li>
<li>Clique <b>Próxima</b>. Se for solicitado um nome de <b>usuário</b> e <b>senha</b>, digite seu login e senha e clique em <b>OK</b>.</li>
</ul>

<p>A partir de agora, você pode acessar a pasta clicando <b>Executar > Nome de rede > Pasta</b>.</p>


<h4><a name=\"oswindowsmapdrive\"></a>Mapeamento da Biblioteca como uma unidade de rede</h4>
<div style=\"border:1px sólida #ffc34f; background: #fffdbe;padding:1em;\">
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
<tr>
<td style=\"border-right:1px sólida padding-right:1em;\">#FFDD9D;
<img height=\"18\" width=\"20\" src=\"/bitrix/components/bitrix/webdav.help/templates/.default/images/help.png\" border=\"0\"/>
</td>
<td style=\"padding-left:1em;\">
<b>Atenção! Windows XP e Windows Server 2003</b> não suportam HTTPS / SSL protocolo seguro. </td>
</tr>
</table>
</div>
<p>Para conectar uma biblioteca como um disco de rede no Windows 7 usando o <b>HTTPS / SSL</b> protocolo seguro: executar o comando <b>Iniciar > executar > cmd</b>. Na linha de comando, digite:<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tbody>
<td width=\"638\" valign=\"top\">
<p>net use z: https://<seu_servidor>/docs/shared//user:<userlogin>*</p>
</td></tr>
</tbody>
</table>
<br>
<p>Para conectar uma biblioteca como um disco de rede usando o gerenciador de arquivos:
<ul>
<li>Run Windows Explorer</b>;</li>
<li>Selecione Ferramentas <i>Mapear Unidade de Rede</i>. O assistente de disco de rede será aberta:
<br /><br /><a href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/network_storage.png',629,459,'Map Rede Drive');\">
<img width = \" 250 \" height = \" 183 \" border = \"0\" src = \"#TEMPLATEFOLDER#/images/en/network_storage_sm.png\" style=\"cursor : pointer; \" alt = \"Clique para ampliar \" /></a></li>
<li>Na <b>Unidade</b> campo, especifique uma carta para mapear a pasta para;</li>
<li><b>Na pasta</b>, digite o caminho para a biblioteca: <i>http://your_server/docs/shared/</i>. Se você quer essa pasta para estar disponível quando o sistema é iniciado, verifique a <b>Reconnect a opção</b> logon;</li>
<li>Clique <b>Pronto</b>. Se for solicitado um nome de usuário e senha, digite seu login e senha e clique em <b>OK</b>.</li>
</ul>
</p>
<p>Mais tarde, você pode abrir a pasta no Windows Explorer onde a pasta será mostrado como uma unidade em Meu computador, ou em qualquer gerenciador de arquivos.</p>

<h2><a name=\"osmacos\"></a>Conexão A Biblioteca no Mac OS e Mac OS X</h2>

<ul>
<li>Selecione <i>Localizador de Go ->Conectar ao Servidor comando</i>,</li>
<li>Digite o endereço da biblioteca em <b>Endereço do Servidor</b>:</p>
<p>href=\"javascript:ShowImg('#TEMPLATEFOLDER#/images/en/macos.png',465,550,'Mac OS X');\">
<img width = \" 235 \" height = \" 278 \" border = \"0\" src = \"#TEMPLATEFOLDER# / images / en / macos_sm.png \" style = \" cursor : pointer; \" alt = \"Clique para ampliar \" /></a></li>
</ul>
<br />

<h2><a name=\"maxfilesize\"></a>aumentar o tamanho máximo dos arquivos enviados</h2>

<p>Essencialmente, o tamanho máximo dos arquivos enviados é o valor de (<b>upload_max_filesize</b> ou <b>post_max_size</b>) variáveis PHP e os parâmetros dos componentes.</p>
<p>Para aumentar a cota de tamanho de arquivos, editar os seguintes valores em <b>php.ini</b>:</p>

<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
  <tbody>
      <td width=\"638\" valign=\"top\">
<p>upload_max_filesize = valor exigido;
<br/>post_max_size = mais do que upload_max_filesize;</p>
      </td></tr>
  </tbody>
</table>

<p>Se estiver usando virtual hosting, editar <b>htaccess</b>, assim:</p>

<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
  <tbody>
      <td width=\"638\" valign=\"top\">
<p>php_value upload_max_filesize<br/>valor necessário
php_value post_max_size mais de _upload_max_filesize</p>
      </td></tr>
  </tbody>
</table>

<p>É provável que você terá que entrar em contato com o administrador de hospedagem, a fim de aumentar os valores das variáveis do PHP (<b>upload_max_filesize</b> e <b>post_max_size</b>).</p>
<p>Depois as quotas foram aumentadas em PHP, edite os parâmetros de seus componentes em conformidade.</p>";
?>