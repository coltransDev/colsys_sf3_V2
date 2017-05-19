<?

$i = 0;
$permiso = $user->getNivelAcceso("144");

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
            $button[$i]["name"] = "Nueva Pregunta";
            $button[$i]["tooltip"] = "Nueva Pregunta";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "pregunta/new";
            $i++;
        }
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
            $button[$i]["name"] = "Nueva Pregunta";
            $button[$i]["tooltip"] = "Nueva Pregunta";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "pregunta/new";
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
            $button[$i]["name"] = "Editar Pregunta";
            $button[$i]["tooltip"] = "Editar Pregunta";
            $button[$i]["image"] = "formularios/edit.gif";
            $button[$i]["link"] = "pregunta/edit?ca_id=" . $this->getRequestParameter('ca_id');
            $i++;
        }
        $button[$i]["name"] = "Vista Prev&iacute;a";
        $button[$i]["tooltip"] = "Vista Prev&iacute;a";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "pregunta/vistaPrevia?ca_id=" . $this->getRequestParameter('ca_id');
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
        $button[$i]["link"] = "pregunta/show?ca_id=" . $this->getRequestParameter('ca_id');
        $i++;
        }
        $button[$i]["name"] = "Vista Prev&iacute;a";
        $button[$i]["tooltip"] = "Vista Prev&iacute;a";
        $button[$i]["image"] = "formularios/ver.png";
        $button[$i]["link"] = "bloque/vistaPrevia?ca_id=" . $this->getRequestParameter('ca_id');
        $i++;
        if ($permiso <= 1) {
            $button[$i]["name"] = "Borrar";
            $button[$i]["tooltip"] = "Borrar";
            $button[$i]["image"] = "formularios/delete.gif";
            $button[$i]["link"] = "pregunta/delete?ca_id=" . $this->getRequestParameter('ca_id');
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
            $button[$i]["name"] = "Nueva Pregunta";
            $button[$i]["tooltip"] = "Nueva Pregunta";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "pregunta/new";
            $i++;
        }
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
            $button[$i]["name"] = "Nueva Pregunta";
            $button[$i]["tooltip"] = "Nueva Pregunta";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "pregunta/new";
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
            $button[$i]["name"] = "Nueva Pregunta";
            $button[$i]["tooltip"] = "Nueva Pregunta";
            $button[$i]["image"] = "formularios/add.gif";
            $button[$i]["link"] = "pregunta/new";
            $i++;
        }
        break;
}
?>

