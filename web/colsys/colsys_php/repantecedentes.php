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
$titulo = 'Entrega Oportuna de Antecedentes';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");
$request_uri = str_replace("/colsys_php/", "", $_SERVER["REQUEST_URI"]);

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
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Sufijo :<BR><SELECT NAME='trafico[]'>";
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
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Tráfico :<BR><SELECT NAME='traorigen[]'>";
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
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Puerto de Destino :<BR><SELECT NAME='ciudestino[]'>";
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
    echo "  <TD Class=mostrar style= 'vertical-align: top;'>Sucursal:<BR><SELECT NAME='sucursal[]'>";
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
    $request_uri = $_SERVER['REQUEST_URI'];     //  Identifica desde que opcón se invocó la consulta y muestra o no titulos,
    $pos = strrpos($request_uri, "repindicadornew.php");    // para facilitar la exportación a Excel
    $con_tit = TRUE;
    if ($pos !== 0){
        $con_tit = FALSE;
    }
       
    set_time_limit(0);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    $subtitulo = "Año(s): ".implode(", ",$ano)." / Mes(es): ".implode(", ",$mes);
    $ano = "(substr(im.ca_referencia::text, 16, 2)::integer + 2000)::text ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
    $mes = "substr(im.ca_referencia::text, 8, 2)::text ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
    
    $sucursal = "su.ca_nombre::text ".((count($sucursal)==1)?"like '$sucursal[0]'":"in ('".implode("','",$sucursal)."')");
    $ciudestino = "c2.ca_ciudad::text ".((count($ciudestino)==1)?"like '$ciudestino[0]'":"in ('".implode("','",$ciudestino)."')");
    $trafico = (isset($trafico))?"substr(im.ca_referencia, 5, 2)::text ".((count($trafico)==1)?"like '$trafico[0]'":"in ('".implode("','",$trafico)."')"):"TRUE";
    $traorigen = "t1.ca_nombre::text ".((count($traorigen)==1)?"like '$traorigen[0]'":"in ('".implode("','",$traorigen)."')");
    $casos = (isset($casos))?$casos:"TRUE";

    if (!$rs->Open("select ca_ident, ca_value from control.tb_config_values cv inner join control.tb_config cn on cn.ca_idconfig = cv.ca_idconfig and cn.ca_param = 'CU119' order by ca_ident")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repantecedentes.php';</script>";
        exit;
    }
    $tipos = array();
    $rs->MoveFirst();
    while ( !$rs->Eof() ) {
        $tipos[$rs->Value('ca_ident')] = $rs->Value('ca_value');
        $rs->MoveNext();
    }
    $query = "select distinct substr(im.ca_referencia::text, 16, 2)::integer + 2000 AS ca_ano, substr(im.ca_referencia::text, 8, 2) AS ca_mes, substr(im.ca_referencia::text, 5, 2) AS ca_trafico, im.ca_referencia, t1.ca_nombre AS ca_traorigen, c1.ca_ciudad AS ca_ciuorigen, t2.ca_nombre AS ca_tradestino, c2.ca_ciudad AS ca_ciudestino, im.ca_modalidad, im.ca_estado, im.ca_tipo, im.ca_fchrecibido, im.ca_propiedades, im.ca_fchenvio as ca_envantecedentes, ";
    $query.= "ic.ca_idcliente, id.ca_nombre AS ca_compania, rp.ca_consecutivo, ic.ca_hbls, su.ca_nombre as ca_sucursal, im.ca_fchembarque, ic.ca_fchantecedentes, ea1.ca_dias::int as ca_numdias, ea2.ca_dias::int as ca_numdias2, ea3.ca_dias::int as ca_numdias3, ea4.ca_dias::int as ca_numdias4 ";
    $query.= "from tb_reportes rp join tb_inoclientes_sea ic on rp.ca_idreporte = ic.ca_idreporte join tb_inomaestra_sea im on ic.ca_referencia::text = im.ca_referencia::text join ids.tb_ids id on ic.ca_idcliente = id.ca_id ";
    $query.= "join control.tb_usuarios us on rp.ca_login = us.ca_login join control.tb_sucursales su on us.ca_idsucursal = su.ca_idsucursal join tb_ciudades c1 on im.ca_origen::text = c1.ca_idciudad::text ";
    $query.= "join tb_ciudades c2 on im.ca_destino::text = c2.ca_idciudad::text join tb_traficos t1 on c1.ca_idtrafico::text = t1.ca_idtrafico::text join tb_traficos t2 on c2.ca_idtrafico::text = t2.ca_idtrafico::text ";
    $query.= "left join tb_entrega_antecedentes ea1 on ea1.ca_idtrafico::text = c1.ca_idtrafico::text and ea1.ca_idciudad::text = '999-9999' and ea1.ca_iddestino::text = '999-9999' and ea1.ca_modalidad = '' ";
    $query.= "left join tb_entrega_antecedentes ea2 on ea2.ca_idtrafico::text = c1.ca_idtrafico::text and ea2.ca_idciudad::text = im.ca_origen::text and ea2.ca_iddestino::text = '999-9999' ";
    $query.= "left join tb_entrega_antecedentes ea3 on ea3.ca_idtrafico::text = c1.ca_idtrafico::text and ( ea3.ca_idciudad::text = im.ca_origen::text or ea3.ca_idciudad::text = '999-9999' ) and ea3.ca_iddestino::text = im.ca_destino::text ";
    $query.= "left join tb_entrega_antecedentes ea4 on ea4.ca_idtrafico::text = c1.ca_idtrafico::text and ea4.ca_modalidad::text = im.ca_modalidad::text ";
    $query.= "where im.ca_impoexpo = 'Importación' and $ano and $mes and $trafico and $traorigen and $ciudestino and ".str_replace("\\","", str_replace("\"","'",$casos))." and $sucursal ";
    $query.= "order by ca_ano, ca_mes, ca_referencia";
    //die($query);
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
    echo "  <TH Class=titulo COLSPAN=16>".COLTRANS."<BR>$titulo<BR>$subtitulo</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH WIDTH=80>Referencia</TH>";
    echo "<TH WIDTH=80>Pto.Origen</TH>";
    echo "<TH WIDTH=80>Pto.Destino</TH>";
    echo "<TH WIDTH=40>Modalidad</TH>";
    echo "<TH WIDTH=70>Nit</TH>";
    echo "<TH WIDTH=150>Cliente</TH>";
    echo "<TH WIDTH=60>Reporte</TH>";
    echo "<TH WIDTH=80>Hbl</TH>";
    echo "<TH WIDTH=70>Sucursal</TH>";
    echo "<TH WIDTH=50>Tipo</TH>";

    echo "<TH WIDTH=50>Embarque</TH>";
    echo "<TH WIDTH=60>Antecedentes</TH>";
    echo "<TH WIDTH=75>Ent.Oportuna</TH>";
    echo "<TH WIDTH=75>Desbloqueo</TH>";
    echo "<TH WIDTH=10>Dif.</TH>";
    echo "<TH WIDTH=50>Justificaci&oacute;n</TH>";
    echo "</TR>";

    $tit_mem = false;
    $ano_mem = '';
    $mes_mem = '';
    $imp_sub = false;
    $sub_tot = array("Cumplíó" => 0, "No Cumplíó" => 0, "No se Midió" => 0);
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
               if ($con_tit){
                    echo "<TR>";
                    echo "  <TD Class=invertir style='font-weight:bold; text-align: right;' COLSPAN=11>Sub Totales: </TD>";
                    foreach($sub_tot as $key => $val){
                       echo "  <TD Class=invertir style='font-weight:bold;'>$key : $val</TD>";
                    }
                    echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2></TD>";
                    echo "</TR>";
               }
               $gra_tot["No Cumplíó"]+= $sub_tot["No Cumplíó"];
               $gra_tot["No se Midió"]+= $sub_tot["No se Midió"];
               $gra_tot["Cumplíó"]+= $sub_tot["Cumplíó"];
               $sub_tot = array("No Cumplíó" => 0, "No se Midió" => 0, "Cumplíó" => 0);
            }
            if ($tit_mem){
                if ($con_tit){
                  echo "<TR>";
                  echo "  <TH Class=invertir style='font-weight:bold;' COLSPAN=16>".strtoupper("$ano_mem - ".$meses[$mes_mem])."</TH>";
                  echo "</TR>";
                }
                $tit_mem = false;
            }
            if ($con_tit){
                echo "<TR>";
                echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=16>TRAFICO: ".$rs->Value('ca_traorigen')."</TD>";
                echo "</TR>";
            }
            $nom_tra = $rs->Value('ca_traorigen');
            $imp_sub = true;
        }
        if ($sub_ref != substr($rs->Value('ca_referencia'),0,3)) {
            if ($con_tit){
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=17></TD>";
                echo "</TR>";
            }
            $sub_ref = substr($rs->Value('ca_referencia'),0,3);
        }

        list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchembarque'), "%d-%d-%d");

        if ($rs->Value('ca_numdias4') != null){
            $ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$rs->Value('ca_numdias4'), $ano));
            $num_dia = "&nbsp;/&nbsp;".$rs->Value('ca_numdias4')."D";
        }else if ($rs->Value('ca_numdias3') != null){
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
        
        list($ano, $mes, $dia) = sscanf($rs->Value('ca_envantecedentes'), "%d-%d-%d %s:%s:%s");
        $ent_efe = date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano));
        $dif_mem = dateDiff($ent_opo,$ent_efe);
        $dif_mem = ($rs->Value('ca_tipo')==1 or $rs->Value('ca_tipo')==2)?NULL:$dif_mem;
        if (!$ent_opo){
           $back_col = " background: #9999CC";
           $sub_tot["No se Midió"]+= 1;
        }else if ($dif_mem > 0 and $ent_opo<>$ent_efe){ //$rs->Value('ca_numdias')
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
        
        $justifica = "";
        if(strlen($rs->Value('ca_propiedades'))!=0){
            $propiedades = $rs->Value('ca_propiedades');
            $propiedades = explode(";", $propiedades);
            foreach ($propiedades as $propiedad){
                $propiedad = explode("=", $propiedad);
                if ($propiedad[0] == "idg"){
                    $justifica = $propiedad[1];
                }
            }
        }
        
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
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$tipos[$rs->Value('ca_tipo')]."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col;font-weight:bold'>".$rs->Value('ca_fchembarque')."</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col;font-weight:bold;'>".$rs->Value('ca_envantecedentes')."</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$ent_opo.$num_dia."</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$rs->Value('ca_fchrecibido')."</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col;font-weight:bold;'>".$dif_mem."</TD>";
        echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$justifica."</TD>";
        echo "</TR>";
        $ref_mem = $rs->Value('ca_referencia');
        $rs->MoveNext();
        while ($ref_mem == $rs->Value('ca_referencia') and !$rs->Eof()){
            if ($con_tit){
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col' colspan='4'> </TD>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_idcliente')."</TD>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_compania')."</TD>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_consecutivo')."</TD>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_hbls')."</TD>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_sucursal')."</TD>";
                echo "  <TD Class=listar style='font-size: 9px;$back_col' colspan='8'></TD>";
                echo "</TR>";
            }
            $rs->MoveNext();
        }
        
    }
    $gra_tot["No Cumplíó"]+= $sub_tot["No Cumplíó"];
    $gra_tot["No se Midió"]+= $sub_tot["No se Midió"];
    $gra_tot["Cumplíó"]+= $sub_tot["Cumplíó"];
    if ($con_tit){
        echo "<TR>";
        echo "  <TD Class=invertir style='font-weight:bold; text-align: right;' COLSPAN=11>Sub Totales: </TD>";
        foreach($sub_tot as $key => $val){
          echo "  <TD Class=invertir style='font-weight:bold;'>$key : $val</TD>";
        }
        echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2></TD>";
        echo "</TR>";
    }
    echo "</TABLE><BR>";

    $val_tot = 0;
    foreach($gra_tot as $key => $val){
       $val_tot+= $val;
    }
    echo "<TABLE CELLSPACING=1>";
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
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"$request_uri\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}

?>