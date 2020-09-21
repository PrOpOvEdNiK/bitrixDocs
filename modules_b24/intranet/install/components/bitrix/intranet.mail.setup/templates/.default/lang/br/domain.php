<?
$MESS["INTR_MAIL_AJAX_ERROR"] = "Erro na execução de da query";
$MESS["INTR_MAIL_CHECK_JUST_NOW"] = "segundos atrás";
$MESS["INTR_MAIL_CHECK_TEXT"] = "Última verificação em #DATE#";
$MESS["INTR_MAIL_CHECK_TEXT_NA"] = "Não há informação sobre o status do domínio";
$MESS["INTR_MAIL_CHECK_TEXT_NEXT"] = "Proxima verificação de e-mails: #DATE#";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM"] = "Você quer desvincular o domínio?";
$MESS["INTR_MAIL_DOMAINREMOVE_CONFIRM_TEXT"] = "Você deseja desanexar o domínio?<br>Todas as caixas de correio anexadas ao portal também serão desanexadas!";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME"] = "nome inválido";
$MESS["INTR_MAIL_DOMAIN_BAD_NAME_HINT"] = "O nome do domínio pode incluir caracteres latinos, dígitos e hífens; não pode começar ou terminar com um hífen ou repetir o hífen nas posições 3 e 4. Terminar o nome com <b>.com</b>.";
$MESS["INTR_MAIL_DOMAIN_CHECK"] = "Verificar";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_HINT"] = "Escolha um nome em domínio .com";
$MESS["INTR_MAIL_DOMAIN_CHOOSE_TITLE"] = "Escolher Domínio";
$MESS["INTR_MAIL_DOMAIN_EMPTY_NAME"] = "inserir nome";
$MESS["INTR_MAIL_DOMAIN_EULA_CONFIRM"] = "Eu aceito os termos do <a href=\"http://www.bitrix24.ru/about/domain.php\" target=\"_blank\">Contrato de Licença</a>";
$MESS["INTR_MAIL_DOMAIN_HELP"] = "Se você não tem seu domínio configurado para uso com o E-mail Hospedado no Yandex, faça isso agora.
<br/><br/>
- <a href=\"https://passport.yandex.com/registration/\" target=\"_blank\">Crie uma conta de E-mail Hospedada no Yandex</a> or use uma caixa de correio existente se você tem uma.
- <a href=\"https://pdd.yandex.ru/domains_add/\" target=\"_blank\">Anexe seu domínio</a> a um E-mail Hospedado no Yandex<sup> (<a href=\"http://help.yandex.ru/pdd/add-domain/add-exist.xml\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup><br/>
- Verifique a propiedade do seu domínio <sup>(<a href=\"http://help.yandex.ru/pdd/confirm-domain.xml\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup><br/>
- Configure registros MX <sup>(<a href=\"http://help.yandex.ru/pdd/records.xml#mx\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup> ou delefate seu domínio para Yandex <sup>(<a href=\"http://help.yandex.ru/pdd/hosting.xml#delegate\" target=\"_blank\" title=\"How do I do it?\">?</a>)</sup>
<br/><br/>
Uma vez que sua conta de E-mail Hospedado no Yandex foi configurada, anexe o domínio ao seu Bitrix24:
<br/><br/>
- <a href=\"https://pddimp.yandex.ru/api2/admin/get_token\" target=\"_blank\" onclick=\"window.open(this.href, '_blank', 'height=480,width=720,top='+parseInt(screen.height/2-240)+',left='+parseInt(screen.width/2-360)); return false; \">Pegue um token</a> (preencha os campos do formulário e clique em \"Get token&quot;. Uma vez que o token aparece, copie-o para a Área de Transferência)<br/>
- Adicione o domínio e o token aos parâmetros.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1"] = "Passo&nbsp;1.&nbsp;&nbsp;Confirme a propriedade do domínio";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_A"] = "Fazer upload de um arquivo chamado <b>#SECRET_N#.html</b> para o diretório raiz do site. O arquivo deve conter o texto: <b>#SECRET_C#</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B"] = "Para configurar o registro CNAME, você precisa ter permissão de gravação nos registros de DNS do seu domínio em um registrador ou serviço de hospedagem web, aquele em que você registrou esse domínio. Você vai encontrar essas configurações em sua conta ou no painel de controle do serviço.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAME"] = "Nome de registro: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_NAMEV"] = "<b>yamail-#SECRET_N#</b> (ou <b>yamail-#SECRET_N#.#DOMAIN#.</b>, que depende da interface. Observe o ponto no final.)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_PROMPT"] = "Especifique os seguintes valores:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_TYPE"] = "Tipo de registro: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUE"] = "Valor: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_B_VALUEV"] = "<b>mail.yandex.ru.</b> (atenção ao ponto final)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C"] = "Defina o endereço de e-mail em suas informações de registro de domínio para <b>#SECRET_N#@yandex.ru</b>. Use o painel de controle do seu registro de domínio para definir o endereço de e-mail.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_C_HINT"] = "Altere este endereço para seu e-mail real assim que o domínio for confirmado.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_HINT"] = "Se você tem alguma dúvida verificar sua propriedade do domínio, por favor contate o serviço de suporte em <a href=\"http://www.bitrixsoft.com/support/\" target=\"_blank\">www.bitrixsoft.com/support/</a>.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_OR"] = "ou";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP1_PROMPT"] = "Você precisa confirmar que você é proprietário desse domínio por meio de um dos seguintes métodos:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2"] = "Passo&nbsp;2.&nbsp;&nbsp;Configure os registros MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_HINT"] = "Exclua todos os outros registros MX e TXT que não estiverem relacionados a Yandex. As alterações feitas em registros MX podem levar de algumas horas a três dias para serem atualizados toda a Internet.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_MXPROMPT"] = "Criar um novo registro MX com os seguintes parâmetros:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAME"] = "Nome de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_NAMEV"] = "<b>@</b> (ou <b>#DOMAIN#.</b> - se necessário. Observe o ponto no final)";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PRIORITY"] = "Prioridade: ";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_PROMPT"] = "Depois de ter confirmado a sua propriedade do domínio, você terá que alterar os registros MX correspondentes no seu web hosting.";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TITLE"] = "Configurar registros MX";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_TYPE"] = "Tipo de registro:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUE"] = "Valor:";
$MESS["INTR_MAIL_DOMAIN_INSTR_STEP2_VALUEV"] = "<b>mx.yandex.net.</b>";
$MESS["INTR_MAIL_DOMAIN_INSTR_TITLE"] = "Para conectar o seu domínio ao Bitrix24, existem algumas etapas.";
$MESS["INTR_MAIL_DOMAIN_LONG_NAME"] = "máximo 63 caracteres antes .com";
$MESS["INTR_MAIL_DOMAIN_NAME_FREE"] = "este nome é válido";
$MESS["INTR_MAIL_DOMAIN_NAME_OCCUPIED"] = "este nome não é válido";
$MESS["INTR_MAIL_DOMAIN_NOCONFIRM"] = "Domínio não confirmado";
$MESS["INTR_MAIL_DOMAIN_NOMX"] = "Registros MX não configurados";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TEXT"] = "Uma vez conectado, você não poderá alterar o nome do domínio<br>ou obter outro porque você pode registrar<br>apenas um domínio para seu Bitrix24.<br><br>Se você achar que o nome <b>#DOMAIN#</b> está correto, confirme seu novo domínio.";
$MESS["INTR_MAIL_DOMAIN_REG_CONFIRM_TITLE"] = "Verifique se você inseriu o nome do domínio corretamente.";
$MESS["INTR_MAIL_DOMAIN_REMOVE"] = "Desvincular";
$MESS["INTR_MAIL_DOMAIN_SAVE"] = "Salvar";
$MESS["INTR_MAIL_DOMAIN_SAVE2"] = "Anexar";
$MESS["INTR_MAIL_DOMAIN_SETUP_HINT"] = "O nome do domínio pode levar de 1 hora até vários dias para confirmar.";
$MESS["INTR_MAIL_DOMAIN_SHORT_NAME"] = "ao menos dois caracteres antes .com";
$MESS["INTR_MAIL_DOMAIN_STATUS_CONFIRM"] = "Confirmado";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOCONFIRM"] = "Não confirmado";
$MESS["INTR_MAIL_DOMAIN_STATUS_NOMX"] = "Registros MX não configurados";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE"] = "Status do link de Domínio";
$MESS["INTR_MAIL_DOMAIN_STATUS_TITLE2"] = "Domínio confirmado";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_MORE"] = "Mostrar outras opções";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_TITLE"] = "Coloque outro nome ou escolha um";
$MESS["INTR_MAIL_DOMAIN_SUGGEST_WAIT"] = "Buscando nomes possíveis...";
$MESS["INTR_MAIL_DOMAIN_TITLE"] = "Se o seu domínio está configurado para trabalhar em Yandex.Mail para domínios, basta digitar o nome do domínio e o token no formulário abaixo";
$MESS["INTR_MAIL_DOMAIN_TITLE2"] = "O domínio está vinculado ao seu portal";
$MESS["INTR_MAIL_DOMAIN_TITLE3"] = "Domínio para o seu e-mail";
$MESS["INTR_MAIL_DOMAIN_WAITCONFIRM"] = "Aguardando confirmação";
$MESS["INTR_MAIL_DOMAIN_WAITMX"] = "Registros MX não configurados";
$MESS["INTR_MAIL_DOMAIN_WHOIS"] = "Verificar";
$MESS["INTR_MAIL_GET_TOKEN"] = "obter";
$MESS["INTR_MAIL_INP_CANCEL"] = "Cancelar";
$MESS["INTR_MAIL_INP_DOMAIN"] = "Nome de domínio";
$MESS["INTR_MAIL_INP_PUBLIC_DOMAIN"] = "Os colaboradores podem criar caixas de e-mail neste domínio";
$MESS["INTR_MAIL_INP_TOKEN"] = "Token";
$MESS["INTR_MAIL_MANAGE"] = "Configurar a caixa de e-mail dos colaboradores";
?>