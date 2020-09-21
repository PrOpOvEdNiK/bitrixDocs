<?
$MESS["CONTENT"] = "<div>Conteúdo:
  <ul>
    <li><a href=\"#bizproc\" title=\"O que é um negócio de Processos de Negócios?\">Processos de Negócios</a></li>
    <li><a href=\"#tipical\" title=\"O que são Processos?\">Processos de Negócios típicos de negócios mais comuns</a></li>
    <li><a href=\"#work\" title=\"Como criar um Processo de negócio?\">Criando um Processo de Negócios</a></li>
    <li><a href=\"#perfomance\" title=\"Como faço para executar um processo de negócio completo?\">Execução de um Processo de Negócio</a></li>
  </ul>
  
  <h1><a name=\"bizproc\"></a>Processos de Negócios</h1>
  <p>A noção de <b>Processos de negócios</b> refere-se a um instrumento para criar, manter e gerir os fluxos de informação.</p>
  <p><i><b>Processos de Negócios</b> é o fluxo de informações (ou documentos) por uma rota ou esquema definido. Um esquema de processo de negócio pode especificar:</i></p>
  <ul>
    <li>um ou mais <i>pontos de entrada e saída</i> (o início e fim do processo);</li>
    <li>uma seqüência <i>de ações (passos, etapas, funções)</i>, que será executado pelo algoritmo de processo de negócio.</li>
  </ul>
  <p>O mundo real assume uma ampla variedade de diferentes fluxos de informação, os sistemas que vão de simples a muito complexos. Um simples processo de publicação de um documento pode conter uma variedade de ações possíveis e garfos condicionais e podem exigir uma variedade de dados de entrada e notificações do usuário.</p>

  <p><b>Processos de negócio</b> permite que um usuário comum crie e editar qualquer variedade imaginável de combinações de informações e sistemas de fluxo de ação. O editor de processos de negócios foi desenvolvido para ser o mais simples possível, o que significa que um usuário regular de negócios, não um programador, será capaz de acessar uma ampla gama de funções e características. No entanto, a própria noção de processos de negócio implica que um nível mais do que a média de mentalidade analítica e um profundo conhecimento do que realmente está acontecendo dentro da empresa devem ser combinadas para obter o benefício integral de processos de negócios.</p>
  <p>O designer de processos de negócios na sua essência é um simples criador de bloco <b>arrastar e soltar</b>. Modelos de processos de negócios são criados em uma versão especializada do editor visual. Um autor de processo de negócio pode especificar as etapas do processo e sua sequência. Destacar os detalhes específicos para o processo usando esquemas visuais simples.</p>
  <p>Um fluxo de informação específica é definido pelo modelo de processo de negócio, que é composto de várias ações. Uma ação pode ser qualquer evento de sua escolha: a criação de um documento, enviar uma mensagem de e-mail, acrescentar um registro de banco de dados, etc.</p>
  <p>O sistema já contém dezenas de ações internas e alguns processos de negócios típicos que podem ser usados para modelar atividades empresariais mais comuns.</p>
  <p>Existem dois tipos mais comuns de processos de negócios:</p>
  <ul>
    <li>um <b>processo de negócio sequencial</b> para executar uma série de ações consecutivas de um documento, a partir de um ponto de partida pré-definida para um ponto final pré-definido;</li>
    <li>um <b>de processos de negócios status-driven</b>, que não tem um ponto inicial ou final, o estado do processo é alterado em tempo de execução do fluxo de trabalho. Tais processos de negócios podem, teoricamente, acabar a qualquer momento.</li>
  </ul>
  
  <h2>Business Process Sequential</h2>
  <p>O modo sequencial é geralmente usado para os processos que têm um ciclo de vida limitado e predefinido. Um exemplo típico disso é a criação e aprovação de um documento de texto. Qualquer processo sequencial normalmente inclui várias ações entre os pontos de início e término.</p>
  <p><img border=\"1\" alt=\"Exemplo: processo linear simples\" title=\"Exemplo: processo linear simples\" src=\"/images/bp/en/2.png\"/></p>

  <h2>Estado-driven Business Process</h2>

  <p>Uma abordagem Status-Driven é usada quando um processo não tem um período de tempo definido e pode repetir ou retornar a um estado dado, devido à natureza do processo (por exemplo: atualização contínua da documentação do produto). A situação aqui não é apenas um marcador para denotar o grau de progresso do documento, mas sim, que ele descreve um verdadeiro ciclo do processo mundial.</p>
  <p>A criação de um modelo de processo de status-driven não é tão simples como de um processo sequencial, mas abre amplas possibilidades para automatizar o processamento de informações. Um esquema típico para tais processos consiste de vários estados, que por sua vez incluem ações e condições de alteração de status.</p>
  <img border=\"1\" alt=\"Example: processo com statuses\" title=\"Example: processo com statuses\" src=\"/images/bp/en/3.png\"/>
  <p>Cada ação em um estado geralmente é um processo sequencial finito.</p>

  <h1><a name=\"tipical\"></a>Processos de Negócios típicos</h1>
  <p>O sistema é fornecido com vários processos de negócio típicos prontos para serem usados. Você pode adaptá-los para o seu fluxo de informação da empresa usando o designer visual de processos de negócios.</p>

  <h2>\"Aprovação Simples/Vote\" processo sequencial</h2>
  <p>Recomendada quando uma decisão deve ser feita por maioria simples de votos.</p>

  <h2>\"Primeiro de aprovação\" processo sequencial</h2>
  <p>Recomendada quando uma única aprovação ou a resposta (\"Preciso de um voluntário?\") é suficiente.</p>

  <h2>Aprovar documento com os Estados\" Processo de Estado-driven</h2>
  <p>Recomendado quando acordo mútuo é necessária para aprovar um documento.</p>

  <h2>\"Aprovação de dois estágios\" processo seqüencial</h2>
  <p>Recomendado quando um documento requer uma avaliação preliminar de especialistas antes de ser aprovado.</p>
  
  <h2>\"Opinião do Especialista\" Processo sequencial</h2>
  <p>Recomendado para situações em que uma pessoa que aprova ou rejeita um documento precisa de comentários de especialistas sobre ele. </p>

  <h2>\"Ler documento\" processo sequencial</h2>
  <p>Recomendada quando os funcionários têm de se familiarizar com um documento.</p>
  <p>Você pode visualizar os processos de negócios (padrão e definido pelo usuário) relacionados a um determinado tipo de documento clicando no botão <b>Mais</b> e selecionando os processos de negócios <b></b> no menu: </p>
  <p><img border=\"1\" src=\"/images/bp/en/4.png\" alt=\"Visualizar Processos de Negócio\" title=\"Visualizar Processos de Negócio\"/></p>
  <p>Isto irá abrir a página <b>Business Process Templates</b> na qual você pode editar processos existentes e criar novos processos.</p>
  <p><img border=\"1\" src=\"/images/bp/en/11.png\" processos alt=\"business page\" processos title=\"Business page\"/></p>

  <h1><a name=\"work\"></a>Criação de um Business Process</h1>
  <p>Para criar e editar um processo de negócio, você vai usar um editor de processos de negócios visual.</p>
  <p>Antes de criar um processo de negócio, você deve selecionar o tipo de processo: sequencial ou status-driven, que vai definir o layout do editor visual. O tipo pode ser selecionado usando os controles da barra de ferramentas de contexto do formulário <b>Business Process Templates</b>.</p>
  <p>O primeiro passo a tomar ao criar um processo de negócio é definir os parâmetros. Os parâmetros do processo são dados que podem ser acessados em qualquer comando, ação ou condição. Tendo os parâmetros definidos você pode avançar e criar o processo.</p>
  <img border=\"1\" processo title=\"Configurações de Parâmetros\" processo alt=\"Setting parameters\" src=\"/images/bp/en/6.png\"/>

  <h2>Criar um processo de Estado-Driven</h2>
  <p>Primeiramente, crie e configure os status necessários usando o botão Adicionar do Estado. Em seguida, crie comandos para cada estado. Cada comando representa um processo sequencial separado.</p>
  <img border=\"1\" src=\"/images/bp/en/7.png\" ações alt=\"Assigning em ações title=\"Assigning statuses\" em statuses\"/>

  <h2>Criação de um processo sequencial</h2>
  <p>Quando você cria um processo sequencial, o editor visual mostra um conjunto personalizável de ações.</p>
  <p>O editor visual utiliza a técnica de drag-and-drop popular para adicionar ações. Depois de ter adicionado um comando, configure os parâmetros do comando. Cada comando tem um diálogo exclusivo parâmetros.</p>
  <img border=\"1\" title=\"Adicionando ações no editor visual\" alt=\"Adicionando Ações no Editor Visual\" src=\"/images/bp/en/8.png\" /><br /><br />

  <h1><a name=\"perfomance\"></a>Execução de um Processo de Negócio</h1>
  <p>Um processo de negócio pode ser executado manualmente ou automaticamente, dependendo de seus parâmetros. O modo de lançamento não afeta a execução. Um processo pode ter várias instâncias, cada uma funcionando de forma independente.</p>
  <p>Para executar um processo de negócio em um documento específico, clique no processo <b>Novos Negócios</b> comando no menu de ação do documento e selecione o processo de negócio desejado na lista.</p>
  <img border=\"1\" src=\"/images/bp/en/5.png\" alt=\"Lançando um processo de negócio para um documento\" title=\" Lançando um processo de negócio para um documento \"/>
  <p>Depois que janela de parâmetros do processo de negócios, abriu, especifique os parâmetros e clique em <b>Início</b>.</p>
  <img border=\"1\" title=\"Configurando um Processo de Negócio\" alt=\" Configurando um Processo de Negócio \" src=\"/images/bp/en/9.png\"/>
  <p>Se um processo de negócio oferece opções de notificação, uma notificação será enviada a um empregado quando o processo chega a um ponto em que o empregado deve realizar alguma ação. Para exibir e executar as tarefas atribuídas pelo processo de negócio funcionando, o usuário pode clicar nos <b>Processos de Negócios</b> link no menu à esquerda sob o <b>Meu Site</b> grupo.</p>
</div>";
$MESS["TITLE"] = "Processos de Negócios";
?>