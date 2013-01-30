<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPANTECEDENTES.PHP                                           \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Reporte de Libro de Referencias                             \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 53;
$titulo = 'Entrega Oportuna de Antecedentes';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($traorigen) and !isset($boton) and !isset($accion)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repantecedentes.php'>";
    echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=9 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura style= 'vertical-align: top;' ROWSPAN=2></TD>";
    echo "  <TD Class=listar style= 'vertical-align: top;'>Año:<BR><SELECT NAME='ano[]' size='8' multiple='multiple'>";
    for ( $i=5; $i>=-1; $i-- ) {
        $sel = (date('Y')==date('Y')-$i)?'SELECTED':'';
        echo " <OPTION VALUE=".(date('Y')-$i)." $sel>".(date('Y')-$i)."</OPTION>";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style= 'vertical-align: top;'>Mes:<BR><SELECT NAME='mes[]' size='12' multiple='multiple'>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED";
        }
        echo ">$val</OPTION>";
    }
    echo "  </SELECT></TD>";
    $tm =& DlRecordset::NewRecordset($conn);

    if (!$tm->Open("select DISTINCT ca_identificacion as ca_trafico from tb_parametros p, tb_traficos t where ca_casouso = 'CU010' and p.ca_valor = t.ca_idtrafico order by ca_identificacion")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repantecedentes.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Sufijo :<BR><SELECT NAME='trafico'>";
    echo " <OPTION VALUE=%>Sufijos (Todos)</OPTION>";
    while ( !$tm->Eof()) {
        echo " <OPTION VALUE=".$tm->Value('ca_trafico').">".$tm->Value('ca_trafico')."</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";

    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repantecedentes.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
        echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";
    if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Marítimo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Puerto de Destino :<BR><SELECT NAME='ciudestino'>";
    echo " <OPTION VALUE=%>Todos los Puertos</OPTION>";
    while ( !$tm->Eof()) {
        echo " <OPTION VALUE=".$tm->Value('ca_ciudad').">".$tm->Value('ca_ciudad')."</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";
    if (!$tm->Open("select DISTINCT ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit;
    }
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Sucursal:<BR><SELECT NAME='sucursal'>";
    echo "  <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
        $tm->MoveNext();
    }

    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style= 'vertical-align: top;'>Estado:<BR><SELECT NAME='casos'>";
    while (list ($clave, $val) = each ($estados)) {
        echo " <OPTION VALUE='".$val."'>".$clave;
    }
    echo "  </SELECT></TD>";
    echo "  <TH style='vertical-align:center;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=8></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.ano.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}
elseif (!isset($boton) and !isset($accion) and isset($traorigen)) {
  
    set_time_limit(0);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    $subtitulo = "Año(s): ".implode(", ",$ano)." / Mes(es): ".implode(", ",$mes);
    $ano = "im.ca_ano::text ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
    $mes = "im.ca_mes::text ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
    
    $query = "select distinct im.ca_ano, im.ca_mes, im.ca_referencia, im.ca_traorigen, im.ca_ciuorigen, im.ca_tradestino, im.ca_ciudestino, im.ca_modalidad, im.ca_estado, (SELECT ca_fchenvio::date FROM tb_emails where ca_tipo='Antecedentes' and ca_subject like '%'||im.ca_referencia||'%' order by ca_idemail DESC limit 1) as ca_envantecedentes, ";
    $query.= "ic.ca_idcliente, ic.ca_compania, ic.ca_consecutivo, ic.ca_hbls, ic.ca_sucursal, im.ca_fchembarque, ic.ca_fchantecedentes, ea1.ca_dias::int as ca_numdias, ea2.ca_dias::int as ca_numdias2, ea3.ca_dias::int as ca_numdias3 ";
    $query.= "from vi_inoclientes_sea ic inner join vi_inomaestra_sea im on ic.ca_referencia = im.ca_referencia inner join tb_ciudades cd on im.ca_origen = cd.ca_idciudad ";
    $query.= "left join tb_entrega_antecedentes ea1 on ea1.ca_idtrafico::text = cd.ca_idtrafico::text and ea1.ca_idciudad::text = '999-9999'  and ea1.ca_modalidad = '' ";
    $query.= "left join tb_entrega_antecedentes ea2 on ea2.ca_idtrafico::text = cd.ca_idtrafico::text and ea2.ca_idciudad::text = im.ca_origen::text ";
    $query.= "left join tb_entrega_antecedentes ea3 on ea3.ca_idtrafico::text = cd.ca_idtrafico::text and ea3.ca_modalidad::text = im.ca_modalidad::text ";
    $query.= "where im.ca_impoexpo = 'Importación' and $ano and $mes and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%' and ca_ciudestino like '%$ciudestino%' and ".str_replace("\\","", str_replace("\"","'",$casos))." and ca_sucursal like '%$sucursal%' ";
    $query.= "order by im.ca_ano, im.ca_mes, im.ca_referencia";
    
    if (!$rs->Open($query)) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='repantecedentes.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=13>".COLTRANS."<BR>$titulo<BR>$subtitulo</TH>";
    echo "</TR>";
    echo "<TH WIDTH=80>Referencia</TH>";
    echo "<TH WIDTH=80>Pto.Origen</TH>";
    echo "<TH WIDTH=80>Pto.Destino</TH>";
    echo "<TH WIDTH=50>Modalidad</TH>";
    echo "<TH WIDTH=70>Nit</TH>";
    echo "<TH WIDTH=150>Cliente</TH>";
    echo "<TH WIDTH=60>Reporte</TH>";
    echo "<TH WIDTH=80>Hbl</TH>";
    echo "<TH WIDTH=70>Sucursal</TH>";

    echo "<TH WIDTH=70>Fch.Embarque</TH>";
    echo "<TH WIDTH=75>Ent.Oportuna</TH>";
    echo "<TH WIDTH=70>Env.Efectivo</TH>";
    echo "<TH WIDTH=50>Diferencia</TH>";

    $tit_mem = false;
    $ano_mem = '';
    $mes_mem = '';
    $imp_sub = false;
    $sub_tot = array("No Cumplíó" => 0, "No se Midió" => 0, "Cumplíó" => 0);
    $sub_tot = array("No Cumplíó" => 0, "No se Midió" => 0, "Cumplíó" => 0);
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        if ($ano_mem."-".$mes_mem != $rs->Value('ca_ano')."-".$rs->Value('ca_mes')) {
            $ano_mem = $rs->Value('ca_ano');
            $mes_mem = $rs->Value('ca_mes');
            $tit_mem = true;
            $nom_tra = '';
            $sub_ref = '';
        }
       
        if ($nom_tra != $rs->Value('ca_traorigen')) {
            if($imp_sub){
               echo "<TR>";
               echo "  <TD Class=invertir style='font-weight:bold; text-align: right;' COLSPAN=9>Sub Totales: </TD>";
               foreach($sub_tot as $key => $val){
                  echo "  <TD Class=invertir style='font-weight:bold;'>$key : $val</TD>";
               }
               echo "  <TD Class=invertir style='font-weight:bold;'></TD>";
               echo "</TR>";
               $gra_tot["No Cumplíó"]+= $sub_tot["No Cumplíó"];
               $gra_tot["No se Midió"]+= $sub_tot["No se Midió"];
               $gra_tot["Cumplíó"]+= $sub_tot["Cumplíó"];
               $sub_tot = array("No Cumplíó" => 0, "No se Midió" => 0, "Cumplíó" => 0);
            }
            if ($tit_mem){
                  echo "<TR>";
                  echo "  <TH Class=invertir style='font-weight:bold;' COLSPAN=13>".strtoupper("$ano_mem - ".$meses[$mes_mem])."</TH>";
                  echo "</TR>";
                  $tit_mem = false;
            }
            echo "<TR>";
            echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=13>TRAFICO: ".$rs->Value('ca_traorigen')."</TD>";
            echo "</TR>";
            $nom_tra = $rs->Value('ca_traorigen');
            $imp_sub = true;
        }
        if ($sub_ref != substr($rs->Value('ca_referencia'),0,3)) {
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=titulo COLSPAN=13></TD>";
            echo "</TR>";
            $sub_ref = substr($rs->Value('ca_referencia'),0,3);
        }

        list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchembarque'), "%d-%d-%d");

        if ($rs->Value('ca_numdias3') != null){
            $ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$rs->Value('ca_numdias3'), $ano));
            $num_dia = "&nbsp;/&nbsp;".$rs->Value('ca_numdias3')."D";
        }else if ($rs->Value('ca_numdias2') != null){
            $ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$rs->Value('ca_numdias2'), $ano));
            $num_dia = "&nbsp;/&nbsp;".$rs->Value('ca_numdias2')."D";
        }else if ($rs->Value('ca_numdias') != null){
            $ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$rs->Value('ca_numdias'), $ano));
            $num_dia = "&nbsp;/&nbsp;".$rs->Value('ca_numdias')."D";
        }else{
            $ent_opo = null;
            $num_dia = null;
        }
        
        $dif_mem = dateDiff($ent_opo,$rs->Value('ca_envantecedentes'));
        if ($dif_mem > 0){ //$rs->Value('ca_numdias')
           $back_col = " background: #FF0000";
           $sub_tot["No Cumplíó"]+= 1;
        }else if (!$dif_mem){
           $back_col = " background: #9999CC";
           $sub_tot["No se Midió"]+= 1;
        }else{
           $back_col = " background: #F0F0F0";
           $sub_tot["Cumplíó"]+= 1;
        }
        // $back_col= (($dif_mem > $rs->Value('ca_numdias'))?" background: #FF0000":((!$dif_mem)?" background: #9999CC":" background: #F0F0F0"));
        
        echo "<TR>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_referencia')." </TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_ciuorigen')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_ciudestino')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_modalidad')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_idcliente')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_compania')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_consecutivo')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_hbls')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_sucursal')."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_fchembarque')."</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$ent_opo.$num_dia."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_envantecedentes')."</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$dif_mem."</TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    $gra_tot["No Cumplíó"]+= $sub_tot["No Cumplíó"];
    $gra_tot["No se Midió"]+= $sub_tot["No se Midió"];
    $gra_tot["Cumplíó"]+= $sub_tot["Cumplíó"];
    echo "<TR>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: right;' COLSPAN=9>Sub Totales: </TD>";
    foreach($sub_tot as $key => $val){
      echo "  <TD Class=invertir style='font-weight:bold;'>$key : $val</TD>";
    }
    echo "  <TD Class=invertir style='font-weight:bold;'></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    $val_tot = 0;
    foreach($gra_tot as $key => $val){
       $val_tot+= $val;
    }
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=3>RESUMEN<BR>$subtitulo</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: center;'>Críterio</TD>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: center;'>Cantidad</TD>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: center;'>%</TD>";
    echo "</TR>";
    reset($gra_tot);
    $por_tot = 0;
    foreach($gra_tot as $key => $val){
      echo "<TR>";
      echo "  <TD Class=listar style='font-weight:bold;'>$key</TD>";
      echo "  <TD Class=listar style='font-weight:bold; text-align: right;'>".number_format($val)."</TD>";
      echo "  <TD Class=listar style='font-weight:bold; text-align: right;'>".round($val/$val_tot*100,2)."</TD>";
      echo "</TR>";
      $por_tot+= round($val/$val_tot*100,2);
    }
    echo "<TR>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: left;'>Total :</TD>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: right;'>".number_format($val_tot)."</TD>";
    echo "  <TD Class=invertir style='font-weight:bold; text-align: right;'>".number_format($por_tot)."</TD>";
    echo "</TR>";
    echo "</TABLE><BR>";


    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repantecedentes.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}

?>