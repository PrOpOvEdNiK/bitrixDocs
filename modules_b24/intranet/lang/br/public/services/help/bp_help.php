<?
$MESS["SERVICES_INFO"] = "<div> Conteúdo:
  <ul>
    <li> <a href='#Introdução' title=\"Descrição Geral\">Fluxo de trabalho e Processos de Negócio</a></li>

    <li> <a href='#workflow' title=\"O que se entende por 'Fluxo de trabalho'?\">fluxo de trabalho</a></li>

    <li> <a href='#bizproc' title=\"O que é um processo?\">processos de negócio</a></li>

    <li> <a href='#tipical' title=\"Que processos de negócio típicos são Incluso?\">Processos de Negócios típicos</a></li>

    <li> <a href='#work' title=\"Como criar um processo de negócios\">Criando um Processo de Negócios</a></li>

    <li> <a href='#perfomance' title=\"Como é um processo de negócio concluido?\">Execução de um Processo de Negócio</a></li>
   </ul>

  <br/>

  <h1> <a name='introduction'></a> de fluxo de trabalho e processos de negócio</h1>

  <p><b>Bitrix Intranet</b> inclui os dois módulos seguintes que permitem
  trabalho em equipe no contexto do portal intranet. </p>

  <ul>
    <li> O <b>fluxo de trabalho</b> módulo fornece instruções passo- a-passo
    processamento de páginas estáticas ou dinâmicas e informações. Este módulo é
      incluído em todas as edições do produto. </li>

    <li> O Processo <b>Negócios</b> módulo suporta simples, passo -a-passo
      bloco de informação de processamento de elementos ( um separado linear de tempo limitado
      processo ), bem como variável ou processos baseados em status. este
      módulo está incluído como <b>processos típicos</b> módulo em juniores
      edições. A versão completa, que fornece ferramentas para criar novos processos, está incluído na <b>Bitrix Intranet :
      Enterprise Edition</b>. </li>
   </ul>

  <p>Como implementar essas ferramentas de fluxo de trabalho de gerenciamento de processos de forma otimizada sobre o tipo de
  documentos que circulam na empresa, e deve ser determinada pelo responsável
  para a integração de processos de negócios. A implementação pode ser feito por um administrador do portal. </p>

  <h1> <a name='fluxo de trabalho'></a> Fluxo de Trabalho</h1>
<p>O <b>fluxo de trabalho</b> módulo facilita o processamento de documentos linear. Este módulo é apropriado quando um documento simplesmente precisa passar por uma série de etapas consecutivas, até atingir o seu estado final (por exemplo, publicação). </p>

  <p>Por padrão, o fluxo de trabalho <b></b> módulo fornece três estados que são suficientes
  para o esquema de fluxo de trabalho mais simples. No entanto, projetos reais no mundo real irá normalmente
  requerem a adição de status personalizados. Status personalizados podem ser criados por um
  administrador do portal ou por pessoas permissões para criar status dado. </p>
 <img border='1' title='Documents e alt='Documents statuses' e statuses' src='#SITE_DIR#images/bp/1.png' />
  <p>O <b>fluxo de trabalho</b> módulo suporta a atribuição dos responsáveis pela
  mover um documento de um estado para outro, bem como permitindo que você listar pessoas autorizadas a editar uma
  documento enquanto ele está em um determinado estado. O módulo pode manter as versões históricas de uma copia do documento
  antes as alterações são salvas, dependendo das configurações. Apenas um portal
  administrador pode alterar as configurações do módulo. </p>

  <h1> <a name='bizproc'></a> processos de negócios</h1>

  <p>os processos <b>Negócios</b> módulo é uma extensa instrumento para criar,   executar e gerir os fluxos de informação. Este módulo oferece muito mais
  capacidade de gestão da informação do que <b>fluxo de trabalho</b>. </p>

  <p><i><b>Processo de Negócios </b> é o fluxo de informações (ou documentos ) através de uma
  rota ou esquema definido. Um esquema de processo de negócio pode especificar :</i> </p>

  <ul>
    <li> <i>um ou vários pontos de entrada e saída;</i> </li>
    <li> <i>seqüência de ações (passos, etapas, funções ), a serem cumpridas em uma ordem atribuída ou sob certas condições.</i> </li>
   </ul>

  <p>O mundo real vai exigir flui muitas informações diferentes, desde o mais simples ao mais muito complicado.   O simples processo de publicação de um documento pode conter um
  variedade de ações possíveis e garfos condicionais e podem exigir uma variedade de entrada
  de dados e de usuários notificações. </p>

  <p>Os Processos <b>Negócios</b> módulo fornece uma interface de usuário para criar e
  editar processos de negócios. Este editor é tão simples como ele pode ser, mas não mais simples, o que significa que um usuário regular de negócios será capaz de acessar uma ampla gama de funcionalidades. No entanto, a própria noção de negócio
  processos implica que um alto nível de destreza analítica e conhecimento profundo do que realmente está acontecendo dentro da empresa devem ser combinados para obter o benefício integral deste recurso. </p>

  <p>O designer de processos de negócios em
  essência é um simples arrastar <b>visual e criador queda</b> bloco. negócio
  modelos de processo são criados em uma versão especializada do editor visual. A
  processo comercial autor pode especificar as etapas do processo e a sua sequência, bem como realçar os detalhes específicos do processo usando
  sistemas visuais simples. </p>
<p>O fluxo de informação específica é definida pelo processo de negócio
  molde, o qual é constituído por um conjunto de ações. Uma ação pode ser qualquer evento
  de sua escolha : a criação de uma criação; envio de uma mensagem de e-mail; fazer um registro de banco de dados
  etc</p>

  <p>O pacote de distribuição do produto contém dezenas de ações internas e
  alguns processos comerciais típicos que podem ser utilizados para modelar mais comum
  atividades. </p>

  <p>Existem os dois tipos de processos de negócios gerais, e os processos de negócio módulo suporta ambos: </p>

  <ul>
    <li> <b>processos de negócios sequencial</b> - para realizar uma série de ações consecutivas de um documento,
      a partir de um ponto de partida pré-definido para um ponto final pré-definido; </li>

    <li> <b>processo de negócio impulsionado pelo Estado</b> não tem um início ou fim
      ponto; o fluxo de trabalho muda o status do processo. Tais processos de negócios
      pode, teoricamente, acabamento em qualquer fase. </li>
   </ul>

  <h2> <b>Sequencial de Processos de Negócios</b> </h2>

  <p>O modo sequencial é geralmente usado para os processos que têm um número limitado e predefinido
  ciclo de vida. Um exemplo típico disso é a criação e aprovação de um texto
  documento. Qualquer processo sequencial normalmente inclui várias ações entre o
  pontos de início e fim. </p>

  <p><img border='1' alt='Example: simples title='Example: processo de 'Simples processo linear' src='#SITE_DIR#images/bp/2.png' /> </p>

  <h2> Estado -impulsionado Processos de Negócios</h2>

  <p>A abordagem orientada para o estado é usado quando um processo não tem um tempo definido
  quadro e pode repetir ou retornar a um determinado estado, devido à natureza da
  o processo ( por exemplo : a atualização contínua de produto
  documentação). Um status aqui não é apenas um marcador sobre
  grau de documento de prontidão; em vez disso, descreve uma verdadeira
  ciclo do processo mundial. </p>

  <p>A criação de um modelo de processo orientado a estado não é tão simples como para
  um processo sequencial, mas abre amplas possibilidades para automatizar informações
  processamento. Um regime típico de tais processos consiste em vários estados
  que por sua vez incluem ações e condições de alteração de status. </p>
 <img border='1' alt='Example: processo com processo title='Example: statuses' com statuses' src='#SITE_DIR#images/bp/3.png' />
  <p>Cada ação em um estado geralmente é um processo sequencial finito. </p>

  <h1> <a name='tipical'></a> Processos de Negócios típicos</h1>

  <p>Os processos de negócio mais comuns estão incluídas nas edições júnior ( <b>Bitrix Intranet : Office Edition</b> e <b>Bitrix Intranet : Extranet Edição</b> ) como somente leitura construções. você pode
  configurá-los para lidar com os documentos necessários, mas não pode alterar a lógica.   O <b>Bitrix Intranet :
      Enterprise Edition</b> inclui um editor visual em que você
  pode editar modelos padrão e criar seus próprios processos de negócio. </p>
' Aprovação Simples / Votar ' <h2>processo sequencial</h2>

  <p>recomendada quando uma decisão deve ser feita por maioria simples de votos. </p>

  \"Primeiro de Aprovação ' <h2>processo sequencial</h2>

  <p>recomendada quando uma única aprovação ou de resposta ( \" Preciso de um voluntário ... ' ) é suficiente. </p>

  <h2> \"Aprovar documento com os Estados \" Processo impulsionado pelo Estado</h2>

  <p>recomendada quando acordo mútuo é necessária para aprovar um documento. </p>

  <h2> \"Aprovação de dois estágios \" Processo sequencial</h2>

  <p>recomendada quando um documento requer uma avaliação preliminar de especialistas antes de ser aprovado. </p>

  <h2> \" Opinião Expert\" Processo sequencial</h2>

  <p>Recomendado para situações em que uma pessoa que é para aprovar ou rejeitar um documento precisa de comentários de especialistas sobre ele. </p>

  <h2> \"Ler Documento \" Processo sequencial</h2>

  <p>recomendada quando os funcionários estão a familiarizar-se com um documento. </p>
  Você pode ver os processos de negócios (padrão e definidos pelo usuário ) relacionado a um
  determinado tipo de documento clicando <img src='#SITE_DIR#images/bp/4.png' alt='Business processa processos title='Botão Negócios 'botão' />
  , que abrirá as <b>modelos de processo de negócio</b> página onde você pode editar
  existentes e criar novos processos.
  <p> <img border='1' src='#SITE_DIR#images/bp/11.png' alt='Business processa processos title='Business page' page' />
  <h1> <a name='work'></a> A criação de um Processo de negócios</h1>

  <p>Para criar e editar os processos de negócios, você vai precisar do visual especial
  editor incluídos apenas na <b>Bitrix Intranet :
      Enterprise Edition</b> só. </p>

  <p>Antes de criar um processo de negócio, você tem que selecionar o tipo de processo :
  sequencial ou orientada por status, que irá definir o layout do visual
  editor. O tipo pode ser selecionado usando os controles da barra de ferramentas de contexto do <b>Negócios
  Modelos de processo</b> formulário. </p>

  <p>O primeiro passo na criação de um processo de negócio é definir os parâmetros. o
  parâmetros do processo são dados que podem ser acessados em qualquer comando, ação ou
  condição. Tendo os parâmetros definidos podem prosseguir e criar o
  processo. </p>
 <img border='1' title='Definição de processo' alt='Definição de parâmetros' src='#SITE_DIR#images/bp/6.png' />

  <h2> Criando um processo impulsionado pelo Estado</h2>

  <p>Primeiro de tudo, criar e configurar os status necessários usando o botão Adicionar do Estado. Em seguida, crie
  comandos para cada estado. Cada comando representa um sequencial separado
  processo. </p>
   ações <img border='1' src='#SITE_DIR#images/bp/7.png' alt='Assigning em ações title='Assigning statuses' em statuses' />
<h2>Criando um processo sequencial</h2>

  <p>Quando você cria um processo sequencial, o editor visual mostra uma
  conjunto personalizável de ações. </p>

  <p>O editor visual utiliza a técnica de arrastar e soltar popular para adicionar
  ações. Tendo acrescentado um comando, configure seus parâmetros. Cada comando tem um
  diálogo parâmetros únicos. </p>
 <img border='1' title='Adicionar ações nas ações alt='Adicionar visual' visuais no Visual editor' src='#SITE_DIR#images/bp/8.png' />
  <h1> <a name='perfomance'></a> Execução de um Processo de Negócio</h1>

  <p>Criado (ou já existente) processo de negócio pode ser executada manualmente ou
  automaticamente, dependendo de seus parâmetros. esta escolha
  não afeta a execução. Um processo pode ter várias instâncias, cada uma
  funcionando independentemente. </p>

  <p>Para executar um processo de negócio em um documento específico, selecione o <b>Nova
  Business Process</b> comando no menu de ação do documento e selecione o
  processo de negócio desejado na lista. </p>
 <img border='1' src='#SITE_DIR#images/bp/5.png' alt='Launching um processo de negócio para um document' title='Lançamento de um processo de negócio para um documento' />
  <p>Quando uma janela de parâmetros de processos de negócios abre, especifique os parâmetros e
  clique <b>Início</b>. </p>
 <img border='1' title='Definir um processo' negócio alt='Definir um Processo de negócios' src='#SITE_DIR#images/bp/9.png' />
  <p>Se um processo de negócio oferece opções de notificação, uma notificação será enviada a um empregado quando o processo chega a um ponto em que o empregado dado deve executar alguma ação. Para exibir e executar as tarefas atribuídas, a pessoa pode
  abrir a Processos <b>Negócios</b> na sua página pessoal. </p>
 </div>";
$MESS["SERVICES_TITLE"] = "Processos de Negócio";
?>