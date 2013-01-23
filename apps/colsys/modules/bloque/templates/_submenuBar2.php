<?

/*
  $button[0]["name"]="Principal";
  $button[0]["tooltip"]="Pagina inicial del Colsys";
  $button[0]["image"]="22x22/gohome.gif";
  $button[0]["link"]= "/index.html";
 */

$i = 0;
/*
  if ($action != "index") {
  $button[$i]["name"] = "Formularios";
  $button[$i]["tooltip"] = "Listado de formularios";
  $button[$i]["image"] = "formularios/formulario.png";
  $button[$i]["link"] = "formulario/index";
  $i++;
  } */

switch ($action) {
    case "index":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
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
        $button[$i]["name"] = "Encuesta Servicio";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/evalServicioClientes";
        $i++;
        $button[$i]["name"] = "Nuevo Bloque";
        $button[$i]["tooltip"] = "Nuevo Bloque";
        $button[$i]["image"] = "formularios/add.gif";
        $button[$i]["link"] = "bloque/new";
        $i++;
        break;
    case "show":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
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
        $button[$i]["name"] = "Encuesta Servicio";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/evalServicioClientes";
        $i++;
        $button[$i]["name"] = "Nuevo Formulario";
        $button[$i]["tooltip"] = "Nuevo Formulario";
        $button[$i]["image"] = "formularios/add.gif";
        $button[$i]["link"] = "formulario/new";
        $i++;
        $button[$i]["name"] = "Editar Formulario";
        $button[$i]["tooltip"] = "Editar Formulario";
        $button[$i]["image"] = "formularios/add.gif";
        $button[$i]["link"] = "formulario/edit";
        $i++;
        break;
    case "edit":
        $i = 0;
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
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
        $button[$i]["name"] = "Vista Prev&iacute;a";
        $button[$i]["tooltip"] = "Vista Prev&iacute;a";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/vistaPrevia?ca_id=" . $this->getRequestParameter('ca_id');
        $i++;
        $button[$i]["name"] = "Borrar";
        $button[$i]["tooltip"] = "Borrar";
        $button[$i]["image"] = "formularios/delete.gif";
        $button[$i]["link"] = "formulario/delete?ca_id=" . $this->getRequestParameter('ca_id');
        $i++;
        break;
    case "create":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
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
        $button[$i]["name"] = "Nuevo Bloque";
        $button[$i]["tooltip"] = "Nuevo Bloque";
        $button[$i]["image"] = "formularios/add.gif";
        $button[$i]["link"] = "bloque/new";
        $i++;
        $button[$i]["name"] = "Encuesta Servicio";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/evalServicioClientes";
        $i++;
        $button[$i]["name"] = "Formulario de Ejemplo";
        $button[$i]["tooltip"] = "Formulario de Ejemplo";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/vistaPrevia?ca_id=2";
        $i++;
        break;
    case "update":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
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
        $button[$i]["name"] = "Nuevo Bloque";
        $button[$i]["tooltip"] = "Nuevo Bloque";
        $button[$i]["image"] = "formularios/add.gif";
        $button[$i]["link"] = "bloque/new";
        $i++;
        $button[$i]["name"] = "Encuesta Servicio";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/evalServicioClientes";
        $i++;
        $button[$i]["name"] = "Formulario de Ejemplo";
        $button[$i]["tooltip"] = "Formulario de Ejemplo";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/vistaPrevia?ca_id=2";
        $i++;
        break;
    case "new":
        $button[$i]["name"] = "Formularios";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/formulario.png";
        $button[$i]["link"] = "formulario/index";
        $i++;
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
        $button[$i]["name"] = "Nuevo Bloque";
        $button[$i]["tooltip"] = "Nuevo Bloque";
        $button[$i]["image"] = "formularios/add.gif";
        $button[$i]["link"] = "bloque/new";
        $i++;
        $button[$i]["name"] = "Encuesta Servicio";
        $button[$i]["tooltip"] = "Listado de formularios";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/evalServicioClientes";
        $i++;
        $button[$i]["name"] = "Formulario de Ejemplo";
        $button[$i]["tooltip"] = "Formulario de Ejemplo";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "formulario/vistaPrevia?ca_id=2";
        $i++;
        break;
}


/*
  if ($action != "index") {
  $button[$i]["name"] = "Inicio ";
  $button[$i]["tooltip"] = "Pagina inicial del módulo";
  $button[$i]["image"] = "16x16/gohome.gif";
  $button[$i]["link"] = "bodegas/index";
  $i++;
  }

  switch ($action) {
  case "index":
  $button[$i]["name"] = "Nuevo";
  $button[$i]["tooltip"] = "Crear una nueva noticia";
  $button[$i]["image"] = "16x16/new.gif";
  $button[$i]["link"] = "bodegas/formClientePanel";
  $i++;
  break;
  } */

if ($action != "ayuda") {
    /* $button[$i]["name"]="Ayuda";
      $button[$i]["tooltip"]="Ayudas del modulo de cotizaciones";
      $button[$i]["image"]="22x22/help.gif";
      $button[$i]["link"]= "cotizaciones/ayuda";
      $i++; */
}
?>