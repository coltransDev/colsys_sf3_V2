<?php
/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       repindicadornew.PHP                                         \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripción:   Reporte de Cuadro INO para Gerencia.                        \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */

$titulo = 'Generador de Indicadores de Gestión';
$meses = array("%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
$criterios = array("ca_ano" => "Año", "ca_mes" => "Mes", "ca_sucursal" => "Sucursal", "ca_traorigen" => "Tráfico", "ca_compania" => "Clientes");
$transportes = array("%" => "Todos", "Aéreo" => "Aéreo", "Marítimo" => "Marítimo");      // Arreglo con los tipos de Transportes

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                               // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>document.location.href = 'entrada.php';</script>";
}

$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and ! isset($buscar)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function validar(){";
    echo "  return (true);";
    echo "}";

    echo "function llenar_departamentos(){";
    echo "  department_element = document.getElementById('departamento');";
    echo "  department_element[department_element.length] = new Option();";
    echo "  for (cont=0; cont<forma.elements.length; cont++){";
    echo "      if (forma.elements[cont].name == 'array_departamentos'){";
    echo "          department_element[department_element.length] = new Option(forma.elements[cont].value,forma.elements[cont].value,false,false);";
    echo "      }";
    echo "  }";
    echo "}";

    echo "function llenar_indicadores(department_element){";
    echo "  indicad_element = document.getElementById('indicador');";
    echo "  indicad_element.length=0;";
    echo "  i = 0;";
    echo "  while (isNaN(document.getElementById(department_element.value+'_'+i))) {";
    echo "     objeto = document.getElementById(department_element.value+'_'+i);";
    echo "     indicad_element[indicad_element.length] = new Option(objeto.value,objeto.value,false,false);";
    echo "     i++;";
    echo "  }";
    echo "  if (department_element.value == 'Servicio_al_Cliente'){";
    echo "      document.getElementById('transporte').style.display = 'block';";
    echo "  }else";
    echo "      document.getElementById('transporte').style.display = 'none';";
    echo "}";
    echo "</script>";

    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='forma' ACTION='repindicadornew.php' ONSUBMIT='return validar();'>";

    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select dep.ca_nombre ca_departamento, idg.ca_nombre as ca_indicador from idg.tb_idg idg inner join control.tb_departamentos dep on idg.ca_iddepartamento = dep.ca_iddepartamento order by 1, 2")) {    // Selecciona los registros de la tabla IDG
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        exit;
    }
    while (!$tm->Eof()) {
        $dep_mem = $departamento = str_replace(" ", "_", $tm->Value('ca_departamento'));
        echo "<INPUT ID='array_departamentos' TYPE='HIDDEN' NAME='array_departamentos' VALUE='$dep_mem'>";
        $i = 0;
        while ($departamento == $dep_mem and ! $tm->Eof()) {
            echo "<INPUT ID='" . $departamento . "_" . $i . "' TYPE='HIDDEN' NAME='" . $departamento . "_" . $i . "' VALUE='" . $tm->Value('ca_indicador') . "'>";
            $tm->MoveNext();
            $departamento = str_replace(" ", "_", $tm->Value('ca_departamento'));
            $i++;
        }
    }

    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</B></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 10px;'>Pulse la tecla control para seleccionar varios ítems <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Servicio'></TH>";
    echo "</TR>";
    $tm->MoveFirst();
    $sql = "select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal";
    if (!$tm->Open($sql)) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "Error 102: $sql";
        //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'repindicadornew.php';</script>";
        exit;
    }
    $us = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    $sql = "select ca_nombre, ca_sucursal from vi_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Regional' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_nombre";
    if (!$us->Open($sql)) {
        echo "Error 110: $sql";
        //echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        //echo "<script>document.location.href = 'repindicadornew.php';</script>";
        exit;
    }
    $us->MoveFirst();
    while (!$us->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='usu_nombre' VALUE='" . $us->Value('ca_nombre') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='usu_sucursal' VALUE='" . $us->Value('ca_sucursal') . "'>";
        $us->MoveNext();
    }

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=4></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano[]' SIZE=5 MULTIPLE>";
    $sel = "SELECTED";
    for ($i = 0; $i < 5; $i++) {
        $anno = (date('Y') - $i);
        if ($anno >= 2012) {
            echo " <OPTION VALUE=$anno $sel>$anno</OPTION>";
        }
        $sel = "";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes[]' SIZE=13 MULTIPLE>";
    while (list ($clave, $val) = each($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m') == $clave) {
            echo" SELECTED";
        }
        echo ">$val</OPTION>";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Sucursal:<BR><SELECT ID=sucursal NAME='sucursal[]' SIZE=10 MULTIPLE>";
    echo "  <OPTION VALUE=% SELECTED>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<OPTION VALUE='" . $tm->Value('ca_sucursal') . "' $sel>" . $tm->Value('ca_sucursal') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    $sql = "select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre";
    if (!$tm->Open($sql)) {       // Selecciona todos lo registros de la tabla Traficos
        echo "Error 153: $sql";
        //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'repindicadornew.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo " <TD Class=listar>Tráfico :<BR><SELECT NAME='traorigen[]' SIZE=10 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Tráficos</OPTION>";
    while (!$tm->Eof()) {
        echo " <OPTION VALUE='" . $tm->Value('ca_nombre') . "'>" . $tm->Value('ca_nombre') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";
    $sql = "select ca_ciudad from vi_ciudades where ca_idtrafico = '$regional' and ca_puerto in ('Marítimo','Ambos') order by ca_ciudad";
    if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = '$regional' and ca_puerto in ('Marítimo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "Error 168: $sql";
        //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'repindicadornew.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo " <TD Class=listar>Puerto Destino :<BR><SELECT NAME='ciudestino[]' SIZE=6 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Puertos</OPTION>";
    while (!$tm->Eof()) {
        echo " <OPTION VALUE='" . $tm->Value('ca_ciudad') . "'>" . $tm->Value('ca_ciudad') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";

    echo "  <TH style='vertical-align:bottom;' ROWSPAN=4><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='forma.submit();'><BR /><BR /></TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar>Cliente: </TD>";
    echo "  <TD Class=listar COLSPAN=4><INPUT TYPE='text' NAME='cliente' size='100'></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar>Departamento: </TD>";
    echo "  <TD Class=listar ><SELECT ID='departamento' NAME='departamento' ONCHANGE='llenar_indicadores(this);'></SELECT></TD>";
    echo "  <TD Class=listar ><SELECT ID='transporte' NAME='transporte[]' style='display: none'>";
    while (list ($clave, $val) = each($transportes)) {
        echo "   <OPTION VALUE='$clave'>$val</OPTION>";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=2><SELECT ID='indicador' NAME='indicador'></SELECT></TD>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=7></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<script language='javascript'>llenar_departamentos();</script>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"repindicadornew.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (!isset($boton) and ! isset($accion) and isset($buscar)) {
    set_time_limit(1000000000000);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    include_once 'include/functions.php';                                      // Módulo de Funciones Varias
    //  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $ult_ano = 0;
    foreach ($ano as $num) {
        $ult_ano = ($num > $ult_ano) ? $num : $ult_ano;
    }
    $ult_mes = 0;
    foreach ($mes as $num) {
        $ult_mes = ($num > $ult_mes) ? $num : $ult_mes;
    }
    $ult_dia = date("Y-m-d", mktime(0, 0, 0, $ult_mes + 1, 0, $ult_ano));

    $ano_tit = implode(',', $ano);
    $mes_tit = implode(',', $mes);
    $suc_tit = implode(',', $sucursal);
    $ciu_tit = implode(',', $ciudestino);

    $tra_mem = $transporte[0];

    $tot_cols = 11;
    $ano_fes = "to_char(ca_fchfestivo,'YYYY') " . ((count($ano) == 1) ? "like '$ano[0]'" : "in ('" . implode("','", $ano) . "')");

    if (count($ano) == 1) {
        $ano_mem = "'" . substr($ano[0], -2) . "'";
    } else {
        foreach ($ano as $tmp)
            $ano_mem[] = "'" . substr($tmp, -2) . "'";
    }
    if ($indicador == "Oportunidad en Entrega de Antecedentes") {
        // echo "<script>document.location.href = 'repantecedentes.php?$parametros';</script>";
        include_once 'repantecedentes.php';
        exit;
    }
    $ano = "ca_ano::text " . ((count($ano) == 1) ? "like '$ano[0]'" : "in ('" . implode("','", $ano) . "')");
    $mes_fes = "to_char(ca_fchfestivo,'MM') " . ((count($mes) == 1) ? "like '$mes[0]'" : "in ('" . implode("','", $mes) . "')");
    $mes_mem = "'" . implode("','", $mes) . "'";
    $mes = "ca_mes " . ((count($mes) == 1) ? "like '$mes[0]'" : "in ('" . implode("','", $mes) . "')");
    $sucursal = "ca_sucursal " . ((count($sucursal) == 1) ? "like '$sucursal[0]'" : "in ('" . implode("','", $sucursal) . "')");

    if ($indicador == "Oportunidad en la Entrega de Cotizaciones - Coltrans" or $indicador == "Oportunidad en la Entrega de Cotizaciones - Colmas") {
        if (in_array("%", $ciudestino)) {
            $ciudestino = "";
        } else {
            $ciudestino = "ca_ciudestino " . ((count($ciudestino) == 1) ? "like '$ciudestino[0]'" : "in ('" . implode("','", $ciudestino) . "')");
        }

        if (in_array("%", $traorigen)) {
            $traorigen = "";
        } else {
            $traorigen = "ca_traorigen " . ((count($traorigen) == 1) ? "like '$traorigen[0]'" : "in ('" . implode("','", $traorigen) . "')");
        }

        if (in_array("%", $modalidad)) {
            $modalidad = "";
        } else {
            $modalidad = "ca_modalidad " . ((count($modalidad) == 1) ? "like '$modalidad[0]'" : "in ('" . implode("','", $modalidad) . "')");
        }

        if (in_array("%", $transporte)) {
            $transporte = "";
        } else {
            $transporte = "ca_transporte " . ((count($transporte) == 1) ? "like '$transporte[0]'" : "in ('" . implode("','", $transporte) . "')");
        }
        $impoexpo = "";
    } else {
        if (in_array("%", $ciudestino)) {
            $ciudestino = "";
        } else {
            $ciudestino = "ca_ciudestino " . ((count($ciudestino) == 1) ? "like '$ciudestino[0]'" : "in ('" . implode("','", $ciudestino) . "')");
        }
        if (in_array("%", $traorigen)) {
            $traorigen = "";
        } else {
            $traorigen = "ca_traorigen " . ((count($traorigen) == 1) ? "like '$traorigen[0]'" : "in ('" . implode("','", $traorigen) . "')");
        }
        if ($departamento == 'Exportaciones') {
            $array_indicador = explode(" - ", $indicador);
            $tra_mem = $transporte[0] = $array_indicador[2];
        }
        if (in_array("%", $transporte)) {
            $transporte = "";
        } else {
            $transporte = "ca_transporte " . ((count($transporte) == 1) ? "like '$transporte[0]'" : "in ('" . implode("','", $transporte) . "')");
        }
    }

    $cliente = ((strlen($cliente) != 0) ? "and upper(ca_compania) like upper('%$cliente%')" : "");

    $campos = "ca_sucursal";
    $tm = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo '<script type="text/javascript" src="../js/jquery/jquery.min.js"></script>';
    echo "<script language='javascript' src='../js/highcharts/js/highcharts.js'></script>";
    echo "<script language='javascript' src='../js/highcharts/js/modules/exporting.js'></script>";

    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento   
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'repindicadornew.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
    echo "}";
    echo "function uno(src,color_entrada) {";
    echo "    src.style.background=color_entrada;src.style.cursor='hand'";
    echo "}";
    echo "function dos(src,color_default) {";
    echo "    src.style.background=color_default;src.style.cursor='default';";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='repindicadornew.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos

    $array_avg = array();  // Para el calcilo del Promedio General
    $array_pnc = array();  // Para el calculo del Producto no Conforme
    $array_null = array();  // Para el conteo de los Registros que nos pueden calcular
    $sql = "select cfg.ca_idsucursal, suc.ca_nombre, ca_lim1, ca_tiempo from idg.tb_idg idg inner join idg.tb_config cfg on idg.ca_idg = cfg.ca_idg inner join control.tb_departamentos dep on idg.ca_iddepartamento = dep.ca_iddepartamento left join control.tb_sucursales suc on suc.ca_idsucursal = cfg.ca_idsucursal where dep.ca_nombre = '" . str_replace("_", " ", $departamento) . "' and idg.ca_nombre = '$indicador' order by cfg.ca_fchcreado asc";
    if (!$tm->Open($sql)) {
        echo "Error 324: $sql";
        //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    $lcs_array = array();
    while (!$tm->Eof() and ! $tm->IsEmpty()) {
        $suc_mem = ($tm->Value('ca_idsucursal') == "999") ? "Todas" : $tm->Value('ca_nombre');
        $lcs_array[$suc_mem] = $tm->Value('ca_lim1');
        $ca_tiempoindi = $tm->Value('ca_tiempo');
        $tm->MoveNext();
    }
    //print_r($lcs_array);
    $format_avg = "d";
    if ($indicador == "Confirmación Salida de la Carga") {
        $source = "vi_repindicadores";
        $subque = "LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_usuenvio, min(to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')) as ca_fchenvio, to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')-rs.ca_fchsalida as ca_diferencia from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where rs.ca_idetapa in ('IAETA','IMETA') group by rp.ca_consecutivo, rs.ca_fchsalida, rs.ca_usuenvio, ca_diferencia) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
        $ind_mem = 1;
        $add_cols = 4;
    } else if ($indicador == "Tiempo de Tránsito") {
        $source = "vi_repindicadores";
        $subque = "LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, max(to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')) as ca_fchenvio, rs.ca_fchllegada-rs.ca_fchsalida as ca_diferencia from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where rs.ca_idetapa in ('IACAD','IMCPD') group by ca_consecutivo, ca_fchsalida, ca_fchllegada, ca_diferencia) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
        $ind_mem = 2;
        $add_cols = 3;
    } else if ($indicador == "Tiempo de Desconsolidación") {
        $source = "vi_repindicadores";
        $ind_mem = 3;
        $add_cols = 4;
    } else if ($indicador == "Oportunidad en la Facturación" and $departamento != "Aduanas_" and $departamento != "Exportaciones") {
        if ($departamento == 'Aéreo') {
            $source = "vi_repindicador_air";
            $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, rs.ca_fchllegada, rs.ca_fchcontinuacion, min(rs.ca_fchenvio) as ca_fchconf_lleg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IACAD') group by rp.ca_consecutivo, rs.ca_fchllegada, rs.ca_fchcontinuacion order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
            $subque.= " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_fact, min(rs.ca_fchenvio::date) as ca_fchenvio from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IAFFL') group by rp.ca_consecutivo) rs2 ON (vi_repindicador_air.ca_consecutivo = rs2.ca_consecutivo_fact)";
            $subque.= " RIGHT OUTER JOIN (select ca_referencia as ca_referencia_fac, ca_idcliente as ca_idcliente_fac, ca_hawb as ca_hawb_fac, ca_fchfactura, ca_usucreado, ca_observaciones from tb_inoingresos_air where ((string_to_array(ca_referencia,'.'))[5]::int) in ($ano_mem) and ((string_to_array(ca_referencia,'.'))[3])::text in ($mes_mem) order by ca_referencia, ca_idcliente, ca_hawb, ca_fchfactura) ii ON ($source.ca_referencia = ii.ca_referencia_fac and $source.ca_idcliente = ii.ca_idcliente_fac and $source.ca_hawb = ii.ca_hawb_fac) ";
            $campos.= ", ca_referencia, ca_idcliente_fac, ca_hawb, ca_fchenvio, ca_fchfactura";
        } else if ($departamento == 'Marítimo') {
            $source = "vi_repindicador_sea";
            $subque = " LEFT OUTER JOIN (select to_char(rs.ca_fchllegada,'YYYY') as ca_ano_new, to_char(rs.ca_fchllegada,'MM') as ca_mes_new, rp.ca_consecutivo as ca_consecutivo_conf, rs.ca_fchllegada, min(rs.ca_fchenvio) as ca_fchconf_lleg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa in ('IMCPD')) group by rp.ca_consecutivo, rs.ca_fchllegada order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
            if ($departamento == "Marítimo") {
                $subque.= " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_fact, min(rs.ca_fchenvio::date) as ca_fchenvio from tb_repstatus rs INNER join tb_emails e ON rs.ca_idemail = e.ca_idemail INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = '88888' and (e.ca_subject LIKE '%Factura de%' or e.ca_subject like '%Recargos Locales Id.:%')) group by rp.ca_consecutivo) rs2 ON ($source.ca_consecutivo = rs2.ca_consecutivo_fact) ";
                $subque.= " RIGHT OUTER JOIN (
                select c.ca_referencia as ca_referencia_fac, c.ca_idcliente as ca_idcliente_fac, c.ca_hbls as ca_hbls_fac, 
                    i.ca_fchfactura, i.ca_usucreado, i.ca_observaciones 
                        from tb_inoingresos_sea  i
                    inner join tb_inoclientes_sea c on c.ca_idinocliente=i.ca_idinocliente
                where 
                    substr(i.ca_observaciones,1,12) != 'Contenedores' and substr(i.ca_observaciones,1,7) != 'OTM/DTA' 
                order by ca_referencia, ca_idcliente, ca_hbls, ca_fchfactura) ii        
                ON ($source.ca_referencia = ii.ca_referencia_fac and $source.ca_idcliente = ii.ca_idcliente_fac and $source.ca_hbls = ii.ca_hbls_fac) ";
            } else if ($departamento == "OTM") {
                $transporte = "ca_transporte = 'Marítimo' ";   // Esta variable viene con valor "Terrestre"
                $subque.= " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_cont, (string_to_array(rs.ca_propiedades, '='::text))[2] as ca_fchplanilla, min(rs.ca_fchenvio) as ca_fchconf_plan from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = '99999') group by rp.ca_consecutivo, rs.ca_propiedades order by rp.ca_consecutivo) rs2 ON ($source.ca_consecutivo = rs2.ca_consecutivo_cont) ";
                $subque.= " RIGHT OUTER JOIN (select ca_referencia as ca_referencia_fac, ca_idcliente as ca_idcliente_fac, ca_hbls as ca_hbls_fac, ca_fchfactura, ca_usucreado, ca_observaciones from tb_inoingresos_sea where substr(ca_observaciones,1,12) != 'Contenedores' and substr(ca_observaciones,1,7) = 'OTM/DTA' order by ca_referencia, ca_idcliente, ca_hbls, ca_fchfactura) ii ON ($source.ca_referencia = ii.ca_referencia_fac and $source.ca_idcliente = ii.ca_idcliente_fac and $source.ca_hbls = ii.ca_hbls_fac and $source.ca_modalidad = 'FCL') ";
            }

            $campos.= ", ca_referencia, ca_idcliente_fac, ca_hbls, ca_fchfactura";

            $ano = str_replace("ca_ano", "ca_ano_new", $ano);
            $mes = str_replace("ca_mes", "ca_mes_new", $mes);
            $campos = str_replace("ca_ano", "ca_ano_new", $campos);
            $campos = str_replace("ca_mes", "ca_mes_new", $campos);
        }
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 378: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }

        $ind_mem = 4;
        $add_cols = 7;
    } else if ($indicador == "Oportunidad en el envío de seguimientos al Cliente" || $indicador == "Oportunidad en el Envio de Comunicaciones") {
        $format_avg = "H:i:s";
        $source = "vi_repindicadores";
        $transporte = "ca_transporte = '$departamento'";
        $impoexpo = "ca_impoexpo = 'Importación'";
        $sin_etapa = ($departamento == "Marítimo") ? "rs.ca_idetapa != 'IMAGR' and" : "rs.ca_idetapa != 'IAFFL' and";
        $subque = "LEFT OUTER JOIN (select to_char(ca_fchrecibo,'YYYY') as ca_ano_new, to_char(ca_fchrecibo,'MM') as ca_mes_new, ca_ciudad as ca_ciuorigen, ca_consecutivo as ca_consecutivo_sub, ca_fchrecibo, ca_fchenvio, ca_usuenvio, ca_observaciones_idg, te.ca_etapa from tb_repstatus rs RIGHT OUTER JOIN vi_usuarios usr ON rs.ca_usuenvio = usr.ca_login and usr.ca_empresa = 'Coltrans S.A.S.' LEFT OUTER JOIN tb_reportes rp ON ($sin_etapa rp.ca_idreporte = rs.ca_idreporte and rp.$transporte) INNER JOIN tb_ciudades pd ON (rp.ca_origen = pd.ca_idciudad) JOIN tb_tracking_etapas te ON te.ca_idetapa = rs.ca_idetapa where " . str_replace("ca_ano", "to_char(ca_fchrecibo,'YYYY')", $ano) . " and " . str_replace("ca_mes", "to_char(ca_fchrecibo,'MM')", $mes) . " and rs.ca_tipo != 2 order by ca_consecutivo, ca_fchrecibo) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 399: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 5;
        $add_cols = 7;
        $ano = str_replace("ca_ano", "ca_ano_new", $ano);
        $mes = str_replace("ca_mes", "ca_mes_new", $mes);
        $campos = str_replace("ca_ano", "ca_ano_new", $campos);
        $campos = str_replace("ca_mes", "ca_mes_new", $campos);
    } else if ($indicador == "Oportunidad de Primer Status") {
        $format_avg = "H:i:s";
        $source = "vi_repindicadores";
        $subque = "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio, ca_usuenvio from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte) group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) where " . str_replace("ca_ano", "to_char(ca_fchrecibo,'YYYY')", $ano) . " and " . str_replace("ca_mes", "to_char(ca_fchrecibo,'MM')", $mes) . " order by rp.ca_consecutivo, ca_fchrecibo) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 422: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 6;
        $add_cols = 4;
    } else if ($indicador == "Cumplimiento de Proveedores") {
        $source = "vi_repindicadores";
        $ind_mem = 7;
        $add_cols = 3;
    } else if ($indicador == "Oportunidad en la Entrega de Cotizaciones - Coltrans" or $indicador == "Oportunidad en la Entrega de Cotizaciones - Colmas") {
        if ($indicador == "Oportunidad en la Entrega de Cotizaciones - Coltrans")
            $empresa = "Coltrans";
        else if ($indicador == "Oportunidad en la Entrega de Cotizaciones - Colmas")
            $empresa = "Colmas";
        $format_avg = "H:i:s";
        $source = "vi_cotindicadores";
        $impoexpo = " ca_empresa = '$empresa' ";
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 449: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $ind_mem = 8;
        $add_cols = 7;
        $tot_cols--;
        $cot_ant = null;
        $campos.= ", to_number(substr(ca_consecutivo,0,position('-' in ca_consecutivo)),'99999999')";
    } else if ($indicador == "Oportunidad en confirmación de llegada de la carga al cliente") {
        if ($departamento == 'Aéreo') {
            $tipo = "D";
            $source = "vi_repindicador_air";
            $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, rs.ca_fchllegada, min(rs.ca_fchenvio) as ca_fchconf_lleg, rs.ca_usuenvio, rs.ca_observaciones_idg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_transporte = 'Aéreo' and rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IACAD') group by rp.ca_consecutivo, rs.ca_fchllegada, rs.ca_usuenvio order by rp.ca_consecutivo, rs.ca_observaciones_idg) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
        } else if ($departamento == 'Marítimo') {
            $tipo = "T";
            $format_avg = "H:i:s";
            $source = "vi_repindicador_sea";
            $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, min(rs.ca_fchenvio) as ca_fchconf_lleg, rs.ca_usuenvio, rs.ca_observaciones_idg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_transporte = 'Marítimo' and rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IMCPD') group by rp.ca_consecutivo, rs.ca_idetapa, rs.ca_fchllegada, rs.ca_usuenvio, rs.ca_horallegada, rs.ca_observaciones_idg order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
        }
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 477: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $ind_mem = 9;
        $add_cols = 7;
        $ini_ant = null;
        $fin_ant = null;
    } else if ($indicador == "Oportunidad en Nacionalización de Mcias Sucursal" or $indicador == "Oportunidad en Nacionalización de Mcias Puerto") {
        $tipo = "T";
        $format_avg = "H:i:s";
        $source = "vi_repindicador_brk";
        $transporte = "ca_transporte = 'Aduana'";
        $subque = " INNER JOIN ( select bke.*, prm.ca_valor, prm.ca_valor2 from (select * from tb_brk_evento where ca_realizado = 1) bke INNER JOIN (select * from tb_parametros where ca_casouso = 'CU037' order by ca_identificacion) prm ON (prm.ca_identificacion = bke.ca_idevento) order by ca_referencia ) bke ON ($source.ca_referencia = bke.ca_referencia) ";

        if (strpos($indicador, 'Puerto') === false) {
            $sucursal = "((string_to_array($source.ca_referencia,'.'))[1]) = '200'";
        } else {
            $pto_nam = array("Cartagena" => 10, "Buenaventura" => 20);
            foreach (explode(',', $ciu_tit) as $ciu) {
                if ($ciu != '%') {
                    $num_mem = 200 + $pto_nam[$ciu];
                    $sucursal = "((string_to_array($source.ca_referencia,'.'))[1]) = '$num_mem'";
                } else {
                    $sucursal = "((string_to_array($source.ca_referencia,'.'))[1]) in ('210','220')";
                }
            }
        }
        $suc_nam = array("Bogotá D.C." => "10", "Medellín" => "20", "Cali" => "30", "Barranquilla" => "40");
        foreach (explode(',', $suc_tit) as $suc) {
            if ($suc != '%') {
                $sucursal.= " and ((string_to_array($source.ca_referencia,'.'))[2]) = '" . $suc_nam[$suc] . "'";
            }
        }
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 519: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $ind_mem = 10;
        $add_cols = 3;
        $cot_ant = null;
        $campos.= ", $source.ca_referencia, bke.ca_valor2";
    } else if ($indicador == "Oportunidad en la Facturación" and $departamento == "Aduanas_") {
        $tipo = "D";
        $source = "vi_repindicador_brk";
        $transporte = "ca_transporte = 'Aduana' and (ca_propiedades IS NULL OR ca_propiedades not like '%idg_fac_aduana=false%')";
        $subque = " INNER JOIN ( select bke.*, prm.ca_valor, prm.ca_valor2 from tb_brk_evento bke INNER JOIN (select * from tb_parametros where ca_casouso = 'CU037' and ca_identificacion in (15, 17) order by ca_valor2) prm ON (prm.ca_identificacion = bke.ca_idevento) order by ca_referencia ) bke ON ($source.ca_referencia = bke.ca_referencia) ";
        $subque.= " LEFT JOIN (select DISTINCT subf.ca_referencia_sub, subf.ca_fchfactura, fact.ca_usucreado, fact.ca_observaciones from tb_brk_ingresos fact INNER JOIN (select ca_referencia as ca_referencia_sub, min(ca_fchfactura) as ca_fchfactura from tb_brk_ingresos group by ca_referencia) subf ON fact.ca_referencia = subf.ca_referencia_sub and fact.ca_fchfactura = subf.ca_fchfactura) rf ON (rf.ca_referencia_sub = vi_repindicador_brk.ca_referencia) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {        // Selecciona todos lo registros de la tabla Festivos
            echo "Error 542: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $ind_mem = 11;
        $add_cols = 5;
        $cot_ant = null;
        $campos.= ", $source.ca_referencia, ca_valor2";
    } else if (stripos($indicador, "Oportunidad en Exportación") !== FALSE and $departamento == "Exportaciones") {
        $tipo = "D";
        $impoexpo = "ca_impoexpo = 'Exportación'";
        if (substr($indicador, 0, 6) == 'Aduana') {
            $impoexpo.= " and ca_nomsia IN ('COLMAS S.A.S.','AGENCIA DE ADUANAS COLMAS SAS NIVEL 1')";
        }
        $no_docs = array("SAE", "DEX", "Cancelación Póliza Seguro", "Radicación Documento de Transporte", "Recibo de Soportes desde Puerto");
        $source = "vi_repindicador_expall";
        
        $subque = "LEFT OUTER JOIN (select exm.ca_referencia_exm, ext.ca_idevento, ext.ca_fchevento, ext.ca_usuario, pre.ca_valor, aed.ca_fechadoc from ((select ca_referencia as ca_referencia_exm, ca_tipoexpo from tb_expo_maestra) UNION (select ca_referencia as ca_referencia_exm, (ca_datos->'modalidad'->>0)::int as ca_tipoexpo FROM ino.tb_master WHERE ca_impoexpo = 'Exportación')) as exm ";
        $subque.= "LEFT OUTER JOIN (select ca_referencia as ca_referencia_ext, ca_idevento, ca_fchevento, ca_usuario from tb_expo_tracking where ca_realizado = 1) ext ON (ext.ca_referencia_ext = exm.ca_referencia_exm) ";
        $subque.= "LEFT OUTER JOIN (select DISTINCT ca_referencia as ca_referencia_aed, ca_idevento, min(ca_fechadoc) as ca_fechadoc from tb_expo_aedex group by ca_referencia, ca_idevento) aed ON (aed.ca_referencia_aed = ext.ca_referencia_ext and aed.ca_idevento = ext.ca_idevento) ";
        
        $subque.= "INNER JOIN tb_parametros prm ON (prm.ca_casouso = 'CU011' and exm.ca_tipoexpo = prm.ca_identificacion) ";
        $subque.= "INNER JOIN tb_parametros pre ON (pre.ca_casouso = prm.ca_valor2 and pre.ca_identificacion = ext.ca_idevento) ";
        $subque.= "order by ca_referencia_exm) exe ON (vi_repindicador_expall.ca_referencia = exe.ca_referencia_exm) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 573: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $ind_mem = 14;
        $add_cols = 7;
        $cot_ant = null;
        $campos.= ", $source.ca_referencia, exe.ca_fchevento, exe.ca_idevento, exe.ca_usuario";
    } else if (stripos($indicador, "Oportunidad en la Facturación") !== FALSE and $departamento == "Exportaciones") {
        $tipo = "D";
        $impoexpo = "ca_impoexpo = 'Exportación'";
        if (substr($indicador, 0, 6) == 'Aduana') {
            $impoexpo.= " and ca_nomsia IN ('COLMAS S.A.S.','AGENCIA DE ADUANAS COLMAS SAS NIVEL 1')";
        }
        $source = "vi_repindicador_expall";
        $subque = "LEFT OUTER JOIN (select ca_consecutivo as ca_consecutivo_sub, ca_fchsalida, ca_horasalida from tb_repstatus rps LEFT OUTER JOIN ( select max(srps.ca_idstatus) as ca_idstatus, srpt.ca_consecutivo from tb_repstatus srps LEFT OUTER JOIN tb_reportes srpt ON (srps.ca_idreporte = srpt.ca_idreporte) where srpt.ca_impoexpo = 'Exportación'  group by ca_consecutivo) rpf ON (rps.ca_idstatus = rpf.ca_idstatus)) rs ON (rs.ca_consecutivo_sub = vi_repindicador_expall.ca_consecutivo) ";

        $evento = ($tra_mem == 'Marítimo') ? "Recibo de Soportes desde Puerto" : "DEX";
        $subque.= "LEFT OUTER JOIN (select exm.ca_referencia_exm, ext.ca_idevento, ext.ca_fchevento, ext.ca_fechadoc, pre.ca_valor from ((select ca_referencia as ca_referencia_exm, ca_tipoexpo from tb_expo_maestra) UNION (select ca_referencia as ca_referencia_exm, (ca_datos->'modalidad'->>0)::int as ca_tipoexpo FROM ino.tb_master WHERE ca_impoexpo = 'Exportación')) as exm ";
        $subque.= "LEFT OUTER JOIN (select et.ca_referencia as ca_referencia_ext, et.ca_idevento, min(et.ca_fchevento) as ca_fchevento, min(ea.ca_fechadoc) as ca_fechadoc from tb_expo_tracking et LEFT JOIN tb_expo_aedex ea ON et.ca_referencia = ea.ca_referencia and et.ca_idevento = ea.ca_idevento where ca_realizado = 1 group by et.ca_referencia, et.ca_idevento) ext ON (ext.ca_referencia_ext = exm.ca_referencia_exm) ";
        $subque.= "INNER JOIN tb_parametros prm ON (prm.ca_casouso = 'CU011' and exm.ca_tipoexpo = prm.ca_identificacion) ";
        $subque.= "INNER JOIN tb_parametros pre ON (pre.ca_casouso = prm.ca_valor2 and pre.ca_identificacion = ext.ca_idevento and pre.ca_valor = '$evento') ";
        $subque.= "order by ca_referencia_exm) exe ON (vi_repindicador_expall.ca_referencia = exe.ca_referencia_exm) ";

        //$subque.= "LEFT OUTER JOIN (select DISTINCT subf.ca_referencia_sub, subf.ca_fchfactura, subf.ca_usuario, fact.ca_observaciones from tb_expo_ingresos fact INNER JOIN (select ca_referencia as ca_referencia_sub, min(ca_fchfactura) as ca_fchfactura, min(ca_usucreado) as ca_usuario from tb_expo_ingresos group by ca_referencia) subf ON fact.ca_referencia = subf.ca_referencia_sub and fact.ca_fchfactura = subf.ca_fchfactura) rf ON (rf.ca_referencia_sub = vi_repindicador_expall.ca_referencia) ";
        $subque.= "LEFT OUTER JOIN ((SELECT DISTINCT subf.ca_referencia_sub, subf.ca_fchfactura, subf.ca_usuario, fact.ca_observaciones FROM tb_expo_ingresos fact INNER JOIN (SELECT ca_referencia as ca_referencia_sub, min(ca_fchfactura) as ca_fchfactura, min(ca_usucreado) as ca_usuario FROM tb_expo_ingresos GROUP BY ca_referencia) subf ON fact.ca_referencia = subf.ca_referencia_sub and fact.ca_fchfactura = subf.ca_fchfactura) UNION (SELECT mast.ca_referencia as ca_referencia_sub, fact.ca_fchcomprobante as ca_fchfactura, ca_usuario, prm.ca_valor as ca_observaciones FROM ino.tb_comprobantes fact INNER JOIN ino.tb_house h ON h.ca_idhouse = fact.ca_idhouse INNER JOIN ino.tb_master mast ON mast.ca_idmaster = h.ca_idmaster INNER JOIN (SELECT c.ca_idhouse, min(ca_fchgenero) as ca_fchgenero, min(ca_usugenero) as ca_usuario FROM ino.tb_comprobantes c GROUP BY c.ca_idhouse ORDER BY ca_idhouse ASC) as fc ON fc.ca_idhouse  = fact.ca_idhouse and fc.ca_fchgenero = fact.ca_fchgenero LEFT JOIN tb_parametros prm ON (prm.ca_casouso = 'CU275' and (((fact.ca_datos -> 'idg'::text) -> 'OFC'::text) -> 'idexclusion')::text::numeric = prm.ca_identificacion) WHERE fact.ca_estado = 5 and fact.ca_fchanulado IS NULL and mast.ca_impoexpo = 'Exportación' ORDER BY mast.ca_referencia ASC, ca_fchfactura ASC )) rf ON (rf.ca_referencia_sub = vi_repindicador_expall.ca_referencia) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 606: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $ind_mem = 15;
        $add_cols = 7;
        $cot_ant = null;
        $campos.= ", $source.ca_referencia";
    } else if ($indicador == "Oportunidad en Revision de Documentos") {
        $format_avg = "H:i:s";
        $source = "vi_repindicadores_otm";
        $transporte = "ca_transporte = 'Terrestre'";
        $subque = "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio as ca_fchrecibo from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte and rps.ca_etapa = 'OTRDO') group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) order by rp.ca_consecutivo, ca_fchrecibo) sq ON ($source.ca_consecutivo = sq.ca_consecutivo_sub) ";
        $subque.= "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio as ca_fchrevision from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte and rps.ca_etapa = 'OTRVD') group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) order by rp.ca_consecutivo, ca_fchrecibo) sf ON ($source.ca_consecutivo = sf.ca_consecutivo_sub) ";
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 629: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 16;
        $add_cols = 3;
    } else if ($indicador == "Oportunidad en Finalización") {
        $tipo = "D";
        $source = "vi_repindicadores_otm";
        $transporte = "ca_transporte = 'Terrestre'";
        $subque = "LEFT OUTER JOIN (select ca_idreporte, ca_fechafinalizacion, ca_fchpresentacion from tb_repotm) ro ON ($source.ca_idreporte = ro.ca_idreporte) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 650: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 17;
        $add_cols = 3;
    } else if ($indicador == "Oportunidad en Aceptacion") {
        $tipo = "D";
        $source = "vi_repindicadores_otm";
        $transporte = "ca_transporte = 'Terrestre'";
        $subque = "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio as ca_fchaceptacion from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte and rps.ca_etapa = 'OTACP') group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) order by rp.ca_consecutivo, ca_fchrecibo) sq ON ($source.ca_consecutivo = sq.ca_consecutivo_sub) ";
        $subque.= "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio as ca_fchcargue from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte and rps.ca_etapa = 'OTPRC') group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) order by rp.ca_consecutivo, ca_fchrecibo) sd ON ($source.ca_consecutivo = sd.ca_consecutivo_sub) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 672: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 18;
        $add_cols = 3;
    } else if ($indicador == "Oportunidad en Despacho") {
        $tipo = "D";
        $source = "vi_repindicadores_otm";
        $transporte = "ca_transporte = 'Terrestre'";
        $subque = "LEFT OUTER JOIN (select ca_idreporte, ca_fechafinalizacion from tb_repotm)  ro ON $source.ca_idreporte = ro.ca_idreporte ";
        $subque.= "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio as ca_fchdespacho from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte and rps.ca_etapa = 'OTDES') group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) order by rp.ca_consecutivo, ca_fchrecibo) sq ON ($source.ca_consecutivo = sq.ca_consecutivo_sub) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 693: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 19;
        $add_cols = 3;
    } else if ($indicador == "Oportunidad en Facturacion") {
        $tipo = "D";
        $source = "vi_repindicadores_otm";
        $transporte = "ca_transporte = 'Terrestre'";
        $subque = " LEFT OUTER JOIN (select ii.ca_referencia, ii.ca_idcliente, ii.ca_hbls, rp.ca_consecutivo as ca_consecutivo_ref, ii.ca_fchfactura, ii.ca_observaciones from tb_inoingresos_sea ii inner join tb_inomaestra_sea im on ii.ca_referencia = im.ca_referencia inner join tb_inoclientes_sea ic on ii.ca_referencia = ic.ca_referencia and ii.ca_idcliente = ic.ca_idcliente and ii.ca_hbls = ic.ca_hbls inner join tb_reportes rp on ic.ca_idreporte = rp.ca_idreporte where im.ca_impoexpo = 'OTM/DTA' and substr(ii.ca_observaciones,1,7) = 'OTM/DTA') rs2 ON ($source.ca_consecutivo = rs2.ca_consecutivo_ref) ";
        $subque.= " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_cont, (string_to_array(rs.ca_propiedades, '='::text))[2] as ca_fchplanilla, min(rs.ca_fchenvio) as ca_fchconf_plan from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = '99999') group by rp.ca_consecutivo, rs.ca_propiedades order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_cont) ";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 719: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 20;
        $add_cols = 4;
    } else if ($indicador == "Oportunidad en Facturación Contenedores") {
        $source = "vi_repindicador_cnt";
        $subque.= " 
            LEFT OUTER JOIN (
	select c.ca_referencia as ca_referencia_fac, c.ca_idcliente as ca_idcliente_fac, 
		c.ca_hbls as ca_hbls_fac, i.ca_factura, i.ca_fchfactura, i.ca_usucreado, i.ca_observaciones 
	from tb_inoingresos_sea i
	inner join tb_inoclientes_sea c on c.ca_idinocliente=i.ca_idinocliente

where i.oid in (
			select min(oid) from tb_inoingresos_sea 
			where ca_observaciones = 'Contenedores' 			) 
	order by ca_referencia, ca_idcliente, ca_hbls, ca_fchfactura)            
 ii ON ($source.ca_referencia = ii.ca_referencia_fac and $source.ca_idcliente = ii.ca_idcliente_fac and $source.ca_hbls = ii.ca_hbls_fac) ";
        $campos.= ", ca_referencia, ca_idcliente_fac, ca_hbls, ca_fchfactura";

        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 735: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }

        $ind_mem = 21;
        $add_cols = 9;
    } else if ($indicador == "Oportunidad en el envío de las comunicaciones marítimas") {
        $format_avg = "H:i:s";
        $source = "vi_repindicador_sea";
        $subque = "INNER JOIN (
                        select to_char(ca_fchrecibo,'YYYY') as ca_ano_new, to_char(ca_fchrecibo,'MM') as ca_mes_new, rs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_conf,rs.ca_fchenvio, u.ca_departamento, rs.ca_fchrecibo, rs.ca_usuenvio, rs.ca_observaciones_idg 
                        ,CASE WHEN rs.ca_idetapa= '88888' THEN 'Status' WHEN rs.ca_idetapa = 'IMDES' THEN 'Desconsolidación' WHEN rs.ca_idetapa = 'IMPLA' THEN 'Planilla' END
                        from tb_repstatus rs 
                                INNER JOIN tb_reportes rp ON (rp.ca_transporte = 'Marítimo' and rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa IN ('88888','IMDES','IMPLA'))
                                LEFT JOIN tb_emails e ON rs.ca_idemail = e.ca_idemail
                                LEFT JOIN control.tb_usuarios u ON rs.ca_usuenvio = u.ca_login
                    WHERE (ca_subject NOT LIKE '%Factura de%' or ca_subject NOT LIKE '%Recargos Locales Id.:%') and rs.ca_tipo = 2 and u.ca_departamento NOT IN ('OTM','Operativo')
                    ORDER BY rp.ca_consecutivo, rs.ca_fchenvio ) rs1 ON (vi_repindicador_sea.ca_consecutivo = rs1.ca_consecutivo_conf) ";
        $sql = "select ca_fchfestivo from tb_festivos";
        if (!$tm->Open($sql)) {
            echo "Error 399: $sql";
            //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            //echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        $festi = array();
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $festi[] = $tm->Value('ca_fchfestivo');
            $tm->MoveNext();
        }
        $tm->MoveFirst();
        $ind_mem = 22;
        $add_cols = 6;
        $campos.= ",ca_mes";
    }

    $queries = "select * from $source $subque where " . ($impoexpo ? $impoexpo . " and " : "") . "  $sucursal $cliente and " . ($ciudestino ? $ciudestino . " and" : "") . "   " . ($transporte ? $transporte . " and" : "") . " $ano and $mes";
    $queries.= " order by $campos";
//    die($queries);
    //echo $queries;
    if (!$rs->Open("$queries")) {                              // Selecciona todos lo registros de la vista vi_repgerencia_sea
        echo "Error 755: $queries";
        //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";        // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=" . ($tot_cols + $add_cols) . ">" . COLTRANS . "<BR>$titulo<BR>Indicador $indicador $mes_tit / $ano_tit</TH>";
    echo "</TR>";
    $saltos = array();
    $titems = array();
    echo "<TR>";
    echo "	<TH>#</TH>";
    if ($ind_mem == 8) {
        echo "	<TH>Cotización</TH>";
        echo "	<TH>Ver.</TH>";
    } else if (!in_array($ind_mem, array(10, 11))) {
        echo "	<TH>Reporte</TH>";
        echo "	<TH>Ver.</TH>";
    }

    echo "	<TH>Año</TH>";
    echo "	<TH>Mes</TH>";
    echo "	<TH>Sucursal</TH>";
    echo "	<TH>T.Origen</TH>";
    echo "	<TH>Destino</TH>";
    echo "	<TH>Transporte</TH>";
    echo "	<TH>Modalidad</TH>";
    echo "	<TH>Cliente</TH>";
    switch ($ind_mem) {
        case 1:
            echo "	<TH>Fch.Salida</TH>";
            echo "	<TH>Usuario Env.</TH>";
            echo "	<TH>Envío Msg</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 2:
            echo "	<TH>Fch.Salida</TH>";
            echo "	<TH>Fch.Llegada</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 3:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>Fch.Llegada</TH>";
            echo "	<TH>Fch.Desconsolidación</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 4:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>Continuación</TH>";
            if ($departamento == 'Aéreo' or $departamento == 'Marítimo') {
                echo "	<TH>Fch.Llegada</TH>";
            } else if ($departamento == 'Terrestre') {
                echo "	<TH>Fch.Planilla</TH>";
            }
            if ($departamento == 'Marítimo') {
                echo "	<TH>Fch.Envio Email</TH>";
            } else {
                echo "	<TH>Fch.Factura</TH>";
            }
            if ($departamento == 'Aéreo'){
                echo "	<TH>Fch.Envío</TH>";
            }
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Observaciones</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 5:
            echo "	<TH>Ciu.Origen</TH>";
            echo "	<TH>Fch.Status</TH>";
            echo "	<TH>Envío Msg</TH>";
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Dif.</TH>";
            echo "	<TH>Observaciones</TH>";
            echo "	<TH>Etapa</TH>";
            break;
        case 6:
            echo "	<TH>Fch.Reporte</TH>";
            echo "	<TH>Primer Status</TH>";
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 7:
            echo "	<TH>E.T.A.</TH>";
            echo "	<TH>Fch.Llegada</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 8:
            echo "	<TH>Vendedor</TH>";
            echo "	<TH>Fch.Solicitud</TH>";
            echo "	<TH>Fch.Envio</TH>";
            echo "	<TH>Usu.Envio</TH>";
            echo "	<TH>Observaciones</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 9:
            echo "	<TH>Referencia</TH>";
            echo " <TH>ETA</TH>";
            echo "	<TH>Fch.Llegada</TH>";
            echo "	<TH>Fch.Confirmación</TH>";
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Dif.</TH>";
            echo "	<TH>Observaciones</TH>";
            break;
        case 10:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>Coordinador</TH>";
            echo "	<TH>Eventos</TH>";
            echo "	<TH>Calculos</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 11:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>Observaciones</TH>";
            echo "	<TH>Coordinador</TH>";
            echo "	<TH>Facturó</TH>";
            echo "	<TH>Eventos</TH>";
            echo "	<TH>Calculos</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 14:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>IDG</TH>";
            echo "	<TH>Ag.Aduana</TH>";
            echo "	<TH>Observaciones</TH>";
            echo "	<TH>Eventos</TH>";
            echo "	<TH>Calculos</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 15:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>IDG</TH>";
            echo "	<TH>Ag.Aduana</TH>";
            echo "	<TH>Observaciones</TH>";
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Calculos</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 16:
            echo "	<TH>Fch.Rec.Docs</TH>";
            echo "	<TH>Fch.Rev.Docs</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 17:
            echo "	<TH>Fch.Finalizacion</TH>";
            echo "	<TH>Fch.Presentacion</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 18:
            echo "	<TH>Fch.Aceptación</TH>";
            echo "	<TH>Fch.Cargue</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 19:
            echo "	<TH>Fch.Despacho</TH>";
            echo "	<TH>Fch.Finalización</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 20:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>Fch.Facturación</TH>";
            echo "	<TH>Fch.Planilla</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 21:
            echo "	<TH>Referencia</TH>";
            echo "	<TH>Cliente</TH>";
            echo "	<TH>Costo</TH>";
            echo "	<TH>Fact.Proveedor</TH>";
            echo "	<TH>Fecha Factura</TH>";
            echo "	<TH>Fact.Cliente</TH>";
            echo "	<TH>Fecha Factura</TH>";
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Dif.</TH>";
            break;
        case 22:
            echo "	<TH>Tipo</TH>";
            echo "	<TH>Fch.Recibo</TH>";
            echo "	<TH>Envío Msg</TH>";
            echo "	<TH>Usuario</TH>";
            echo "	<TH>Dif.</TH>";
            echo "	<TH>Observaciones</TH>";
            break;
    }
    echo "</TR>";
    $rs->MoveFirst();
    $contador = 1;
    $data = array();
    echo $rs->Eof();
    echo $rs->IsEmpty();
    while (!$rs->Eof() and ! $rs->IsEmpty()) {                                  // Lee la totalidad de los registros obtenidos en la instrucción Select
        //echo "paso por aqui";
        $adicionales = false;
        if ($ind_mem == 3 and ( $rs->Value('ca_transporte') != 'Marítimo' or $rs->Value('ca_modalidad') != 'LCL')) {
            $rs->MoveNext();
            continue;
        } else if ($ind_mem == 8 and $rs->Value('ca_consecutivo') == $cot_ant and false) {
            echo "  <TD Class=mostrar COLSPAN='3'></TD>";
            $rs->MoveNext();
            continue;
        }
        $sql = "select suc.ca_nombre as ca_sucursal, suc.ca_entrada, suc.ca_salida, emp.ca_nombre as ca_empresa from control.tb_sucursales suc inner join control.tb_empresas emp on suc.ca_idempresa = emp.ca_idempresa where emp.ca_nombre = 'Coltrans S.A.S.' and suc.ca_nombre = '" . $rs->Value('ca_sucursal') . "'";
        if (!$tm->Open($sql)) {
            echo "Error 940: $sql";
//            echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
//            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        while (!$tm->Eof() and ! $tm->IsEmpty()) {
            $entrada = $tm->Value('ca_entrada');    // Hora de entrada para la sucursal
            $salida = $tm->Value('ca_salida');    // Hora de salida para la sucursal
            $tm->MoveNext();
        }

        echo "<TR>";
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $contador++ . "</TD>";
        if ($ind_mem == 8) {
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_consecutivo') . "</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_version') . "</TD>";
        } else if (!in_array($ind_mem, array(10, 11))) {
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_consecutivo') . "</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_version') . "</TD>";
        }
        if ($ind_mem == 5 or $ind_mem == 16 or $ind_mem == 22) {
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_ano_new') . "</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_mes_new') . "</TD>";
        } else {
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_ano') . "</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_mes') . "</TD>";
        }
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_sucursal') . "</TD>";
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_traorigen') . "</TD>";
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_ciudestino') . "</TD>";
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_transporte') . "</TD>";
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_modalidad') . "</TD>";
        echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_compania') . "</TD>";

        //echo "-------------------------------->".$ind_mem."<br /><br /><br />";
        switch ($ind_mem) {
            case 1:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchsalida') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_usuenvio') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchenvio') . "</TD>";
                echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>" . $rs->Value('ca_diferencia') . "</TD>";
                $data[] = array($rs->Value('ca_usuenvio') => array($rs->Value('ca_mes') => $rs->Value('ca_diferencia')));
                break;
            case 2:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchsalida') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchllegada') . "</TD>";
                echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>" . $rs->Value('ca_diferencia') . "</TD>";
                $data[] = array($rs->Value('ca_traorigen') => array($rs->Value('ca_mes') => $rs->Value('ca_diferencia')));
                break;
            case 3:
                $sql = "select ic.ca_referencia, rp.ca_consecutivo, im.ca_fchconfirmacion, (CASE WHEN to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') < im.ca_fchconfirmacion THEN NULL ELSE to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') END) as ca_fchdesconsolidacion, (CASE WHEN to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') < im.ca_fchconfirmacion THEN NULL ELSE to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') END)-im.ca_fchconfirmacion as ca_diferencia from tb_inoclientes_sea ic LEFT OUTER JOIN tb_reportes rp ON (ic.ca_idreporte::text = rp.ca_idreporte::text) LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia) where ca_consecutivo = '" . $rs->Value('ca_consecutivo') . "' order by ic.ca_referencia, im.ca_fchconfirmacion";
                if (!$tm->Open($sql)) {
                    echo "Error 963: $sql";
                    //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'repindicadornew.php';</script>";
                    exit;
                }
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $tm->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $tm->Value('ca_fchconfirmacion') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $tm->Value('ca_fchdesconsolidacion') . "</TD>";
                echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>" . $tm->Value('ca_diferencia') . "</TD>";
                $data[] = array($rs->Value('ca_ciudestino') => array($rs->Value('ca_mes') => $rs->Value('ca_diferencia')));
                break;
            case 4:
                $ref_tmp = $rs->Value('ca_referencia');
                $idc_tmp = $rs->Value('ca_idcliente');
                $hbl_tmp = $rs->Value('ca_hbls');
                $fch_llegada = ($departamento == "OTM") ? $rs->Value('ca_fchplanilla') : $rs->Value('ca_fchllegada');
                $fch_factura = ($departamento == "Marítimo") ? $rs->Value('ca_fchenvio') :($rs->Value('ca_fchenvio')?$rs->Value('ca_fchenvio'):$rs->Value('ca_fchfactura'));
                //$fch_factura = ($departamento == "Marítimo") ? $rs->Value('ca_fchenvio') :$rs->Value('ca_fchfactura');
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_continuacion') . "</TD>";
                if (in_array(trim($rs->Value("ca_observaciones")), array("Facturación al Agente", "Facturacion al Agente","Reemplazo Factura", "Cierre contable de Clientes", "Referencia Particulares", "Acuerdos Comerciales","Costos de Origen no informados a tiempo"))) {
                    $dif_mem = null;
                } else {
                    if ($rs->Value('ca_continuacion') == "CABOTAJE") {
                        $fch_llegada = $rs->Value('ca_fchcontinuacion');
                    }
                    $dif_mem = workDiff($festi, $fch_llegada, $fch_factura);
                }

                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("D", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $fch_llegada . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $fch_factura . "</TD>";
                if ($departamento == 'Aéreo') {
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchenvio') . "</TD>";
                }
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usucreado') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value("ca_observaciones") . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                echo "</TR>";
                if ($departamento == 'Marítimo') {
                    $data[] = array($rs->Value('ca_usucreado') => array(substr($fch_llegada, 5, 2) => $dif_mem));
                } elseif ($departamento == 'Aéreo') {
                    $data[] = array($rs->Value('ca_usucreado') => array($rs->Value('ca_mes') => $dif_mem));
                }
                /*
                  if ($departamento != "OTM") {
                  $avanza = false;
                  if ($rs->Value('ca_continuacion') == "N/A") {
                  $avanza = true;
                  while ($rs->Value('ca_referencia') == $ref_tmp and $rs->Value('ca_idcliente') == $idc_tmp and $rs->Value('ca_hbls') == $hbl_tmp and !$rs->Eof()) {
                  $rs->MoveNext(); // Omite las facturas adicionales sobre una misma carga.
                  }
                  } else if ($rs->Value('ca_continuacion') == "OTM" or $rs->Value('ca_continuacion') == "DTA") {
                  $avanza = true;
                  while ($rs->Value('ca_referencia') == $ref_tmp and $rs->Value('ca_idcliente') == $idc_tmp and $rs->Value('ca_hbls') == $hbl_tmp and !$rs->Eof()) {
                  if (trim($rs->Value('ca_observaciones')) == "OTM/DTA") { // Busca la Factura por el OTM o el DTA
                  echo "<TR>";
                  echo "  <TD Class=mostrar style='font-size: 9px;'>" . $contador++ . "</TD>";
                  echo "  <TD Class=mostrar COLSPAN=12></TD>";
                  if (in_array($rs->Value("ca_observaciones"), array("Facturación al Agente", "Reemplazo Factura", "Cierre contable de Clientes"))) {
                  $dif_mem = null;
                  } else {
                  $dif_mem = workDiff($festi, $rs->Value('ca_fchplanilla'), $rs->Value('ca_fchfactura'));
                  }
                  $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                  $color = analizar_dif("D", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                  echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchplanilla') . "</TD>";
                  echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchfactura') . "</TD>";
                  echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value("ca_observaciones") . "</TD>";
                  echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                  echo "</TR>";
                  }
                  $rs->MoveNext();
                  }
                  }
                  if ($avanza and !$rs->Eof()) {           // Retrocede un registro para quedar en la última factura del Hbl de una Referencia
                  $rs->MovePrevious();
                  }
                  } */
                break;
            case 5:
                $idreporte = $rs->Value('ca_idreporte');
                while ($idreporte == $rs->Value('ca_idreporte') and ! $rs->Eof() and ! $rs->IsEmpty()) {
                    if ($adicionales) {
                        echo "<TR>";
                        echo "  <TD Class=mostrar COLSPAN=11></TD>";
                    }
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchrecibo'), "%d-%d-%d %d:%d:%d");
                    $tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
                    $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    
                    if ($departamento == "Aéreo" && $rs->Value('ca_etapa')=="Comunicaciones Varias") {
                        $dif_mem = null;
                    }else{
                        $dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado, $entrada, $salida);
                    }
                    $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                    $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_ciuorigen') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchrecibo') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchenvio') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usuenvio') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_observaciones_idg') . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_etapa') . "</TD>";
                    if ($adicionales) {
                        echo "</TR>";
                    }
                    $adicionales = true;
                    $data[] = array($rs->Value('ca_usuenvio') => array($rs->Value('ca_mes_new') => hourTosec($dif_mem)));
                    $rs->MoveNext(); // Buscar Todos los Status de un Embarque
                }
                if (!$rs->Eof()) {           // Retrocede un registro para quedar en el último Status del Reporte
                    $rs->MovePrevious();
                }
                if (!$adicionales) {
                    echo "  <TD Class=mostrar></TD>";
                    echo "  <TD Class=mostrar></TD>";
                    echo "  <TD Class=invertir></TD>";
                }
                //$data[] = array($rs->Value('ca_usuenvio')=>array($rs->Value('ca_mes_new')=>hourTosec($dif_mem)));
                break;
            case 6:
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchcreado'), "%d-%d-%d %d:%d:%d");
                $tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
                $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                $dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado, $entrada, $salida);
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchcreado') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchenvio') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usuenvio') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                $data[] = array($rs->Value('ca_usuenvio') => array($rs->Value('ca_mes') => hourTosec($dif_mem)));
                break;
            case 7:
                $sql = "select rs.ca_fchllegada from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where ca_consecutivo = '" . $rs->Value('ca_consecutivo') . "' order by ca_fchllegada";
                if (!$tm->Open($sql)) {       // Selecciona todos lo registros de la tabla Status
                    echo "Error 1092: $sql";
                    //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'repindicadornew.php';</script>";
                    exit;
                }
                $first_date = true;
                $fch_eta = $fch_llegada = null;
                $tm->MoveFirst();

                while (!$tm->Eof() and ! $tm->IsEmpty()) {
                    if ($first_date and strlen($tm->Value('ca_fchllegada')) != 0) {
                        $fch_eta = $tm->Value('ca_fchllegada');
                        $first_date = false;
                    }
                    if (strlen($tm->Value('ca_fchllegada')) != 0) {
                        $fch_llegada = $tm->Value('ca_fchllegada');
                    }
                    $tm->MoveNext();
                }
                $dif_mem = dateDiff($fch_eta, $fch_llegada);
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("D", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>$fch_eta</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>$fch_llegada</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                $data[] = array($rs->Value('ca_traorigen') => array($rs->Value('ca_mes') => $dif_mem));
                break;
            case 8:
                if ($rs->Value('ca_fchsolicitud') != $ini_ant or $rs->Value('ca_fchpresentacion') != $fin_ant) {
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchsolicitud'), "%d-%d-%d %d:%d:%d");
                    $tstamp_confirmado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchpresentacion'), "%d-%d-%d %d:%d:%d");
                    $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    $dif_mem = calc_dif($festi, $tstamp_confirmado, $tstamp_enviado, $entrada, $salida);
                    $ini_ant = $rs->Value('ca_fchsolicitud');
                    $fin_ant = $rs->Value('ca_fchpresentacion');
                }
                if (trim($rs->Value("ca_observaciones")) == "Licitaciones" or trim($rs->Value("ca_observaciones")) == "Acuerdos autorizados") {
                    $dif_mem = null;
                }
                // if ((trim($rs->Value("ca_observaciones")) == "Gastos en origen" or trim($rs->Value("ca_observaciones")) == "Gastos proveedores") and ($rs->Value('ca_sucursal') == "Pereira" or $rs->Value('ca_sucursal') == "Bucaramanga")) {
                if (trim($rs->Value("ca_observaciones")) == "Gastos en origen" or trim($rs->Value("ca_observaciones")) == "Gastos proveedores") {
                    $dif_mem = null;
                }
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usuario') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchsolicitud') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchpresentacion') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usupresentacion') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_observaciones') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                $cot_ant = $rs->Value('ca_consecutivo');
                $ver_ant = $rs->Value('ca_version');
                while ($cot_ant == $rs->Value('ca_consecutivo') and $ver_ant == $rs->Value('ca_version') and ! $rs->Eof() and ! $rs->IsEmpty()) {
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px;' COLSPAN=5>&nbsp;</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px;'>" . $rs->Value('ca_traorigen') . "</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px;'>" . $rs->Value('ca_ciudestino') . "</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px;'>" . $rs->Value('ca_transporte') . "</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px;'>" . $rs->Value('ca_modalidad') . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;' COLSPAN=8>&nbsp;</TD>";
                    echo "</TR>";
                    $rs->MoveNext();
                }
                if (!$rs->Eof()) {           // Retrocede un registro para quedar en el último Producto de la Cotización
                    $rs->MovePrevious();
                }
                $data[] = array($rs->Value('ca_usuario') => array($rs->Value('ca_mes') => hourTosec($dif_mem)));
                break;
            case 9:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_eta') . "</TD>";
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    $fch_mem = $rs->Value('ca_fchllegada');
                    if ($rs->Value('ca_fchllegada') != $ini_ant or $rs->Value('ca_fchconf_lleg') != $fin_ant) {
                        $dif_mem = dateDiff($rs->Value('ca_fchllegada'), $rs->Value('ca_fchconf_lleg'));
                        $ini_ant = $rs->Value('ca_fchllegada');
                        $fin_ant = $rs->Value('ca_fchconf_lleg');
                    }
                } else if ($rs->Value('ca_transporte') == 'Marítimo') {
                    $fch_mem = $rs->Value('ca_fchconfirmacion');
                    if ($rs->Value('ca_fchconfirmacion') != $ini_ant or $rs->Value('ca_fchconf_lleg') != $fin_ant) {
                        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchconfirmacion'), "%d-%d-%d %d:%d:%d");
                        $tstamp_confirmado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchconf_lleg'), "%d-%d-%d %d:%d:%d");
                        $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                        $dif_mem = calc_dif($festi, $tstamp_confirmado, $tstamp_enviado, $entrada, $salida);
                        $ini_ant = $rs->Value('ca_fchconfirmacion');
                        $fin_ant = $rs->Value('ca_fchconf_lleg');
                    }
                }
                $dif_mem = (is_null($dif_mem) and $rs->Value('ca_transporte') == 'Marítimo') ? null : $dif_mem;
                $dif_mem = ($rs->Value("ca_eta") > $ult_dia or $rs->Value("ca_eta") >= date("Y-m-d")) ? null : $dif_mem;

                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif($tipo, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $fch_mem . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchconf_lleg') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usuenvio') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_observaciones_idg') . "</TD>";
                $data[] = array($rs->Value('ca_usuenvio') => array($rs->Value('ca_mes') => hourTosec($dif_mem)));
                continue;
                break;
            case 10:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_coordinador') . "</TD>";

                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";
                $int_dos = "";
                $int_tres = "";
                $array_eventos = array();
                $matriz_eventos = array();
                $referencia = $rs->Value('ca_referencia');
                $fcn_ini = $rs->Value('ca_fchcreado');  // Toma la Fecha y hora de creacion de la referencia
                $int_uno = "00";
                $matriz_eventos["intervalo_1"][$int_uno] = $fcn_ini;
                $array_eventos[$int_uno] = "Fch. Referencia";


                echo "<TR>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>Fch. Referencia</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchcreado') . "</TD>";
                echo "</TR>";

                $dif_ref = 0;
                $exc_dig = true;
                $exc_fac = true;
                $exc_idg = ($rs->Value('ca_aplicaidg') == "t") ? true : false;
                while ($referencia == $rs->Value('ca_referencia') and ! $rs->Eof() and ! $rs->IsEmpty()) {
                    $array_eventos[$rs->Value('ca_valor2')] = $rs->Value('ca_valor');
                    $fchEventoArry = date_parse($rs->Value('ca_fchevento'));
                    $fchEvento = date("Y-m-d H:i:s", mktime($fchEventoArry["hour"], $fchEventoArry["minute"], $fchEventoArry["second"], $fchEventoArry["month"], $fchEventoArry["day"], $fchEventoArry["year"]));

                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_valor') . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>" . $fchEvento . "</TD>";
                    echo "</TR>";

                    if (in_array($rs->Value('ca_idevento'), array(25))) { //Evalua si el evento abre el primer invervalo
                        if ($matriz_eventos["intervalo_1"][$int_uno] < $fchEvento) {
                            unset($matriz_eventos["intervalo_1"][$int_uno]);
                            $matriz_eventos["intervalo_1"][$rs->Value('ca_valor2')] = $fchEvento;
                            $fcn_ini = $fchEvento;
                        }
                    }

                    if (in_array($rs->Value('ca_idevento'), array(26))) { //Evalua si el evento cierra el primer invervalo
                        $matriz_eventos["intervalo_1"][$rs->Value('ca_valor2')] = $fchEvento;
                    }

                    if (in_array($rs->Value('ca_idevento'), array(1)))  //Evalua si el evento abre el segundo invervalo
                        $matriz_eventos["intervalo_2"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                    if (in_array($rs->Value('ca_idevento'), array(2, 3))) {  //Evalua si el evento cierra el segundo invervalo
                        if (strlen($int_dos) != 0) {
                            if ($matriz_eventos["intervalo_2"][$int_dos] < $fchEvento) {
                                unset($matriz_eventos["intervalo_2"][$int_dos]);
                                $matriz_eventos["intervalo_2"][$rs->Value('ca_valor2')] = $fchEvento;
                            }
                        } else {
                            $matriz_eventos["intervalo_2"][$rs->Value('ca_valor2')] = $fchEvento;
                            $int_dos = $rs->Value('ca_valor2');
                        }
                    }

                    if (in_array($rs->Value('ca_idevento'), array(7))) {  //Evalua si el evento abre el tercer invervalo
                        $exc_dig = false;
                        $matriz_eventos["intervalo_3"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);
                    }

                    if (in_array($rs->Value('ca_idevento'), array(6, 8))) {  //Evalua si el evento cierra el tercer invervalo
                        if (strlen($int_tres) != 0) {
                            if ($matriz_eventos["intervalo_3"][$int_tres] < $fchEvento) {
                                unset($matriz_eventos["intervalo_3"][$int_tres]);
                                $matriz_eventos["intervalo_3"][$rs->Value('ca_valor2')] = $fchEvento;
                            }
                        } else {
                            $matriz_eventos["intervalo_3"][$rs->Value('ca_valor2')] = $fchEvento;
                            $int_tres = $rs->Value('ca_valor2');
                        }
                    }

                    if (in_array($rs->Value('ca_idevento'), array(9)))  //Evalua si el evento abre el cuarto A invervalo
                        $matriz_eventos["intervalo_4a"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                    if (in_array($rs->Value('ca_idevento'), array(10)))  //Evalua si el evento cierra el cuarto A invervalo
                        $matriz_eventos["intervalo_4a"][$rs->Value('ca_valor2')] = $fchEvento;

                    if (in_array($rs->Value('ca_idevento'), array(19)))  //Evalua si el evento abre el cuarto B invervalo
                        $matriz_eventos["intervalo_4b"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                    if (in_array($rs->Value('ca_idevento'), array(20)))  //Evalua si el evento cierra el cuarto B invervalo
                        $matriz_eventos["intervalo_4b"][$rs->Value('ca_valor2')] = $fchEvento;

                    if (in_array($rs->Value('ca_idevento'), array(18)))  //Evalua si el evento abre el quinto invervalo
                        $matriz_eventos["intervalo_5"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                    if (in_array($rs->Value('ca_idevento'), array(12)))  //Evalua si el evento cierra el quinto invervalo
                        $matriz_eventos["intervalo_5"][$rs->Value('ca_valor2')] = $fchEvento;

                    if (substr($rs->Value('ca_referencia'), 0, 3) == '200') {        // Evalua si es un referencia de Sucursal o de Puerto
                        if (in_array($rs->Value('ca_idevento'), array(13)))  //Evalua si el evento abre el sexto invervalo
                            $matriz_eventos["intervalo_6"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                        if (in_array($rs->Value('ca_idevento'), array(15))) {  //Evalua si el evento cierra el sexto invervalo
                            $exc_fac = false;
                            $matriz_eventos["intervalo_6"][$rs->Value('ca_valor2')] = $fchEvento;
                        }
                    } else {
                        if (in_array($rs->Value('ca_idevento'), array(14)))  //Evalua si el evento abre el sexto invervalo
                            $matriz_eventos["intervalo_7"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                        if (in_array($rs->Value('ca_idevento'), array(21)))  //Evalua si el evento cierra el sexto invervalo
                            $matriz_eventos["intervalo_7"][$rs->Value('ca_valor2')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'), array(22)))  //Evalua si el evento abre el noveno invervalo
                            $matriz_eventos["intervalo_9"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                        if (in_array($rs->Value('ca_idevento'), array(15))) {  //Evalua si el evento cierra el noveno invervalo
                            $exc_fac = false;
                            $matriz_eventos["intervalo_9"][$rs->Value('ca_valor2')] = $fchEvento;
                        }

                        if (in_array($rs->Value('ca_idevento'), array(23)))  //Evalua si el evento abre el decimo invervalo
                            $matriz_eventos["intervalo_10"][$rs->Value('ca_valor2')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                        if (in_array($rs->Value('ca_idevento'), array(24)))  //Evalua si el evento cierra el decimo invervalo
                            $matriz_eventos["intervalo_10"][$rs->Value('ca_valor2')] = $fchEvento;
                    }
                    $rs->MoveNext(); // Buscar Todos los Registros de la referencia
                }
                echo "  </TABLE></TD>";

                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";

                $ini_mem = true;
                foreach ($matriz_eventos as $intervalo) {
                    echo "<TR>";
                    $flag = true;
                    $ini_event = null;
                    $fin_event = null;
                    ksort($intervalo);
                    while (list ($clave, $val) = each($intervalo)) {
                        if ($flag) {
                            $ini_event = $val;
                            $flag = false;
                        } else {
                            $fin_event = $val;
                        }
                        echo "<TD>$array_eventos[$clave]<br /> $val</TD>";
                    }
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($ini_event, "%d-%d-%d %d:%d:%d");
                    $tstamp_inicial = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($fin_event, "%d-%d-%d %d:%d:%d");
                    $tstamp_final = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    $dif_mem = calc_dif($festi, $tstamp_inicial, $tstamp_final, $entrada, $salida);

                    list($hour, $minute, $second) = sscanf($dif_mem, "%d:%d:%d");
                    $temp = ($hour * 60) + ($minute);
                    $dif_ref+= $temp;

                    echo "<TD>Diferencia :<br />$dif_mem</TD>";
                    echo "</TR>";
                }
                echo "  </TABLE></TD>";

                $hour = intval($dif_ref / 60);
                $minute = $dif_ref % 60;

                $dif_ref = ($exc_dig or $exc_fac or ! $exc_idg) ? null : str_pad($hour, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minute, 2, "0", STR_PAD_LEFT) . ":" . str_pad(null, 2, "0", STR_PAD_LEFT);

                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif($tipo, $lcs_var, $dif_ref, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_ref . "</TD>";

                if (!$rs->Eof()) {           // Retrocede un registro para quedar en el último Producto de la Cotización
                    $rs->MovePrevious();
                }
                continue;
                break;
            case 11:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_observaciones') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_coordinador') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_usucreado') . "</TD>";
                $observaciones = $rs->Value("ca_observaciones");

                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";

                $excluir = true;
                $matriz_eventos = array();
                $referencia = $rs->Value('ca_referencia');
                while ($referencia == $rs->Value('ca_referencia') and ! $rs->Eof() and ! $rs->IsEmpty()) {
                    $fchEventoArry = date_parse($rs->Value('ca_fchevento'));
                    $fchEvento = date("Y-m-d", mktime($fchEventoArry["hour"], $fchEventoArry["minute"], $fchEventoArry["second"], $fchEventoArry["month"], $fchEventoArry["day"], $fchEventoArry["year"]));
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_valor') . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>" . $fchEvento . "</TD>";
                    echo "</TR>";
                    if (in_array($rs->Value('ca_idevento'), array(15)))  //Evalua si el evento abre el invervalo
                        $matriz_eventos["intervalo_1"][$rs->Value('ca_valor')] = (($fcn_ini > $fchEvento) ? $fcn_ini : $fchEvento);

                    if (in_array($rs->Value('ca_idevento'), array(17)))  //Evalua si el evento cierra el invervalo
                        $matriz_eventos["intervalo_1"][$rs->Value('ca_valor')] = $fchEvento;

                    $rs->MoveNext(); // Buscar Todos los Registros de la referencia
                }
                echo "  </TABLE></TD>";

                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";
                foreach ($matriz_eventos as $intervalo) {
                    echo "<TR>";
                    $flag = true;
                    $ini_event = null;
                    $fin_event = null;
                    while (list ($clave, $val) = each($intervalo)) {
                        if ($flag) {
                            $ini_event = $val;
                            $flag = false;
                        } else {
                            $fin_event = $val;
                        }
                        echo "<TD>$clave <br /> $val</TD>";
                    }
                    $dif_mem = workDiff($festi, $ini_event, $fin_event);
                    // echo $dif_mem;        
                    echo "</TR>";
                }
                echo "  </TABLE></TD>";
                $dif_mem = ($observaciones == 'Cierre Contable' or $observaciones == 'Anulación de Facturas' or $observaciones == 'Ajuste de Anticipo') ? null : $dif_mem;
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif($tipo, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";

                if (!$rs->Eof()) {           // Retrocede un registro para quedar en la última Referencia
                    $rs->MovePrevious();
                }
                $data[] = array($rs->Value('ca_usucreado') => array($rs->Value('ca_mes') => $dif_mem));
                continue;
                break;
            case 14:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . (($rs->Value('ca_aplicaidg') == 't') ? "Sí" : "No") . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_nomsia') . "</TD>";
                $sql = "select rps.* from tb_repstatus rps INNER JOIN tb_reportes rep ON rps.ca_idreporte = rep.ca_idreporte and rep.ca_consecutivo = '" . $rs->Value('ca_consecutivo') . "' where rps.ca_observaciones_idg IS NOT NULL order by ca_fchenvio";
                if (!$tm->Open($sql)) {
                    echo "Error 1437: $sql";
                    //echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'repindicadornew.php';</script>";
                    exit;
                }
                $observacionesIdg = "";
                if ($tm->GetRowCount() > 0) {
                    $tm->MoveFirst();
                    while (!$tm->Eof()) {           // Carga todas las observaciones de IDG
                        $observacionesIdg.= $tm->Value('ca_observaciones_idg');
                        $tm->MoveNext();
                        $observacionesIdg.= (!$tm->Eof()) ? "<br />" : "";
                    }
                }
                echo "  <TD Class=mostrar style='font-size: 9px;'>$observacionesIdg</TD>";

                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";
                $ult_mem = $rs->Value('ca_fchevento');
                $nom_sia = $rs->Value('ca_nomsia');
                $apl_idg = $rs->Value("ca_aplicaidg");
                $tip_tra = $rs->Value('ca_transporte');
                $rad_mem = null;
                $sae_mem = null;

                $matriz_eventos = array();
                $referencia = $rs->Value('ca_referencia');
                while ($referencia == $rs->Value('ca_referencia') and ! $rs->Eof() and ! $rs->IsEmpty()) {
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_valor') . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_usuario') . "</TD>";
                    $ult_mem = (!in_array($rs->Value('ca_valor'), $no_docs) and $rs->Value('ca_fchevento') > $ult_mem) ? $rs->Value('ca_fchevento') : $ult_mem;
                    if ($rs->Value('ca_valor') == 'Radicación Documento de Transporte') {
                        $fch_tmp = $rad_mem = $rs->Value('ca_fchevento');
                    } else if ($rs->Value('ca_valor') == 'SAE') {
                        $fch_tmp = $sae_mem = $rs->Value('ca_fechadoc');
                    } else {
                        $fch_tmp = $rs->Value('ca_fchevento');
                    }
                    echo "  <TD Class=mostrar style='font-size: 9px;'>$fch_tmp</TD>";
                    echo "</TR>";
                    $rs->MoveNext(); // Buscar Todos los Registros de la referencia
                }
                echo "  </TABLE></TD>";

                if (substr($indicador, 0, 6) == 'Aduana') {
                    $matriz_eventos["intervalo_1"]['Rec.Último Documento'] = $ult_mem;
                    $matriz_eventos["intervalo_1"]['SAE'] = $sae_mem;
                } else if (substr($indicador, 0, 5) == 'Carga') {
                    if (!is_null($sae_mem) and $nom_sia == 'COLMAS S.A.S.' and $tra_mem == 'Marítimo') {
                        $matriz_eventos["intervalo_1"]['SAE'] = $sae_mem;
                    } else {
                        $matriz_eventos["intervalo_1"]['Rec.Último Documento'] = $ult_mem;
                    }
                    $matriz_eventos["intervalo_1"]['Radicación Documento de Transporte'] = $rad_mem;
                }

                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";
                foreach ($matriz_eventos as $intervalo) {
                    echo "<TR>";
                    $flag = true;
                    $ini_event = null;
                    $fin_event = null;
                    while (list ($clave, $val) = each($intervalo)) {
                        if ($flag) {
                            $ini_event = $val;
                            $flag = false;
                        } else {
                            $fin_event = $val;
                        }
                        echo "<TD>$clave <br /> $val</TD>";
                    }
                    $dif_mem = workDiff($festi, $ini_event, $fin_event);
                    $dif_mem = (!is_null($ini_event) and ! is_null($fin_event) and $ini_event > $fin_event) ? 1 : $dif_mem;
                    echo "</TR>";
                }
                echo "  </TABLE></TD>";

                $dif_mem = ($apl_idg == 'f') ? null : $dif_mem;
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif($tipo, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";

                $data[] = array($rs->Value('ca_usuario') => array($rs->Value('ca_mes') => $dif_mem));

                if (!$rs->Eof()) {           // Retrocede un registro para quedar en en la última Referencia
                    $rs->MovePrevious();
                }
                continue;
                break;
            case 15:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . (($rs->Value('ca_aplicaidg') == 't') ? "Sí" : "No") . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_nomsia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_observaciones') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_usuario') . "</TD>";
                $nom_sia = $rs->Value('ca_nomsia');
                $apl_idg = $rs->Value("ca_aplicaidg");

                $matriz_eventos = array();
                if (substr($indicador, 0, 6) == 'Aduana') {
                    if ($tra_mem == 'Aéreo') {
                        $matriz_eventos["intervalo_1"]['DEX'] = $rs->Value('ca_fechadoc');
                    } else if ($tra_mem == 'Marítimo') {
                        $matriz_eventos["intervalo_1"]['Fch.Recibo Soportes'] = $rs->Value('ca_fchevento');
                    }
                } else if (substr($indicador, 0, 5) == 'Carga') {
                    if ($tra_mem == 'Aéreo') {
                        if ($nom_sia == 'COLMAS S.A.S.' || $nom_sia == 'AGENCIA DE ADUANAS COLMAS SAS NIVEL 1') {
                            $matriz_eventos["intervalo_1"]['DEX'] = $rs->Value('ca_fechadoc');
                        } else {
                            $matriz_eventos["intervalo_1"]['Fch.Carga Embarcada'] = $rs->Value('ca_fchsalida');
                        }
                    } else if ($tra_mem == 'Marítimo') {
                        $matriz_eventos["intervalo_1"]['Fch.Confirmación Salida'] = $rs->Value('ca_fchsalida');
                    }
                }
                $matriz_eventos["intervalo_1"]['Fch.Factura'] = $rs->Value('ca_fchfactura');

                $uno = true;
                echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";
                foreach ($matriz_eventos as $intervalo) {
                    echo "<TR>";
                    $flag = true;
                    $ini_event = null;
                    $fin_event = null;
                    while (list ($clave, $val) = each($intervalo)) {
                        if ($flag) {
                            $ini_event = $val;
                            $flag = false;
                        } else {
                            $fin_event = $val;
                        }
                        echo "<TD>$clave <br /> $val</TD>";
                    }
                    if ($uno) {
                        $dif_mem = workDiff($festi, $ini_event, $fin_event);
                        $uno = false;
                    }
                    echo "</TR>";
                }
                echo "  </TABLE></TD>";
                $dif_mem = ($rs->Value("ca_observaciones") == 'Cierre contable' or $rs->Value("ca_observaciones") == 'Facturación al Agente' or $rs->Value("ca_observaciones") == 'Cierre contable de Clientes' or $rs->Value("ca_observaciones") == 'Error de Factura' or $rs->Value("ca_observaciones") == 'Faltantes Soportes Agente' or $rs->Value("ca_observaciones") == 'Faltante Facturas Proveedores' or $rs->Value("ca_observaciones") == 'Faltante facturas proveedores' or $rs->Value("ca_observaciones") == 'Transición SAP') ? null : $dif_mem;
                $dif_mem = ($apl_idg == 'f') ? null : $dif_mem;
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif($tipo, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                $data[] = array($rs->Value('ca_usuario') => array($rs->Value('ca_mes') => $dif_mem));
                continue;
                break;
            case 16:
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchrecibo'), "%d-%d-%d %d:%d:%d");
                $tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchrevision'), "%d-%d-%d %d:%d:%d");
                $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                $dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado, $entrada, $salida);
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchrecibo') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchrevision') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                break;
            case 17:
                $dif_mem = workDiff($festi, $rs->Value('ca_fechafinalizacion'), $rs->Value('ca_fchpresentacion'));
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fechafinalizacion') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchpresentacion') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                break;
            case 18:
                $dif_mem = workDiff($festi, $rs->Value('ca_fchaceptacion'), $rs->Value('ca_fchcargue'));
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                $color = analizar_dif($tipo, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchaceptacion') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchcargue') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                break;
            case 19:
                $dif_mem = workDiff($festi, $rs->Value('ca_fechafinalizacion'), $rs->Value('ca_fchdespacho'));
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchdespacho') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fechafinalizacion') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                break;
            case 20:
                $dif_mem = workDiff($festi, $rs->Value('ca_fchplanilla'), $rs->Value('ca_fchfactura'));
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchplanilla') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchfactura') . "</TD>";
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                break;
            case 21:
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_referencia') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_compania') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_costo') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_factura_prov') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchfactura_prov') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_factura') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_fchfactura') . "</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>" . $rs->Value('ca_usucreado') . "</TD>";
                $dif_mem = workDiff($festi, $rs->Value('ca_fchfactura_prov'), $rs->Value('ca_fchfactura'));
                $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                $color = analizar_dif($tipo, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                $data[] = array($rs->Value('ca_usucreado') => array($rs->Value('ca_mes') => $dif_mem));
                break;
            case 22:
                $idreporte = $rs->Value('ca_idreporte');
                while ($idreporte == $rs->Value('ca_idreporte') and ! $rs->Eof() and ! $rs->IsEmpty()) {
                    if ($adicionales) {
                        echo "<TR>";
                        echo "  <TD Class=mostrar COLSPAN=11></TD>";
                    }
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchrecibo'), "%d-%d-%d %d:%d:%d");
                    $tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
                    $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    $dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado, $entrada, $salida);
                    $lcs_var = ($lcs_array[$rs->Value('ca_sucursal')]) ? $lcs_array[$rs->Value('ca_sucursal')] : $lcs_array['Todas'];
                    $color = analizar_dif("T", $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_null); // Función que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('case') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchrecibo') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_fchenvio') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_usuenvio') . "</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>" . $dif_mem . "</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; text-align:left;'>" . $rs->Value('ca_observaciones_idg') . "</TD>";
                    if ($adicionales) {
                        echo "</TR>";
                    }
                    $adicionales = true;
                    $data[] = array($rs->Value('ca_usuenvio') => array($rs->Value('ca_mes') => hourTosec($dif_mem)));
                    $rs->MoveNext(); // Buscar Todos los Status de un Embarque
                }
                if (!$rs->Eof()) {           // Retrocede un registro para quedar en el último Status del Reporte
                    $rs->MovePrevious();
                }
                if (!$adicionales) {
                    echo "  <TD Class=mostrar></TD>";
                    echo "  <TD Class=mostrar></TD>";
                    echo "  <TD Class=invertir></TD>";
                }
                //$data[] = array($rs->Value('ca_usuenvio')=>array($rs->Value('ca_mes_new')=>hourTosec($dif_mem)));
                break;
        }
        $rs->MoveNext();
    }

    /* Gráficas de IDG por usuario */

    if ($data) {
        $dataJson = array();
        $datos = array();

        //echo "<pre>";print_r($data);echo "</pre>";

        foreach ($data as $key => $gridUsuario) {
            foreach ($gridUsuario as $usuario => $gridMes) {
                foreach ($gridMes as $mes => $valor) {
                    if (!in_array($mes, $serieX))
                        $serieX[] = $mes;

                    $datos[$usuario][$mes]["valor"] += $valor;
                    $datos[$usuario][$mes]["total"] ++;
                    $datosProm[$usuario]["valor"] += $valor;
                    $datosProm[$usuario]["total"] ++;
                }
            }
        }

        sort($serieX);

        foreach ($data as $key => $gridUsuario) {
            foreach ($gridUsuario as $usuario => $gridMes) {
                foreach ($serieX as $mes) {
                    if ($ind_mem == 5 || $ind_mem == 6 || $ind_mem == 8 || $ind_mem == 9 || $ind_mem == 22) {
                        $datos[$usuario][$mes]["prom"] = round($datos[$usuario][$mes]["valor"] / $datos[$usuario][$mes]["total"], 0) * 1000;
                        $datosProm[$usuario]["prom"] = round($datosProm[$usuario]["valor"] / $datosProm[$usuario]["total"], 0) * 1000;
                    } else {
                        $datos[$usuario][$mes]["prom"] = round($datos[$usuario][$mes]["valor"] / $datos[$usuario][$mes]["total"], 2);
                        $datosProm[$usuario]["prom"] = round($datosProm[$usuario]["valor"] / $datosProm[$usuario]["total"], 2);
                    }
                }
                ksort($datos[$usuario]);
                ksort($datosProm[$usuario]);
            }
        }


        $data[] = array($rs->Value('ca_usuario') => array($rs->Value('ca_mes') => $dif_mem));

        /* Gráfica por Meses */
        foreach ($datos as $usuario => $gridMes) {
            foreach ($gridMes as $key => $gridItems) {
                if ($usuario) {
                    $dataJson[$usuario][] = $gridItems["prom"] ? $gridItems["prom"] : null;
                    $dataCarga[$usuario][] = $gridItems["total"] ? $gridItems["total"] : null;
                }
            }
        }

        foreach ($dataJson as $usuario => $grid) {
            $dataIdg[] = array("name" => $usuario, "data" => $grid, "type" => "column", "yAxis" => 1);
        }

        foreach ($dataCarga as $usuario => $grid) {
            $dataIdg[] = array("name" => $usuario, "data" => $grid, "type" => "spline", "yAxis" => 2);
        }


        /* Grafica por Promedio */
        foreach ($datosProm as $usuario => $gridItems) {
            if ($usuario) {
                $dataJson2[$usuario][] = $gridItems["prom"] ? $gridItems["prom"] : null;
                $dataCarga2[$usuario][] = $gridItems["total"] ? $gridItems["total"] : null;
            }
        }

        arsort($dataCarga2);

        foreach ($dataJson2 as $usuario => $grid) {
            $dataIdg2[] = array("name" => $usuario, "data" => $grid, "type" => "column");
        }

        foreach ($dataCarga2 as $usuario => $grid) {
            $d[] = array("name" => $usuario, "y" => $grid[0]);
        }

        //$dataIdg2[] = array("type" => "pie", "name" => "Estadísticas por Casos", "data" => $d, "center" => array(200, 150), "size" => 200);

        $d[0]["sliced"] = true;
        //echo "<pre>";print_r($d);echo "</pre>";
        ?>  

        <script type="text/javascript">
        <? if (count($serieX) > 1) { ?>
                var chart;
                        $(document).ready(function() {
                chart = new Highcharts.Chart({
                chart: {
                renderTo: 'container',
                },
                        title: {
                        text: '<?= $indicador ?>'
                        },
                        subtitle: {
                        text: '<?= $mes_tit . "-" . $ano_tit ?>'
                        },
                        xAxis: [{
                        categories: <?= json_encode($serieX) ?>
                        }],
                        yAxis: [
                        { // Primary yAxis
                        gridLineWidth: 0,
                                title: {
                                text: '# Casos',
                                        style: {
                                        color: '#4572A7'
                                        }
                                }
                        }, { //  Secondary yAxis
            <? if ($ind_mem == 5 || $ind_mem == 6 || $ind_mem == 8 || $ind_mem == 9 || $ind_mem == 22) { ?>
                            type: 'datetime',
                                    title: {
                                    text: 'Tiempo (Horas)'
                                    },
            <? } else { ?>
                            title: {
                            text: 'Tiempo (Días)'
                            },
            <? } ?>
                        opposite: true
                        }, { // Tertiary yAxis
                        gridLineWidth: 0,
                        }
                        ],
                        tooltip: {
                        formatter: function() {
                        var str = "";
                                if (this.series.type == "column"){
            <? if ($ind_mem == 5 || $ind_mem == 6 || $ind_mem == 8 || $ind_mem == 9 || $ind_mem == 22) { ?>
                            str = '<u>' + this.series.name + ': ' + dateFormat1(this.y) + ' horas</u><br/>';
            <? } else { ?>
                            str = '<u>' + this.series.name + ': ' + this.y + ' días</u><br/>';
            <? } ?>
                        } else if (this.series.type == "pie"){
                        str = '<u>' + this.point.name + ': ' + this.y + ' casos</u><br/>';
                        } else{
                        str = '<u>' + this.series.name + ': ' + this.y + ' casos</u><br/>';
                        }
                        return str;
                        }
                        },
                        series: <?= json_encode($dataIdg) ?>
                });
                });
        <? } ?>
            var chart2;
                    $(document).ready(function() {

            chart2 = new Highcharts.Chart({
            chart: {
            renderTo: 'container2',
            },
                    title: {
                    text: '<?= $indicador ?>'
                    },
                    subtitle: {
                    text: '<?= "PROMEDIO: " . $mes_tit . "-" . $ano_tit ?>'
                    },
                    xAxis: {
                    categories: <?= json_encode($serieX) ?>
                    },
                    yAxis: {
        <? if ($ind_mem == 5 || $ind_mem == 6 || $ind_mem == 8 || $ind_mem == 9 || $ind_mem == 22) { ?>
                        type: 'datetime',
                                title: {
                                text: 'Tiempo (Horas)'
                                },
        <? } else { ?>
                        title: {
                        text: 'Tiempo (Días)'
                        },
        <? } ?>
                    opposite: true
                    },
                    tooltip: {
                    formatter: function() {
                    var str = "";
                            if (this.series.type == "column"){
        <? if ($ind_mem == 5 || $ind_mem == 6 || $ind_mem == 8 || $ind_mem == 9 || $ind_mem == 22) { ?>
                        str = '<u>' + this.series.name + ': ' + dateFormat1(this.y) + ' horas</u><br/>';
        <? } else { ?>
                        str = '<u>' + this.series.name + ': ' + this.y + ' días</u><br/>';
        <? } ?>
                    } else if (this.series.type == "pie"){
                    str = '<u>' + this.point.name + ': ' + this.y + ' casos</u><br/>';
                    } else{
                    str = '<u>' + this.series.name + ': ' + this.y + ' casos</u><br/>';
                    }
                    return str;
                    }
                    },
                    plotOptions: {
                    column: {
                    pointPadding: 0.2,
                            borderWidth: 0
                    }
                    },
                    series: <?= json_encode($dataIdg2) ?>
            });
            });
                    var chart3;
                    $(document).ready(function() {

            chart2 = new Highcharts.Chart({
            chart: {
            renderTo: 'container3',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
            },
                    title: {
                    text: '<?= $indicador ?>'
                    },
                    subtitle: {
                    text: '<?= "Consolidado de casos por usuario: " . $mes_tit . "-" . $ano_tit ?>'
                    },
                    tooltip: {
                    formatter: function() {
                    var str = "";
                            str = '<u>' + this.point.name + ': ' + this.y + ' casos</u><br/>';
                            return str;
                    }
                    },
                    plotOptions: {
                    pie: {
                    allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            },
                            showInLegend: true
                    }
                    },
                    series: [{
                    type: 'pie',
                            data: <?= json_encode($d) ?>
                    }]
            });
            });
                    function dateFormat1(tim){

                    horas = Math.floor(((tim / 1000) / 60) / 60);
                            min = Math.floor(((tim - (horas * 60 * 60 * 1000)) / 1000) / 60);
                            sec = Math.round((tim - ((horas * 60 * 60 * 1000) + (min * 60 * 1000))) / 1000);
                            horas = horas < 9?"0" + horas:horas;
                            min = min < 9?"0" + min:min;
                            sec = sec < 9?"0" + sec:sec;
                            return horas + ":" + min + ":" + sec;
                    }
        </script>
        <?
    }

    if ($format_avg == "d") {
        $promedio_general = array_avg($array_avg);
    } else if ($array_avg < "24:00:00") {
        $promedio_general = date($format_avg, array_avg($array_avg));
    } else {
        list($dia, $hor, $min, $seg) = sscanf(date("d, H:i:s", array_avg($array_avg)), "%d, %d:%d:%d");
        if ($dia == 30) {
            $promedio_general = date("H:i:s", array_avg($array_avg));
        } else {
            $tmp = $dia * 24 + $hor;

            $dia = floor($tmp / 9);
            $min+= ($tmp % 9) * 60;
            $time_aju = mktime(0, $min, $seg, 1, $dia, 2000);
            $promedio_general = date("d, H:i:s", $time_aju);

            // $promedio_general = date("d, H:i:s",array_avg($array_avg));
        }
    }

    echo "<TR HEIGHT=5>";
    echo "  <TH Class=titulo COLSPAN=" . ($tot_cols + $add_cols - 1) . " style='font-size: 9px; text-align:right;'>Promedio Ponderado :</TH>";
    echo "  <TH Class=titulo>$promedio_general</TH>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<BR />";
    echo "<TABLE WIDTH=500 BORDER=0 CELLSPACING=1 CELLPADDING=1>";
    echo "<TH Class=titulo COLSPAN=7>" . COLTRANS . "<BR>$titulo<BR>Indicador $indicador $mes_tit / $ano_tit</TH>";

    echo "<TR>";
    echo "  <TD Class=listar ROWSPAN=4><b>Sucursal(es):</b><br /> - " . str_replace(",", "<br /> - ", str_replace("%", "Todas", $suc_tit)) . "</TD>";
    echo "  <TD Class=listar>Producto NO Conforme (%)</TD>";
    echo "  <TD Class=listar>No. Casos " . count($array_pnc) . "</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>" . formatNumber(round(count($array_pnc) / count($array_avg) * 100, 2), 2) . "%</TD>";
    echo "  <TD Class=listar ROWSPAN=3>&nbsp;</TD>";
    echo "  <TD Class=listar>LCs:</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>" . $lcs_var . "</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Promedio Ponderado:</TD>";
    echo "  <TD Class=listar>No. Casos " . count($array_avg) . "</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>" . $promedio_general . "</TD>";
    echo "  <TD Class=listar>LC:</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>" . $lc_var . "</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Registros Excluidos del Promedio</TD>";
    echo "  <TD Class=listar>No. Casos " . count($array_null) ."</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>" . formatNumber(round(count($array_null) / $contador * 100, 2), 2) . "%</TD>";
    echo "  <TD Class=listar COLSPAN=3>&nbsp;</TD>";
    echo "</TR>";

    echo "</TABLE>";

    echo "<TABLE width='100%' CELLSPACING=10> ";
    echo "<TR>";
    echo '<TD><div id="container2" style="height: 600px; margin: 0 auto"></div></TD>';
    echo "</TR>";
    echo "<TR>";
    echo '<TD><div id="container3" style="height: 600px; margin: 0 auto"></div></TD>';
    echo "</TR>";
    if (count($serieX) > 1) {
        echo "<TR colspan='2'>";
        echo '<TD><div id="container" style="min-width: 310px; height: 600px; margin: 0 auto"></div></TD>';
        echo "</TR>";
    }
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repindicadornew.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}

function analizar_dif($tipo, $lcs_var, $dif_mem, &$array_avg, &$array_pnc, &$array_null) {
    $contar = true;
    if ($dif_mem == null) {
        $color = "resaltar";
        $array_null[] = null;
        $contar = false;
    } else {
        if ($tipo == "T") {
            $lcs_sec = $lcs_var * 3600;

            list($hor, $min, $seg) = sscanf($dif_mem, "%d:%d:%d");
            $dif_sec = ($hor * 3600) + ($min * 60) + $seg;

            if ($dif_sec > $lcs_sec) {
                $color = "negativo";
                $array_pnc[] = $dif_mem;
            } else {
                $color = "invertir";
            }
        } else {
            if ($dif_mem > $lcs_var) {
                $color = "negativo";
                $array_pnc[] = $dif_mem;
            } else {
                $color = "invertir";
            }
        }
    }

    if ($contar) {
        if ($tipo == "D") {
            $array_avg[] = $dif_mem;
        } else {
            list($hor, $min, $seg) = sscanf($dif_mem, "%d:%d:%d");
            $array_avg[] = mktime($hor, $min, $sec, 0, 0, 0);
        }
    }
    return $color;
}
?>
