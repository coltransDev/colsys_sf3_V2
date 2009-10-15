<?php 
/*
while (list ($clave, $val) = each ($HTTP_POST_VARS)) {
    echo "$clave => $val<br>";
}

while (!$rs->Eof() and !$rs->IsEmpty()) {
    $rs->MoveNext();
}

$rs->MoveFirst();

$rs->Value('ca_vlrneto')

$rs->GetRowCount();

$rs->GetCurrentRow();


$script = "select rs.ca_idreporte, rp.ca_consecutivo, rs.ca_idstatus, rs.ca_piezas, rs.ca_peso, rs.ca_volumen, pr.ca_valor2";
$script.= "	from tb_repstatus rs ";
$script.= " LEFT OUTER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte)";
$script.= "	LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and pr.ca_valor = (string_to_array(rs.ca_piezas,'|'))[2])";
$script.= "	RIGHT OUTER JOIN (select max(ca_idstatus) as ca_idstatus from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte) group by rp.ca_consecutivo) ls ON (rs.ca_idstatus = ls.ca_idstatus)";
$script.= " where ca_consecutivo = '".$ic->Value("ca_contenedores")."'";
if (!$rp->Open("$script")) {    // Trae de la Tabla de la Reportes de Negocio el Último Status.
	echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
	echo "<script>document.location.href = 'inosea.php';</script>";
	exit;
}


select u.ca_sucursal, count(DISTINCT i.ca_hbls) from vi_inoclientes_sea i, control.tb_usuarios u where i.ca_login = u.ca_login
and substr(ca_referencia,8,2) = '01' and substr(ca_referencia,15,1) = '6' and ca_referencia in (select ca_referencia from
tb_inomaestra_sea where ca_usucerrado != '') group by ca_sucursal

echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";
    
echo "<TR HEIGHT=5>";
echo "  <TD Class=invertir COLSPAN=3></TD>";
echo "</TR>";

             echo "<script type='text/javascript' src='javascripts/Tokenizer.js'></script>";


             echo "function validacion(ventana, to, id, pr){";
             echo "  frame = document.getElementById(ventana + '_frame');";
             echo "  ventana = document.getElementById(ventana);";
             echo "  nu = to.getAttribute('ID').substring(to.getAttribute('ID').indexOf('_')+1);";
             echo "}";
             echo "function uptarifas(cadena, nu){";
             echo "  elemento = document.getElementById('idflete_' + nu);";
             echo "  elemento.length=0;";
             echo "  elemento.options[elemento.length] = new Option();";
             echo "  elemento.length=0;";
             echo "  i = 0;";
             echo "  j = cadena.indexOf('|');";
             echo "  while (true) {";
             echo "     segmento = cadena.substring(i, j);";            //, 
             echo "     elemento.options[elemento.length] = new Option(segmento,segmento,false,false);";
             echo "     i = j + 1;";
             echo "     j = cadena.indexOf('|', i);";
             echo "     if (j >= cadena.length || j == -1){";
             echo "         break;";
             echo "     }";
             echo "  }";
             echo "}";
             echo "function ofrecer(to){";
             echo "  nu = to.getAttribute('ID').substring(to.getAttribute('ID').indexOf('_')+1);";
             echo "  elemento = document.getElementById('oferta_' + nu);";
             echo "  var tokens = to.value.tokenize(',', ' ', true);";
             echo "  elemento.value = tokens[2]+' '+tokens[4]+' Min.'+tokens[3]+' '+tokens[4];";
             echo "}";



    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=250 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<SMALL>";
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Naviera</TH>";
    echo "<TH>Tar.Neta</TH>";
    echo "<TH>Sug.Venta</TH>";
    echo "<TH>Mínimo</TH>";
    if (isset($cn) and isset($id) and isset($pr)) {                                                              // Switch que evalua cual botòn de comando fue pulsado por el usuario
        if (!$rs->Open("select f.ca_idtrayecto, t.ca_nombre, f.ca_vlrneto, f.ca_vlrminimo, f.ca_fleteminimo, ca_idmoneda from vi_fletes f, vi_trayectos t where f.ca_idtrayecto = t.ca_idtrayecto and ca_idconcepto = $cn and f.ca_idtrayecto in (select ca_idtrayecto from vi_trayectos t, vi_cotproductos p where p.ca_idcotizacion = $id and p.ca_idproducto = $pr and t.ca_origen = p.ca_idorigen and t.ca_destino = p.ca_iddestino)")) {    // Mueve el apuntador al registro que se desea modificar
            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
            exit;
            }
        while (!$rs->Eof()) {
            echo "<TR>";
            echo " <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
            echo " <TD Class=mostrar>".number_format($rs->Value('ca_vlrneto'),2)." ".$rs->Value('ca_idmoneda')."</TD>";
            echo " <TD Class=mostrar>".number_format($rs->Value('ca_vlrminimo'),2)." ".$rs->Value('ca_idmoneda')."</TD>";
            echo " <TD Class=mostrar>".number_format($rs->Value('ca_fleteminimo'),2)." ".$rs->Value('ca_idmoneda')."</TD>";
            echo "</TR>";
            $rs->MoveNext();
        }
    }
    echo "</TABLE><BR>";
    echo "</SMALL>";
    echo "</FORM>";
    echo "</CENTER>";
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";

    
            echo "<TR>";
            echo " <TD Class=mostrar>";
            echo " <fieldset>";
            echo " <legend>".$rs->Value('ca_nombre')."</legend>";
            echo " <fieldset>Tarifa&nbspNeta:&nbsp".number_format($rs->Value('ca_vlrneto'),2)."&nbsp".$rs->Value('ca_idmoneda')."</fieldset>";
            echo " <fieldset>Sug.Venta&nbsp:&nbsp".number_format($rs->Value('ca_vlrminimo'),2)."&nbsp".$rs->Value('ca_idmoneda')."</fieldset>";
            echo " <fieldset>Mínima&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp".number_format($rs->Value('ca_fleteminimo'),2)."&nbsp".$rs->Value('ca_idmoneda')."</fieldset>";
            echo " </fieldset>";
            echo " </TD>";
            echo "</TR>";

    if (isset($criterio) and strlen(trim($criterio)) != 0 and !isset($condicion)) {
        if ($opcion == 'ca_referencia' or $opcion == 'ca_mbls' or $opcion == 'ca_motonave' or $opcion == 'ca_observaciones') {
            $condicion= "where lower($opcion) like lower('%".$criterio."%')"; }
        elseif ($opcion == 'ca_idequipo') {
            $condicion= ", vi_inoequipos_sea e where i.ca_referencia = e.ca_referencia and lower($opcion) like lower('%".str_replace("ca_","e.ca",$criterio)."%')"; }
        elseif ($opcion == 'ca_hbls' or $opcion == 'ca_idcliente' or $opcion == 'ca_compania' or $opcion == 'ca_factura') {
            $condicion= ", vi_inoclientes_sea c where i.ca_referencia = c.ca_referencia and lower($opcion) like lower('%".str_replace("ca_","e.ca",$criterio)."%')"; }
        elseif ($opcion == 'ca_factura_prov') {
            $condicion= ", vi_inocostos_sea c where i.ca_referencia = c.ca_referencia and lower(".substr($opcion,0,10).") like lower('%".str_replace("ca_","e.ca",$criterio)."%')"; }
       }





             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='javascript' src='javascripts/valreporte.js'></script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";

             echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_contacto.style.top=dalt'>";
             echo "<DIV ID='find_contacto' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
             echo "<IFRAME ID='find_contacto_frame' SRC='' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
             echo "</IFRAME>";
             echo "</DIV>";

             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='reportenegocio.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";         // Trae el id del Contacto para el Cliente
             echo "<TABLE WIDTH=600 CELLSPACING=1>";
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=3 style='font-weight:bold;'>REPORTE DE NEGOCIO</TH>";
             echo "  <TD Class=mostrar style='text-align:center;'><B>Cotización:</B><BR><INPUT TYPE='TEXT' NAME='idcotizacion' VALUE=".$rs->Value('ca_idcotizacion')." SIZE=13 MAXLENGTH=10></TD>";
             echo "  <TD Class=mostrar style='text-align:center;'><B>Reporte No.:</B><BR><INPUT TYPE='TEXT' NAME='idreporte' VALUE=".$rs->Value('ca_idreporte')." SIZE=13 MAXLENGTH=10></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=5 style='font-weight:bold;'>INFORMACION GENERAL</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=titulo>1. Impor/Exportación</TD>";
             echo "  <TD Class=titulo COLSPAN=2>2. Ciudad de Origen</TD>";
             echo "  <TD Class=titulo COLSPAN=2>3. Ciudad de Destino</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>&nbsp&nbsp&nbsp&nbsp<SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i];
                  if ($rs->Value('ca_impoexpo') == $imporexpor[$i]) {
                      echo " SELECTED";
                  }
                  echo ">".$imporexpor[$i]."</OPTION>";
                  }
             echo "  </SELECT>&nbsp&nbsp&nbsp</TD>";
             if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos where ca_nombre = '".$rs->Value('ca_traorigen')."' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE='".$tm->Value('ca_idtrafico')."'>".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_nombre = '".$rs->Value('ca_traorigen')."' order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE='".$tm->Value('ca_idciudad')."'";
                     if ($rs->Value('ca_origen') == $tm->Value('ca_idciudad')) {
                         echo " SELECTED";
                     }
                     echo ">".$tm->Value('ca_ciudad')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos where ca_nombre = '".$rs->Value('ca_tradestino')."' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE='".$tm->Value('ca_idtrafico')."'>".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_nombre = '".$rs->Value('ca_tradestino')."' order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' SIZE=7>";         // Llena el cuadro de lista con los valores de la tabla Destinos
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE='".$tm->Value('ca_idciudad')."'";
                     if ($rs->Value('ca_destino') == $tm->Value('ca_idciudad')) {
                         echo " SELECTED";
                     }
                     echo ">".$tm->Value('ca_ciudad')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' NAME='fchdespacho' SIZE=12 VALUE='".$rs->Value('ca_fchdespacho')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
             if (!$tm->Open("select ca_idagente, ca_nombre from vi_agentes where ca_nomtrafico = '".$rs->Value('ca_traorigen')."' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=listar COLSPAN=2>5. Agente Coltrans:<BR><SELECT NAME='idagente'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE='".$tm->Value('ca_idagente')."'";
                     if ($rs->Value('ca_idagente') == $tm->Value('ca_idagente')) {
                         echo " SELECTED";
                     }
                     echo ">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar COLSPAN=2>6. Incoterms:<BR><SELECT NAME='incoterms'>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <OPTION VALUE='".$tincoterms[$i]."'";
                  if ($rs->Value('ca_incoterms') == $tincoterms[$i]) {
                      echo " SELECTED";
                  }
                  echo " >".$tincoterms[$i]."</OPTION>";
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4>7. Descripción de la Mercancía:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=93>".$rs->Value('ca_mercancia_desc')."</TEXTAREA></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <INPUT ID=id_pro TYPE='HIDDEN' NAME='idproveedor' VALUE=".$rs->Value('ca_idproveedor').">";
             echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>8. Nombre:<BR><INPUT ID=nombre_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$rs->Value('ca_nombre_pro')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar>8.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_pro' VALUE='".$rs->Value('ca_orden_prov')."' SIZE=15 MAXLENGTH=15></TD>";
             echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_pro\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>8.2 Contacto:<BR><INPUT ID=contacto_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$rs->Value('ca_contacto_pro')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar COLSPAN=2>8.3 Dirección:<BR><INPUT ID=direccion_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$rs->Value('ca_direccion_pro')."' SIZE=40 MAXLENGTH=80></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>8.4 Teléfono:<BR><INPUT ID=telefonos_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$rs->Value('ca_telefonos_pro')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "    <TD Class=mostrar>8.5 Fax:<BR><INPUT ID=fax_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$rs->Value('ca_fax_pro')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "    <TD Class=mostrar COLSPAN=2>8.6 Correo Electrónico:<BR><INPUT ID=email_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$rs->Value('ca_email_pro')."' SIZE=30 MAXLENGTH=40></TD>";
             echo "  </TR>";
             echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=4></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <INPUT ID=id_con TYPE='HIDDEN' NAME='idconsignatario' VALUE=".$rs->Value('ca_idconsignatario').">";
             echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Consignatario:<BR></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>9. Nombre:<BR><INPUT ID=nombre_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_nombre_con')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar>9.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_cons' VALUE='".$rs->Value('ca_orden_cons')."' SIZE=15 MAXLENGTH=15></TD>";
             echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_con\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>9.2 Contacto:<BR><INPUT ID=contacto_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_contacto_con')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar COLSPAN=2>9.3 Dirección:<BR><INPUT ID=direccion_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_direccion_con')."' SIZE=40 MAXLENGTH=80></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>9.4 Teléfono:<BR><INPUT ID=telefonos_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_telefonos_con')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "    <TD Class=mostrar>9.5 Fax:<BR><INPUT ID=fax_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_fax_con')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "    <TD Class=mostrar COLSPAN=2>9.6 Correo Electrónico:<BR><INPUT ID=email_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_email_con')."' SIZE=30 MAXLENGTH=40></TD>";
             echo "  </TR>";
             echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=4></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <INPUT ID=id_rep TYPE='HIDDEN' NAME='idrepresentante' VALUE=".$rs->Value('ca_idrepresentante').">";
             echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Representante:<BR></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>10. Nombre:<BR><INPUT ID=nombre_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_nombre_rep')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar>10.1 Enviar Información:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'Sí' ".(($rs->Value('ca_informar_repr')=="Sí")?"CHECKED":"").">Sí&nbsp&nbsp&nbsp<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'No' ".(($rs->Value('ca_informar_repr')=="No")?"CHECKED":"").">No</TD>";
             echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_rep\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>10.2 Contacto:<BR><INPUT ID=contacto_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_contacto_rep')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar COLSPAN=2>10.3 Dirección:<BR><INPUT ID=direccion_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_direccion_rep')."' SIZE=40 MAXLENGTH=80></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>10.4 Teléfono:<BR><INPUT ID=telefonos_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_telefonos_rep')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "    <TD Class=mostrar>10.5 Fax:<BR><INPUT ID=fax_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_fax_rep')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "    <TD Class=mostrar COLSPAN=2>10.6 Correo Electrónico:<BR><INPUT ID=email_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_email_rep')."' SIZE=30 MAXLENGTH=40></TD>";
             echo "  </TR>";
             echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=4></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
             echo "  <TD Class=mostrar COLSPAN=4>11. Preferencias del Cliente:<BR><TEXTAREA NAME='preferencias_clie' WRAP=virtual ROWS=4 COLS=93>".$rs->Value('ca_preferencias_clie')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=4></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TD Class=titulo ROWSPAN=3 style='text-align:left; vertical-align:top;'>12. Transporte:<BR><CENTER><SELECT NAME='transporte' ONCHANGE='llenar_modalidades();'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i];
                  if ($rs->Value('ca_transporte') == $transportes[$i]) {
                      echo " SELECTED";
                  }
                  echo ">".$transportes[$i];
                  }
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=mostrar>13. Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='llenar_lineas();'>";
             if ($rs->Value('ca_transporte') == 'Aéreo') {
                 echo " <OPTION VALUE=CONSOLIDADO SELECTED>CONSOLIDADO</OPTION>";
             }else if ($rs->Value('ca_transporte') == 'Marítimo') {
                 echo " <OPTION VALUE=LCL ".(($rs->Value('ca_modalidad')=="LCL")?"SELECTED":"").">LCL</OPTION>";
                 echo " <OPTION VALUE=FCL ".(($rs->Value('ca_modalidad')=="FCL")?"SELECTED":"").">FCL</OPTION>";
             }
             echo "  </SELECT></TD>";
             if (!$tm->Open("select ca_idlinea, ca_nombre from vi_transporlineas where ca_transporte = '".$rs->Value('ca_transporte')."' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'trayectos.php';</script>";
                 exit; }
             $tm->MoveFirst();
             echo "  <TD Class=mostrar COLSPAN=3>14. Línea Transporte:<BR><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE='".$tm->Value('ca_idlinea')."'";
                     if ($rs->Value('ca_idlinea') == $tm->Value('ca_idlinea')) {
                         echo " SELECTED";
                     }
                     echo ">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>15.&nbspColmas&nbspS.I.A.&nbspLtda:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='colmas' TYPE='radio' VALUE = 'Sí' ".(($rs->Value('ca_colmas')=="Sí")?"CHECKED":"").">Sí&nbsp&nbsp&nbsp&nbsp<INPUT NAME='colmas' TYPE='radio' VALUE = 'No' ".(($rs->Value('ca_colmas')=="No")?"CHECKED":"").">No</TD>";
             echo "  <TD Class=mostrar>16.&nbspSeguro&nbspcon&nbspAnker:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='seguro' TYPE='radio' VALUE = 'Sí' ".(($rs->Value('ca_seguro')=="Sí")?"CHECKED":"").">Sí&nbsp&nbsp&nbsp&nbsp<INPUT NAME='seguro' TYPE='radio' VALUE = 'No' ".(($rs->Value('ca_seguro')=="No")?"CHECKED":"").">No</TD>";
             echo "  <TD Class=mostrar>17. Lib. Automática:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT ID=si NAME='liberacion' TYPE='radio' VALUE = 'Sí' ".(($rs->Value('ca_liberacion')=="Sí")?"CHECKED":"")." ONCLICK='liberar(this);'>Sí&nbsp&nbsp&nbsp&nbsp<INPUT ID=no NAME='liberacion' TYPE='radio' VALUE = 'No' ".(($rs->Value('ca_liberacion')=="No")?"CHECKED":"")." ONCLICK='liberar(this);'>No</TD>";
             echo "  <TD Class=mostrar>Tiempo de Crédito:<BR><INPUT READONLY TYPE='TEXT' NAME='tiempocredito' VALUE='".$rs->Value('ca_tiempocredito')."' SIZE=18 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4>18. Zona/Depósito Aduanero:<BR><SELECT NAME='zonadeposito'>";             // Llena el cuadro de lista con las zonas o depósitos aduaneros
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<script>llenar_zonas();</script>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=5></TD>";
             echo "</TR>";
             
             echo "</TABLE><BR>";

             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"reportenegocio.php\"'></TH>";  // Cancela la operación
             echo "<BR>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";



                     echo "  <TR>";
                     echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                     $co->MoveFirst();
                     while (!$co->Eof()) {
                            echo"<OPTION VALUE=".$co->Value('ca_idconcepto').">".$co->Value('ca_concepto')."</OPTION>";
                            $co->MoveNext();
                           }
                     echo "  </SELECT></TD>";
                     echo "  <TD Class=mostrar>20.1 Cantidad:<BR><INPUT TYPE='TEXT' NAME='cantidad[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "  <TD Class=mostrar COLSPAN=2><TD>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                     echo "  </TR>";
        
                     echo "  <TR>";
                     echo "    <TD Class=mostrar>21. Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='neta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "    <TD Class=mostrar>21.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "    <TD Class=mostrar>21.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "    <TD Class=mostrar>21.3 Moneda:<BR><SELECT NAME='idmoneda_tar[]'>";
                                $mn->MoveFirst();
                                while (!$mn->Eof()) {
                                       echo"<OPTION VALUE=".$mn->Value('ca_idmoneda')." ".(($mn->Value('ca_idmoneda')=='USD')?'SELECTED':'').">".$mn->Value('ca_idmoneda')."</OPTION>";
                                       $mn->MoveNext();
                                }
                     echo "    </SELECT></TD>";
                     echo "  </TR>";
                     echo "  <TR>";
                     echo "    <TD Class=mostrar>22. BAF Neto:<BR><INPUT TYPE='TEXT' NAME='neta_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "    <TD Class=mostrar>22.1 BAF Agente:<BR><INPUT TYPE='TEXT' NAME='agente_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "    <TD Class=mostrar>22.2 BAF Venta:<BR><INPUT TYPE='TEXT' NAME='venta_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                     echo "    <TD Class=mostrar>22.3 Moneda:<BR><SELECT NAME='idmoneda_baf[]'>";
                                $mn->MoveFirst();
                                while (!$mn->Eof()) {
                                       echo"<OPTION VALUE=".$mn->Value('ca_idmoneda')." ".(($mn->Value('ca_idmoneda')=='USD')?'SELECTED':'').">".$mn->Value('ca_idmoneda')."</OPTION>";
                                       $mn->MoveNext();
                                }
                     echo "    </SELECT></TD>";
                     echo "  </TR>";
                     echo "  <TR HEIGHT=5>";
                     echo "    <TD Class=invertir COLSPAN=4></TD>";
                     echo "  </TR>";





                    echo "  <TD ID=tconc_$i>&nbsp</TD>";
                    echo "  <TD ID=tcant_$i align=right><INPUT ID=hcant_$i TYPE='HIDDEN' NAME='conceptos[$i][ncant]'>&nbsp</TD>";
                    echo "  <TD ID=tntar_$i align=right><INPUT ID=hntar_$i TYPE='HIDDEN' NAME='conceptos[$i][nntar]'>&nbsp</TD>";
                    echo "  <TD ID=tnmin_$i align=right><INPUT ID=hnmin_$i TYPE='HIDDEN' NAME='conceptos[$i][nnmin]'>&nbsp</TD>";
                    echo "  <TD ID=trtar_$i align=right><INPUT ID=hrtar_$i TYPE='HIDDEN' NAME='conceptos[$i][nrtar]'>&nbsp</TD>";
                    echo "  <TD ID=trmin_$i align=right><INPUT ID=hrmin_$i TYPE='HIDDEN' NAME='conceptos[$i][nrmin]'>&nbsp</TD>";
                    echo "  <TD ID=tctar_$i align=right><INPUT ID=hctar_$i TYPE='HIDDEN' NAME='conceptos[$i][nctar]'>&nbsp</TD>";
                    echo "  <TD ID=tcmin_$i align=right><INPUT ID=hcmin_$i TYPE='HIDDEN' NAME='conceptos[$i][ncmin]'>&nbsp</TD>";



                    echo "  <INPUT ID=fidco_$i TYPE='HIDDEN' NAME='conceptos[$i][fidco]'>";
                    echo "  <TD align=left><INPUT ID=fconc_$i Class=field style='text-align:left; font-weight:bold;' TYPE='BUTTON'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=40><INPUT ID=fcant_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][fcant]'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=65><INPUT ID=fntar_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][fntar]'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=65><INPUT ID=fnmin_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][fnmin]'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=65><INPUT ID=frtar_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][frtar]'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=65><INPUT ID=frmin_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][frmin]'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=65><INPUT ID=fctar_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][fctar]'>&nbsp</TD>";
                    echo "  <TD align=right WIDTH=65><INPUT ID=fcmin_$i Class=field TYPE='BUTTON' NAME='conceptos[$i][fcmin]'>&nbsp</TD>";
                    echo "  <INPUT ID=fidmn_$i TYPE='HIDDEN' NAME='conceptos[$i][fidmn]'>";

             echo "isset Conceptos...:".isset($conceptos)."<br\>";
             echo "isset boton...:".isset($boton)."<br\>";
             while (list ($clave_0, $val_0) = each ($conceptos)) {
                echo "$clave_0 => $val_0<br>";
                while (list ($clave_1, $val_1) = each ($val_0)) {
                    echo "$clave_1 => $val_1<br>";
                    }
             }



if (!$rs->Open("select ca_idcliente, ca_compania from tb_clientes")) {                  // Selecciona todos lo registros de la tabla Trasportistas
    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
    echo "<script>document.location.href = 'entrada.php';</script>";
    exit; }

$arr_ids = array();
$arr_nam = array();
$arr_lib = array();
while (!$rs->Eof() and !$rs->IsEmpty()) {
    array_push($arr_ids,$rs->Value('ca_idcliente'));
    array_push($arr_nam,$rs->Value('ca_compania'));
    $rs->MoveNext();
}

if (!$rs->Open("select ca_cliente from tb_liberaciones")) {                // Selecciona todos lo registros de la tabla Trasportistas
    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
    echo "<script>document.location.href = 'entrada.php';</script>";
    exit; }
while (!$rs->Eof() and !$rs->IsEmpty()) {
    array_push($arr_lib,$rs->Value('ca_cliente'));
    $rs->MoveNext();
}
set_time_limit(360);
while (list ($clave, $val) = each ($arr_lib)) {
    $distancia_mas_corta = 0;
    $posicion = -1;
    reset($arr_nam);
    while (list ($clave_1, $val_1) = each ($arr_nam)) {
      $lev = similar_text($val, $val_1);
      if ($lev >= $distancia_mas_corta) {
          if (eregi($val, $val_1) or eregi($val_1, $val)){
              $posicion = $clave_1;
              $distancia_mas_corta = $lev;
          }else {
              if (strlen($val) < strlen($val_1)){
                  $p = searchs($val, $val_1);
              }else{
                  $p = searchs($val_1, $val);
              }
              if ($p > $distancia_mas_corta){
                  $posicion = $clave_1;
                  $distancia_mas_corta = $p;
              }
          }
        }
    }
    echo "$lev; $val; ".$arr_ids[$posicion]."; ".$arr_nam[$posicion]."<br>";
}


function searchs($source, $target){
    $same = 0;
    foreach(explode(" ",$source) as $key=>$expression){
//      echo "<BR> * ".$expression." - ".$target;
//      $pos = stripos($expression, $target);
        $pos = stripos ($target, $expression);
//      echo " | Pos $pos Long ".strlen($expression)." <BR>";
        if ($pos>0){
            $same+= strlen(trim($expression));
        }
    }
    return $same;   
}


        case 'Nueva Versión': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_reportes (ca_fchreporte, ca_consecutivo, ca_version, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente, ca_incoterms, ca_mercancia_desc, ca_idproveedor, ca_orden_prov, ca_idconsignatario, ca_orden_cons, ca_confirmar_cons, ca_idrepresentante, ca_informar_repr, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito, ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_login, ca_fchcreado, ca_usucreado) values('$fchreporte', '$consecutivo', (select (case when max(ca_version) <> 0 then max(ca_version)+1 else 1 end) as ca_version from tb_reportes where ca_idreporte = $id), $idcotizacion, '$idciuorigen', '$idciudestino', '$impoexpo', '$fchdespacho', $idagente, '$incoterms', '".AddSlashes($mercancia_desc)."', $idproveedor, '$orden_pro', $idconsignatario, '$orden_cons', '$confirmar', $idrepresentante, '$informar_repr', '$transporte', '$modalidad', '$colmas', '$seguro', '$liberacion', '$tiempocredito', '$preferencias_clie', '$instrucciones', $idlinea, $idconsignar, $idbodega, '$mastersame', '$continuacion', '$continuacion_dest', '$continuacion_conf', '$login', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'reportenegocio.php';</script>";
                 exit;
                }
             if (!$rs->Open("select last_value from tb_reportes_id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'reportenegocio.php';</script>";
                 exit;
                }
             $id = $rs->Value('last_value');
             break;
             }



$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");

str_replace("\"","'",$casos)

$back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" ");
$back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;


//             echo "function validacion(){";
//             echo "  frame = document.getElementById('findreporte_frame');";
//             echo "  idreporte = document.adicionar.idreporte.value;";
//             echo "  frame.src='ventanas.php?opcion=find_reporte&idreporte='+idreporte;";
//             echo "}";

//             echo "<DIV ID='findreporte' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
//             echo "  <IFRAME ID='findreporte_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
//             echo "  </IFRAME>";
//             echo "</DIV>";


       if ( $rs->Value('ca_fchllegada')== '' or $rs->Value('ca_fchfactura')== '' ){
	       $dif_mem = 0;
	   }else if ($rs->Value('ca_fchfactura') >= $rs->Value('ca_fchllegada')){
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchllegada'), "%d-%d-%d");
		   $tstamp_llegado = mktime(8, 0, 0, $mes, $dia, $ano);
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchfactura'), "%d-%d-%d");
		   $tstamp_confirm = mktime(17, 0, 0, $mes, $dia, $ano);
	       $dif_mem = calc_dif($festi, $tstamp_llegado, $tstamp_confirm);
	       $dif_mem = floor($dif_mem / (60 * 60 * 8));
	   }else{
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchllegada'), "%d-%d-%d");
		   $tstamp_llegado = mktime(17, 0, 0, $mes, $dia, $ano);
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchfactura'), "%d-%d-%d");
		   $tstamp_confirm = mktime(8, 0, 0, $mes, $dia, $ano);
	       $dif_mem = calc_dif($festi, $tstamp_confirm, $tstamp_llegado);
	       $dif_mem = floor($dif_mem / (60 * 60 * 8));
		   $dif_mem = $dif_mem * -1;
	   }


   $tstamp_llegado = mktime(8, 0, 0, 5, 7, 2007);
   $tstamp_confirm = mktime(17, 0, 0, 5, 18, 2007);
   $dif_mem = calc_dif($festi, $tstamp_llegado, $tstamp_confirm);
   echo $dif_mem;
   $dif_mem = round($dif_mem / (60 * 60 * 9),4);
   echo $dif_mem;


             echo "  <TD Class=mostrar>6. Incoterms:<BR><SELECT ID=incoterms NAME='incoterms'>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <OPTION VALUE='".$tincoterms[$i]."'>".$tincoterms[$i]."</OPTION>";
                  }
             echo "  </SELECT></TD>";



             echo "  <TD Class=mostrar>6. Incoterms:<BR><SELECT ID=incoterms NAME='incoterms'>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <OPTION VALUE='".$tincoterms[$i]."'";
                  if ($rs->Value('ca_incoterms')==$tincoterms[$i]) {
                      echo " SELECTED"; }
                  echo ">".$tincoterms[$i]."</OPTION>";
                  }
             echo "  </SELECT></TD>";
             echo "  </TABLE></TD>";

     echo "    <TD Class=mostrar><B>6. Incoterms:</B><BR>".$rs->Value('ca_incoterms')."</TD>";



	$vista_1 = ($nivel >= 0)?'visible':'hidden'; 					// Habilita la opción para creación de reportes AG
	echo "		<TD><IMG src='./graficos/new_ag.gif' alt='Crear Reporte AG' border=0 onclick='elegir(\"Reporte_Ag\", 0, 0);' style='visibility: $vista_1;'></TH></TD>";  // Botón para la creación de un Registro Nuevo
*/


	if (!$rs->Open("select ca_idreporte, ca_consecutivo, ca_idproveedor, ca_incoterms from tb_reportes order by ca_idreporte")) {                       // Selecciona todos lo registros AG de la tabla Reportes
		echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		echo "<script>document.location.href = 'entrada.php';</script>";
		exit; }
	$tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

    echo "<table width=100% border=1>";
	while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
		$array_prov = explode("|",$rs->Value('ca_idproveedor'));
		$array_inco = explode("|",$rs->Value('ca_incoterms'));
		if ((count($array_prov) == count($array_inco)) or (!is_array($array_prov) and !is_array($array_inco))){
			$rs->MoveNext();
			continue;
		}

		$flag = $array_inco[0];
		$resp = true;
		while (list ($clave, $val) = each ($array_inco)) {
			if ($val != $flag){
				$resp = false;
			}
		}
		if ($resp){
			$array_inco = array_fill(0, count($array_prov), $flag);
//			echo "update tb_reportes set ca_incoterms = '".implode("|",$array_inco)."' where ca_idreporte = ".$rs->Value('ca_idreporte').";<br/>";
		}

		echo "<tr>";
		echo "	<td>".count($array_prov)."</td>";
		echo "	<td>".count($array_inco)."</td>";
		echo "	<td>".$rs->Value('ca_idreporte')."</td>";
		echo "	<td>".$rs->Value('ca_consecutivo')."</td>";
		echo "	<td>".$rs->Value('ca_idproveedor')."</td>";
		echo "	<td>".$rs->Value('ca_incoterms')."</td>";
		echo "	<td>".implode("|",$array_inco)."</td>";
		echo "</tr>";

		$rs->MoveNext();
	}
    echo "</table>";
/*


?>
