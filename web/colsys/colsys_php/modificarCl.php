<?
    $sql= "select * from vi_inoclientes_sea where ca_idinocliente = '" . $idinocliente . "' ";
    if (!$rs->Open($sql)) {    // Mueve el apuntador al registro que se desea modificar
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php?id=5-m';</script>";
        exit;
    }
    $id=$rs->Value('ca_referencia');
    $us = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$us->Open("select ca_impoexpo, ca_modalidad, ca_mbls,ca_fchmbls from tb_inomaestra_sea where ca_referencia = '$id'")) {
        echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'entrada.php?id=12-m';</script>";
        exit;
    }
    $impoexpo = $us->Value('ca_impoexpo');
    $modalidad = $us->Value('ca_modalidad');
    $mbls[] = $us->Value('ca_mbls');
    $mbls[] = $us->Value('ca_fchmbls');
    if (!$us->Open("select ca_valor from tb_parametros where ca_casouso = 'CU041'")) {
        echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'entrada.php?id=2069';</script>";
        exit;
    }
    $observaciones = array();
    $us->MoveFirst();
    while (!$us->Eof()) {
        array_push($observaciones, $us->Value('ca_valor'));
        $us->MoveNext();
    }
    $de = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$de->Open("select d.ca_iddeduccion, d.ca_deduccion from tb_deducciones d, tb_inomaestra_sea i where d.ca_habilitado = 't' and d.ca_transporte = 'Marítimo' and d.ca_impoexpo = 'Importación' and d.ca_modalidad = i.ca_modalidad and i.ca_referencia = '$id'")) {
        echo "<script>alert(\"" . addslashes($de->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'entrada.php?id=2081';</script>";
        exit;
    }
    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $dd = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    $sql="select idd.oid as ca_oid, i.ca_factura, ca_iddeduccion, idd.ca_neto, idd.ca_valor, idd.ca_idinoingreso
        from tb_inodeduccion_sea idd
        inner join tb_inoingresos_sea i on i.ca_idinoingreso = idd.ca_idinoingreso 
        where i.ca_idinocliente  = '" . $rs->Value('ca_idinocliente') . "' ";

    if (!$dd->Open($sql)) {
        echo $sql;
        //<script>document.location.href = 'entrada.php?id=2093';</script>";
        exit;
    }
?>
    <HEAD>
    <TITLE><?=$titulo?></TITLE>
    <script language='JavaScript' type='text/JavaScript'>
    function validar(){;
      if (document.modificar.consecutivo.value == '' && document.modificar.vigencia.value == 'true' && document.modificar.impoexpo.value != 'OTM/DTA' && document.modificar.modalidad.value != 'PARTICULARES')
          alert('El Número de Reporte de Negocio no es válido');
      else if (document.modificar.hbls.value == '')
          alert('El Número de HBL no es válido');
      else if (document.modificar.fchhbls.value == '' || document.modificar.fchhbls.value.length < 10)
          alert('Ingrese la Fecha del Hbl, tenga en cuenta que debería ser la misma Fecha del Master.');
      else if (document.modificar.numpiezas.value == '' || document.modificar.numpiezas.value < 0)
          alert('El número de piezas no es válido');
      else if (document.modificar.peso.value == '' || document.modificar.peso.value <= 0)
          alert('El peso no es una cantidad válida');
      else if (document.modificar.volumen.value == '' || document.modificar.volumen.value <= 0)
          alert('El volumen no es una cantidad válida');
      else if (document.modificar.numorden.value == '')
          alert('Debe ingresar el número de Orden del Cliente');
      else if (document.modificar.login.value == '')
          alert('Debe seleccionar el nombre del Vendedor');
      /*else if (!eval(document.modificar.validado.value))
          alert('El peso o el volumen registrado superan la capacidad de carga total de la referencia. Ingrese nuevamente el volumen en M³ y el peso en Kilos. Si se trata de un LCL asegúrese de haber registrado en la master la cantidad de metros cúbicos y no el peso de mercancia en el concepto T/M3. '+document.modificar.explicacion.value);*/
      else{
          respuesta = true;
          elementos = document.getElementById('num_reg');
          for (cont=0; cont<elementos.value; cont++) {
               elemento = document.getElementById('factura_' + cont);
               if (elemento.value == ''){
                   continue;
                  }
               elemento = document.getElementById('fchfactura_' + cont);
               if (!chkDate(elemento)){
                   elemento.focus();
                   respuesta = false;
                   break;
                  }
               elemento = document.getElementById('valor_' + cont);
               if (elemento.value == ''){
                   alert('Debe ingresar el Valor de la Factura del Cliente');
                   elemento.focus();
                   respuesta = false;
                   break;
                  }
               elemento = document.getElementById('tcambio_' + cont);
               if (elemento.value == ''){
                   alert('Debe ingresar la Tasa de Cambio de la Factura');
                   elemento.focus();
                   respuesta = false;
                   break;
                  }
              }
          i = 0;
          pz = 0;
          ps = 0;
          while (isNaN(document.getElementById('contenedor_'+i+'_id'))) {
              if (document.getElementById('contenedor_'+i+'_id').checked) {
                pz+= parseFloat(document.getElementById('contenedor_'+i+'_pz').value);
                ps+= parseFloat(document.getElementById('contenedor_'+i+'_ps').value);
              }
              i++;
          }
          if ((document.getElementById('numpiezas').value != roundNumber(pz,2) || document.getElementById('peso').value != roundNumber(ps,2)) && '<?=$modalidad?>' != 'COLOADING' && '<?=$modalidad?>' != 'PROYECTOS' && '<?=$modalidad?>' != 'PARTICULARES' && '<?=$impoexpo?>' != 'OTM/DTA'){
                   alert('Hay inconsistencia entre el Piezas/Peso y el desgloce en Contenedores');
                   respuesta = false;
              }
          if (respuesta){
            document.getElementById('continuacion_dest').disabled = false;
            document.getElementById('idbodega').disabled = false;
            document.getElementById('login').disabled = false;
            }
          return (respuesta);
          }
      return (false);
    }
    function roundNumber(rnum, rlength) {
      var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);
      return newnumber;
    }
    function llenar_select(){
      facturas  = document.getElementById('num_reg');
      elementos = document.getElementById('num_ded');
      for (cont=0; cont<elementos.value; cont++) {
           elemento = document.getElementById('dedfactura_' + cont);
           indice = elemento.selectedIndex;
           elemento.length=0;
           elemento.options[elemento.length] = new Option();
           elemento.length=0;
           for (numb=0; numb<facturas.value; numb++) {
                fuente = document.getElementById('factura_' + numb);
                opcion = (numb == indice) ? true : false;
                if (fuente.value == '')continue;
                elemento[elemento.length] = new Option(fuente.value,fuente.value,opcion,opcion);
               }
          }
    }
    function buscar_reporte(){
      idcliente = 0;
      consecutivo = document.modificar.consecutivo.value;
      referencia = document.modificar.referencia.value;
      ventana = 'findreporte';
      frame = document.getElementById(ventana + '_frame');
      frame.style.height = document.body.clientHeight-16;
      ventana = document.getElementById(ventana);
      ventana.style.visibility = "visible";
      ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );
      alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );
      ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));
      frame.src='findreporte.php?opcion=find_reporte\&accion=Marítimo'+'\&consecutivo='+consecutivo+'\&referencia='+referencia;
    }
    function asignar(){
      for (cont=0; cont<document.modificar.login.length; cont++) {
           if (document.modificar.vendedor.value == document.modificar.login[cont].value){
               document.modificar.login[cont].selected = true;
           }else if (document.modificar.vendedor.value == '' && document.modificar.login[cont].value == 'Comercial'){
               document.modificar.login[cont].selected = true;
           }
      }
    }
    function valida_cantidades(){
      frame = document.getElementById('findreporte_frame');
      referencia = document.getElementById('referencia').value;
      peso = document.getElementById('peso').value - document.getElementById('peso_ant').value;
      volumen = document.getElementById('volumen').value - document.getElementById('volumen_ant').value;
      frame.src='ventanas.php?opcion=valida_cantidades&referencia='+referencia+'&peso='+peso+'&volumen='+volumen;
      if (document.getElementById('consecutivo').value == ''){
            document.getElementById('login').disabled = false }
    }
    function cambiar(element){
            if(element)
            {
                if(element.value != 'N/A'){
                    document.getElementById('continuacion_dest').disabled = false;
                }else{
                    document.getElementById('idbodega')[0].selected = true;
                    document.getElementById('continuacion_dest')[0].selected = true;
                    document.getElementById('continuacion_dest').disabled = true;
                }
            }
    }
    function pesosCalc(element){
            if(element)
            {
                index = element.id.substring(element.id.indexOf('_')+1);
                neto = document.getElementById('neto_'+index);
                tcamb = document.getElementById('tcambio_'+index);
                valor = document.getElementById('valor_'+index);
                valor.value = Math.round(eval(neto.value) * eval(tcamb.value))
            }
        }

    function aplica_trm(element){
    if(element){
        //alert(element.id);
        
      i = 0;
      index = element.id.substring(element.id.indexOf('_')+1);
      //alert(index);
      //alert('dedfactura_'+index);
      //alert('idinoingreso_'+index);
      factura = document.getElementById('dedfactura_'+index);
      //alert(factura.value);
      while (isNaN(document.getElementById('factura_'+i))) {
         if (document.getElementById('factura_'+i).value == factura.value){
             tcambio = document.getElementById('tcambio_'+i).value;
         }
         i++;
      }
      document.getElementById('deduccion_'+index).value = document.getElementById('dedneto_'+index).value * tcambio;
    }
    }
    function borrar_deduccion(element){
    if(element){
      index = element.id.substring(element.id.indexOf('_')+1);
      document.getElementById('dedneto_'+index).value = '';
      document.getElementById('deduccion_'+index).value = '';
    }
    }
    function seldetails(element){
      index = element.id.substring(element.id.indexOf('_')+1);
      index = index.substring(0,index.indexOf('_'));
      if(element.checked){
        document.getElementById('contenedor_'+index+'_pz').style.display = 'block';
        document.getElementById('contenedor_'+index+'_ps').style.display = 'block';
        document.getElementById('contenedor_'+index+'_vo').style.display = 'block';
      }else{
        document.getElementById('contenedor_'+index+'_pz').style.display = 'none';
        document.getElementById('contenedor_'+index+'_ps').style.display = 'none';
        document.getElementById('contenedor_'+index+'_vo').style.display = 'none';
      }
    }
    </script>
    <script language='javascript' src='javascripts/popcalendar.js'></script>
    
    </HEAD>

    <BODY>
        <STYLE>@import URL("Coltrans.css");</STYLE>
    <? require_once("menu.php"); ?>
    <DIV ID='findreporte' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>
      <IFRAME ID='findreporte_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'></IFRAME>
    </DIV>
    <? list($mod, $tra, $mes, $con, $ano) = sscanf($id, "%d.%d.%d.%d.%d"); ?>    
    <CENTER>
    <H3><?=$titulo?></H3>
    <FORM METHOD=post NAME='modificar' ACTION='inosea.php' ONSUBMIT='return validar();'>
    <TABLE WIDTH=550 CELLSPACING=1>
    <INPUT TYPE='HIDDEN' NAME='oid' id='oid' VALUE="<?= $rs->Value('ca_oid')?>">
    <INPUT TYPE='HIDDEN' NAME='idinocliente' id='idinocliente' VALUE="<?=$rs->Value('ca_idinocliente')?>">
    <INPUT TYPE='HIDDEN' NAME='referencia' id='referencia' VALUE="<?= $id ?>">
    <INPUT TYPE='HIDDEN' NAME='impoexpo' id='impoexpo' VALUE="<? $impoexpo ?>">
    <INPUT TYPE='HIDDEN' NAME='vigencia' id='vigencia' VALUE="<?=((mktime(0, 0, 0, $mes, 1, $ano) >= mktime(0, 0, 0, 4, 1, 2008)) ? 'true' : 'false') ?>">
    <INPUT TYPE='HIDDEN' NAME='hbl' id='hbl' VALUE="<?=$rs->Value('ca_hbls') ?>">
    <INPUT TYPE='HIDDEN' NAME='peso_ant' id='peso_ant' VALUE="<?= $rs->Value('ca_peso') ?>">
    <INPUT TYPE='HIDDEN' NAME='volumen_ant' id='volumen_ant' VALUE="<?= $rs->Value('ca_volumen') ?>">
    <INPUT TYPE='HIDDEN' NAME='idcliente' id='idcliente' VALUE="<?= $rs->Value('ca_idcliente') ?>">
    <INPUT TYPE='HIDDEN' NAME='idreporte' id='idreporte' VALUE="<?= $rs->Value('ca_idreporte') ?>">
    <INPUT TYPE='HIDDEN' NAME='validado' id='validado'>
    <INPUT TYPE='HIDDEN' NAME='explicacion' id='explicacion'>
    <TH Class=titulo COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><?=$id?><BR>Información del Cliente</TH>
    <TR>
      <TD Class=mostrar>ID Reporte:<BR><INPUT TYPE='TEXT' NAME='consecutivo' id='consecutivo' VALUE='<?= $rs->Value('ca_consecutivo') ?>' SIZE=12 MAXLENGTH=10 READONLY>&nbsp;<a><IMG ID=report_lupa src='graficos/lupa.gif' onclick='buscar_reporte();' alt='Buscar' hspace='0' vspace='0'></a></TD>
      <TD Class=listar>Vendedor: <?=$rs->Value('ca_login')?> <BR>
          <SELECT NAME='login' id=login no-change >
            <OPTION VALUE=''></OPTION>
            <?
    if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Regional' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
        echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'entrada.php?id=2315';</script>";
        exit;
    }
    $us->MoveFirst();
    while (!$us->Eof()) {
        ?>
            <option value='<?= $us->Value('ca_login')?>' <?=($rs->Value('ca_login') == $us->Value('ca_login'))?"selected":"" ?>> <?=$us->Value('ca_nombre')?></option>
        <?
        $us->MoveNext();
    }
    $tmp = & DlRecordset::NewRecordset($conn);
    $sql = "select ca_propiedades from tb_clientes where ca_idcliente = " . $rs->Value('ca_idcliente');
    $tmp->Open($sql);
    $img = "";

    if ($tmp->Value('ca_propiedades') != "") {
        if (strpos($tmp->Value('ca_propiedades'), "cuentaglobal=true") !== false) {
            $img = '<img src="/images/CG30.png" title="Cliente de Cuentas Globales" />';
        }
    }
    ?>
      </SELECT></TD>
      <TD Class=mostrar>ID Proveedor:<BR><INPUT TYPE='TEXT' NAME='idproveedor' VALUE='<?=$rs->Value('ca_idproveedor') ?>' SIZE=10 MAXLENGTH=8></TD>
      <TD Class=mostrar COLSPAN=2>Proveedor:<BR><INPUT TYPE='TEXT' NAME='proveedor' VALUE='<?= $rs->Value('ca_proveedor') ?>' SIZE=40 MAXLENGTH=50></TD>
    </TR>
    <TR>
      <TD Class=mostrar style='vertical-align:bottom'>Id Cliente:<BR><INPUT TYPE='TEXT' NAME='idalterno' VALUE='<?= $rs->Value('ca_idalterno') ?>' SIZE=11 MAXLENGTH=9 READONLY></TD>
      <TD Class=mostrar COLSPAN=3>Nombre del Cliente:<BR><INPUT TYPE='TEXT' READONLY NAME='cliente' VALUE='<?= $rs->Value('ca_compania') ?>' SIZE=60 MAXLENGTH=60 READONLY></TD>
      <TD Class=mostrar>Orden Cliente No.<BR><INPUT TYPE='TEXT' NAME='numorden' VALUE='<?=$rs->Value('ca_numorden') ?>' SIZE=17 MAXLENGTH=100></TD>
    </TR>
    <?
    $fchhbls = date("Y-m-d");
    if (strlen($rs->Value('ca_fchhbls')) != 0) {
        $fchhbls = $rs->Value('ca_fchhbls');
    }
    if (strlen($mbls[1]) != 0 and $fchhbls > $mbls[1]) {
        $fchhbls = $mbls[1];
    }
    ?>
    <TR>
     <TD Class=invertir COLSPAN=2>
      <TABLE WIDTH=100% CELLSPACING=1>
      <TR>
        <TD Class=mostrar COLSPAN=3>
          <TABLE WIDTH=100% CELLSPACING=1>
          <TR>
              <TD Class=mostrar>HBL:<BR><INPUT TYPE='TEXT' NAME='hbls' VALUE='<?= $rs->Value('ca_hbls') ?>' SIZE=25 MAXLENGTH=25></TD>
              <TD Class=mostrar>Fch.HBL<BR><INPUT TYPE='TEXT' NAME='fchhbls' SIZE=12 VALUE='<?=$fchhbls?>' ONKEYDOWN="chkDate(this)" ONDBLCLICK="popUpCalendar(this, this, 'yyyy-mm-dd')"></TD>
              <TD Class=mostrar>Hbl Dest.<BR><CENTER><INPUT TYPE='CHECKBOX' NAME='imprimirorigen' VALUE='Sí' <?= (($rs->Value('ca_imprimirorigen') == 't') ? "CHECKED" : "") ?>></CENTER></TD>
          </TR>
          </TABLE>
        </TD>
      </TR>
      <TR>
        <TD Class=mostrar COLSPAN=2></TD>
        <TD Class=mostrar></TD>
      </TR>
      <TR>
        <TD Class=mostrar>No.Piezas:<BR><INPUT ID='numpiezas' TYPE='TEXT' NAME='numpiezas' VALUE='<?= $rs->Value('ca_numpiezas') ?>' SIZE=6 MAXLENGTH=6></TD>
        <TD Class=mostrar>No.Kilos:<BR><INPUT TYPE='TEXT' NAME='peso' id='peso' VALUE='<?= $rs->Value('ca_peso') ?>' SIZE=9 MAXLENGTH=9 ONCHANGE='valida_cantidades();'></TD>
        <TD Class=mostrar>No.CMB:<BR><INPUT TYPE='TEXT' NAME='volumen' id='volumen' VALUE='<?= $rs->Value('ca_volumen') ?>' SIZE=13 MAXLENGTH=15 ONCHANGE='valida_cantidades();'></TD>
      </TR>

      <TR>
      <TD Class=mostrar>Continua/Viaje:<BR><SELECT NAME='continuacion' ONCHANGE='cambiar(this);'>
      <?
    for ($i = 0; $i < count($continuaciones); $i++) {
         echo "<OPTION VALUE=" . $continuaciones[$i];
        if ($rs->Value('ca_continuacion') == $continuaciones[$i]) {
             echo "  SELECTED";
        }
        echo">" . $continuaciones[$i] . "</OPTION>";
    }
    ?>
      </SELECT></TD>
      <?
    if (!$us->Open("select ca_nombre, ca_idciudad, ca_ciudad from vi_ciudades where ca_puerto not in ('Ninguno') order by ca_nombre")) {
        echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'entrada.php?id=2390';</script>";
        exit;
    }
    $us->MoveFirst();
      echo "<TD Class=mostrar COLSPAN=2>Destino Final:<BR><SELECT NAME='continuacion_dest' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo"<OPTION VALUE=''></OPTION>";
    $nam_tmp = null;
    while (!$us->Eof()) {
        if ($nam_tmp != $us->Value('ca_nombre')) {
            echo "<optgroup label='" . $us->Value('ca_nombre') . "'>";
            $nam_tmp = $us->Value('ca_nombre');
        }
        echo"<OPTION VALUE=" . $us->Value('ca_idciudad');
        if ($rs->Value('ca_continuacion_dest') == $us->Value('ca_idciudad')) {
             echo " SELECTED";
        }
        echo">" . $us->Value('ca_ciudad') . "</OPTION>";
        $us->MoveNext();
    }
    ?>
      </SELECT></TD>
      </TR>
      <TR>
    <?
    if (!$us->Open("select ca_idbodega, ca_nombre from tb_bodegas where ca_transporte = 'Marítimo' and ca_tipo = 'Operador Multimodal'")) {
        echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'entrada.php?id=2414';</script>";
        exit;
    }
    $us->MoveFirst();
      echo "<TD Class=mostrar COLSPAN=5>Operador:<BR><SELECT NAME='idbodega' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo"<OPTION VALUE=''></OPTION>";
    while (!$us->Eof()) {
        echo"<OPTION VALUE=" . $us->Value('ca_idbodega');
        if ($rs->Value('ca_idbodega') == $us->Value('ca_idbodega')) {
             echo " SELECTED";
        }
        echo">" . substr($us->Value('ca_nombre'), 0, strpos($us->Value('ca_nombre'), ' Nit.')) . "</OPTION>";
        $us->MoveNext();
    }
    ?>
      </SELECT></TD>
      <script>cambiar(document.getElementById('continuacion'));</script>
      </TR>
      <TR>
        <TD COLSPAN=5>Fecha Recibo Antecedentes:&nbsp;<INPUT TYPE='TEXT' NAME='fchantecedentes' SIZE=12 VALUE='<?= $rs->Value('ca_fchantecedentes') ?>' READONLY></TD>
      </TR>
      </TABLE>
     </TD>
     <TD Class=invertir COLSPAN=3>
     <?
    $co = & DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '$id' and ca_idconcepto != 9")) {       // Selecciona todos lo registros de la tabla Equiposde una referencia Ino-Marítimo
        echo "<script>alert(\"" . addslashes($co->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php?id=2436';</script>";
        exit;
    }
    ?>
      <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>
      <TH>Chk</TH>
      <TH>Concepto</TH>
      <TH>Id Equipo</TH>
      <TH>No.Precinto</TH>
      <TH>Piezas</TH>
      <TH>Kilos</TH>
      <?
    $array_cont = array();
    foreach (explode("|", $rs->Value('ca_contenedores')) as $parcial) {
        $sub_array = explode(";", $parcial);
        $array_cont[$sub_array[0]]['pz'] = $sub_array[1];
        $array_cont[$sub_array[0]]['ps'] = $sub_array[2];
    }
    $i = 0;
    while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $cadena = (array_key_exists($co->Value('ca_idequipo'), $array_cont)) ? " CHECKED" : "";
        $vista = ($cadena == "") ? "style='display: none'" : "";
        ?>
        <TR>
          <TD Class=listar><INPUT ID='contenedor_<?= $i?>_id' TYPE='CHECKBOX' NAME='contenedores[<?=$i?>][id]' VALUE='<?= $co->Value('ca_idequipo') ?>' ONCLICK='seldetails(this);'<?=$cadena?> ></TD>
          <TD Class=listar><?= $co->Value('ca_concepto') ?></TD>
          <TD Class=listar><?= $co->Value('ca_idequipo') ?></TD>
          <TD Class=listar><?= $co->Value('ca_numprecinto') ?></TD>
          <TD Class=listar><INPUT ID='contenedor_<?= $i ?>_pz' TYPE='TEXT' NAME='contenedores[<?=$i?>][pz]' VALUE='<?= $array_cont[$co->Value('ca_idequipo')]['pz'] ?>' SIZE=3 MAXLENGTH=6 <?=$vista ?> ></TD>
          <TD Class=listar><INPUT ID='contenedor_<?= $i ?>_ps' TYPE='TEXT' NAME='contenedores[<?=$i?>][ps]' VALUE='<?= $array_cont[$co->Value('ca_idequipo')]['ps'] ?>' SIZE=3 MAXLENGTH=10 <?=$vista ?> ></TD>
        </TR>
    <?
        $co->MoveNext();
        $i++;
    }
    ?>
      </TABLE>
     </TD>
    </TR>
    <TR>
      <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><TABLE CELLSPACING=1 WIDTH=505>
    <TR>
      <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Datos de Facturación del Cliente</B></TD>
    </TR>
    <?
    $i = 0;
    $num_reg = $rs->mRowCount + 1;
    ?>
    <INPUT ID=num_reg TYPE='HIDDEN' NAME='num_reg' VALUE="<?= $num_reg ?>">
    <?
    do {
    ?>
        <TR>
          <INPUT ID=oid_fc_<?=$i?> TYPE='HIDDEN' NAME='facturacion[<?=$i?>][oid_fc]' VALUE="<?=$rs->Value('ca_oid_fc') ?>">
          <INPUT ID="idinoingreso_<?=$i?>" TYPE='HIDDEN' NAME='facturacion[<?=$i?>][idinoingreso]' VALUE="<?=$rs->Value('ca_idinoingreso') ?>">
          <TD Class=mostrar>Factura:<BR><INPUT ID="factura_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][factura]' VALUE='<?= $rs->Value('ca_factura') ?>' SIZE=10 MAXLENGTH=15 ONCHANGE='llenar_select();'></TD>
          <TD Class=mostrar>Fch.Factura:<BR><INPUT ID="fchfactura_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][fchfactura]' VALUE='<?= (($rs->Value('ca_fchfactura') != '') ? $rs->Value('ca_fchfactura') : date("Y-m-d")) ?>' SIZE=12 VALUE='<?= date("Y-m-d") ?>' ONKEYDOWN="chkDate(this)" ONDBLCLICK="popUpCalendar(this, this, 'yyyy-mm-dd')"></TD>
          <TD Class=mostrar>Valor:<BR><INPUT ID="neto_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][neto]' onchange='pesosCalc(this);' VALUE='<?= $rs->Value('ca_neto') ?>' SIZE=8 MAXLENGTH=15></TD>
          <TD Class=mostrar>Moneda:<BR><SELECT ID="moneda_<?=$i?>" NAME='facturacion[<?=$i?>][moneda]'>
        <?
        $idm = (strlen($rs->Value('ca_idmoneda')) != 0) ? $rs->Value('ca_idmoneda') : 'USD';
        $mn->MoveFirst();
        while (!$mn->Eof()) {
            echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == $idm) ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
            $mn->MoveNext();
        }
        ?>
           </SELECT></TD>
          <TD Class=mostrar>T.R.M.:<BR><INPUT ID="tcambio_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][tcambio]' onchange='pesosCalc(this);' VALUE='<?= $rs->Value('ca_tcambio') ?>' SIZE=9 MAXLENGTH=7></TD>
          <TD Class=mostrar>Vlr.Moneda Local:<BR><INPUT ID="valor_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][valor]' VALUE='<?= $rs->Value('ca_valor') ?>' SIZE=12 MAXLENGTH=15></TD>
          <TD Class=mostrar>Observación IDG:<BR><SELECT ID="observacion_<?=$i?>" NAME='facturacion[<?=$i?>][observacion]'>
          <OPTION VALUE=''></OPTION>
          <?
        for ($x = 0; $x < count($observaciones); $x++) {
             echo "<OPTION VALUE='" . $observaciones[$x] . "'";
            if (trim($rs->Value('ca_observaciones_fact')) == $observaciones[$x]) {
                echo" SELECTED";
            }
            echo ">" . $observaciones[$x] . "</OPTION>";
        }
        ?>
          </SELECT></TD>
        </TR>
        <?
        $con_mem = '';
        $rs->MoveNext();
        $i++;
    } while (!$rs->Eof());
    ?>
    <TR>
      <INPUT ID="oid_fc_<?=$i?>" TYPE='HIDDEN' NAME='facturacion[<?$i?>][oid_fc]' VALUE=''>
      <TD Class=mostrar>Factura:<BR><INPUT ID="factura_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][factura]' SIZE=10 MAXLENGTH=15 ONCHANGE='llenar_select()'></TD>
      <TD Class=mostrar>Fch.Factura:<BR><INPUT ID="fchfactura_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][fchfactura]' SIZE=12 VALUE='<?= date("Y-m-d") ?>' ONKEYDOWN="chkDate(this)" ONDBLCLICK="popUpCalendar(this, this, 'yyyy-mm-dd')"></TD>
      <TD Class=mostrar>Valor:<BR><INPUT ID="neto_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][neto]' onchange='pesosCalc(this);' SIZE=8 MAXLENGTH=15></TD>
      <TD Class=mostrar>Moneda:<BR><SELECT ID="moneda_<?=$i?>" NAME='facturacion[<?=$i?>][moneda]'>
    <?
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    ?>
       </SELECT></TD>
      <TD Class=mostrar>T.R.M.:<BR><INPUT ID="tcambio_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][tcambio]' onchange='pesosCalc(this);' SIZE=9 MAXLENGTH=7></TD>
      <TD Class=mostrar>Vlr.Moneda Local:<BR><INPUT ID="valor_<?=$i?>" TYPE='TEXT' NAME='facturacion[<?=$i?>][valor]' onchange='pesosCalc(this);' SIZE=12 MAXLENGTH=15></TD>
      <TD Class=mostrar>Observación IDG:<BR><SELECT ID="observacion_<?=$i?>" NAME='facturacion[<?=$i?>][observacion]'>
      <OPTION VALUE=''></OPTION>
      <?
    for ($x = 0; $x < count($observaciones); $x++) {
         echo "<OPTION VALUE='" . $observaciones[$x] . "'>" . $observaciones[$x] . "</OPTION>";
    }
    ?>
      </SELECT></TD>
    </TR>

      </TABLE></TD>

    </TR>
    <TR HEIGHT=5>
      <TD Class=captura COLSPAN=5></TD>
    </TR>
    <TR>
      <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Conceptos Deducibles de la Factura</B></TD>
    </TR>
    <?
    $j = 0;
    ?>
    <INPUT ID=num_ded TYPE='HIDDEN' NAME='num_ded' VALUE="<?= ($dd->mRowCount + 5) ?>" > 
    <?
    while (!$dd->Eof()) {
    ?>
        <TR>
          <INPUT ID="oid_<?=$j?>" TYPE='HIDDEN' NAME='deducibles[<?=$j?>][oid]' VALUE="<?= $dd->Value('ca_oid')?>">
          <TD Class=mostrar COLSPAN=2>Concepto a Deducir:<BR><SELECT ID=iddeduccion_<?=$j?> NAME='deducibles[<?=$j?>][iddeduccion]'>
    <?              
        $de->MoveFirst();
        while (!$de->Eof()) {
            echo"<OPTION VALUE=" . $de->Value('ca_iddeduccion');
            if ($de->Value('ca_iddeduccion') == $dd->Value('ca_iddeduccion')) {
                 echo " SELECTED";
            }
            echo ">" . $de->Value('ca_deduccion') . "</OPTION>";
            $de->MoveNext();
        }
     ?>
     </SELECT></TD>
     <TD Class=mostrar>Aplicar/Factura:<BR>
         <SELECT ID="dedfactura_<?=$j?>" NAME='deducibles[<?=$j?>][dedfactura]' ONCHANGE='aplica_trm(this);'>
     <?
        $rs->MoveFirst();
        while (!$rs->Eof()) {
            echo"<OPTION VALUE='" . $rs->Value('ca_factura') . "'";
            if ($rs->Value('ca_factura') == $dd->Value('ca_factura')) {
                 echo " SELECTED";
            }
            echo">" . $rs->Value('ca_factura') . "</OPTION>";
            $rs->MoveNext();
        }
          echo "</SELECT></TD>";
          echo "<TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' ID=dedneto_$j NAME='deducibles[$j][dedneto]' VALUE='" . $dd->Value('ca_neto') . "' SIZE=10 MAXLENGTH=15 ONCHANGE='aplica_trm(this);'></TD>";
          echo "<TD Class=mostrar>Vlr.Moneda Local *:<BR><INPUT TYPE='TEXT' ID=deduccion_$j NAME='deducibles[$j][deduccion]' VALUE='" . $dd->Value('ca_valor') . "' SIZE=10 MAXLENGTH=15 ONFOCUS='aplica_trm(this);'>&nbsp;<IMG ID=borrar_$j src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='borrar_deduccion(this)'></TD>";
        echo "</TR>";
        $dd->MoveNext();
        $j++;
    }
    for ($i = $j; $i < $j + 5; $i++) {
        echo "<TR>";
          echo "<INPUT ID=oid_$i TYPE='HIDDEN' NAME='deducibles[$i][oid]' VALUE=''>";
          echo "<TD Class=mostrar COLSPAN=2>Concepto a Deducir:<BR><SELECT ID=iddeduccion_$i NAME='deducibles[$i][iddeduccion]'>";
        $de->MoveFirst();
        while (!$de->Eof()) {
            echo"<OPTION VALUE=" . $de->Value('ca_iddeduccion') . ">" . $de->Value('ca_deduccion') . "</OPTION>";
            $de->MoveNext();
        }
          echo "</SELECT></TD>";
          echo "<TD Class=mostrar>Aplicar/Factura:<BR><SELECT ID=dedfactura_$i NAME='deducibles[$i][dedfactura]' ONCHANGE='aplica_trm(this);'>";
        $rs->MoveFirst();
        while (!$rs->Eof()) {
            echo"<OPTION VALUE='" . $rs->Value('ca_factura') . "'";
            if ($rs->Value('ca_factura') == $dd->Value('ca_factura')) {
                 echo " SELECTED";
            }
            echo">" . $rs->Value('ca_factura') . "</OPTION>";
            $rs->MoveNext();
        }
          echo "</SELECT></TD>";
          echo "<TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' ID=dedneto_$i NAME='deducibles[$i][dedneto]' SIZE=10 MAXLENGTH=15 ONCHANGE='aplica_trm(this);'></TD>";
          echo "<TD Class=mostrar>Vlr.Moneda Local *:<BR><INPUT TYPE='TEXT' ID=deduccion_$i NAME='deducibles[$i][deduccion]' SIZE=10 MAXLENGTH=15 ONFOCUS='aplica_trm(this);'></TD>";
        echo "</TR>";
    }
    ?>
    <TR>
      <TD Class=mostrar COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>* Aplica la misma moneda y TRM de la factura</B></TD>
    </TR>
    </TABLE><BR>
    <script>valida_cantidades();</script>

    <TABLE CELLSPACING=10>
    <TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar Cliente'></TH>
    <TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = "inosea.php?boton=Consultar&id=$id"'></TH>
    <BR>
    </TABLE>
    </FORM>
    </CENTER>

    <? require_once("footer.php");?>
    </BODY>
