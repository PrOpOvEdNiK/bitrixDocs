<?
$MESS["CONTENT"] = "<div> Contenido:
  <ul>
    <li><a href=\"#bizproc\" title=\"¿Qué es un proceso de negocios?\">Procesos de negocios</a></li>

    <li><a href=\"#tipical\" title=\"¿Cuáles son los procesos de negocio más típicos?\">Típicos procesos de negocios</a></li>

    <li><a href=\"#work\" title=\"Cómo crear un proceso de negocio\">Creación de un proceso de negocios</a></li>

    <li><a href=\"#perfomance\" title=\"¿Cómo ejecuto un proceso de negocio completado?\">Ejecución de un proceso de negocios</a></li>
   </ul>
  <h1><a name=\"bizproc\"></a>Business Processes</h1>

  <p>La noción de <b>business processes</b> se refiere a un instrumento para crear, mantener y administrar flujos de información.</p>

  <p><i>A <b>Business Process</b> es el flujo de información (o documentos) por una ruta o esquema definido. Un esquema de proceso de negocios puede especificar:</i></p>
  <ul>
    <li>uno o mas <i>puntos de entrada y salida</i> (el inicio y el final del proceso); </li>
    <li>a <i>Secuencia de acciones (pasos, etapas, funciones)</i> que será ejecutada por el algoritmo de proceso de negocio. </li>
   </ul>
  <p>El mundo real asume una amplia gama de diferentes flujos de información, los esquemas que van desde los muy simples a los muy complejos. Un simple proceso de publicación de un documento puede contener una variedad de acciones posibles y horquillas condicionales y puede requerir una variedad de datos de entrada y notificaciones de usuario.</p>

  <p><b>Business processes</b> permiten a un usuario común crear y editar cualquier variedad imaginable de combinaciones de información y esquemas de flujo de acción. El editor de procesos de negocio se ha desarrollado para ser lo más simple posible, lo que significa que un usuario de negocios regular, no un programador, será capaz de acceder a una amplia gama de funciones y características. Sin embargo, la noción misma de procesos de negocio implica que un nivel de mentalidad analítica superior a la media y un conocimiento profundo de lo que realmente está sucediendo dentro de la empresa deben combinarse para obtener el beneficio total de los procesos de negocio. </p>
<p>El diseñador de procesos de negocios es esencialmente un creador de bloques visuales <b>arrastrar y soltar</b>  Las plantillas de proceso de negocio se crean en una versión especializada del editor visual. Un autor de procesos de negocios puede especificar los pasos del proceso y su secuencia; Resalte los detalles específicos del proceso usando esquemas visuales simples.</p>
<p>A El flujo de información específico se define por la plantilla de proceso empresarial, que está compuesta por múltiples acciones. Una acción puede ser cualquier evento de su elección: crear un documento; Enviar un mensaje de correo electrónico; Añadir un registro de base de datos, etc. </p>
<p>El sistema ya contiene docenas de acciones integradas y algunos procesos empresariales típicos que pueden usarse para modelar las actividades empresariales más comunes. </p>
<p>Hay dos tipos más comunes de procesos de negocio: </p>
 <ul>
    <li>a <b>proceso secuencial de negocios</b> Para realizar una serie de acciones consecutivas en un documento, desde un punto de inicio predefinido hasta un punto final predefinido; </li>
    <li>a <b>Proceso de negocio impulsado por el estado</b> que no tiene un punto inicial o final; El estado del proceso se cambia en tiempo de ejecución por el flujo de trabajo. Tales procesos de negocio pueden, teóricamente, terminar en cualquier etapa.</li>
   </ul>

  <h2>Proceso de negocio secuencial</h2>

  <p>El modo secuencial se utiliza generalmente para procesos que tienen un ciclo de vida limitado y predefinido. Un ejemplo típico de esto es la creación y aprobación de un documento de texto. Cualquier proceso secuencial normalmente incluye varias acciones entre los puntos inicial y final.</p>
  <p><img border=\"1\" alt=\"Ejemplo: proceso lineal simple\" title=\"Ejemplo: proceso lineal simples\" src=\"/images/bp/en/2.png\" /></p>

  <h2>Proceso de negocios impulsado por el estado</h2>

  <p>A El enfoque basado en el estado se utiliza cuando un proceso no tiene un marco de tiempo definido y puede repetir o volver a un estado dado debido a la naturaleza del proceso (por ejemplo: actualización continua de la documentación del producto). Un estado aquí no es sólo un marcador para indicar el grado de progreso del documento; Más bien, describe un ciclo de proceso del mundo real. </p>
  <p>TLa creación de una plantilla de proceso basada en el estado no es tan simple como de un proceso secuencial, pero abre amplias posibilidades para automatizar el procesamiento de la información. Un esquema típico para tales procesos consiste en varios estados que a su vez incluyen acciones y condiciones de cambio de estado. </p>
 <img border=\"1\" alt=\"Ejemplo: proceso con estados\" title=\"Ejemplo: proceso con estados\" src=\"/images/bp/en/3.png\" />
  <p>Cada acción en un estado es generalmente un proceso secuencial finito.</p>

  <h1><a name=\"tipical\"></a>Típicos procesos de negocios</h1>

<p>El sistema se suministra con múltiples procesos empresariales listos para usar. Usted puede adaptarlos para adaptarse a su empresa de flujo de información utilizando el diseñador de procesos de negocio visual.</p>
  <h2>\"Simple Approval/Vote\" Sequential Process</h2>

  <p>Recomendado cuando la decisión se tome por mayoría simple de votos. </p>

  <h2>\"Primera Aprobación\" Proceso Secuencial</h2>

  <p>Recomendado cuando una sola aprobación o respuesta (\"Necesito un voluntario?\") es suficiente.</p>

  <h2>&quot;Approve Document with States&quot; Status-driven Process</h2>

  <p>Recomendado cuando se requiere un acuerdo mutuo para aprobar un documento. </p>

  <h2>&quot;Two-stage Approval&quot; Sequential Process</h2>

<p>Recomendado cuando un documento requiere una evaluación previa de un experto antes de ser aprobado. </p>

  <h2>&quot;Expert Opinion&quot; Sequential Process</h2>

  <p>Recomendado para situaciones en las que una persona que apruebe o rechace un documento necesita comentarios de expertos.</p>

  <h2>&quot;Read Document&quot; Sequential Process</h2>

  <p>Recomendado cuando los empleados tienen que familiarizarse con un documento. </p>
  <p>Puede ver los procesos empresariales (estándar y definidos por el usuario) relacionados con un determinado tipo de documento haciendo clic en <b>Más</b> botón y seleccionar <b>Business processes</b> en el menú: </p>
  <p><img border=\"1\" src=\"/images/bp/en/4.png\" alt=\"Ver procesos empresariales\" title=\"Ver procesos empresariales\" /></p>
<p>Esto abrirá el <b>Plantillas de Procesos de Negocio</b> Página en la que puede editar los procesos existentes y crear nuevos.</p>
  <p><img border=\"1\" src=\"/images/bp/en/11.png\" alt=\"Página Procesos de negocio\" title=\"Página Procesos de negocio\" /></p>
  <h1><a name=\"work\"></a>Creación de un proceso de negocios</h1>

  <p>Para crear y editar un proceso de negocio, se utilizará un editor de procesos de negocio visual.</p>

  <p>Antes de crear un proceso de negocio, debe seleccionar el tipo de proceso: secuencial o controlado por el estado, que definirá el diseño del editor visual. El tipo se puede seleccionar utilizando los controles de la barra <b>Plantillas de Procesos de Negocio</b> form.</p>

  <p>El primer paso a seguir al crear un proceso de negocio es definir los parámetros. Los parámetros del proceso son datos a los que se puede acceder en cualquier comando, acción o condición. Con los parámetros definidos, puede proceder y crear el proceso.</p>
 <img border=\"1\" title=\"Configuración de los parámetros del proceso\" alt=\"Configuración de los parámetros del proceso\" src=\"/images/bp/en/6.png\" />

  <h2>Creating a Status-Driven Process</h2>

  <p>En primer lugar, cree y configure los estados requeridos con el botón Agregar estado. A continuación, cree comandos para cada estado. Cada comando representa un proceso secuencial separado.</p>
   <img border=\"1\" src=\"/images/bp/en/7.png\" alt=\"Asignación de acciones en los estados\" title=\"Asignación de acciones en los estados\" />

  <h2>Creating a Sequential Process</h2>

  <p>Cuando crea un proceso secuencial, el editor visual muestra un conjunto personalizable de acciones.</p>

  <p>El editor visual utiliza la técnica popular de arrastrar y soltar para añadir acciones. Una vez agregado un comando, configure los parámetros del comando. Cada comando tiene un diálogo de parámetros únicos.</p>
 <img border=\"1\" title=\"Agregar acciones en el editor visual\" alt=\"Agregar acciones en el editor visual\" src=\"/images/bp/en/8.png\" /><br /><br />
  <h1><a name=\"perfomance\"></a>Running a Business Process</h1>
<p>Un proceso de negocio se puede ejecutar manual o automáticamente dependiendo de sus parámetros. El modo de inicio no afecta a la ejecución. Un proceso puede tener varias instancias, cada una funcionando independientemente.</p>
  <p>Para ejecutar un proceso comercial en un documento específico, haga clic en el <b>Nuevo Proceso de Negocios</b> en el menú de acción del documento y seleccione el proceso de negocio requerido en la lista..</p>
 <img border=\"1\" src=\"/images/bp/en/5.png\" alt=\"Inicio de un proceso de negocio para un documento\" title=\"Inicio de un proceso de negocio para un documento\" />
<p>Una vez abierta la ventana de parámetros de proceso de negocio, especifique los parámetros y haga clic en <b>Inicio</b>.</p>
 <img border=\"1\" title=\"Configuración de un proceso de negocios\" alt=\"Configuración de un proceso de negocios\" src=\"/images/bp/en/9.png\" />
  <p>Si un proceso empresarial proporciona opciones de notificación, se enviará una notificación a un empleado cuando el proceso llegue a un punto en el que el empleado debe realizar alguna acción. Para ver y realizar las tareas asignadas por el proceso empresarial en ejecución, un usuario puede hacer clic en el <b>Business Processes</b> enlace en el menú de la izquierda bajo el <b>Mi espacio de trabajo</b> grupo.</p>
</div>";
$MESS["TITLE"] = "Procesos de negocios";
?>