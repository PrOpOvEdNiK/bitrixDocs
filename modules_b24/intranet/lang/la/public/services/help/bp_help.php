<?
$MESS["SERVICES_INFO"] = "<div> Contenido:
  <ul>
    <li><a href='&#35;introduction' title='Descripción General'>Workflow y Business Processes</a></li>

    <li><a href='&#35;workflow' title=\"¿qué quiere decir 'workflow'?\">Workflow</a></li>

    <li><a href='&#35;bizproc' title='¿qué es un business process?'>Business Processes</a></li>

    <li><a href='&#35;tipical' title='¿Cuáles son los típicos business processes incluidos?'>Business Processes típocos</a></li>

    <li><a href='&#35;work' title='¿cómo crear un business process'>Creando un Business Process</a></li>

    <li><a href='&#35;perfomance' title='¿cómo ejecutar un business process?'>Ejecutando un Business Process</a></li>
  </ul>

  <br />

  <h1><a name='introduction'></a>Workflow y Business Processes</h1>

  <p><b>Bitrix Intranet</b> incluye estos dos módulos, los mismos que permiten un trabajo en equipo en el contexto del portal de intranet.</p>

  <ul>
    <li> El módulo <b>Workflow</b> provee procesos step-by-step
    sobre páginas estáticas o información dinámica. Este módulo se incluye en todas las ediciones de Bitrix Intranet.</li>

    
    <li> El módulo  <b>Business Process</b> soporta, tanto procesos simples y step-by-step
      sobre elementos de un bloque de información (procesos lineales independiente y limitados por el tiempo) como también procesos definidos sobre variables de estatus. Este módulo se incluye en las ediciones menores mediante plantillas de procesos típicos. Las versiones completas y más avanzadas del software incluyen el diseñador de <strong>Business Process</strong>, con las cuales el usuario podrá crear nuevos procesos.</li>
  </ul>

  <p>¿Cómo implementar las herramientas de WorkFlow y Business Process de manera óptima sobre los diferentes tipos de documentos que circulan en la compañía? Deberían ser determinado por la persona responsable de la integración de procesos de negocio. La implementación puede ser realizada por un administrador del portal.</p>

  <h1><a name='workflow'></a>Workflow</h1>

  <p>El módulo <strong>WorkFlo</strong>w facilita el procesamiento de documentos lineal. Este módulo es apropiado cuando un documento sólo tiene que pasar por una serie de pasos consecutivos hasta llegar a su estado final (por ejemplo, la publicación).</p>
  <p>Por defecto, el módulo <strong>WorkFlow</strong> proporciona tres estados que son suficientes para un esquema de WorkFlow sencillo. Sin embargo, los proyectos del mundo real, por lo general, requieren la adición de estados personalizados. Los estados personalizados pueden ser creados por un administrador del portal o por usuarios a quieres se les ha otorgado permisos para crear estados.</p>
 <img border='1' title='Documentos y estatus' alt='Documentos y estatus' src='#SITE_DIR#images/bp/1.png' />
  <p>El módulo <strong>Workflow</strong> es compatible con la asignación de responsables de mover un documento a partir de un estado a otro, así como dejar que usted defina las personas autorizadas para editar un documento mientras este se encuentra en un estatus determinado. Dependiendo de la configuración, el módulo puede mantener el histórico de versiones del documento antes de guardar los cambios. Sólo un administrador del portal puede cambiar los ajustes del módulo.</p>

  <h1><a name='bizproc'></a>Business Processes</h1>

  <p>El concepto de  <b>business process</b> se refiere a un instrumento para crear, mantener y administrar flujos de información.</p>

  <p><i>Un <b>Business Process</b> es el flujo de información (o documentos) por un esquema o ruta predefinida. Un esquema de business process puede especificar:</i></p>
  <ul>
    <li>uno o más puntos de <em>entrada</em> o <em>salida </em>(el proceso se inicia o termina); </li>
    <li>una secuencia de acciones <i>(pasos, etapas, funciones)</i> las cuales serán ejecutadas por el algoritmo del business process. </li>
  </ul>
  <p>El mundo real supone una amplia gama de diferentes flujos de información, esquemas que van desde los muy simples a los muy complejos. Un simple proceso de publicación de un documento puede contener una variedad de posibles acciones y condiciones, además puede requerir una variedad de datos de entrada y comunicación con los involucrados.</p>

  <p><br>
  Los <strong>Business Process</strong> (procesos de negocio) permiten a un usuario común, crear y editar, cualquier variedad imaginable de combinaciones de esquemas y flujos de información y acciones sobre ella. El editor de procesos de negocio ha sido desarrollado para ser lo más simple posible, lo que significa que un usuario estándar del negocio (no necesariamente un programador) podrá acceder a una amplia gama de funciones y características. Sin embargo, la noción misma de los procesos de negocio implica que un nivel superior al promedio de mentalidad analítica y un profundo conocimiento de lo que realmente está pasando dentro de la empresa se combinen entre sí para sacar el máximo provecho posible a los procesos de negocio.</p>
<p>El diseñador de procesos de negocio, en esencia, es un bloque de creación visual con funciones jalar y soltar. Plantillas de procesos de negocios son creadas en una versión especializada del editor visual. Un autor de procesos de negocio puede especificar los pasos del proceso y su respectiva secuencia; resaltar los detalles específicos del proceso utilizando esquemas visuales simples.</p>
<p>Un flujo de información específica se define por la plantilla de procesos de negocio, que se compone de múltiples acciones. Una acción puede ser cualquier evento de su elección: la creación de un documento; el envío de un mensaje de correo electrónico; la adición de un registro a la base de datos, etc.</p>
<p>El sistema ya contiene docenas de acciones integradas y algunos procesos de negocio típicos que pueden ser utilizados para modelar las actividades de negocio más comunes.</p>
<p>Existen dos tipos de business processes: </p>
 <ul>
    <li><b>Business process</b><strong> secuencial </strong>para realizar un serie consecutiva de acciones sobre un documento, desde un punto de partida hasta un punto final predefinidos; </li>
    <li><b>Business process manejados por estatus;</b> los mismos que no cuentan con un punto de inicio y salida establecidos, y donde el proceso cambia según el estatus según la rutina del wokflow. Estos procesos de negocio pueden, en teoría, culminar en cualquier estado del proceso.</li>
  </ul>

  <h2>Business Process Secuencial</h2>

  <p>El modelo secuencial es generalmente usado por procesos que tienen un ciclo de vida predefinido. Un ejemplo típico de este tipo de procesos es la creación y aprobación de documentos de texto. Cualquier proceso secuencial usualmente incluye varias acciones entre el inicio y final del proceso.</p>

  <p><img border='1' alt='Ejemplo: proceso lineal simple' title='Ejemplo: proceso lineal simple' src='#SITE_DIR#images/bp/2.png' /></p>
  <p>&lt;h2&gt;Business Process manejado por estatus&lt;/h2&gt;</p>
  <p>&lt;p&gt;Un enfoque de conducido por estatus se utiliza cuando un proceso no tiene un plazo definido y se puede repetir o volver a un estado determinado, debido a la naturaleza del proceso (por ejemplo: la actualización continua de la documentación del producto). Un estatus aquí no es sólo un marcador para indicar el grado progreso en la documentación de un producto; sino que describe un ciclo continuo de procesos del mundo real.&lt;/p&gt;<br />
  &lt;p&gt;La creación de una plantilla de proceso manejado por estatus no es tan simple como la de un proceso secuencial, pero nos abre amplias posibilidades para automatizar el procesamiento de información. Un esquema típico de este tipo de procesos consiste en varios estados que a su vez incluyen acciones y condiciones de cambio de estado.&lt;/p&gt;</p>
  <img border='1' alt='Ejemplo: proceso con estatus' title='Ejemplo: proceso con estatus' src='#SITE_DIR#images/bp/3.png' />
  <p>Cada acción en un estado es generalmente un proceso secuencial finito.</p>

  <h1><a name='tipical'></a>Business Processes Típicos</h1>
<p>El sistema es entregado con varias business processes típico listos para usar los mismos que pueden ser adaptados por usted para acondicionarlos a los flujos de información de su compañía.</p>
  <h2>Proceso secuencial de \"Aprobación Simple/Votación&quot;</h2>

  <p>Recomendable cuando una decisión será tomada por una mayoría simple de votos</p>

  <h2>Proceso secuencial de \"Primera aprobación\"</h2>

  <p>Recomendable cuando una simple aprobación o respuesta (&quot;Necesito un voluntario&quot;) es suficiente.</p>

  <h2>Proceso manejado por estatus de &quot;Aprobación de documento por Estatus</h2>

  <p>Recomendado cuando un acuerdo mutuo es requerido para aprobar un documento.</p>

  <h2>Proceso secuencial de &quot;Aprobación de 2 pasos&quot;</h2>

<p>Recomendado cuando un documento requiere una evaluación previa de un experto antes de ser aprobado.</p>

  <h2>Proceso secuencial de &quot;Opinión de experto&quot;</h2>

  <p>Recomendado en situaciones en las que una persona quien aprobará o rechazará un documento requiere el comentario u opinión de un experto.</p>

  <h2>Proceso secuencial de &quot;Lectura de documentos&quot;</h2>

  <p>Recomendado cuando es requerido que los empleados se familiaricen con un documento.</p>
  <p>Usted puede ver el business processes (standards y definidos por el usuario) relativos a cierto documento haciendo click en el botón<strong> más</strong> y seleccionado <b>Business processes</b> en el menú:</p> <img src='#SITE_DIR#images/bp/4.png' alt='Botón de Business processes' title='Botón de Business processes' />
 <p>Esto abrirá la página de <strong>Plantillas de Business Process</strong>, desde la que podrá editar procesos existentes y crear nuevos procesos.</p>
  <p><img border='1' src='#SITE_DIR#images/bp/11.png' alt='Página de Business processes' title='Página de Business processes' />
  <h1><a name='work'></a>Creando un Business Process</h1>

  <p>Para crear y editar un business process, usted necesita usar el editor visual de business process.</p>

  <p>Antes de crear un business process, usted tiene que seleccionar el tipo de proceso que seguirá: secuencial o manejado por estatus, lo que definirá el layout del editor visual. El tipo puede ser seleccionar usando los controles de la barra de herramientas contextual del formulario de <strong>Plantillas de Business Process</strong>.</p>

  <p>El primer paso a tomar cuando se crea un business process es definir los parámetros. Los parámetros del proceso son los datos que se puede acceder en cualquier comando, acción o condición. Teniendo los parámetros definidos, usted puede proceder a crear el proceso.</p>
 <img border='1' title='Configurando parámetros del proceso' alt='Configurando parámetros del proceso' src='#SITE_DIR#images/bp/6.png' />

  <h2>Creando un Proceso Dirigido por Estatus</h2>

  <p>Antes que nada, cree y configure el estatus requerido usando el botón &quot;Agregar Estatus&quot;. Luego cree comandos para cada estatus. Cada comando representará una secuencia separada del proceso.</p>
  <img border='1' src='#SITE_DIR#images/bp/7.png' alt='Asignando acciones a los estatus' title='Asignando acciones a los estatus' />

  <h2>Creando un Proceso Secuencia</h2>

  <p>Cuando usted crea un proceso secuencial, el editor visual mostrará un conjunto de acciones personalizables.</p>

  <p>El editor visual usa la popular técnica de jalar y soltar para poder adicionar acciones. Teniendo adicionado un comando, configure los parámetros del comando. Cada comando tiene un único diálogo de parámetros.</p>
 <img border='1' title='Adicionando acciones en el editor visual' alt='Adicionando acciones en el editor visual' src='#SITE_DIR#images/bp/8.png' />
 <h1><a name=\"perfomance\"></a>Ejecutando un Business Process</h1>
<p>Un business process puede ser ejecutado manualmente o de forma automática, dependiendo de sus parámetros. El modo en el que se decida lanzar este no afecta su ejecución. Un proceso puede tener múltiples instancias, cada na ejecutándose independientemente. </p>
  <p>Para ejecutar un business process sobre un determinado documento, click en el comando <b>Nuevo Business Process</b>, en el menú de acciones del documento y seleccione el business process requerido desde la lista.</p>
 <img border='1' src='#SITE_DIR#images/bp/5.png' alt='Lanzando un business process para un documento' title='Lanzando un business process para un documento' />
 <p>Después de que la ventana de parámetros de Business Process se ha abierto, especifique el parámetro y haga click en <strong>Iniciar</strong>.</p>
 <img border='1' title='Configurando un business process' alt='Configurando un business process' src='#SITE_DIR#images/bp/9.png' />
 <p>Si un business process incluye opciones de notificación, esta notificación será enviada al empleado cuando el proceso llegue al punto en la que dicho empleado debe realizar alguna acción. Para ver y realizar tareas asignadas mediante la ejecución del un business process, un usuario puede hacer click en el link de <b>Business Processes</b> en el menú derecho bajo el grupo <strong>Mis Herramientas</strong>.</p>
</div>";
$MESS["SERVICES_TITLE"] = "Procesos de negocios";
?>