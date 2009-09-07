<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPINDICADORES.PHP                                           \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripci�n:   Reporte de Cuadro INO para Gerencia.                        \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Generador de Indicadores de Gesti�n';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$criterios = array( "ca_ano" => "A�o", "ca_mes" => "Mes", "ca_sucursal" => "Sucursal", "ca_traorigen" => "Tr�fico", "ca_compania" => "Clientes");
$transportes= array("A�reo","Mar�timo");                          // Arreglo con los tipos de Transportes

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                               // Captura las variables de la sessi�n abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
    echo "<script>document.location.href = 'entrada.php';</script>";
   }


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($boton) and !isset($agrupamiento)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function validar(){";
    echo "  if (document.getElementById('cri_elegido').value == '') {";
    echo "      alert('Debe seleccionar por lo menos un criterio de Ordenamiento');";
    echo "  	elemento = document.getElementById('cri_seleccion');";
    echo "		elemento.focus();";
    echo "	}else if (document.getElementById('indicador').selectedIndex == 4 && (document.getElementById('lci').value.length<8 || document.getElementById('lc').value.length<8 || document.getElementById('lcs').value.length<8)){";
    echo "      alert('Para el Indicador '+document.getElementById('indicador').value+ ' los l�mites deben estar en t�rminos de horas as� HH:MM:SS');";
    echo "	}else if (document.getElementById('indicador').selectedIndex == 5 && (document.getElementById('lci').value.length<8 || document.getElementById('lc').value.length<8 || document.getElementById('lcs').value.length<8)){";
    echo "      alert('Para el Indicador '+document.getElementById('indicador').value+ ' los l�mites deben estar en t�rminos de horas as� HH:MM:SS');";
    echo "	}else if (document.getElementById('indicador').selectedIndex == 6 && document.getElementById('indicador').value == 'Mar�timo' && (document.getElementById('lci').value.length<8 || document.getElementById('lc').value.length<8 || document.getElementById('lcs').value.length<8)){";
    echo "      alert('Para el Indicador '+document.getElementById('indicador').value+ ' los l�mites deben estar en t�rminos de horas as� HH:MM:SS');";
    echo "	}else if (document.getElementById('indicador').selectedIndex == 7 && (document.getElementById('lci').value.length<8 || document.getElementById('lc').value.length<8 || document.getElementById('lcs').value.length<8)){";
    echo "      alert('Para el Indicador '+document.getElementById('indicador').value+ ' los l�mites deben estar en t�rminos de horas as� HH:MM:SS');";
    echo "  }else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "function addTable(from,to){";
    echo "if (from.selectedIndex >= 0) {";
    echo "    to.options[to.length] = new Option(from[from.selectedIndex].text,from.value,false,false);";
    echo "    from[from.selectedIndex] = null;";
    echo "    from.focus();";
    echo "    to.options[to.length-1].selected=true; }";
    echo "}";

    echo "function llenar_procesos(){";
    echo "  process_element = document.getElementById('procesos');";
    echo "  process_element[process_element.length] = new Option();";
    echo "  for (cont=0; cont<forma.elements.length; cont++){";
    echo "      if (forma.elements[cont].name == 'array_procesos'){";
    echo "          process_element[process_element.length] = new Option(forma.elements[cont].value,forma.elements[cont].value,false,false);";
    echo "      }";
    echo "  }";
    echo "}";

    echo "function llenar_indicadores(process_element){";
    echo "  indicad_element = document.getElementById('indicador');";
    echo "  indicad_element.length=0;";
    echo "  i = 0;";
    echo "  while (isNaN(document.getElementById(process_element.value+'_'+i))) {";
    echo "     objeto = document.getElementById(process_element.value+'_'+i);";
    echo "     indicad_element[indicad_element.length] = new Option(objeto.value,objeto.value,false,false);";
    echo "     i++;";
    echo "  }";
    echo "  llenar_transportes();";
    echo "}";

    echo "function llenar_transportes(){";
    echo "  process_element = document.getElementById('procesos');";
    echo "  trans_element = document.getElementById('transporte');";
    echo "  trans_element.length=0;";
    echo "  if (process_element.value=='A�reo'){";
    echo "      trans_element[trans_element.length] = new Option('A�reo','A�reo',false,false);";
    echo "  }else if (process_element.value=='Mar�timo'){";
    echo "      trans_element[trans_element.length] = new Option('Mar�timo','Mar�timo',false,false);";
    echo "  }else if (process_element.value=='Aduana'){";
    echo "      trans_element.options[trans_element.length] = new Option();";
    echo "  }else {";
    echo "      if (process_element.value=='Oferta_y_Contrataci�n'){";
    echo "          trans_element[trans_element.length] = new Option('Todos','%',false,false);";
    echo "      }";
    echo "      trans_element[trans_element.length] = new Option('A�reo','A�reo',false,false);";
    echo "      trans_element[trans_element.length] = new Option('Mar�timo','Mar�timo',false,false);";
    echo "  }";
    echo "  llenar_modalidades();";
    echo "}";

    echo "function llenar_modalidades(){";
    echo "  modal_element = document.getElementById('modalidad');";
    echo "  trans_element = document.getElementById('transporte');";
    echo "  modal_element.length=0;";
    echo "  if (trans_element.value=='A�reo'){";
    echo "      modal_element[modal_element.length] = new Option('CONSOLIDADO','CONSOLIDADO',false,false);";
    echo "  }else if (trans_element.value=='Mar�timo'){";
    echo "      modal_element[modal_element.length] = new Option('Todos','%',false,false);";
    echo "      modal_element[modal_element.length] = new Option('LCL','LCL',false,false);";
    echo "      modal_element[modal_element.length] = new Option('FCL','FCL',false,false);";
    echo "      modal_element[modal_element.length] = new Option('COLOADING','COLOADING',false,false);";
    echo "      modal_element[modal_element.length] = new Option('PROYECTOS','PROYECTOS',false,false);";
    echo "  }";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='forma' ACTION='repindicadores.php' ONSUBMIT='return validar();'>";

    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_valor, ca_valor2 from tb_parametros where ca_casouso = 'CU072' order by ca_valor2, ca_valor")) {    // Selecciona los registros de la tabla par�metros
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        exit;
        }
    while (!$tm->Eof()) {
        $pro_mem = $proceso = str_replace(" ","_",$tm->Value('ca_valor2'));
        echo "<INPUT ID='array_procesos' TYPE='HIDDEN' NAME='array_procesos' VALUE='$pro_mem'>";
        $i = 0;
        while($proceso == $pro_mem and !$tm->Eof()){
            echo "<INPUT ID='".$proceso."_".$i."' TYPE='HIDDEN' NAME='".$proceso."_".$i."' VALUE='".$tm->Value('ca_valor')."'>";
            $tm->MoveNext();
            $proceso = str_replace(" ","_",$tm->Value('ca_valor2'));
            $i++;
        }
    }

    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los par�metros para el Reporte</B></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 10px;'>Pulse la tecla control para seleccionar varios �tems <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Servicio'></TH>";
    echo "</TR>";
    $tm->MoveFirst();
    if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit; }

    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
    if (!$us->Open("select ca_nombre, ca_sucursal from vi_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_nombre")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit;
    }
    $us->MoveFirst();
    while (!$us->Eof()) {
       echo "<INPUT TYPE='HIDDEN' NAME='usu_nombre' VALUE='".$us->Value('ca_nombre')."'>";
       echo "<INPUT TYPE='HIDDEN' NAME='usu_sucursal' VALUE='".$us->Value('ca_sucursal')."'>";
       $us->MoveNext();
    }

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=4></TD>";
    echo "  <TD Class=listar>A�o:<BR><SELECT NAME='ano[]' SIZE=5 MULTIPLE>";
    $sel = "SELECTED";
    for ( $i=0; $i<5; $i++ ){
        echo " <OPTION VALUE=".(date('Y')-$i)." $sel>".(date('Y')-$i)."</OPTION>";
        $sel = "";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes[]' SIZE=13 MULTIPLE>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Sucursal:<BR><SELECT ID=sucursal NAME='sucursal[]' SIZE=10 MULTIPLE>";
    echo "  <OPTION VALUE=% SELECTED>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."' $sel>".$tm->Value('ca_sucursal')."</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=listar>Tr�fico :<BR><SELECT NAME='traorigen[]' SIZE=10 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Tr�ficos</OPTION>";
    while ( !$tm->Eof()) {
        echo " <OPTION VALUE='".$tm->Value('ca_nombre')."'>".$tm->Value('ca_nombre')."</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";
    if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Mar�timo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=listar>Puerto Destino :<BR><SELECT NAME='ciudestino[]' SIZE=6 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Puertos</OPTION>";
    while ( !$tm->Eof()) {
        echo " <OPTION VALUE='".$tm->Value('ca_ciudad')."'>".$tm->Value('ca_ciudad')."</OPTION>";
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
    echo "  <TD Class=listar COLSPAN=3>Proceso: <SELECT ID='procesos' NAME='procesos' ONCHANGE='llenar_indicadores(this);'>";
    echo "      </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=2><TABLE WIDTH=100%>";
    echo "      <TR>";
    echo "          <TD Class=listar>LCs :</TD><TD Class=listar><INPUT ID='lcs' TYPE='text' NAME='lcs_var' size='7'></TD>";
    echo "          <TD Class=listar>LC :</TD><TD Class=listar><INPUT ID='lc' TYPE='text' NAME='lc_var' size='7'></TD>";
    echo "          <TD Class=listar>LCi :</TD><TD Class=listar><INPUT ID='lci' TYPE='text' NAME='lci_var' size='7'></TD>";
    echo "	</TR>";
    echo "  </TABLE></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=3><TABLE WIDTH=100%><TR>";
    echo "  <TR>";
    echo "      <TD Class=listar COLSPAN=2>Indicador: <SELECT ID='indicador' NAME='indicador'></SELECT></TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "      <TD Class=listar>Transporte:<BR><SELECT ID='transporte' NAME='transporte[]' ONCHANGE='llenar_modalidades();'></SELECT></TD>";
    echo "      <TD Class=listar>Modalidad:<BR><SELECT ID='modalidad' NAME='modalidad[]'></SELECT></TD>";
    echo "  </TR></TABLE></TD>";
    echo "  <TD Class=destacar COLSPAN=2>Criterios de Agrupamiento: <BR/><TABLE CELLSPACING=1>";
    echo "  <TD Class=invertir WIDTH='100' style='text-align:right;'><SELECT ID=cri_seleccion NAME='criterio' SIZE=6>";   // Llena el cuadro de lista con los valores de la tabla campos
    while (list ($clave, $val) = each ($criterios)) {
        echo "   <OPTION VALUE='$clave'>$val</OPTION>";
    }
    echo "    </SELECT>";
    echo "    </TD>";
    echo "    <TD Class=invertir WIDTH='20' style='text-align:center;'>";
    echo "      <INPUT TYPE='BUTTON' NAME='pasar' VALUE='>>' ONCLICK='addTable(document.getElementById(\"cri_seleccion\"),document.getElementById(\"cri_elegido\"));'><br>"; // Controles para trasladar elementos seleccionados
    echo "      <INPUT TYPE='BUTTON' NAME='pasar' VALUE='<<' ONCLICK='addTable(document.getElementById(\"cri_elegido\"),document.getElementById(\"cri_seleccion\"));'>";
    echo "    </TD>";
    echo "    <TD Class=invertir WIDTH='100'>";
    echo "       <SELECT ID=cri_elegido NAME='agrupamiento[]' MULTIPLE SIZE=6></SELECT>";         // Cuadro de lista receptor de campos elegidos
    echo "    </TD>";
    echo "   </TR></TABLE>";
    echo "</TD></TR>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=7></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<script language='javascript'>llenar_procesos();</script>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"repindicadores.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($agrupamiento)){
    set_time_limit(0);
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
    include_once 'include/functions.php';                                      // M�dulo de Funciones Varias
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo

    $ano_mem = implode(',',$ano);
    $mes_mem = implode(',',$mes);
    $suc_mem = implode(',',$sucursal);

    $tra_mem = $transporte[0];

    $tot_cols = 11;
    $ano_fes = "to_char(ca_fchfestivo,'YYYY') ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
    $ano = "ca_ano ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
    $mes_fes = "to_char(ca_fchfestivo,'MM') ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
    $mes = "ca_mes ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
    $sucursal = "ca_sucursal ".((count($sucursal)==1)?"like '$sucursal[0]'":"in ('".implode("','",$sucursal)."')");
    $cliente = ((strlen($cliente)!=0)?"and upper(ca_compania) like upper('%$cliente%')":"");
    $traorigen = "ca_traorigen ".((count($traorigen)==1)?"like '$traorigen[0]'":"in ('".implode("','",$traorigen)."')");
    $modalidad = "ca_modalidad ".((count($modalidad)==1)?"like '$modalidad[0]'":"in ('".implode("','",$modalidad)."')");
    $transporte = "ca_transporte ".((count($transporte)==1)?"like '$transporte[0]'":"in ('".implode("','",$transporte)."')");

    $campos = "";
    while (list ($clave, $val) = each ($agrupamiento)) {
        $campos.= $val.",";
    }
    $campos = substr($campos,0,strlen($campos)-1);
    $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'repindicadores.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repindicadores.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos

    $array_avg = array();  // Para el calcilo del Promedio General
    $array_pnc = array();  // Para el calculo del Producto no Conforme
    $array_pmc = array();  // Para el calculo del Producto por debajo del L�mite central inferior
    $array_null= array();  // Para el conteo de los Registros que nos pueden calcular

    $format_avg = "d";
    switch ($indicador) {
        case "Confirmaci�n Salida de la Carga":
            $source   = "vi_repindicadores";
            $subque   = "LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, min(to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')) as ca_fchenvio, to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')-rs.ca_fchsalida as ca_diferencia from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where rs.ca_idetapa in ('IAETA','IMETA') group by ca_consecutivo, ca_fchsalida, ca_diferencia ) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
            $ind_mem  = 1;
            $add_cols = 3;
            break;
        case "Tiempo de Tr�nsito":
            $source   = "vi_repindicadores";
            $subque   = "LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, max(to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')) as ca_fchenvio, rs.ca_fchllegada-rs.ca_fchsalida as ca_diferencia from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where rs.ca_idetapa in ('IACAD','IMCPD') group by ca_consecutivo, ca_fchsalida, ca_fchllegada, ca_diferencia) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
            $ind_mem  = 2;
            $add_cols = 3;
            break;
        case "Tiempo de Desconsolidaci�n":
            $source   = "vi_repindicadores";
            $ind_mem  = 3;
            $add_cols = 4;
            break;
        case "Oportunidad en la Facturaci�n":
            if ($tra_mem == 'A�reo'){
                $source   = "vi_repindicador_air";
                $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, rs.ca_fchllegada, min(rs.ca_fchenvio) as ca_fchconf_lleg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IACAD') group by rp.ca_consecutivo, rs.ca_fchllegada order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
                $subque.= " LEFT OUTER JOIN (select ca_referencia as ca_referencia_fac, ca_idcliente as ca_idcliente_fac, ca_hawb as ca_hawb_fac, ca_fchfactura, ca_observaciones from tb_inoingresos_air where ((string_to_array(ca_referencia,'.'))[5]::int)+2000 in ($ano_mem) and ((string_to_array(ca_referencia,'.'))[3])::text in ('$mes_mem') order by ca_referencia, ca_idcliente, ca_hawb, ca_fchfactura) ii ON ($source.ca_referencia = ii.ca_referencia_fac and $source.ca_idcliente = ii.ca_idcliente_fac and $source.ca_hawb = ii.ca_hawb_fac) ";
                $campos.= ", ca_referencia, ca_idcliente_fac, ca_hawb, ca_fchfactura";
            } else if ($tra_mem == 'Mar�timo'){
                $source = "vi_repindicador_sea";
                $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, rs.ca_fchllegada, min(rs.ca_fchenvio) as ca_fchconf_lleg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IMCPD') group by rp.ca_consecutivo, rs.ca_fchllegada order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
                $subque.= " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_cont, rs.ca_fchllegada as ca_fchplanilla, min(rs.ca_fchenvio) as ca_fchconf_plan from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = '99999') group by rp.ca_consecutivo, rs.ca_fchllegada order by rp.ca_consecutivo) rs2 ON ($source.ca_consecutivo = rs2.ca_consecutivo_cont) ";
                $subque.= " LEFT OUTER JOIN (select ca_referencia as ca_referencia_fac, ca_idcliente as ca_idcliente_fac, ca_hbls as ca_hbls_fac, ca_fchfactura, ca_observaciones from tb_inoingresos_sea where ((string_to_array(ca_referencia,'.'))[5]::int)+2000 in ($ano_mem) and ((string_to_array(ca_referencia,'.'))[3])::text in ('$mes_mem') order by ca_referencia, ca_idcliente, ca_hbls, ca_fchfactura) ii ON ($source.ca_referencia = ii.ca_referencia_fac and $source.ca_idcliente = ii.ca_idcliente_fac and $source.ca_hbls = ii.ca_hbls_fac) ";
                $campos.= ", ca_referencia, ca_idcliente_fac, ca_hbls, ca_fchfactura";
            }
            if (!$tm->Open("select ca_fchfestivo from tb_festivos")) {        // Selecciona todos lo registros de la tabla Festivos
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }
            $festi = array();
            while (!$tm->Eof() and !$tm->IsEmpty()) {
                $festi[] = $tm->Value('ca_fchfestivo');
                $tm->MoveNext();
            }

            $ind_mem  = 4;
            $add_cols = 6;
            break;
        case "Oportunidad en el Env�o de Comunicaciones":
            $format_avg = "H:i:s";
            $source   = "vi_repindicadores";
            $subque   = "LEFT OUTER JOIN (select ca_consecutivo as ca_consecutivo_sub, ca_fchrecibo, ca_fchenvio from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where ".str_replace("ca_ano","to_char(ca_fchrecibo,'YYYY')",$ano)." and ".str_replace("ca_mes","to_char(ca_fchrecibo,'MM')",$mes)." order by ca_consecutivo, ca_fchrecibo) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
            if (!$tm->Open("select ca_fchfestivo from tb_festivos")) {        // Selecciona todos lo registros de la tabla Festivos
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }
            $festi = array();
            while (!$tm->Eof() and !$tm->IsEmpty()) {
                $festi[] = $tm->Value('ca_fchfestivo');
                $tm->MoveNext();
            }
            $tm->MoveFirst();
            $ind_mem  = 5;
            $add_cols = 3;
            break;
        case "Oportunidad de Primer Status":
            $format_avg = "H:i:s";
            $source = "vi_repindicadores";
            $subque = "LEFT OUTER JOIN (select fs.ca_idstatus, rp.ca_consecutivo as ca_consecutivo_sub, ca_fchenvio from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) RIGHT OUTER JOIN (select ca_consecutivo, min(ca_idstatus) as ca_idstatus from tb_repstatus rps INNER JOIN tb_reportes rpt ON (rps.ca_idreporte = rpt.ca_idreporte) group by ca_consecutivo) fs ON (fs.ca_idstatus = rs.ca_idstatus) where ".str_replace("ca_ano","to_char(ca_fchrecibo,'YYYY')",$ano)." and ".str_replace("ca_mes","to_char(ca_fchrecibo,'MM')",$mes)." order by rp.ca_consecutivo, ca_fchrecibo) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) ";
            if (!$tm->Open("select ca_fchfestivo from tb_festivos")) {        // Selecciona todos lo registros de la tabla Festivos
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }
            $festi = array();
            while (!$tm->Eof() and !$tm->IsEmpty()) {
                $festi[] = $tm->Value('ca_fchfestivo');
                $tm->MoveNext();
            }
            $tm->MoveFirst();
            $ind_mem  = 6;
            $add_cols = 3;
            break;
        case "Cumplimiento de Proveedores":
            $source   = "vi_repindicadores";
            $ind_mem  = 7;
            $add_cols = 3;
            break;
        case "Oportunidad en la Entrega de Cotizaciones":
            $format_avg = "H:i:s";
            $source   = "vi_cotindicadores";
            if (!$tm->Open("select ca_fchfestivo from tb_festivos")) {        // Selecciona todos lo registros de la tabla Festivos
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }
            $festi = array();
            while (!$tm->Eof() and !$tm->IsEmpty()) {
                $festi[] = $tm->Value('ca_fchfestivo');
                $tm->MoveNext();
            }
            $ind_mem  = 8;
            $add_cols = 3;
            $tot_cols--;
            $cot_ant  = null;
            $campos.= ", to_number(substr(ca_consecutivo,0,position('-' in ca_consecutivo)),'99999999')";
            break;
        case "Oportunidad en Confirmaci�n de llegada":
            if ($tra_mem == 'A�reo'){
                $tipo = "D";
                $source   = "vi_repindicador_air";
                $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, rs.ca_fchllegada, min(rs.ca_fchenvio) as ca_fchconf_lleg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IACAD') group by rp.ca_consecutivo, rs.ca_fchllegada order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
            } else if ($tra_mem == 'Mar�timo'){
                $tipo = "T";
                $format_avg = "H:i:s";
                $source = "vi_repindicador_sea";
                $subque = " LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_conf, min(rs.ca_fchenvio) as ca_fchconf_lleg from tb_repstatus rs INNER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IMCPD') group by rp.ca_consecutivo, rs.ca_fchllegada, rs.ca_horallegada order by rp.ca_consecutivo) rs1 ON ($source.ca_consecutivo = rs1.ca_consecutivo_conf) ";
            }
            if (!$tm->Open("select ca_fchfestivo from tb_festivos")) {        // Selecciona todos lo registros de la tabla Festivos
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }
            $festi = array();
            while (!$tm->Eof() and !$tm->IsEmpty()) {
                $festi[] = $tm->Value('ca_fchfestivo');
                $tm->MoveNext();
            }
            $ind_mem  = 9;
            $add_cols = 4;
            $ini_ant  = null;
            $fin_ant  = null;
            break;
        case "Oportunidad en Nacionalizaci�n de Mcias":
            $tipo = "T";
            $format_avg = "H:i:s";
            $source   = "vi_repindicador_brk";
            $transporte = "ca_transporte = 'Aduana'";
            $subque = " LEFT OUTER JOIN ( select bke.*, prm.ca_valor from tb_brk_evento bke	LEFT OUTER JOIN tb_parametros prm ON (prm.ca_casouso = 'CU037' and prm.ca_identificacion = bke.ca_idevento) order by ca_referencia) bke ON ($source.ca_referencia = bke.ca_referencia) ";

            if (!$tm->Open("select ca_fchfestivo from tb_festivos")) {        // Selecciona todos lo registros de la tabla Festivos
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }
            $festi = array();
            while (!$tm->Eof() and !$tm->IsEmpty()) {
                $festi[] = $tm->Value('ca_fchfestivo');
                $tm->MoveNext();
            }
            $ind_mem  = 10;
            $add_cols = 3;
            $cot_ant  = null;
            $campos.= ", vi_repindicador_brk.ca_referencia, bke.ca_fchevento, bke.ca_idevento";
            break;
	}

    $queries = "select * from $source $subque where ca_impoexpo = 'Importaci�n' and $sucursal $cliente and $transporte and $ano and $mes";
    $queries.= " order by $campos";
    // die($queries);
	
    if (!$rs->Open("$queries")) {                       							// Selecciona todos lo registros de la vista vi_repgerencia_sea 
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      		// Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

	echo "<TR>";
	echo "  <TH Class=titulo COLSPAN=".($tot_cols+$add_cols).">COLTRANS S.A.<BR>$titulo<BR>Indicador $indicador $mes_mem / $ano_mem</TH>";
	echo "</TR>";
	$saltos = array();
	$titems = array();
	echo "<TR>";
	echo "	<TH>#</TH>";
        if ($ind_mem == 8){
            echo "	<TH>Cotizaci�n</TH>";
        }else if (!in_array($ind_mem, array(10,11))){
            echo "	<TH>Reporte</TH>";
            echo "	<TH>Ver.</TH>";
        }

        echo "	<TH>A�o</TH>";
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
                echo "	<TH>Env�o Msg</TH>";
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
                echo "	<TH>Fch.Desconsolidaci�n</TH>";
                echo "	<TH>Dif.</TH>";
                break;
            case 4:
                echo "	<TH>Referencia</TH>";
                echo "	<TH>Continuaci�n</TH>";
                if ($tra_mem == 'A�reo'){
                        echo "	<TH>Fch.Llegada</TH>";
                } else if ($tra_mem == 'Mar�timo'){
                        echo "	<TH>Fch.Llegada/Planilla</TH>";
                }
                echo "	<TH>Fch.Factura</TH>";
                echo "	<TH>Dif.</TH>";
                echo "	<TH>Observaciones</TH>";
                break;
            case 5:
                echo "	<TH>Fch.Status</TH>";
                echo "	<TH>Env�o Msg</TH>";
                echo "	<TH>Dif.</TH>";
                break;
            case 6:
                echo "	<TH>Fch.Reporte</TH>";
                echo "	<TH>Primer Status</TH>";
                echo "	<TH>Dif.</TH>";
                break;
            case 7:
                echo "	<TH>E.T.A.</TH>";
                echo "	<TH>Fch.Llegada</TH>";
                echo "	<TH>Dif.</TH>";
                break;
            case 8:
                echo "	<TH>Fch.Solicitud</TH>";
                echo "	<TH>Fch.Envio</TH>";
                echo "	<TH>Dif.</TH>";
                break;
            case 9:
                echo "	<TH>Referencia</TH>";
                echo "	<TH>Fch.Llegada</TH>";
                echo "	<TH>Fch.Confirmaci�n</TH>";
                echo "	<TH>Dif.</TH>";
                break;
            case 10:
                echo "	<TH>Referencia</TH>";
                echo "	<TH>Coordinador</TH>";
                echo "	<TH>Eventos</TH>";
                echo "	<TH>Calculos</TH>";
                echo "	<TH>Dif.</TH>";
                break;
	}
	echo "</TR>";
	$rs->MoveFirst();
        $contador = 1;
        while (!$rs->Eof() and !$rs->IsEmpty()){                                  // Lee la totalidad de los registros obtenidos en la instrucci�n Select
            $adicionales = false;
            if ($ind_mem == 3 and ($rs->Value('ca_transporte') != 'Mar�timo' or $rs->Value('ca_modalidad') != 'LCL')){
                    $rs->MoveNext();
                    continue;
            } else if ($ind_mem == 8 and $rs->Value('ca_consecutivo') == $cot_ant and false){
                    echo "  <TD Class=mostrar COLSPAN='3'></TD>";
                    $rs->MoveNext();
                    continue;
            }
            echo "<TR>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$contador++."</TD>";
            if ($ind_mem == 8){
                echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_consecutivo')."</TD>";
            }else if (!in_array($ind_mem, array(10,11))){
                echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_consecutivo')."</TD>";
                echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_version')."</TD>";
            }
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_ano')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_mes')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_sucursal')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_traorigen')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_ciudestino')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_transporte')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_modalidad')."</TD>";
            echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_compania')."</TD>";
            switch ($ind_mem) {
                case 1:
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fchsalida')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fchenvio')."</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$rs->Value('ca_diferencia')."</TD>";
                    break;
                case 2:
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fchsalida')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fchllegada')."</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$rs->Value('ca_diferencia')."</TD>";
                    break;
                case 3:
                    if (!$tm->Open("select ic.ca_referencia, rp.ca_consecutivo, im.ca_fchconfirmacion, (CASE WHEN to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') < im.ca_fchconfirmacion THEN NULL ELSE to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') END) as ca_fchdesconsolidacion, (CASE WHEN to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') < im.ca_fchconfirmacion THEN NULL ELSE to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') END)-im.ca_fchconfirmacion as ca_diferencia from tb_inoclientes_sea ic LEFT OUTER JOIN tb_reportes rp ON (ic.ca_idreporte::text = rp.ca_idreporte::text) LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ic.ca_referencia, im.ca_fchconfirmacion")) {       // Selecciona todos lo registros de la tabla InoClientes / InoMaestra
                            echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                            echo "<script>document.location.href = 'repindicadores.php';</script>";
                            exit; }
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_referencia')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchconfirmacion')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchdesconsolidacion')."</TD>";
                    echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$tm->Value('ca_diferencia')."</TD>";
                    break;
                case 4:
                    $ref_tmp = $rs->Value('ca_referencia');
                    $idc_tmp = $rs->Value('ca_idcliente');
                    $hbl_tmp = $rs->Value('ca_hbls');
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_referencia')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_continuacion')."</TD>";
                    if (in_array($rs->Value("ca_observaciones"), array("Facturaci�n al Agente","Reemplazo Factura","Cierre contable de Clientes") )) {
                        $dif_mem = null;
                    }else{
                        $dif_mem = workDiff($festi, $rs->Value('ca_fchllegada'),$rs->Value('ca_fchfactura'));
                    }
                    
                    $color = analizar_dif("D", $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchllegada')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchfactura')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value("ca_observaciones")."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                    if ($rs->Value('ca_continuacion') == "N/A"){
                        while ($rs->Value('ca_referencia') == $ref_tmp and $rs->Value('ca_idcliente') == $idc_tmp and $rs->Value('ca_hbls') == $hbl_tmp and !$rs->Eof()){
                            $rs->MoveNext();	// Omite las facturas adicionales sobre una misma carga.
                        }
                    }else if ($rs->Value('ca_continuacion') == "OTM" or $rs->Value('ca_continuacion') == "DTA"){
                        while ($rs->Value('ca_referencia') == $ref_tmp and $rs->Value('ca_idcliente') == $idc_tmp and $rs->Value('ca_hbls') == $hbl_tmp and !$rs->Eof()){
                            if ($rs->Value('ca_observaciones') == "OTM/DTA"){ // Busca la Factura por el OTM o el DTA
                                echo "<TR>";
                                echo "  <TD Class=mostrar COLSPAN=12></TD>";
                                if (in_array($rs->Value("ca_observaciones"), array("Facturaci�n al Agente","Reemplazo Factura","Cierre contable de Clientes") )) {
                                    $dif_mem = null;
                                }else{
                                    $dif_mem = workDiff($festi, $rs->Value('ca_fchplanilla'),$rs->Value('ca_fchfactura'));
                                }
                                $color = analizar_dif("D", $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchplanilla')."</TD>";
                                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchfactura')."</TD>";
                                echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value("ca_observaciones")."</TD>";
                                echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                                echo "</TR>";
                            }
                            $rs->MoveNext();
                        }
                    }
                    if (!$rs->Eof()){           // Retrocede un registro para quedar en la �ltima factura del Hbl de una Referencia
                        $rs->MovePrevious();
                    }
                    break;
                case 5:
                    $idreporte = $rs->Value('ca_idreporte');
                    while ($idreporte == $rs->Value('ca_idreporte') and !$rs->Eof() and !$rs->IsEmpty()) {
                            if ($adicionales){
                                    echo "<TR>";
                                    echo "  <TD Class=mostrar COLSPAN=11></TD>";
                            }
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchrecibo'), "%d-%d-%d %d:%d:%d");
                            $tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
                            $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                            $dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado);
                            $color = analizar_dif("T", $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                            echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchrecibo')."</TD>";
                            echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchenvio')."</TD>";
                            echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                            if ($adicionales){
                                    echo "</TR>";
                            }
                            $adicionales = true;
                            $rs->MoveNext();	// Buscar Todos los Status de un Embarque
                    }
                    if (!$adicionales){
                            echo "  <TD Class=mostrar></TD>";
                            echo "  <TD Class=mostrar></TD>";
                            echo "  <TD Class=invertir></TD>";
                    } else {
                            continue;
                    }
                    break;
                case 6:
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchcreado'), "%d-%d-%d %d:%d:%d");
                    $tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
                    $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                    $dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado);
                    $color = analizar_dif("T", $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchcreado')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchenvio')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                    break;
                case 7:
                    if (!$tm->Open("select ca_fchllegada from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ca_fchllegada")) {       // Selecciona todos lo registros de la tabla Status
                            echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                            echo "<script>document.location.href = 'repindicadores.php';</script>";
                            exit; }
                    $first_date = true;
                    $fch_eta = $fch_llegada = null;
                    while (!$tm->Eof() and !$tm->IsEmpty()) {
                            if ($first_date and strlen($tm->Value('ca_fchllegada'))!= 0){
                                    $fch_eta = $tm->Value('ca_fchllegada');
                                    $first_date = false;
                            }
                            $fch_llegada = $tm->Value('ca_fchllegada');
                            $tm->MoveNext();
                    }
                    $dif_mem = dateDiff($fch_eta,$fch_llegada);
                    $color = analizar_dif("D", $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>$fch_eta</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>$fch_llegada</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                    break;
                case 8:
                    if ($rs->Value('ca_fchsolicitud') != $ini_ant or $rs->Value('ca_fchpresentacion') != $fin_ant){
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchsolicitud'), "%d-%d-%d %d:%d:%d");
                            $tstamp_confirmado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchpresentacion'), "%d-%d-%d %d:%d:%d");
                            $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                            $dif_mem = calc_dif($festi, $tstamp_confirmado, $tstamp_enviado);
                            $ini_ant = $rs->Value('ca_fchsolicitud');
                            $fin_ant = $rs->Value('ca_fchpresentacion');
                    }
                    $color = analizar_dif("T", $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchsolicitud')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchpresentacion')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                    $cot_ant = $rs->Value('ca_consecutivo');
                    while ($cot_ant == $rs->Value('ca_consecutivo') and !$rs->Eof() and !$rs->IsEmpty()) {
                        echo "<TR>";
                        echo "  <TD Class=mostrar style='font-size: 9px;' COLSPAN=5>&nbsp;</TD>";
                        echo "  <TD Class=invertir style='font-size: 9px;'>".$rs->Value('ca_traorigen')."</TD>";
                        echo "  <TD Class=invertir style='font-size: 9px;'>".$rs->Value('ca_ciudestino')."</TD>";
                        echo "  <TD Class=invertir style='font-size: 9px;'>".$rs->Value('ca_transporte')."</TD>";
                        echo "  <TD Class=invertir style='font-size: 9px;'>".$rs->Value('ca_modalidad')."</TD>";
                        echo "  <TD Class=mostrar style='font-size: 9px;' COLSPAN=4>&nbsp;</TD>";
                        echo "</TR>";
                        $rs->MoveNext();
                    }
                    if (!$rs->Eof()){           // Retrocede un registro para quedar en el �ltimo Producto de la Cotizaci�n
                        $rs->MovePrevious();
                    }
                    break;
                case 9:
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_referencia')."</TD>";
                    if ($rs->Value('ca_transporte') == 'A�reo'){
                            $fch_mem = $rs->Value('ca_fchllegada');
                            if ($rs->Value('ca_fchllegada') != $ini_ant or $rs->Value('ca_fchconf_lleg') != $fin_ant){
                                    $dif_mem = dateDiff($rs->Value('ca_fchllegada'),$rs->Value('ca_fchconf_lleg'));
                                    $ini_ant = $rs->Value('ca_fchllegada');
                                    $fin_ant = $rs->Value('ca_fchconf_lleg');
                            }
                    } else if ($rs->Value('ca_transporte') == 'Mar�timo'){
                            $fch_mem = $rs->Value('ca_fchconfirmacion');
                            if ($rs->Value('ca_fchconfirmacion') != $ini_ant or $rs->Value('ca_fchconf_lleg') != $fin_ant){
                                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchconfirmacion'), "%d-%d-%d %d:%d:%d");
                                    $tstamp_confirmado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                                    list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchconf_lleg'), "%d-%d-%d %d:%d:%d");
                                    $tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
                                    $dif_mem = calc_dif($festi, $tstamp_confirmado, $tstamp_enviado);
                                    $ini_ant = $rs->Value('ca_fchconfirmacion');
                                    $fin_ant = $rs->Value('ca_fchconf_lleg');
                            }
                    }
                    $dif_mem = (is_null($dif_mem) and $rs->Value('ca_transporte') == 'Mar�timo')?"48:00:00":$dif_mem;
                    $color = analizar_dif($tipo, $lci_var, $lcs_var, $dif_mem, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$fch_mem."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:left;'>".$rs->Value('ca_fchconf_lleg')."</TD>";
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
                    continue;
                    break;
                case 10:
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_referencia')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_coordinador')."</TD>";

                    echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";
                    $matriz_eventos = array();
                    $referencia = $rs->Value('ca_referencia');
                    if ($rs->Value('ca_fchreferencia') > $rs->Value('ca_fcharribo')){
                        $matriz_eventos["intervalo_1"]["Fch. Referencia"] = $rs->Value('ca_fchreferencia');
                    }else{
                        $matriz_eventos["intervalo_1"]["Fch. Arribo"] = $rs->Value('ca_fcharribo');
                    }
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>Fch. Referencia</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fchreferencia')."</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>Fch. Arribo</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fcharribo')."</TD>";
                    echo "</TR>";

                    $int_uno = $int_dos = "";
                    $dif_ref = null;
                    while ($referencia == $rs->Value('ca_referencia') and !$rs->Eof() and !$rs->IsEmpty()) {
                        $fchEventoArry = date_parse($rs->Value('ca_fchevento'));
                        $fchEvento = date("Y-m-d H:i",mktime($fchEventoArry["hour"],$fchEventoArry["minutes"],$fchEventoArry["secons"],$fchEventoArry["month"],$fchEventoArry["day"],$fchEventoArry["year"]));
                        echo "<TR>";
                        echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_valor')."</TD>";
                        echo "  <TD Class=mostrar style='font-size: 9px;'>".$fchEvento."</TD>";
                        echo "</TR>";
                        if (in_array($rs->Value('ca_idevento'),array(1,3))){ //Evalua si el evento cierra el primer invervalo
                            if ($rs->Value('ca_idevento')==1){
                                $int_uno = $rs->Value('ca_valor');
                                $matriz_eventos["intervalo_1"][$rs->Value('ca_valor')] = $fchEvento;
                            } else if ($rs->Value('ca_idevento')==3){
                                if ($matriz_eventos["intervalo_1"][$int_uno] < $fchEvento){
                                     array_pop($matriz_eventos["intervalo_1"]);
                                     $matriz_eventos["intervalo_1"][$rs->Value('ca_valor')] = $fchEvento;
                                }
                            }
                        }

                        if (in_array($rs->Value('ca_idevento'),array(1)))  //Evalua si el evento abre el segundo invervalo
                            $matriz_eventos["intervalo_2"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(2,3))){  //Evalua si el evento cierra el segundo invervalo
                            if ($rs->Value('ca_idevento')==2){
                                $int_dos = $rs->Value('ca_valor');
                                $matriz_eventos["intervalo_2"][$rs->Value('ca_valor')] = $fchEvento;
                            } else if ($rs->Value('ca_idevento')==3){
                                if ($matriz_eventos["intervalo_2"][$int_dos] < $fchEvento){
                                     array_pop($matriz_eventos["intervalo_2"]);
                                     $matriz_eventos["intervalo_2"][$rs->Value('ca_valor')] = $fchEvento;
                                }
                            }
                        }

                        if (in_array($rs->Value('ca_idevento'),array(7)))  //Evalua si el evento abre el tercer invervalo
                            $matriz_eventos["intervalo_3"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(8)))  //Evalua si el evento abre el tercer invervalo
                            $matriz_eventos["intervalo_3"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(9)))  //Evalua si el evento abre el cuarto invervalo
                            $matriz_eventos["intervalo_4"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(10)))  //Evalua si el evento abre el cuarto invervalo
                            $matriz_eventos["intervalo_4"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(19)))  //Evalua si el evento abre el quinto invervalo
                            $matriz_eventos["intervalo_5"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(20)))  //Evalua si el evento abre el quinto invervalo
                            $matriz_eventos["intervalo_5"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(18)))  //Evalua si el evento abre el sexto invervalo
                            $matriz_eventos["intervalo_6"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(12)))  //Evalua si el evento abre el sexto invervalo
                            $matriz_eventos["intervalo_6"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(14)))  //Evalua si el evento abre el septimo invervalo
                            $matriz_eventos["intervalo_7"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(15)))  //Evalua si el evento abre el septimo invervalo
                            $matriz_eventos["intervalo_7"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(14)))  //Evalua si el evento abre el octavo invervalo
                            $matriz_eventos["intervalo_8"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(21)))  //Evalua si el evento abre el octavo invervalo
                            $matriz_eventos["intervalo_8"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(22)))  //Evalua si el evento abre el noveno invervalo
                            $matriz_eventos["intervalo_9"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(15)))  //Evalua si el evento abre el noveno invervalo
                            $matriz_eventos["intervalo_9"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(23)))  //Evalua si el evento abre el decimo invervalo
                            $matriz_eventos["intervalo_10"][$rs->Value('ca_valor')] = $fchEvento;

                        if (in_array($rs->Value('ca_idevento'),array(24)))  //Evalua si el evento abre el decimo invervalo
                            $matriz_eventos["intervalo_10"][$rs->Value('ca_valor')] = $fchEvento;

                        $rs->MoveNext();	// Buscar Todos los Registros de la referencia
                    }
                    echo "  </TABLE></TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; vertical-align:top;'><TABLE CELLSPACING=1>";

                    foreach($matriz_eventos as $intervalo){
                        echo "<TR>";
                        $flag = true;
                        $ini_event = null;
                        $fin_event = null;
                        while (list ($clave, $val) = each ($intervalo)) {
                            if ($flag){
                                $ini_event = $val;
                                $flag = false;
                            }else{
                                $fin_event = $val;
                            }
                            echo "<TD>$clave <br /> $val</TD>";
                        }
                        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($ini_event, "%d-%d-%d %d:%d:%d");
                        $tstamp_inicial = mktime($hor, $min, $seg, $mes, $dia, $ano);
                        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($fin_event, "%d-%d-%d %d:%d:%d");
                        $tstamp_final   = mktime($hor, $min, $seg, $mes, $dia, $ano);
                        $dif_mem = calc_dif($festi, $tstamp_inicial, $tstamp_final);
                        $dif_ref+= $dif_mem;
                        echo "<TD>Diferencia :<br /> $dif_mem</TD>";
                        echo "</TR>";
                    }
                    echo "  </TABLE></TD>";
                    $color = analizar_dif($tipo, $lci_var, $lcs_var, $dif_ref, $array_avg, $array_pnc, $array_pmc, $array_null); // Funci�n que retorna un Arreglo con el resultado de Dif
                    echo "  <TD Class=$color style='font-size: 9px; text-align:right;'>".$dif_ref."</TD>";
                    continue;
                    break;
            }
    	$rs->MoveNext();
    }

    echo "<TR HEIGHT=5>";
    echo "  <TH Class=titulo COLSPAN=".($tot_cols+$add_cols-1)." style='font-size: 9px; text-align:right;'>Promedio Ponderado :</TH>";
    echo "  <TH Class=titulo>".(($format_avg=="H:i:s")?date($format_avg,array_avg($array_avg)):array_avg($array_avg))."</TH>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<BR />";
    echo "<TABLE WIDTH=500 BORDER=0 CELLSPACING=1 CELLPADDING=1>";
    echo "<TH Class=titulo COLSPAN=7>COLTRANS S.A.<BR>$titulo<BR>Indicador $indicador $mes_mem / $ano_mem</TH>";
	
    echo "<TR>";
    echo "  <TD Class=listar ROWSPAN=4><b>Sucursal(es):</b><br /> - ".str_replace(",","<br /> - ",str_replace("%","Todas",$suc_mem))."</TD>";
    echo "  <TD Class=listar>Producto NO Conforme (%)</TD>";
    echo "  <TD Class=listar>No. Casos ".count($array_pnc)."</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".formatNumber(round(count($array_pnc)/count($array_avg)*100,2),2)."%</TD>";
    echo "  <TD Class=listar ROWSPAN=3>&nbsp;</TD>";
    echo "  <TD Class=listar>LCs:</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".$lcs_var."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Promedio Penderado:</TD>";
    echo "  <TD Class=listar>No. Casos ".count($array_avg)."</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".(($format_avg=="H:i:s")?date($format_avg,array_avg($array_avg)):array_avg($array_avg))."</TD>";
    echo "  <TD Class=listar>LC:</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".$lc_var."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Registros Inferiores al Lci</TD>";
    echo "  <TD Class=listar>No. Casos ".count($array_pmc)."</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".formatNumber(round(count($array_pmc)/count($array_avg)*100,2),2)."%</TD>";
    echo "  <TD Class=listar>LCi:</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".$lci_var."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Registros Excluidos del Promedio</TD>";
    echo "  <TD Class=listar>No. Casos ".count($array_null)."</TD>";
    echo "  <TD Class=listar style='font-size: 9px; text-align:right; font-weight:bold;'>".formatNumber(round(count($array_null)/$contador*100,2),2)."%</TD>";
    echo "  <TD Class=listar COLSPAN=3>&nbsp;</TD>";
    echo "</TR>";

    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repindicadores.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
    }

function analizar_dif($tipo, $lci_var, $lcs_var, &$dif_mem, &$array_avg, &$array_pnc, &$array_pmc, &$array_null){
        $contar = true;
	if ($dif_mem == null) {
		$color = "resaltar";
		$array_null[] = null;
                $contar = false;
	}else if ($dif_mem > $lcs_var) {
		$color = "negativo";
		$array_pnc[] = $dif_mem;
	}else if ($dif_mem < $lci_var){
		$color = "destacar";
		$array_pmc[] = $dif_mem;
	}else{
		$color = "invertir";
	}
        if ($contar){
            if ($tipo == "D"){
                    $array_avg[] = $dif_mem;
            }else{
                    list($hor, $min, $seg) = sscanf($dif_mem, "%d:%d:%d");
                    $array_avg[] = mktime($hor, $min, $sec, 0, 0, 0);
            }
        }
	return $color;
}
?>