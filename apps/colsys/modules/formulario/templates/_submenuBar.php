<?

/*
  $button[0]["name"]="Principal";
  $button[0]["tooltip"]="Pagina inicial del Colsys";
  $button[0]["image"]="22x22/gohome.gif";
  $button[0]["link"]= "/index.html";
 */
$id = $this->getRequestParameter("id");
$this->user = $this->getUser();
$permiso = $user->getNivelAcceso("144");



$i = 0;

switch ($action) {

    case "index":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        if ($permiso <= 1) {
            $button[$i]["name"] = "Nuevo Formulario";
            $button[$i]["tooltip"] = "Nuevo Formulario";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "formulario/new";
        }
        /** dejar mas adelante junto a cada formulario la vista previa a su email
          $i++;
          $button[$i]["name"] = "Vista Previa email colmas";
          $button[$i]["tooltip"] = "Vista Previa email colmas";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/vistaPreviaEmail?ca_id=" . base64_encode(5);
          $i++;
         */
        /* $button[$i]["name"] = "Enviar Email";
          $button[$i]["tooltip"] = "Enviar Email";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/envioEmailsPrueba";
          $i++;
          $button[$i]["name"] = "Enviar Email Masivo";
          $button[$i]["tooltip"] = "Enviar Email Masivo";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/envioEmails";
          $i++; */
        break;
    case "filtrar":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        if ($permiso <= 1) {
            $button[$i]["name"] = "Nuevo Formulario";
            $button[$i]["tooltip"] = "Nuevo Formulario";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "formulario/new";
            $i++;
        }
        break;
    case "show":
        $i = 0;
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        if ($permiso <= 1) {
            $button[$i]["name"] = "Editar Formulario";
            $button[$i]["tooltip"] = "Editar Formulario";
            $button[$i]["image"] = "formularios/edit.gif";
            $button[$i]["link"] = "formulario/edit?ca_id=" . $this->getRequestParameter('ca_id');
            $i++;
        }
        $button[$i]["name"] = "Vista Prev&iacute;a";
        $button[$i]["tooltip"] = "Vista Prev&iacute;a";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/vistaPrevia?ca_id=" . base64_encode($this->getRequestParameter('ca_id'));
        $i++;
        break;
    case "edit":
        $i = 0;
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
            $button[$i]["name"] = "Ver Detalle";
            $button[$i]["tooltip"] = "Ver Detalle";
            $button[$i]["image"] = "formularios/detalle.png";
            $button[$i]["link"] = "formulario/show?ca_id=" . $this->getRequestParameter('ca_id');
            $i++;
        }
        $button[$i]["name"] = "Vista Prev&iacute;a";
        $button[$i]["tooltip"] = "Vista Prev&iacute;a";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/vistaPrevia?ca_id=" . base64_encode($this->getRequestParameter('ca_id'));
        $i++;
        if ($permiso <= 1) {
            $button[$i]["name"] = "Borrar";
            $button[$i]["tooltip"] = "Borrar";
            $button[$i]["image"] = "formularios/delete.gif";
            $button[$i]["link"] = "formulario/delete?ca_id=" . $this->getRequestParameter('ca_id');
            $i++;
        }
        break;
    case "create":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        if ($permiso <= 1) {
            $button[$i]["name"] = "Nuevo Formulario";
            $button[$i]["tooltip"] = "Nuevo Formulario";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "formulario/new";
            $i++;
        }
        /* $button[$i]["name"] = "Encuesta Servicio";
          $button[$i]["tooltip"] = "Listado de formularios";
          $button[$i]["image"] = "formularios/ver.png";
          $button[$i]["link"] = "formulario/evalServicioClientes";
          $i++;
          $button[$i]["name"] = "Formulario de Ejemplo";
          $button[$i]["tooltip"] = "Formulario de Ejemplo";
          $button[$i]["image"] = "formularios/ver.png";
          $button[$i]["link"] = "formulario/vistaPrevia?ca_id=2";
          $i++; */
        break;
    case "update":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        if ($permiso <= 1) {
            $button[$i]["name"] = "Nuevo Formulario";
            $button[$i]["tooltip"] = "Nuevo Formulario";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "formulario/new";
            $i++;
        }
        break;
    case "new":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        if ($permiso <= 1) {
            $button[$i]["name"] = "Nuevo Formulario";
            $button[$i]["tooltip"] = "Nuevo Formulario";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "formulario/new";
            $i++;
        }
        break;
    case "contactos":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        break;
    case "estadistica":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        break;
    case "reporte":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        break;

    case "reporteDetallado":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        /* $button[$i]["name"] = "Enviar Email";
          $button[$i]["tooltip"] = "Enviar Email";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/envioEmailsPrueba";
          $i++;
          $button[$i]["name"] = "Enviar Email Masivo";
          $button[$i]["tooltip"] = "Enviar Email Masivo";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/envioEmails";
          $i++; */
        break;

    case "consolidado":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
        if ($permiso <= 2) {
            $button[$i]["name"] = "Bloques";
            $button[$i]["tooltip"] = "Listado de bloques";
            $button[$i]["image"] = "formularios/bloques.png";
            $button[$i]["link"] = "bloque/index";
            $i++;
            $button[$i]["name"] = "Preguntas";
            $button[$i]["tooltip"] = "Listado de preguntas";
            $button[$i]["image"] = "formularios/pregunta.png";
            $button[$i]["link"] = "pregunta/index";
            $i++;
            $button[$i]["name"] = "Opciones";
            $button[$i]["tooltip"] = "Listado de opciones";
            $button[$i]["image"] = "formularios/opcion.png";
            $button[$i]["link"] = "opcion/index";
            $i++;
        }
        /* $button[$i]["name"] = "Excel";
          $button[$i]["tooltip"] = "Exportar la información a Excel";
          $button[$i]["image"] = "formularios/to_excel.gif";
          $button[$i]["link"] = "formulario/consolidado?ca_id=" . $this->getRequestParameter('ca_id');
          $i++; */
        /* $button[$i]["name"] = "Enviar Email";
          $button[$i]["tooltip"] = "Enviar Email";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/envioEmailsPrueba";
          $i++;
          $button[$i]["name"] = "Enviar Email Masivo";
          $button[$i]["tooltip"] = "Enviar Email Masivo";
          $button[$i]["image"] = "formularios/add.gif";
          $button[$i]["link"] = "formulario/envioEmails";
          $i++; */
        break;
}
?>
<?

//php echo url_for('formulario/edit?ca_id='.$formulario->getCaId()) ?>